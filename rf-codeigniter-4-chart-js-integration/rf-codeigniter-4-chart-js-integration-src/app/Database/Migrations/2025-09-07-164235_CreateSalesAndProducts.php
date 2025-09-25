<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesAndProducts extends Migration
{
     public function up()
    {
        /**
         * Tabel sales
         * Menyimpan data transaksi harian
         * - id (PK, auto increment)
         * - date (tanggal transaksi)
         * - amount (jumlah penjualan pada hari itu)
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2', // bisa menampung 9999999999.99
                'default'    => 0.00,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sales');

        /**
         * Tabel products
         * Menyimpan data penjualan per kategori produk
         * - id (PK)
         * - category (nama kategori)
         * - amount (total penjualan dalam kategori)
         */
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'default'    => 0.00,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        // Hapus tabel jika rollback migration
        $this->forge->dropTable('sales');
        $this->forge->dropTable('products');
    }
}
