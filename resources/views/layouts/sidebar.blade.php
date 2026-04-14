<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&display=swap" rel="stylesheet">

<aside class="main-sidebar sidebar-light-red elevation-4">
    <a href="/" class="brand-link">
        <img src="{{ asset('images/lojo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        {{-- <span class="brand-text font-weight-dark">{{ config('app.name') }}</span> --}}
        @php
$appName = config('app.name'); // "LapetShop"
$lapet = substr($appName, 0, 5); // "Lapet"
$shop = substr($appName, 5); // "Shop"
        @endphp
        <span style="filter: drop-shadow(0px 5px 6px rgba(0, 0, 0, 0.45));">
            <span class="brand-text text-danger"
                style="font-family: Fredoka, sans-serif;
  font-optical-sizing: auto;
  font-size: 1.5rem;
  font-weight: 600;
  font-style: normal;
  text-shadow:
        -1px -1px 0 black,
         1px -1px 0 black,
        -1px  1px 0 black,
         1px  1px 0 black;">{{ $lapet }}</span>
            <span class="brand-text"
                style="color:white; font-family: Fredoka, sans-serif;
  font-optical-sizing: auto;
  font-size: 1.5rem;
  font-weight: 600;
  font-style: normal;
  font-variation-settings: width: 100;
  text-shadow:
        -1px -1px 0 black,
         1px -1px 0 black,
        -1px  1px 0 black,
         1px  1px 0 black;  ">{{ $shop }}</span>
        </span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- home --}}
                <x-nav-item title="Home" icon="fas fa-home" :routes="['home']" />
                {{-- transaksi --}}
                <x-nav-item title="Transaksi" icon="fas fa-cash-register" :routes="['transaksi.index', 'transaksi.create', 'transaksi.show']" />
                {{-- produk --}}
                <x-nav-item title="Produk" icon="fas fa-box-open" :routes="['produk.index', 'produk.create', 'produk.edit']" />
                {{-- pelanggan --}}
                <x-nav-item title="Pelanggan" icon="fas fa-users" :routes="['pelanggan.index', 'pelanggan.create', 'pelanggan.edit']" />
                {{-- laporan --}}
                <x-nav-item title="Laporan" icon="fas fa-print" :routes="['laporan.index']" />
                {{-- atmin --}}
                @can('admin')
                    <x-nav-item title="User" icon="fas fa-user-tie" :routes="['user.index', 'user.create', 'user.edit']" />
                    <x-nav-item title="Kategori" icon="fas fa-list" :routes="['kategori.index', 'kategori.create', 'kategori.edit']" />
                    <x-nav-item title="Stok" icon="fas fa-pallet" :routes="['stok.index', 'stok.create']" />
                @endcan
            </ul>
        </nav>
    </div>
</aside>
