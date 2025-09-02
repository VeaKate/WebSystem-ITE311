<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
</head>
<body>
    <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
          </div>
    <?php endif; ?>

    <form action="<?= base_url('login/auth') ?>" method="post">
        <?= csrf_field() ?>
        <h1>Log In</h1>
      <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control" id="floatingInput" required placeholder="email@example.com">
        <label for="floatingInput">Email</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control" id="floatingInput" required placeholder="Password123">
        <label for="floatingInput">Password</label>
      </div>
      <br>
      <p>Don't have an account? <a href="register">Register</a></p>
      <button  type="submit" class="btn btn-success">Login</button>
    </form>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    </body>
</html>

<style>
   body{
      display: grid;
      height: 100vh;
      place-items: center;
   }
   .form-control{
    width: 300px;
   }
   form{
    text-align: center;
    border: 0.1px solid black;
    padding: 50px;
    border-radius: 15px;
   }
  </style>