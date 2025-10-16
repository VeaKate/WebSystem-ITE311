<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index() {
        return view('index');
    }

    // About Page
    public function about(){
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'You must log in first!');
            return redirect()->to(base_url('login'));
        }
        return view('about');
    }

    // Contact Page
    public function contact() {
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'You must log in first!');
            return redirect()->to(base_url('login'));
        }
        return view('contact');
    }

    // User Management Page - Admin Only
    public function userManagement() {
        helper(['form']);
        if (session()->get('user_role') !== 'admin' || !session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Access denied. Admins only.');
            return redirect()->to(base_url('dashboard'));
        }
        $users = \Config\Database::connect()->table('users')->get()->getResultArray();
        if (!empty($users)) {
            session()->set('allUsers', $users);
        } else {
            session()->remove('allUsers');
        }
        // Optionally clear filteredUsers when viewing all
        session()->remove('filteredUsers');
        return view('admin/user_management');
    }

    public function course_management() {
        helper(['form']);
        if (session()->get('user_role') !== 'admin' || !session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Access denied. Admins only.');
            return redirect()->to(base_url('dashboard'));
        }
        $courses = \Config\Database::connect()->table('courses')->get()->getResultArray();
        if (!empty($courses)) {
            session()->set('allCourses', $courses);
        } else {
            session()->remove('allCourses');
        }
        // Optionally clear filteredCourses when viewing all
        session()->remove('filteredCourses');
        return view('admin/course_management');
    }
    // 404 Page Not Found
    public function notFound() {
        return view('error_page');
    }

}