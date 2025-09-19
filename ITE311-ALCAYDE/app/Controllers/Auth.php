<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller {
    protected $database;
    protected $table;
    public function __construct() {
        $this->database = \Config\Database::connect();
        $this->table = $this->database->table('users');
    }

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
                $role = $this->request->getPost('role') ?? 'user';
                $newData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => $role,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if($this->table->insert($newData)) {
                    $message['success'] = 'Registration successful. You can now log in.';
                    return redirect()->to(base_url('login'));
                } else {
                    $message['error'] = 'Failed to register. Please try again.';        
                }
            } else {
                $message['validation'] = $this->validator;
            }
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

                $user = $this->table->where('email', $email)->get()->getRow();

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
                        return redirect()->to(base_url('dashboard'));
                    } else {
                        session()->setFlashdata('error', 'Incorrect email or password.');
                    }
                } else {
                    $message['error'] = 'Email not found.';
                }
            } else {
                $message['validation'] = $this->validator;
            }
        }
        return view('auth/login', $message);
    }

    public function dashboard() {
        if(! session()->get('isLoggedIn')) {
             session()->setFlashdata('error', 'You must log in first!');
            return redirect()->to(base_url('login'));
        }

        return view('auth/dashboard');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function dbfetch() {
        $email = $this->request->getGet('email') ?? $this->request->getPost('email');
        if(! $email) {
            return $this->response->setStatusCode(400)->setBody('Email parameter is required');
        }
        $database = \Config\Database::connect();
        $table = $database->table('users');
        $user = $table->select('id, name, email, role, created_at, updated_at')
                      ->where('email', $email)
                      ->get()
                      ->getRowArray();
        if(! $user) {
            return $this->response->setStatusCode(404)->setBody('User not found');
        }
        return $this->response->setContentType('application/json')
                              ->setBody(json_encode($user));
    }
}