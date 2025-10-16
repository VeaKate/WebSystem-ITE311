<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class RoleAuth implements FilterInterface
{
    /**
     * Before filter method to check user role.
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        $userRole = $session->get('user_role');  // Assuming the user's role is stored in the session under the key 'role'

        if ($arguments !== null && isset($arguments[0])) {
            $requiredRole = $arguments[0];  // The required role is passed as an argument (e.g., 'admin' or 'teacher')

            if ($userRole !== $requiredRole) {
                // Set flash message and redirect
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');  // Redirect to /announcements
            }
            // If the role matches, proceed normally
        }

        return null;  // Allow the request to proceed
    }

    /**
     * After filter method (not used in this case, but required by the interface).
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No after logic needed for this filter
    }
}