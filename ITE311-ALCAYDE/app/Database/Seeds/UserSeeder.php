<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'username' => 'Kiara',
                'email' => 'Kiara34@gmail.com',
                'password' => 'user',
                'role' => 'user'
            ]
        ];
        $this->db->table('users')->insertBatch($students);
    }
}
