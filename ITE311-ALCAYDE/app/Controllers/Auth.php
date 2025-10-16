<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller {

    public function register() {
        helper(['form']);
        $message = [];

        if($this->request->is('post')) {
            $rules = [
                'name' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if($this->validate($rules)) {
                $newData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => $this->request->getPost('role'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                //teacher password: teacher1234
                //admin password: admin1234
                //student password password123
                if(\Config\Database::connect()->table('users')->insert($newData)) {
                    $message['success'] = 'Registration successful. You can now log in.';
                    return redirect()->to(base_url('login'));
                } else {
                    $message['error'] = 'Failed to register. Please try again.';        
                }
            } else {
                $message['validation'] = $this->validator;
            }
        }
        if(session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/register', $message);
    }

    public function login() {
        helper(['form']);
        $message = [];

        if($this->request->is('post')) {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]'
            ];

            if($this->validate($rules)) {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $user =\Config\Database::connect()->table('users')
                       ->where('email', $email)->get()->getRow();

                if($user) {
                    if(password_verify($password, $user->password)) {
                        $session = session();
                        $sessionData = [
                            'user_id' => $user->id,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'user_role' => $user->role,
                            'isLoggedIn' => true
                        ];
                        $session->set($sessionData);
                         
                        if ($user->role === 'admin') {
                            return redirect()->to('/admin/dashboard');
                        } elseif ($user->role === 'teacher') {
                            return redirect()->to('/teacher/dashboard');
                        } else {
                            return redirect()->to('/announcements'); // for students
                        }
                        }
                    } else {
                        session()->setFlashdata('error', 'Incorrect email or password.');
                    }
                } else {
                    $message['error'] = 'Email not found.';
                }
            } else {
                $message['validation'] = $this->validator;
            }
        
        return view('auth/login', $message);
    }


   /* public function dashboard() {
        if(! session()->get('isLoggedIn')) {
             session()->setFlashdata('error', 'You must log in first!');
            return redirect()->to(base_url('login'));
        }
      
        return view('auth/dashboard');
    }*/

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}