<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnnouncementsTable extends Migration
{
    //anonuncements table constraint
    public function up()
    {
     $this->forge->addField([
         'id' => [
             'type'           => 'INT',
             'constraint'     => 5,
             'unsigned'       => true,
             'auto_increment' => true,
         ],
         'title' => [
             'type'       => 'VARCHAR',
             'constraint' => '255',
         ],
         'content' => [
             'type' => 'TEXT',
             'null' => true,
         ],
         'created_at' => [
             'type' => 'DATETIME',
             'null' => true,
             'default' => date('Y-m-d H:i:s'),
         ],
     ]);   

        $this->forge->addKey('id', true);
        $this->forge->createTable('announcements');
    }

    //dropt table announcements if exists
    public function down()
    {
     $this->forge->dropTable('announcements', true);   
    }
}
