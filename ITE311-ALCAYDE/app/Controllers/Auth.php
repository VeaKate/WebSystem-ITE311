<?php
namespace App\Controllers; // Define the namespace for the controller

use CodeIgniter\Controller; // Import the base Controller class from CodeIgniter

class Auth extends Controller {

    // Method to handle user registration
    public function register() {
        helper(['form']); // Load form helper for form validation
        $message = []; // Initialize an array to hold messages for the view

        // Check if the request method is POST
        if($this->request->is('post')) {
            // Define validation rules for registration
            $rules = [
                'name' => 'required|min_length[3]|max_length[50]', // Name must be required and between 3 to 50 characters
                'email' => 'required|valid_email|is_unique[users.email]', // Email must be valid and unique in the users table
                'password' => 'required|min_length[8]|max_length[255]', // Password must be required and between 8 to 255 characters
                'password_confirm' => 'matches[password]' // Confirm password must match the original password
            ];

            // Validate the input data against the defined rules
            if($this->validate($rules)) {
                // Prepare new user data for insertion into the database
                $newData = [
                    'name' => $this->request->getPost('name'), // Get the name from the form
                    'email' => $this->request->getPost('email'), // Get the email from the form
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash the password
                    'role' => $this->request->getPost('role'), // Get the role from the form
                    'created_at' => date('Y-m-d H:i:s'), // Set the current timestamp for creation
                    'updated_at' => date('Y-m-d H:i:s') // Set the current timestamp for update
                ];

                // Attempt to insert the new user data into the database
                if(\Config\Database::connect()->table('users')->insert($newData)) {
                    $message['success'] = 'Registration successful. You can now log in.'; // Success message
                    return redirect()->to(base_url('login')); // Redirect to the login page
                } else {
                    $message['error'] = 'Failed to register. Please try again.'; // Error message if insertion fails
                }
            } else {
                $message['validation'] = $this->validator; // Capture validation errors
            }
        }

        // If the user is already logged in, redirect to the dashboard
        if(session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        // Load the registration view and pass any messages
        return view('auth/register', $message);
    }

    // Method to handle user login
    public function login() {
        helper(['form']); // Load form helper for form validation
        $message = []; // Initialize an array to hold messages for the view

        // Check if the user is already logged in
        if(session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard')); // Redirect to the dashboard if logged in
        }

        // Check if the request method is POST
        if($this->request->is('post')) {
            // Define validation rules for login
            $rules = [
                'email' => 'required|valid_email', // Email must be required and valid
                'password' => 'required|min_length[8]|max_length[255]' // Password must be required and between 8 to 255 characters
            ];

            // Validate the input data against the defined rules
            if($this->validate($rules)) {
                // Get the email and password from the form
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                // Query the database for the user with the provided email
                $user = \Config\Database::connect()->table('users')
                       ->where('email', $email)->get()->getRow(); // Get the user record

                // Check if the user exists
                if($user) {
                    // Verify the provided password against the hashed password in the database
                    if(password_verify($password, $user->password)) {
                        // Create a session for the logged-in user
                        $session = session();
                        $sessionData = [
                            'user_id' => $user->id, // Store user ID in session
                            'user_name' => $user->name, // Store user name in session
                            'user_email' => $user->email, // Store user email in session
                            'user_role' => $user->role, // Store user role in session
                            'isLoggedIn' => true // Set logged-in status
                        ];
                        $session->set($sessionData); // Set session data
                         
                        return redirect()->to(base_url('dashboard')); // Redirect to the dashboard
                    } else {
                        // If password verification fails, set an error message
                        session()->setFlashdata('error', 'Incorrect email or password.');
                        return redirect()->back()->withInput(); // Redirect back with input data
                    }
                } else {
                    // If user not found, set an error message
                    session()->setFlashdata('error', 'Email not found.');
                    return redirect()->back()->withInput(); // Redirect back with input data
                }
            } else {
                $message['validation'] = $this->validator; // Capture validation errors
            }
            
        }

        // Load the login view and pass any messages
        return view('auth/login', $message);
    }

    // Method to display the dashboard
    public function dashboard() {
        // Check if the user is logged in
        if(! session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'You must log in first!'); // Set error message if not logged in
            return redirect()->to(base_url('login')); // Redirect to the login page
        }
      
        // Load the dashboard view
        return view('auth/dashboard');
    }

    // Method to handle user logout
    public function logout() {
        session()->destroy(); // Destroy the session to log out the user
        return redirect()->to(base_url('login')); // Redirect to the login page
    }
}
