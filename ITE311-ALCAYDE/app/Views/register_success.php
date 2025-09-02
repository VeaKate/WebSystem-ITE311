<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Registered</title>
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
</head>
<body>
 <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Success!</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">Registered Sucessfully</h6>
    <p class="card-text">Your account was created. You can now log in.</p>
      <a href="http://localhost/WebSystem-ITE311/ITE311-ALCAYDE/index.php/register"> 
        <button type="button" class="btn btn-outline-danger">
        Back</button>
      </a>
      <a href="http://localhost/WebSystem-ITE311/ITE311-ALCAYDE/login"> 
        <button type="button" class="btn btn-success">
        Login</button>
      </a>
  </div>
</div>
  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>

<style>
   body{
      display: grid;
      height: 100vh;
      place-items: center;
   }
   .card{
    text-align: center;
   }
   a{
    text-decoration: none;
   }
</style>