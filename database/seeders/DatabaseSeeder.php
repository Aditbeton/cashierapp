<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::create([
            'nama' => 'Petugas',
            'username' => 'petugas',
            'role' => 'petugas',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Pelanggan::create([
            'nama' => 'UMUM',
            'alamat' => '-',
            'nomor_tlp' => '-',
        ]);

        \App\Models\Kategori::create(['nama_kategori' => 'Kesehatan']);
        \App\Models\Kategori::create(['nama_kategori' => 'Kecantikan']);
        \App\Models\Kategori::create(['nama_kategori' => 'Elektronik']);

        \App\Models\Produk::create([
            'kategori_id' => 1,
            'kode_produk' => '8991002100001',
            'nama_produk' => 'Vitamin C 1000mg',
            'harga' => 75000,
            'harga_produk' => 75000,
            'stok' => 100
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 1,
            'kode_produk' => '8991002100002',
            'nama_produk' => 'Paracetamol 500mg',
            'harga' => 15000,
            'harga_produk' => 15000,
            'stok' => 200
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 1,
            'kode_produk' => '8991002100003',
            'nama_produk' => 'Masker Bedah 50pcs',
            'harga' => 35000,
            'harga_produk' => 35000,
            'stok' => 300
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 1,
            'kode_produk' => '8991002100004',
            'nama_produk' => 'Hand Sanitizer 100ml',
            'harga' => 20000,
            'harga_produk' => 20000,
            'stok' => 150
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 1,
            'kode_produk' => '8991002100005',
            'nama_produk' => 'Obat Batuk Sirup',
            'harga' => 25000,
            'harga_produk' => 25000,
            'stok' => 120
        ]);

        \App\Models\Produk::create([
            'kategori_id' => 2,
            'kode_produk' => '8991002100011',
            'nama_produk' => 'Lipstick Matte',
            'harga' => 50000,
            'harga_produk' => 50000,
            'stok' => 80
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 2,
            'kode_produk' => '8991002100012',
            'nama_produk' => 'Face Wash Brightening',
            'harga' => 35000,
            'harga_produk' => 35000,
            'stok' => 90
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 2,
            'kode_produk' => '8991002100013',
            'nama_produk' => 'Moisturizer Cream',
            'harga' => 65000,
            'harga_produk' => 65000,
            'stok' => 100
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 2,
            'kode_produk' => '8991002100014',
            'nama_produk' => 'Sunscreen SPF 50',
            'harga' => 70000,
            'harga_produk' => 70000,
            'stok' => 110
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 2,
            'kode_produk' => '8991002100015',
            'nama_produk' => 'Serum Wajah',
            'harga' => 120000,
            'harga_produk' => 120000,
            'stok' => 75
        ]);

        \App\Models\Produk::create([
            'kategori_id' => 3,
            'kode_produk' => '8991002100021',
            'nama_produk' => 'Headset Bluetooth',
            'harga' => 150000,
            'harga_produk' => 150000,
            'stok' => 60
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 3,
            'kode_produk' => '8991002100022',
            'nama_produk' => 'Powerbank 10000mAh',
            'harga' => 200000,
            'harga_produk' => 200000,
            'stok' => 70
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 3,
            'kode_produk' => '8991002100023',
            'nama_produk' => 'Smartwatch',
            'harga' => 350000,
            'harga_produk' => 350000,
            'stok' => 40
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 3,
            'kode_produk' => '8991002100024',
            'nama_produk' => 'Charger Fast Charging',
            'harga' => 100000,
            'harga_produk' => 100000,
            'stok' => 90
        ]);
        \App\Models\Produk::create([
            'kategori_id' => 3,
            'kode_produk' => '8991002100025',
            'nama_produk' => 'Speaker Portable',
            'harga' => 250000,
            'harga_produk' => 250000,
            'stok' => 50
        ]);
    }
}
