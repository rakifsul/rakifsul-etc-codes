<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembers extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'member_code'  => ['type' => 'VARCHAR', 'constraint' => 10, 'unique' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'address'      => ['type' => 'TEXT', 'null' => true],
            'phone'        => ['type' => 'VARCHAR', 'constraint' => 20],
            'email'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'   => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('members');
    }

    public function down()
    {
        //
        $this->forge->dropTable('members');
    }
}
