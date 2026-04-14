@extends('layouts.main', ['title' => 'Produk'])

@section('title-content')
    <i class="fas fa-box-open mr-2"></i>
    Produk
@endsection

@section('content')
    @if (session('store') == 'success')
        {{-- FIX --}}
        <x-alert type="success">
            <strong>Berhasil dibuat!</strong> Produk berhasil dibuat..
        </x-alert>
    @endif

    @if (session('update') == 'success')
        {{-- FIX --}}
        <x-alert type="success">
            <strong>Berhasil diupdate!</strong> Produk berhasil diupdate.
        </x-alert>
    @endif

    @if (session('destroy') == 'success')
        {{-- FIX --}}
        <x-alert type="success">
            <strong>Berhasil dihapus!</strong> Produk berhasil dihapus.
        </x-alert>
    @endif

    <div class="card card-red card-outline">
        <div class="card-header form-inline">
            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i> Tambah
            </a>
            <form action="?" method="get" class="ml-auto">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" value="<?= request()->search ?>"
                        placeholder="Kode, Nama Produk">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-8">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Produk</th>
                        <th>Diskon</th>
                        <th>Harga Jual</th>
                        <th>BarCode</th>
                        <th>Stok</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $key => $produk)
                        <tr>
                            <td>{{ $produks->firstItem() + $key }}</td>
                            <td>{{ $produk->kode_produk }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->nama_kategori }}</td>
                            <td>{{ $produk->harga_produk }}</td>
                            <td>{{ $produk->diskon }}%</td>
                            <td>{{ $produk->harga }}</td>
                            <td>
                                <img src="https://bwipjs-api.metafloor.com/?bcid=ean13&text={{ $produk->kode_produk }}&scale=2&height=5"
                                    alt="Barcode {{ $produk->kode_produk }}">
                            </td>
                            <td>{{ $produk->stok }}</td>
                            <td class="text-right">
                                <a href="{{ route('produk.edit', ['produk' => $produk->id]) }}"
                                    class="btn btn-xs text-success p-0 mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" data-toggle="modal" data-target="#modalDelete"
                                    data-url="{{ route('produk.destroy', ['produk' => $produk->id]) }}"
                                    class="btn btn-xs text-danger p-0 btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="text-center"> Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $produks->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@push('modals')
    <x-modal-delete />
@endpush
