<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
</head>
<body>
  <h1>Create your account</h1>

  <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
          <?= esc(session()->getFlashdata('error') )?>
        </div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= esc(session()->getFlashdata('success')) ?>
        </div>
  <?php endif; ?>
  <?php if(isset($validation)): ?>
        <div class="alert alert-danger">
          <?= $validation->listErrors() ?>
        </div>
  <?php endif; ?>

  <form action="<?= site_url('register') ?>" method="post">
     <?= csrf_field() ?>
<div class="form-floating mb-3">
  <input name="name" type="text"  value="<?= set_value('name') ?>" required class="form-control" id="floatingInput" placeholder="e.g.User1">
  <label for="floatingInput">Username</label>
</div>
<div class="form-floating mb-3">
  <input name="email" type="email" value="<?= set_value('email') ?>" required class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Email</label>
</div>
<div class="form-floating mb-3">
  <input name="role" type="text" list="roles" required class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Role</label>
  <datalist id="roles">
 <option value="admin">
  <option value="teacher">
  <option value="student">
</datalist>
</div>
<div class="form-floating mb-3">
  <input name="password" type="password" name="password" required class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Password</label>
</div>
<div class="form-floating mb-3">
  <input name="password_confirm" type="password" required class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Confirm Password</label>
</div>
<p>Already have an Account? <a href="login">Login</a></p>
    <button type="submit" class="btn btn-outline-success">Create Account</button>
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