<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <style>
      html, body{
        margin: 0 !important;
        padding: 0 !important;
        height: 100vh
      }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <!-- Common for all -->
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a>
            </li>

            <!-- Role-based links -->
            <?php if (session()->get('user_role') === 'admin'): ?>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="user_management.html">User Management</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Course Management</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Student Management</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Enrollment Management</a>
                </li>
            <?php endif; ?>

            <?php if (session()->get('user_role') === 'teacher'): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">My Classes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">Create Course</a>
              </li>
            <?php endif; ?>

            <?php if (session()->get('user_role') === 'student'): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">My Courses</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">My Grades</a>
              </li>
            <?php endif; ?>

            <!-- Dropdown -->
            <?php if (session()->get('isLoggedIn')): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                  Options
                </a>
                <ul class="dropdown-menu">
                   <li><a class="dropdown-item" href="#">System Settings</a></li>
                  <li><a class="dropdown-item" href="<?= base_url('/about')?>">About</a></li>
                  <li><a class="dropdown-item" href="<?= base_url('/contact')?>">Contacts</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a style="color: red; font-weight: bold" class="dropdown-item" href="<?= base_url('/logout')?>">Logout</a></li>
                </ul>
              </li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/login') ?>">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/register') ?>">Register</a></li>
            <?php endif; ?>

         <!-- </ul>

          <!-- Search -->
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
   </nav>
   <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>



    <!--Navigaion for Admin-->
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?= site_url('css/bootstrap.min.css') ?>">
     
    <style>
        html, body{
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: scroll;
        }
        nav{
            display: block;
        }
    </style>

</head>
<body>
   <?php if (session()->get('user_role') === 'admin'): ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('/dashboard') ?>">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/user-management') ?>">User Management</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/course-management')?>">Course Management</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Student Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Enrollment Management</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More Options    
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Reports and Analytics</a></li>
                        <li><a class="dropdown-item" href="#">Commuication Tools</a></li>
                        <li><a class="dropdown-item" href="#">System Settings</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/contact') ?>">Contacts</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/about') ?>">About Us</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a style="color: red; font-weight: bold" class="dropdown-item" href="<?= base_url('/logout') ?>">Logout</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
        </div>
    </nav>
     <?php endif; ?>
    <script src="<?= base_url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>