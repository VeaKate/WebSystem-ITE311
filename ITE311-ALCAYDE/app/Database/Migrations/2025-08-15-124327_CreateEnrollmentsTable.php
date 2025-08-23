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
                'auto_increment' => true, 
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'course_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'course_name' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            'enrollment_date' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('enrollment_id', true);
        $this->forge->createTable('enrollments');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE'); 
        $this->forge->addForeignKey('course_id', 'courses', 'course_id', 'CASCADE', 'CASCADE'); 
    }
    public function down()
    {
        $this->forge->dropForeignKey('enrollments', 'enrollments_user_id_foreign'); 
        $this->forge->dropForeignKey('enrollments', 'enrollments_course_id_foreign'); 
        $this->forge->dropTable('enrollments', true);
    }
}
?>