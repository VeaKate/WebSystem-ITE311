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
                'auto_increment' => true, 
            ],
            'quiz_title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'lesson_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'quizzes_question' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'instructor_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        
        $this->forge->addKey('quiz_id', true);
        $this->forge->createTable('quizzes');
        $this->forge->addForeignKey('lesson_id', 'lessons', 'lesson_id', 'CASCADE', 'CASCADE'); 
        $this->forge->addForeignKey('instructor_id', 'users', 'user_id', 'CASCADE', 'CASCADE'); 
    }

    public function down()
    {
        $this->forge->dropForeignKey('quizzes', 'quizzes_lesson_id_foreign'); 
        $this->forge->dropForeignKey('quizzes', 'quizzes_instructor_id_foreign'); 
        $this->forge->dropTable('quizzes', true);
    }
}
?>