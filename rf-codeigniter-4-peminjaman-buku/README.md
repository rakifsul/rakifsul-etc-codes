# Cara Penggunaan

## Source Code Apa Ini?

Contoh dan template aplikasi peminjaman buku online sederhana yang menggunakan CodeIgniter 4.

## Cara Kerja Source Code Ini

Data diambil dari database oleh Model.

Controller mengembalikan data ke view.

## Prasyarat (Requirements)

- PHP version (PHP 8.4+).
- Database (SQLite3).
- Framework (CodeIgniter 4.x).

## Cara Install

1. Download paket zip ini.
2. Ekstrak di folder manapun.
3. Pastikan php bisa diakses dari folder manapun.
4. Masuk ke folder ./rf-codeigniter-4-peminjaman-buku-src
5. Jalankan: php spark serve --host 127.0.0.1 --port 8080
6. Buka terminal baru, biarkan yang lama tetap berjalan.
7. Jalankan: php spark migrate:refresh
8. Jalankan: php spark db:seed DatabaseSeeder
9. Login
10. Ganti password admin Anda

## Cara Mengunjungi

Buka browser Anda ke http://127.0.0.1:8080


