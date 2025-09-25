## Cara Mencoba Kode Project Ini

Sekarang, saya akan membahas cara mencoba kode ini di komputer lokal dengan sistem operasi Windows 11.

Untuk mencoba kode ini, copy file .env.example sebagai .env

Sekarang, kita memiliki file .env dalam folder source code yang secara default isinya sama dengan .env.example.

Selanjutnya, Anda bisa mengubah isi dari .env sesuai dengan detail database dan sistem Anda.

Namun, untuk kesamaan, jangan ubah dulu isi dari .env.

Kode ini membutuhkan MySQL server untuk staging dan production.

Jadi, pastikan Anda telah menginstallnya di komputer Anda dan membuat databasenya sesuai konfigurasi yang ada di file .env tadi.

### Mencoba Di Environment Development

Sekarang, kita telah memiliki .env yang sudah dikonfigurasi.

Pastikan Anda berada dalam folder source code:

```
cd rf-nodejs-company-profile-src
```

Selanjutnya, jalankan:

```
npm install
```

Selanjutnya, jalankan:

```
npm run db:dev:refresh
```

Catat bahwa dev menggunakan sqlite, jadi tidak perlu install MySQL.

Selanjutnya, jalankan:

```
npm run dev
```

### Mencoba Di Environment Production

Karena versi production dari aplikasi ini memerlukan MySQL server, maka install itu terlebih dahulu.

Selanjutnya, buat database bernama "company_profile-prod".

Selanjutnya, ubah .env bagian ini menjadi:

```
# pilih salah satu
#KNEX_ENV=development
#KNEX_ENV=staging
KNEX_ENV=production
```

Pastikan bagian ini sesuai dengan settingan MySQL Anda:

```
# production database
KNEX_PROD_HOST=127.0.0.1
KNEX_PROD_PORT=3306
KNEX_PROD_USER=root
KNEX_PROD_PASSWORD=root
KNEX_PROD_DATABASE=company_profile-prod
```

Sekarang, kita telah memiliki database di MySQL dan file .env yang sudah dikonfigurasi.

Pastikan Anda berada dalam folder source code.

Selanjutnya, jalankan:

```
npm install
```

Selanjutnya, jalankan:

```
npm run db:prod:refresh
```

Selanjutnya, jalankan:

```
npm run dev
```

### Mencoba Di Environment Staging

Pastikan .env bagian ini seperti ini:

```
# pilih salah satu
#KNEX_ENV=development
KNEX_ENV=staging
#KNEX_ENV=production
```

Caranya serupa dengan di environment production, tinggal replace prod dengan stg di langkah ini:

```
npm run db:stg:refresh
```

### Mengunjungi Aplikasi

Terakhir, buka browser Anda ke alamat yang tertera di BASE_URL yang ada di .env

Secara default adalah:

http://localhost:3000

Di bagian paling bawah halaman tersebut, ada link login dan register untuk admin.

Default admin login:

```
username: admin@example.com
password: admin
```

### Mengubah Favicon

Untuk mengubah favicon di halaman depan, replace favicon.png yang ada di folder "/public/img" yang ada di dalam folder source code.
