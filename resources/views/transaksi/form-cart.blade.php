{{-- resources/views/transaksi/create.blade.php --}}
<style>
    /* Hilangkan spinner di Chrome, Safari, Edge */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Hilangkan spinner di Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div class="card card-red card-outline">
    <div class="card-body">
        <h3 class="m-0 text-right">Rp: <span id="totalJumlah">0</span> ,-</h3>
    </div>
</div>

<form action="{{ route('transaksi.store') }}" method="POST" class="card card-red card-outline">
    @csrf
    <div class="card-body">
        <p class="text-right">Tanggal: {{ $tanggal }}</p>

        <div class="row">
            <div class="col">
                <label>Nama Pelanggan</label>
                <input type="text" id="namaPelanggan" class="form-control" value="Umum" readonly>
                <input type="hidden" name="pelanggan_id" id="pelangganId" value="1">
            </div>
            <div class="col">
                <label>Nama Kasir</label>
                <input type="text" class="form-control" value="{{ $nama_kasir }}" disabled>
            </div>
        </div>

        <table class="table table-striped table-hover table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Sub Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="resultCart">
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            </tbody>
        </table>

        <div class="row mt-3">
            <div class="col-2 offset-6">
                <p>Total</p>
                <p>Pajak 10%</p>
                <p>Total Bayar</p>
            </div>
            <div class="col-4 text-right">
                <p id="subtotal">0</p>
                <p id="taxAmount">0</p>
                <p id="total">0</p>
            </div>
        </div>

        <div class="col-6 offset-6">
            <hr class="mt-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Cash</span>
                </div>
                <input type="text" name="cash" class="form-control @error('cash') is-invalid @enderror"
                    placeholder="Jumlah Cash" value="{{ old('cash') }}">
            </div>
            <input type="hidden" name="total_bayar" id="totalBayar" />
            @error('cash')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 form-inline mt-3">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mr-2">Ke Transaksi</a>
            <a href="{{ route('cart.clear') }}" class="btn btn-danger">Kosongkan</a>
            <button type="submit" class="btn btn-success ml-auto">
                <i class="fas fa-money-bill-wave mr-2"></i> Bayar Transaksi
            </button>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        setTimeout(() => $('.alert-danger').fadeOut('slow'), 5000);
        setTimeout(() => $('.alert-success').fadeOut('slow'), 5000);

        $(function() {
            fetchCart();
        });

        // Ambil data cart
        function fetchCart() {
            $.getJSON("/cart", function(response) {
                $('#resultCart').empty();

                const {
                    items = {}, subtotal = 0, tax_amount = 0, total = 0, extra_info = {}
                } = response;

                $('#subtotal').html(rupiah(subtotal));
                $('#taxAmount').html(rupiah(tax_amount));
                $('#total, #totalJumlah').html(rupiah(total));
                $('#totalBayar').val(total);

                if (Object.keys(items).length === 0) {
                    $('#resultCart').html('<tr><td colspan="6" class="text-center">Tidak ada data.</td></tr>');
                } else {
                    for (const key in items) {
                        addRow(items[key]);
                    }
                }

                if (extra_info.pelanggan) {
                    $('#namaPelanggan').val(extra_info.pelanggan.nama ?? 'Pelanggan Umum');
                    $('#pelangganId').val(extra_info.pelanggan.id ?? 1);
                } else {
                    $('#namaPelanggan').val('Pelanggan Umum');
                    $('#pelangganId').val(1);
                }
            });
        }

        // Tambah row cart
        function addRow(item) {
            const {
                hash,
                title,
                quantity,
                total_price,
                options
            } = item;

            const harga_produk = options?.harga_produk ?? 0;
            const diskon = options?.diskon ?? 0;
            const nilai_diskon = diskon > 0 ? `-${diskon}%` : `${diskon}%`;

            const row = `
<tr>
    <td>${title}</td>
    <td>
        <div class="input-group input-group-sm" style="max-width: 120px;">
            <div class="input-group-prepend">
                <button type="button" class="btn btn-primary" onclick="ePut('${hash}', -1)">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
          <input type="number" class="form-control text-center qty-input" value="${quantity}" min="1" id="qty-${hash}">
            <div class="input-group-append">
                <button type="button" class="btn btn-success" onclick="ePut('${hash}', 1)">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </td>
    <td>${rupiah(harga_produk)}</td>
    <td>${nilai_diskon}</td>
    <td>${rupiah(total_price)}</td>
    <td>
        <button type="button" class="btn btn-xs btn-danger" onclick="eDel('${hash}')">
            <i class="fas fa-times"></i>
        </button>
    </td>
</tr>
`;

            $('#resultCart').append(row);

            // update qty manual via Enter
            $(`#qty-${hash}`).on('keypress', function(e) {
                if (e.which === 13) {
                    let qty = parseInt($(this).val());
                    if (isNaN(qty) || qty < 1) qty = 1;

                    $.ajax({
                        type: "PUT",
                        url: '/cart/' + hash,
                        data: {
                            qty: qty
                        },
                        dataType: "json",
                        success: () => fetchCart()
                    });
                }
            });
        }

        function rupiah(number) {
            const val = parseFloat(number);
            if (isNaN(val)) return "0";
            return new Intl.NumberFormat("id-ID").format(val);
        }

        function ePut(hash, qty) {
            $.ajax({
                type: "PUT",
                url: '/cart/' + hash,
                data: {
                    qty: qty
                },
                dataType: "json",
                success: () => fetchCart()
            });
        }

        function eDel(hash) {
            $.ajax({
                type: "DELETE",
                url: '/cart/' + hash,
                dataType: "json",
                success: () => fetchCart()
            });
        }
    </script>
@endpush
