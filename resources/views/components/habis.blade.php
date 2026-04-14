{{-- Modal untuk Produk Habis dari session --}}
@if (session('produk_habis'))
    <div class="modal show" style="display: block; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Habis</h5>
                </div>
                <div class="modal-body">
                    <p>{{ session('produk_habis') }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Tutup</a>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Modal Produk Tidak Ditemukan --}}
<div class="modal fade" id="produkKosongModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Produk Tidak Ada</h5>
            </div>
            <div class="modal-body">
                <p id="pesanProdukKosong"></p>
            </div>
            <div class="modal-footer">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Tutup</a>
            </div>
        </div>
    </div>
</div>
