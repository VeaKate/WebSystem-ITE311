<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true, 
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'age' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'userType' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
?>