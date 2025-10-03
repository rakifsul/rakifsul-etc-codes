<?php

namespace App\Controllers;
use App\Models\SaleModel;
use App\Models\ProductModel;

class Sales extends BaseController
{
    // Halaman utama yang menampilkan view dengan dua chart
    public function index()
    {
        // Render file View: app/Views/sales_chart.php
        return view('sales_chart');
    }

    // Endpoint API untuk data penjualan harian (Line Chart)
    public function data()
    {
        $model = new SaleModel();

        // Ambil ringkasan data dari model (tanggal + total per hari)
        $sales = $model->getSalesSummary();

        // Array untuk label sumbu X (tanggal)
        $labels = [];
        // Array untuk nilai sumbu Y (total penjualan)
        $values = [];

        foreach ($sales as $row) {
            // Tambahkan tanggal ke label
            $labels[] = $row['sale_date'];
            // Tambahkan jumlah total ke data
            $values[] = $row['total'];
        }

        // Kembalikan data dalam format JSON
        // Chart.js akan mengambil data ini via fetch()
        return $this->response->setJSON([
            'labels' => $labels,
            'values' => $values
        ]);
    }

    // Endpoint API untuk data penjualan per kategori (Bar Chart)
    public function categoryData()
    {
        $model = new ProductModel();

        // Ambil ringkasan data dari model (kategori + total per kategori)
        $data = $model->getCategorySummary();

        // Sama seperti di atas, kita pisahkan label dan nilai
        $labels = [];
        $values = [];

        foreach ($data as $row) {
            // Nama kategori → label
            $labels[] = $row['category'];
            // Total penjualan kategori → nilai
            $values[] = $row['total'];
        }

        // Return JSON untuk digunakan di Chart.js
        return $this->response->setJSON([
            'labels' => $labels,
            'values' => $values
        ]);
    }
}
