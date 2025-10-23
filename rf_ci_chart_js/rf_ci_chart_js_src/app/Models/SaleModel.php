<?php

namespace App\Models;
use CodeIgniter\Model;

class SaleModel extends Model
{
    // Nama tabel di database
    protected $table = 'sales';

    // Primary key tabel
    protected $primaryKey = 'id';

    // Field yang boleh diisi lewat insert/update
    protected $allowedFields = ['date', 'amount'];

    /**
     * Ambil ringkasan penjualan harian.
     * - DATE(date) → ambil hanya tanggal tanpa jam
     * - SUM(amount) → jumlahkan semua transaksi per hari
     * - groupBy("DATE(date)") → grup berdasarkan tanggal
     * - orderBy("sale_date") → urutkan berdasarkan tanggal
     */
    public function getSalesSummary()
    {
        return $this->select("DATE(date) as sale_date, SUM(amount) as total")
                    ->groupBy("DATE(date)")
                    ->orderBy("sale_date", "ASC")
                    ->findAll();
    }
}
