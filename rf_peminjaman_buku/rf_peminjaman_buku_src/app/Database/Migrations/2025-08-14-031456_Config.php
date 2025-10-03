<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Config extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'key'   => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('configs');

        $this->db->table('configs')->insert(['key' => 'SITE_NAME', 'value' => 'Perpustakaan Online']);
        $this->db->table('configs')->insert(['key' => 'SITE_TAGLINE', 'value' => 'Baca buku cepat, mudah, dan terjangkau']);
        $this->db->table('configs')->insert(['key' => 'ADMIN_PAGINATION', 'value' => '10']);
    }

    public function down()
    {
        //
        $this->forge->dropTable('configs');
    }
}
