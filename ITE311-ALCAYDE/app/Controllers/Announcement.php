<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;
use CodeIgniter\Controller;

class Announcement extends Controller
{
    public function index()
    {
        $announcementModel = new AnnouncementModel();

        // Fetch all announcements ordered by created_at DESC
        $announcements = $announcementModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // Store announcements in session
        $session = session();
        $session->set('announcements', $announcements);

        // Now, in your view, you can access session('announcements')
        return view('announcement');
    }
}