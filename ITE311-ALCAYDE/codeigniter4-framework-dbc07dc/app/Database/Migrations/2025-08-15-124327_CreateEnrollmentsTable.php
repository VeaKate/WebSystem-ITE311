<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'enrollment_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'course_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'course_name' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ],
            'enrollment_date' => [
                'type' => 'DATETIME'
            ]
        ]);
        /*$this->forge->addKey('enrollment_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->addForeignKey('course_id', 'courses', 'course_id', 'course_name');
        $this->forge->createTable('enrollments');*/
    }

    public function down()
    {
       $this->forge->dropTable('enrollments', true);
    }
}
