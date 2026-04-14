{{-- Alert Error (Contoh: 'Pop Mie' habis.) --}}
@if (session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif


@if (session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
@endif

<form action="" method="get" id="formCariProduk">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Nama Produk" id="searchProduk">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">
                Cari
            </button>
        </div>
    </div>
</form>

<table class="table table-sm mt-3">
    <thead>
        <tr>
            <th colspan="2" class="border-0">Hasil Pencarian :</th>
        </tr>
    </thead>
    <tbody id="resultProduk"></tbody>
</table>

@push('scripts')
    <script>

        $(function() {
            $('#formCariProduk').submit(function(e) {
                e.preventDefault();
                const search = $('#searchProduk').val();
                if (search.length >= 3) {
                    fetchCariProduk(search);
                }
            });
        });

        function fetchCariProduk(search) {
            $.getJSON("/transaksi/produk", {
                search: search
            }, function(response) {
                $('#resultProduk').html('');

                if (response.length === 0) {
                    const row =
                        `<tr><td colspan="2" class="text-muted">Produk "${search}" tidak ditemukan.</td></tr>`;
                    $('#resultProduk').append(row);
                    return;
                }

                response.forEach(item => {
                    addResultProduk(item);
                });
            });
        }

        function addResultProduk(item) {
            const {
                nama_produk,
                kode_produk
            } = item;

            const btn = `<a href="/transaksi/add/${kode_produk}" class="btn btn-xs btn-success">Tambah</a>`;

            const row = `<tr>
            <td>${nama_produk}</td>
            <td class="text-right">${btn}</td>
        </tr>`;

            $('#resultProduk').append(row);
        }
    </script>
@endpush
