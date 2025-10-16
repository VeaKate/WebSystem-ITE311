<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller {

    public function dashboard() {
        return view('admin_dashboard');
    }

}