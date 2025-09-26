<?= $this->include('templates/header') ?>

<style>
  h2{
    text-align: center;
    transform:translateY(50%)
  }
</style>

<h2 class="mb-4">This page is under development😥</h2>

<!--<h4>My Courses</h4>
<ul class="list-group mb-4">
  <?php foreach ($courses ?? [] as $c): ?>
    <li class="list-group-item"><?= esc($c['title']) ?></li>
  <?php endforeach; ?>
</ul>

<h4>Notifications</h4>
<div class="alert alert-info">You have <?= esc($newAssignments ?? 0) ?> new assignments submitted.</div>

<a href="<?= base_url('/teacher/create') ?>" class="btn btn-primary">Create New Course</a>





<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
</head>
<body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/WebSystem-ITE311/ITE311-ALCAYDE/">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Options
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Report</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Admin</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<div #id="kij" style="text-align: center; margin-top: 20px;">
    <h1>This is My Homepage</h1>
</div>
    <script src="js\bootstrap.bundle.min.js"></script>
</body>
</html>
