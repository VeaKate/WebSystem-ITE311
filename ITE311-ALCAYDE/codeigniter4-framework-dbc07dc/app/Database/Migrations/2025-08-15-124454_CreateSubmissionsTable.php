<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubmissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'submission_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'quiz_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'submission_date' => [
                'type' => 'DATETIME',
            ],
        ]);
        /*$this->forge->addKey('submission_id', true);
        $this->forge->createTable('submissions');
        $this->forge->addForeignKey('quiz_id', 'quizzes', 'quiz_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');*/
        $this->forge->createTable('submissions');
    }

    public function down()
    {
       $this->forge->dropTable('submissions', true);
    }
}
