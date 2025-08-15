<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'quiz_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'quiz_title' => [
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
       /* $this->forge->addKey('quiz_id', true);
        $this->forge->createTable('quizzes');
        $this->forge->addForeignKey('course_id', 'courses', 'course_id');
        $this->forge->addForeignKey('instructor_id', 'users', 'user_id');*/
        $this->forge->createTable('quizzes');
    }

    public function down()
    {
        $this->forge->dropTable('quizzes', true);
    }
}
