<!DOCTYPE html>
<html lang="en"> <!-- Set the language of the document to English -->
<head>
    <meta charset="UTF-8"> <!-- Set character encoding for the document to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design for mobile devices -->
    <title><?= esc($title ?? 'Dashboard') ?></title> <!-- Set the title of the page, escaping any special characters; defaults to 'Dashboard' if $title is not set -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css')?>">

    <style>
      /* Custom styles for the page */
      html, body {
        margin: 0 !important; /* Remove default margin from the HTML and body */
        padding: 0 !important; /* Remove default padding from the HTML and body */
        height: 100vh; /* Set the height of the body to 100% of the viewport height */
      }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary"> <!-- Navigation bar with Bootstrap classes -->
        <div class="container-fluid"> <!-- Fluid container for responsive layout -->

        <div class="collapse navbar-collapse" id="navbarNav"> <!-- Collapsible navigation for mobile view -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <!-- Navigation items -->

            <!-- Common link for all users -->
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a> <!-- Link to the dashboard -->
            </li>

            <!-- Role-based links for admin users -->
            <?php if (session()->get('user_role') === 'admin'): ?> <!-- Check if the logged-in user is an admin -->
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="<?= base_url('user-management') ?>">User Management</a> <!-- Link to user management -->
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Course Management</a> <!-- Link to course management -->
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Student Management</a> <!-- Link to student management -->
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Enrollment Management</a> <!-- Link to enrollment management -->
                </li>
            <?php endif; ?>

            <!-- Role-based links for teacher users -->
            <?php if (session()->get('user_role') === 'teacher'): ?> <!-- Check if the logged-in user is a teacher -->
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">My Classes</a> <!-- Link to the teacher's classes -->
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">Create Course</a> <!-- Link to create a new course -->
              </li>
            <?php endif; ?>

            <!-- Role-based links for student users -->
            <?php if (session()->get('user_role') === 'student'): ?> <!-- Check if the logged-in user is a student -->
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">My Courses</a> <!-- Link to the student's courses -->
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">My Grades</a> <!-- Link to the student's grades -->
              </li>
            <?php endif; ?>

            <!-- Dropdown for logged-in users -->
            <?php if (session()->get('isLoggedIn')): ?> <!-- Check if the user is logged in -->
              <li class="nav-item dropdown"> <!-- Dropdown menu for additional options -->
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                  Options <!-- Dropdown toggle button -->
                </a>
                <ul class="dropdown-menu"> <!-- Dropdown menu items -->
                   <li><a class="dropdown-item" href="#">System Settings</a></li> <!-- Link to system settings -->
                  <li><a class="dropdown-item" href="<?= base_url('/about')?>">About</a></li> <!-- Link to about page -->
                  <li><a class="dropdown-item" href="<?= base_url('/contact')?>">Contacts</a></li> <!-- Link to contact page -->
                  <li><hr class="dropdown-divider"></li> <!-- Divider line in dropdown -->
                  <li><a style="color: red; font-weight: bold" class="dropdown-item" href="<?= base_url('/logout')?>">Logout</a></li> <!-- Logout link -->
                </ul>
              </li>
            <?php else: ?>
              <!-- Links for users who are not logged in -->
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/login') ?>">Login</a></li> <!-- Link to login page -->
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/register') ?>">Register</a></li> <!-- Link to registration page -->
            <?php endif; ?>
        </div>
      </div>
   </nav>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
