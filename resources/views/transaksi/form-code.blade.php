<form action="#" class="card card-red card-outline" id="formBarcode">
    <div class="card-body">
        <div class="row">
            <!-- Kamera -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div id="reader" class="border rounded"
                    style="width:100%; max-width:400px; height:130px; overflow:hidden;"></div>
            </div>

            <!-- Input & Pesan -->
            <div class="col-md-6">
                <div class="input-group mb-2" style="padding: 0">
                    <input type="text" class="form-control" id="barcode" placeholder="Kode / Barcode">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger" id="resetBarcode">Clear</button>
                    </div>
                </div>

                <div class="invalid-feedback" id="msgErrorBarcode"></div>
                <div id="msgSuccessBarcode" class="text-success mt-2"></div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
    <script src="{{ asset('js/html5-qrcode.min.js') }}" type="text/javascript"></script>
    <script>
        let scanner, lastResult = "",
            lastScanTime = 0;

        document.addEventListener("DOMContentLoaded", function() {
            scanner = new Html5Qrcode("reader");

            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 150
                },
                formatsToSupport: [
                    Html5QrcodeSupportedFormats.EAN_13,
                    Html5QrcodeSupportedFormats.EAN_8,
                    Html5QrcodeSupportedFormats.UPC_A,
                    Html5QrcodeSupportedFormats.CODE_128
                ]
            };

            scanner.start({
                    facingMode: "environment"
                },
                config,
                function(decodedText) {
                    const now = Date.now();

                    // cek biar ga spam request
                    if (decodedText && (decodedText !== lastResult || (now - lastScanTime) > 2000)) {
                        lastResult = decodedText;
                        lastScanTime = now;

                        console.log("Scan berhasil:", decodedText);
                        $('#barcode').val(decodedText);
                        addItem(decodedText);
                    }
                },
                function(errorMessage) {
                    // error scan diabaikan aja
                }
            ).catch(err => console.error("Init scanner error:", err));
        });

        $(function() {
            // Setup AJAX CSRF
            $.ajaxSetup({
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Tombol clear
            $('#resetBarcode').click(function() {
                $('#barcode').val('').focus();
                $('#msgSuccessBarcode').html('');
                $('#msgErrorBarcode').removeClass('d-block').html('');
                $('#barcode').removeClass('is-invalid');
            });

            // Submit manual
            $('#formBarcode').submit(function(e) {
                e.preventDefault();
                let kode_produk = $('#barcode').val();
                if (kode_produk.length > 0) {
                    addItem(kode_produk);
                }
            });
        });

        // fungsi AJAX
        function addItem(kode_produk) {
            console.log("Kirim ke server:", kode_produk);

            $('#msgErrorBarcode').removeClass('d-block').html('');
            $('#msgSuccessBarcode').html('');
            $('#barcode').removeClass('is-invalid').prop('disabled', true);

            $.post("/cart", {
                'kode_produk': kode_produk
            }, function(response) {
                console.log("Response:", response);
                fetchCart?.();

                $('#msgSuccessBarcode').html(
                    'Produk berhasil ditambahkan: ' + (response.nama_produk ?? kode_produk)
                );
            }, "json").fail(function(error) {
                console.error("Error:", error);
                if (error.status === 422 && error.responseJSON?.errors?.kode_produk?.length) {
                    $('#msgErrorBarcode').addClass('d-block').html(error.responseJSON.errors.kode_produk[0]);
                    $('#barcode').addClass('is-invalid');
                } else {
                    $('#msgErrorBarcode').addClass('d-block').html("Terjadi kesalahan. Coba lagi.");
                }
            }).always(function() {
                $('#barcode').val('').prop('disabled', false).focus();
            });
        }

        function fetchCart() {
            $.get("/cart/refresh", function(html) {
                $('#cart-container').html(html);
            });
        }
    </script>
@endpush
