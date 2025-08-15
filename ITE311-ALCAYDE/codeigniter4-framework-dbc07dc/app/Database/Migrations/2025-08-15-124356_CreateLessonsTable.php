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
        /*$this->forge->addKey('lesson_id', true);
        $this->forge->createTable('lessons');
        $this->forge->addForeignKey('course_id', 'courses', 'course_id');
        $this->forge->addForeignKey('instructor_id', 'users', 'user_id');*/
        $this->forge->createTable('lessons');
    }

    public function down()
    {
       $this->forge->dropTable('lessons', true);
    }
}
