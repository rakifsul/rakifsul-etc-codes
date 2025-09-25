<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooks extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 200],
            'author'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'category'   => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'year'       => ['type' => 'YEAR', 'null' => true],
            'fine_unit'  => ['type' => 'INT', 'default' => 1000],
            'cover'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('books');
    }

    public function down()
    {
        //
        $this->forge->dropTable('books');
    }
}
