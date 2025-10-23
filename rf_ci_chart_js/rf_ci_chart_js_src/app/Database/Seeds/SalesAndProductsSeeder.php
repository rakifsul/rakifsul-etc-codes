<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SalesAndProductsSeeder extends Seeder
{
    public function run()
    {
        // Dummy data untuk tabel sales (penjualan harian)
        $salesData = [
            [
                'date'   => '2025-09-01',
                'amount' => 200000,
            ],
            [
                'date'   => '2025-09-02',
                'amount' => 150000,
            ],
            [
                'date'   => '2025-09-03',
                'amount' => 250000,
            ],
            [
                'date'   => '2025-09-04',
                'amount' => 180000,
            ],
            [
                'date'   => '2025-09-05',
                'amount' => 300000,
            ],
        ];

        // Insert batch ke tabel sales
        $this->db->table('sales')->insertBatch($salesData);

        // Dummy data untuk tabel products (penjualan per kategori)
        $productsData = [
            [
                'category' => 'Elektronik',
                'amount'   => 500000,
            ],
            [
                'category' => 'Fashion',
                'amount'   => 300000,
            ],
            [
                'category' => 'Makanan',
                'amount'   => 200000,
            ],
            [
                'category' => 'Olahraga',
                'amount'   => 150000,
            ],
        ];

        // Insert batch ke tabel products
        $this->db->table('products')->insertBatch($productsData);
    }
}
