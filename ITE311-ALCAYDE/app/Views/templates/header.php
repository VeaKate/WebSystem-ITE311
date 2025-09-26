<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <style>
      html, body{
        margin: 0;
        padding: 0;
        height: 100vh
      }
    </style>
</head>
<body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
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
                <a class="nav-link" href="<?= base_url('#') ?>">User Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('#') ?>">Manage Courses</a>
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
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">Logout</a></li>
                </ul>
              </li>
            <!--<?php else: ?>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/login') ?>">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/register') ?>">Register</a></li>
            <?php endif; ?>-->

          </ul>

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

