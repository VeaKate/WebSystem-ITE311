<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        // Sample announcements data
        $announcements = [
            [
                'title' => 'Welcome to Our Platform',
                'content' => 'We are excited to have you here! Stay tuned for updates and features.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Scheduled Maintenance',
                'content' => 'Our platform will undergo scheduled maintenance on 2025-10-20 from 1 AM to 3 AM. We apologize for any inconvenience.',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Insert announcements into the database
        $this->db->table('announcements')->insertBatch($announcements);
    }
}
