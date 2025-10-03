<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model
{
    // Nama tabel di database
    protected $table = 'products';

    // Primary key tabel
    protected $primaryKey = 'id';

    // Field yang boleh diisi
    protected $allowedFields = ['category', 'amount'];

    /**
     * Ambil ringkasan penjualan per kategori produk.
     * - SUM(amount) → total jumlah penjualan untuk tiap kategori
     * - groupBy("category") → dikelompokkan per kategori
     * - orderBy("category") → hasil diurutkan berdasarkan nama kategori
     */
    public function getCategorySummary()
    {
        return $this->select("category, SUM(amount) as total")
                    ->groupBy("category")
                    ->orderBy("category", "ASC")
                    ->findAll();
    }
}
