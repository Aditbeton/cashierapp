<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;
use Jackiedo\Cart\Facades\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = Cart::name($request->user()->id);

        $cart->applyTax([
            'id' => 1,
            'rate' => 10,
            'title' => 'Pajak PPN 10%'
        ]);

        return $cart->getDetails()->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => ['required', 'exists:produks,kode_produk']
        ]);

        $produk = Produk::where('kode_produk', $request->kode_produk)->first();

        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan.'], 422);
        }

        if ($produk->stok <= 0) {
            return response()->json(['error' => "'{$produk->nama_produk}' habis."], 422);
        }

        $cart = Cart::name($request->user()->id);

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

        return response()->json([
            'message' => 'Produk berhasil ditambahkan.',
            'nama_produk' => $produk->nama_produk
        ]);
    }


    /*  public function update(Request $request, $hash)
     {
         $request->validate([
             'qty' => ['required', 'in:-1,1']
         ]);

         $cart = Cart::name($request->user()->id);
         $item = $cart->getItem($hash);

         if (!$item) {
             return abort(404);
         }

         $cart->updateItem($item->getHash(), [
             'quantity' => $item->getQuantity() + $request->qty
         ]);

         return response()->json(['message' => 'Berhasil diupdate.']);
     }
          */

    public function destroy(Request $request, $hash)
    {
        $cart = Cart::name($request->user()->id);
        $cart->removeItem($hash);
        return response()->json(['message' => 'Berhasil dihapus.']);
    }

    public function clear(Request $request)
    {
        $cart = Cart::name($request->user()->id);
        $cart->destroy();

        return back();
    }

    public function update(Request $request, $hash)
    {
        $request->validate([
            'qty' => ['required', 'integer']
        ]);

        $cart = Cart::name($request->user()->id);
        $item = $cart->getItem($hash);

        if (!$item) {
            return abort(404);
        }

        if (in_array($request->qty, [-1, 1])) {
            // Kalau -1 atau +1 → treat increment/decrement
            $newQty = $item->getQuantity() + $request->qty;
        } else {
            // Kalau angka lain → treat sebagai set jumlah final
            $newQty = $request->qty;
        }

        if ($newQty < 1)
            $newQty = 1;

        $cart->updateItem($item->getHash(), [
            'quantity' => $newQty
        ]);

        return response()->json(['message' => 'Berhasil diupdate.']);
    }
    public function refresh(Request $request)
    {
        $cart = Cart::name($request->user()->id);
        return view('transaksi.partials.cart', ['cart' => $cart]);
    }

}
