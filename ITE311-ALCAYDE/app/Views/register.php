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

  <?php $errors = session('errors') ?? []; ?>
  <?php if (session('success')): ?>
    <p style="color:green;"><?= esc(session('success')) ?></p>
  <?php endif; ?>

  <?php if ($errors): ?>
    <ul style="color:red;">
      <?php foreach ($errors as $e): ?>
        <li><?= esc($e) ?></li>
      <?php endforeach ?>
    </ul>
  <?php endif; ?>

  <?= form_open('/register') ?>  <!-- auto-adds CSRF when filter is on -->
<div class="form-floating mb-3">
  <input name="name" type="text"  value="<?= old('name') ?>" required class="form-control" id="floatingInput" placeholder="e.g.User1">
  <label for="floatingInput">Username</label>
</div>
<div class="form-floating mb-3">
  <input name="email" type="email"  value="<?= old('email') ?>" required class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Email</label>
</div>
<div class="form-floating mb-3">
  <input name="password" type="password"  value="<?= old('password') ?>" required class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Password</label>
</div>
<div class="form-floating mb-3">
  <input name="pass_confirm" type="password"  value="<?= old('pass_confirm') ?>" required class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Confirm Password</label>
</div>
<p>Already have an Account? <a href="login">Login</a></p>
    <button type="submit" class="btn btn-outline-success">Create Account</button>
  <?= form_close() ?>
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