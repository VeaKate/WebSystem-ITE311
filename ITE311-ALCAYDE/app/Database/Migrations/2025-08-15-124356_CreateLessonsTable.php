<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lesson_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true, 
            ],
            'lesson_title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'course_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'instructor_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        
        $this->forge->addKey('lesson_id', true);
        $this->forge->createTable('lessons');
        $this->forge->addForeignKey('course_id', 'courses', 'course_id', 'CASCADE', 'CASCADE'); 
        $this->forge->addForeignKey('instructor_id', 'users', 'user_id', 'CASCADE', 'CASCADE'); 
    }

    public function down()
    {
        $this->forge->dropForeignKey('lessons', 'lessons_course_id_foreign'); 
        $this->forge->dropForeignKey('lessons', 'lessons_instructor_id_foreign');    
        $this->forge->dropTable('lessons', true);
    }
}
?>