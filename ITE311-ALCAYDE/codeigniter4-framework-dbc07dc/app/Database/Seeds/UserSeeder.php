<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'user_id' => 00000000001,
                'name' => 'Kathania Thhunderfox',
                'age' => 21,
                'email' => 'Kathia34@gmail.com',
                'userType' => 'Student'
            ],
             [
                 'user_id' => 00000000002,
                'name' => 'Rizel Cruz',
                'age' => 18,
                'email' => 'RIAZA@gmail.com',
                'userType' => 'Student'
            ]
        ];
        $instructors = [
            [
                 'user_id' => 00000000003,
               'name' => 'Cyril Consuelo',
                'age' => 26,
                'email' => 'itsZhai@gmail.com',
                'userType' => 'Insructor'
            ],
              [
                 'user_id' => 00000000004,
               'name' => 'Lexter Jed Fuentebella',
                'age' => 29,
                'email' => 'heLLO@lX@gmail.com',
                'userType' => 'Insructor'
            ]
        ];
        $admin = [
            [
                 'user_id' => 00000000005,
                'name' => 'Jeanna Sei',
                'age' => 56,
                'email' => 'admin01@gmail.com',
                'userType' => 'Admin'
            ],
              [
                 'user_id' => 00000000006,
                'name' => 'Drea Mollins',
                'age' => 28,
                'email' => 'admin02@gmail.com',
                'userType' => 'Admin'
            ],
        ];
        $this->db->table('users')->insertBatch($students);
        $this->db->table('users')->insertBatch($instructors);
        $this->db->table('users')->insertBatch($admin);
    }
}
