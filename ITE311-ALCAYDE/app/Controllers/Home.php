<?php

namespace App\Controllers; // Define the namespace for the controller

class Home extends BaseController // Extend the base controller class
{
    // Method to display the index page
    public function index() {
        return view('index'); // Load and return the index view
    }

    // Method to display the About page
    public function about() {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'You must log in first!'); // Set an error message if not logged in
            return redirect()->to(base_url('login')); // Redirect to the login page
        }
        return view('about'); // Load and return the about view
    }

    // Method to display the Contact page
    public function contact() {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'You must log in first!'); // Set an error message if not logged in
            return redirect()->to(base_url('login')); // Redirect to the login page
        }
        return view('contact'); // Load and return the contact view
    }

    // Method to display the User Management page (Admin Only)
    public function userManagement() {
        helper(['form']); // Load form helper for form validation
        // Check if the user is an admin and logged in
        if (session()->get('user_role') !== 'admin' || !session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Access denied. Admins only.'); // Set an error message for unauthorized access
            return redirect()->to(base_url('dashboard')); // Redirect to the dashboard
        }
        // Fetch all users from the database
        $users = \Config\Database::connect()->table('users')->get()->getResultArray();
        // Store users in session if not empty
        if (!empty($users)) {
            session()->set('allUsers', $users);
        } else {
            session()->remove('allUsers'); // Remove users from session if empty
        }
        // Optionally clear filteredUsers when viewing all
        session()->remove('filteredUsers'); // Clear any filtered users
        return view('admin/user_management'); // Load and return the user management view
    }

    // Method to display the Course Management page (Admin Only)
    public function course_management() {
        helper(['form']); // Load form helper for form validation
        
        // Optionally, pass an empty search term to the view
        // Check if the user is an admin and logged in
        if (session()->get('user_role') !== 'admin' || !session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Access denied. Admins only.'); // Set an error message for unauthorized access
            return redirect()->to(base_url('dashboard')); // Redirect to the dashboard
        }
        // Fetch all courses from the database
        $courses = \Config\Database::connect()->table('courses')->get()->getResultArray();
        // Store courses in session if not empty
        if (!empty($courses)) {
            session()->set('allCourses', $courses);
        } else {
            session()->remove('allCourses'); // Remove courses from session if empty
        }
        // Optionally clear filteredCourses when viewing all
        session()->remove('filteredCourses'); // Clear any filtered courses
        return view('admin/user_management'); // Load and return the course management view
    }

    // Method to search for users
    public function searchUser() {
        helper(['form']); // Load form helper for form validation
        // Check if the request method is POST
        if($this->request->is('post')) {
            $searchTerm = $this->request->getPost('search_term'); // Get the search term from the form

            // Query the database for users matching the search term
            $users = \Config\Database::connect()->table('users')
                     ->like('name', $searchTerm) // Search by name
                     ->orLike('email', $searchTerm) // Or search by email
                     ->get()
                     ->getResultArray(); // Get results as an array

            // Check if any users were found
            if (!empty($users) && !empty($searchTerm)) {
                session()->set('searchUsers', $users); // Store found users in session
            } else {
                session()->remove('searchUsers'); // Remove search users from session if none found
                session()->setFlashdata('info', 'No users found matching your search.'); // Set an info message
                return redirect()->to(base_url('user-management', )); // Redirect to user management
            }
            return redirect()->to(base_url('user-management')); // Redirect to user management
        }
        // If the request is not POST (like on refresh)
        session()->remove('searchUsers'); // Reset the search on refresh
        return view('admin/user_management', ['searchTerm' => ' ']); // Load view with empty search term

    }

    // Method to display a 404 Page Not Found
    public function notFound() {
        return view('error_page'); // Load and return the error page view
    }

    // Method to add a new user
    public function addUser() {
        helper(['form']); // Load form helper for form validation
        $message = []; // Initialize an array to hold messages for the view

        // Check if the request method is POST
        if($this->request->is('post')) {
            // Define validation rules for adding a new user
            $rules = [
                'name' => [
                    'label'  => 'Full Name',
                    'rules'  => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]', // Name must be required and match regex
                    'errors' => [
                        'regex_match' => 'The {field} may only contain letters and spaces.' // Custom error message for regex match
                    ]
                ],
                'email' => [
                    'label'  => 'Email Address',
                    'rules'  => 'required|valid_email|is_unique[users.email]|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]', // Email must be valid and unique
                    'errors' => [
                        'regex_match' => 'The {field} contains invalid characters.', // Custom error message for regex match
                        'is_unique'   => 'That email is already registered.' // Custom error message for unique check
                    ]
                ],
                'role' => [
                    'label'  => 'User Role',
                    'rules'  => 'required|in_list[admin,teacher,student, Admin,Teacher,Student,]', // Role must be one of the specified values
                    'errors' => [
                        'in_list' => 'The {field} must be either admin, teacher, or student.' // Custom error message for role validation
                    ]
                ],
            ];

            // Validate the input data against the defined rules
            if($this->validate($rules)) {
                $defaultPassword = "defaultpassword";
                // Prepare new user data for insertion into the database
                $newUser = [
                    'name' => $this->request->getPost('name'), // Get the name from the form
                    'email' => $this->request->getPost('email'), // Get the email from the form
                    'role' => $this->request->getPost('role'), // Get the role from the form
                    'password' => password_hash($defaultPassword, PASSWORD_DEFAULT), // Hash the password
                    'created_at' => date('Y-m-d H:i:s'), // Set the current timestamp for creation
                    'updated_at' => date('Y-m-d H:i:s') // Set the current timestamp for update
                ];

                // Attempt to insert the new user data into the database
                $insertBatch = \Config\Database::connect()->table('users')->insert($newUser);

                // Check if the insertion was successful
                if($insertBatch) {
                    $message['success_ad'] = 'New User Added Successfully'; // Success message
                    return redirect()->to(base_url('user-management')); // Redirect to user management
                } else {
                    session()->setFlashdata('error_ad', 'Failed to add user. Please try again.'); // Error message if insertion fails
                    return redirect()->back()->withInput(); // Redirect back with input data
                }
            } else {
                $message['validation_ad'] = $this->validator; // Capture validation errors
            }
        }

        // Load the user management view and pass any messages
        return view('admin/user_management', $message);
    }

    // Method to delete a user
    public function restrict($id) {
        helper(['form']); // Load form helper for form validation
        // Check if the request method is POST
        if($this->request->is('post')) {
            // Check if the user is an admin
            if (session()->get('user_role') !== 'admin') {
                session()->setFlashdata('error', 'You are not authorized to delete users.'); // Set an error message for unauthorized access
                return redirect()->to(base_url('user-management')); // Redirect to user management
            }

            $account_status = [
                'account_status' => 'restricted',
            ];

            $db = \Config\Database::connect(); // Connect to the database
            $builder = $db->table('users'); // Get the users table

            // Check if user exists
            $user = $builder->where('id', $id)->get()->getRow(); // Fetch the user by ID

            if ($user) {
                $builder->where('id', $id)->update($account_status); // Delete the user
                session()->setFlashdata('success', 'User restricted.'); // Set success message
            } else {
                session()->setFlashdata('error', 'User not found.'); // Set error message if user not found
            }

            // Redirect back to user management page
            return redirect()->to(base_url('user-management'));
        }
        return view('admin/user_management'); // Load and return the user management view
    }

    // Method to edit a user
    public function edit($id) {
        helper(['form', 'url']); // Load form and URL helpers
        
        // Check if the request is POST
        if (!$this->request->is('post')) {
            return redirect()->to(base_url('user-management'))->with('error', 'Invalid request method.'); // Redirect if not POST
        }
        
        // Authorization: Only admins can edit
        if (session()->get('user_role') !== 'admin') {
            session()->setFlashdata('error', 'You are not authorized to edit users.'); // Set error message for unauthorized access
            return redirect()->to(base_url('user-management')); // Redirect to user management
        }
        
        // Validation rules
        $validationRules = [
            'name' => [
                'label'  => 'Full Name',
                'rules'  => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]', // Name must be required and match regex
                'errors' => [
                    'regex_match' => 'The {field} may only contain letters and spaces.' // Custom error message for regex match
                ]
            ],
            'email' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email|regex_match[/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/]', // Email must be valid
                'errors' => [
                    'regex_match' => 'The {field} contains invalid characters.' // Custom error message for regex match
                ]
            ],
            'role' => [
                'label'  => 'User Role',
                'rules'  => 'required|in_list[admin,teacher,student]', // Role must be one of the specified values
                'errors' => [
                    'in_list' => 'The {field} must be either admin, teacher, or student.' // Custom error message for role validation
                ]
            ],
        ];
        
        // Validate the input data against the defined rules
        if (!$this->validate($validationRules)) {
            // Validation failed: Redirect back with errors
            session()->setFlashdata('error_edit', 'Validation errors: ' . implode(', ', $this->validator->getErrors())); // Set error message
            return redirect()->back()->withInput();  // Keeps form data for user to correct
        }
        
        // Get validated data
        $data = [
            'name' => $this->request->getPost('name'), // Get the name from the form
            'email' => $this->request->getPost('email'), // Get the email from the form
            'role' => $this->request->getPost('role'), // Get the role from the form
            'password' => $this->request->getPost('defpass'),
            'updated_at' => date('Y-m-d H:i:s') // Set the current timestamp for update
        ];
        
        // Handle password: Only update if provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT); // Hash the password if provided
        }
        
        // Connect to DB and check if user exists
        $db = \Config\Database::connect(); // Connect to the database
        $builder = $db->table('users'); // Get the users table
        $user = $builder->where('id', $id)->get()->getRow(); // Fetch the user by ID
        
        if (!$user) {
            session()->setFlashdata('error', 'User not found.'); // Set error message if user not found
            return redirect()->to(base_url('user-management')); // Redirect to user management
        }
        
        // Perform update
        $builder->where('id', $id)->update($data); // Update the user data
        
        // Check if update was successful (optional, but good practice)
        if ($db->affectedRows() > 0) {
            session()->setFlashdata('success', 'User updated successfully.'); // Set success message
        } else {
            session()->setFlashdata('error_edit', 'Failed to update user. Please try again.'); // Set error message if update fails
        }
        
        // Redirect to user-management (PRG pattern to prevent resubmission)
        return redirect()->to(base_url('user-management')); // Redirect to user management
    }

    public function restrictedUser() {
        return view('restricted');
    }

    public function unrestrictUser($id) {
        helper(['form']);
        if($this->request->is('post')) {
            $update = [
                'account_status' => 'granted',
            ];
             $db = \Config\Database::connect(); // Connect to the database
             $builder = $db->table('users'); // Get the users table
             $user = $builder->where('id', $id)->get()->getRow(); // Fetch the user by ID
              $builder->where('id', $id)->update( $update); // Update the user data
        }
        return view('admin/user_management');
    }
}
