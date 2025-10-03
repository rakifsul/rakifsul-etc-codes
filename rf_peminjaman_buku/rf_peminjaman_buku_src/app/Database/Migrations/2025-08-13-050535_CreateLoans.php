<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoans extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'member_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'book_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'loan_date'   => ['type' => 'DATE', 'null' => false],
            'due_date'    => ['type' => 'DATE', 'null' => false],
            'return_date' => ['type' => 'DATE', 'null' => true],
            'fine'        => ['type' => 'INT', 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('member_id', 'members', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('book_id', 'books', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loans');
    }

    public function down()
    {
        //
        $this->forge->dropTable('loans');
    }
}
