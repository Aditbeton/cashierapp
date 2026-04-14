<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetilPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;
use Jackiedo\Cart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $penjualans = Penjualan::join('users', 'users.id', 'penjualans.user_id')
            ->join('pelanggans', 'pelanggans.id', 'penjualans.pelanggan_id')
            ->select('penjualans.*', 'users.nama as nama_kasir', 'pelanggans.nama as nama_pelanggan')
            ->orderBy('id', 'desc')
            ->when($search, function ($q, $search) {
                return $q->where('nomor_transaksi', 'like', "%{$search}%");
            })
            ->paginate();

        if ($search)
            $penjualans->appends(['search' => $search]);

        return view('transaksi.index', [
            'penjualans' => $penjualans
        ]);
    }

    public function create(Request $request)
    {
        return view('transaksi.create', [
            'nama_kasir' => $request->user()->nama,
            'tanggal' => date('d F Y')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cash' => ['required', 'numeric', 'gte:total_bayar']
        ]);

        $user = $request->user();
        $lastPenjualan = Penjualan::orderBy('id', 'desc')->first();

        $cart = Cart::name($user->id);
        $cartDetails = $cart->getDetails();

        $total = (int) $cartDetails->get('total');
        $kembalian = $request->cash - $total;
        $allItems = $cartDetails->get('items');

        $errors = [];

        foreach ($allItems as $key => $value) {
            $item = $allItems->get($key);
            $produk = Produk::find($item->id);

            if (!$produk || $produk->stok < $item->quantity) {
                $errors[] = "'{$produk->nama_produk}'hanya ada '{$produk->stok}'";
            }
        }

        if (count($errors)) {
            return redirect()->back()->with('error', nl2br(implode("\n", $errors)));
        }



        // 🟡 Ambil ID pelanggan dari cart, kalau kosong default ke 1 (Pelanggan Umum)
        $pelangganId = $cart->getExtraInfo('pelanggan.id') ?? 1;

        DB::beginTransaction();

        try {
            $no = $lastPenjualan ? $lastPenjualan->id + 1 : 1;
            $no = sprintf("%04d", $no);

            $penjualan = Penjualan::create([
                'user_id' => $user->id,
                'pelanggan_id' => $pelangganId,
                'nomor_transaksi' => date('Ymd') . $no,
                'tanggal' => now(),
                'total' => $total,
                'tunai' => $request->cash,
                'kembalian' => $kembalian,
                'pajak' => $cartDetails->get('tax_amount'),
                'subtotal' => $cartDetails->get('subtotal')
            ]);

            foreach ($allItems as $key => $value) {
                $item = $allItems->get($key);
                $produk = Produk::find($item->id);

                DetilPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $item->id,
                    'jumlah' => $item->quantity,
                    'harga_produk' => $item->price,
                    'subtotal' => $item->price * $item->quantity,
                ]);

                $produk->update([
                    'stok' => $produk->stok - $item->quantity
                ]);
            }

            $cart->destroy();

            DB::commit();
            return redirect()->route('transaksi.index', ['transaksi' => $penjualan->id])->with('store', 'success');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi gagal disimpan. Silakan coba lagi.');
        }
    }

    public function show(Request $request, Penjualan $transaksi)
    {
        $pelanggan = Pelanggan::find($transaksi->pelanggan_id);
        $user = User::find($transaksi->user_id);
        $detilPenjualan = DetilPenjualan::join('produks', 'produks.id', 'detil_penjualans.produk_id')
            ->select('detil_penjualans.*', 'nama_produk')
            ->where('penjualan_id', $transaksi->id)->get();

        return view('transaksi.invoice', [
            'penjualan' => $transaksi,
            'pelanggan' => $pelanggan,
            'user' => $user,
            'detilPenjualan' => $detilPenjualan
        ]);
    }

    public function destroy(Request $request, Penjualan $transaksi)
    {
        $detilPenjualan = DetilPenjualan::where('penjualan_id', $transaksi->id)->get();

        foreach ($detilPenjualan as $detil) {
            $produk = Produk::find($detil->produk_id);
            if ($produk) {
                $produk->stok += $detil->jumlah;
                $produk->save();
            }
        }

        $transaksi->update([
            'status' => 'batal'
        ]);

        return back()->with('destroy', 'Transaksi berhasil dibatalkan dan stok dikembalikan.');
    }

    public function produk(Request $request)
    {
        $search = $request->search;
        $produks = Produk::select('id', 'kode_produk', 'nama_produk')
            ->when($search, function ($q, $search) {
                return $q->where('nama_produk', 'like', "%{$search}%");
            })
            ->orderBy('nama_produk')
            ->take(15)
            ->get();

        return response()->json($produks);
    }

    public function pelanggan(Request $request)
    {
        $search = $request->search;
        $pelanggans = Pelanggan::select('id', 'nama')
            ->when($search, function ($q, $search) {
                return $q->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->take(15)
            ->get();

        return response()->json($pelanggans);
    }

    public function addPelanggan(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:pelanggans']
        ]);
        $pelanggan = Pelanggan::find($request->id);

        $cart = Cart::name($request->user()->id);

        $cart->setExtraInfo([
            'pelanggan' => [
                'id' => $pelanggan->id,
                'nama' => $pelanggan->nama,
            ]
        ]);

        return response()->json(['message' => 'Berhasil.']);
    }

    public function cetak(Penjualan $transaksi)
    {
        $pelanggan = Pelanggan::find($transaksi->pelanggan_id);
        $user = User::find($transaksi->user_id);
        $detilPenjualan = DetilPenjualan::join('produks', 'produks.id', 'detil_penjualans.produk_id')
            ->select('detil_penjualans.*', 'nama_produk')
            ->where('penjualan_id', $transaksi->id)->get();

        return view('transaksi.cetak', [
            'penjualan' => $transaksi,
            'pelanggan' => $pelanggan,
            'user' => $user,
            'detilPenjualan' => $detilPenjualan
        ]);
    }

    public function addToCart($kode)
    {
        $produk = Produk::where('kode_produk', $kode)->first();

        if (!$produk) {
            return redirect()->back()->with('error', "Produk tidak ditemukan.");
        }

        if ($produk->stok <= 0) {
            return redirect()->back()->with('error', "'{$produk->nama_produk}' habis.");
        }

        $cart = Cart::name(auth()->id());

        $existingItem = collect($cart->getItems())->first(function ($item) use ($produk) {
            return $item->getId() == $produk->id;
        });

        $jumlahDiCart = $existingItem ? $existingItem->getQuantity() : 0;

        if ($jumlahDiCart + 1 > $produk->stok) {
            return redirect()->back()->with('error', "'{$produk->nama_produk}' melebihi stok.");
        }

        $hargaAsli = (int) $produk->harga_produk;
        $diskon = (int) $produk->diskon;
        $hargaSetelahDiskon = $diskon > 0 ? $hargaAsli - ($hargaAsli * $diskon / 100) : $hargaAsli;

        $cart->addItem([
            'id' => $produk->id,
            'title' => $produk->nama_produk,
            'quantity' => 1,
            'price' => $hargaSetelahDiskon,
            'options' => [
                'diskon' => $diskon,
                'harga_produk' => $hargaAsli,
            ]
        ]);

        return redirect()->back()->with('success', "Produk '{$produk->nama_produk}' ditambahkan.");
    }
}
