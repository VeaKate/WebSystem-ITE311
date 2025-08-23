<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'course_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true, 
            ],
            'course_name' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            'course_instructor' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
        ]);
        
        $this->forge->addKey('course_id', true);
        $this->forge->createTable('courses');
    }
    
    public function down()
    {
        $this->forge->dropTable('courses', true);
    }
}
?>