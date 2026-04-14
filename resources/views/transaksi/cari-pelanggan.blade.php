<form action="" method="get" id="formCariPelanggan">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Nama Pelanggan" id="searchPelanggan">
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
    <tbody id="resultPelanggan"></tbody>
</table>

<input type="hidden" id="id_pelanggan" name="pelanggan_id">
@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('#formCariPelanggan').submit(function(e) {
                e.preventDefault();
                const search = $('#searchPelanggan').val().trim();

                if (search.length >= 3) {
                    fetchCariPelanggan(search);
                }
            });
        });

        function fetchCariPelanggan(search) {
            $.getJSON("/transaksi/pelanggan", {
                search: search
            }, function(response) {
                $('#resultPelanggan').html('');
                response.forEach(item => {
                    const row = `
                    <tr>
                        <td>${item.nama}</td>
                        <td class="text-right">
                            <button type="button" class="btn btn-xs btn-success" onclick="addPelanggan(${item.id}, '${item.nama}')">
                                Pilih
                            </button>
                        </td>
                    </tr>`;
                    $('#resultPelanggan').append(row);
                });
            });
        }

        function addPelanggan(id, nama) {
            $.post("/transaksi/pelanggan", {
                id: id
            }, function(response) {
                $('#id_pelanggan').val(id);
                $('#nama_pelanggan').val(nama);
                fetchCart();
            }, "json");
        }
    </script>
@endpush
