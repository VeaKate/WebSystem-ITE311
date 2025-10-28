<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Teacher extends Controller {

    
    public function dashboard() {
        return view('teacher_dashboard');
    }
}