# Cara Penggunaan

## Source Code Apa Ini?

Contoh integrasi Chart.js ke dalam CodeIgniter 4 untuk menampilkan grafik penjualan harian (Line Chart) dan grafik penjualan per kategori (Bar Chart).

## Cara Kerja Source Code Ini

Data diambil dari database oleh Model.

Controller mengembalikan data dalam format JSON.

View memanggil endpoint JSON dengan fetch().

Chart.js merender grafik menggunakan data JSON.

## Prasyarat (Requirements)

- PHP version (misalnya PHP 8.4+).
- Database (SQLite3).
- Framework (CodeIgniter 4.x).
- Library eksternal (Chart.js, sudah termasuk).

## Cara Install

1. Download paket zip ini.
2. Ekstrak di folder manapun.
3. Pastikan php bisa diakses dari folder manapun.
4. Masuk ke folder ./rf-codeigniter-4-chart-js-integration-src
5. Jalankan: php spark serve --host 127.0.0.1 --port 8080
6. Buka terminal baru, biarkan yang lama tetap berjalan.
7. Jalankan: php spark migrate:refresh
8. Jalankan: php spark db:seed SalesAndProductsSeeder

## Cara Mengunjungi

Buka browser Anda ke http://127.0.0.1:8080


