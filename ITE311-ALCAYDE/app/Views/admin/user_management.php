<?= $this->include('templates/header') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">


    <style>
         html, body{
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
         nav{
            display: block;
        }
        .find-use, .users{
          overflow: auto;
          width: 100%;
        }
        .btn-group{
            margin-left: auto;
        }
        .op1{
            overflow:visible;
            padding: 5px;
        }
        .users{
          overflow: visible;
          width: 100%;
          text-align: center;
        }
        .opt2{
            background: none;
            border: none;
            font-size: 18px;
            width: 200px;
            padding: 5px;
        }
        .opt2:hover{
            background-color: rgb(29, 29, 176);
            color: white;
        }
    </style>
</head>
<body>
    <!--Search User-->
    <div class="find-use">
       <nav class="navbar bg-body-tertiary">
            <form class="container-fluid" action="" method="post">
                <div class="input-group">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"/>
                <button class="btn btn-outline-success" type="submit">Search User</button>
                </div>
            </form>
        </nav>
    </div>
    <!--All Users-->
    <div class="op1">
       <!-- Put filter + modal controls OUTSIDE -->
        <div class="d-flex flex-wrap align-items-center gap-2 my-3">
        <div class="btn-group">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add new User
        </button>
        </div>

        <!-- Modal (outside table) -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Name</label>
                    </div>
                     <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email</label>
                    </div>
                     <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Role</label>
                    </div>
                     <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Password</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save Changes</button>
                </form>
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!--Users Table-->
    <div class="users">
       <?php
            $users = session('allUsers');
            $filteredUsers = session('filteredUsers');
        ?>
      <table class="table">
          <thead>
              <tr style="text-align: center;">
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Roles</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Updated At</th>
                  <th scope="col">Options</th>
              </tr>
          </thead>
          <tbody>
              <?php if (!empty($users)): ?>
                  <?php foreach ($users as $user): ?>
                      <?php $modalId = 'editInfo' . $user['id']; ?>
                      <tr style="text-align: center;">
                          <th scope="row"><?= esc($user['id']) ?></th>
                          <td><?= esc($user['name']) ?></td>
                          <td><?= esc($user['email']) ?></td>
                          <td><?= esc($user['role']) ?></td>
                          <td><?= esc($user['created_at']) ?></td>
                          <td><?= esc($user['updated_at']) ?></td>
                          <td>
                              <div class="dropdown" data-bs-display="static">
                                  <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Options
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-end">
                                      <li>
                                          <button class="opt2" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">Edit User Information</button>
                                      </li>
                                      <li>
                                          <form action="<?= base_url('users/delete/' . $user['id']) ?>" method="post" style="display:inline;">
                                              <button type="submit" class="opt2" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</button>
                                          </form>
                                      </li>
                                  </ul>
                              </div>
                              <!-- Edit Modal (unique per user) -->
                              <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <form action="<?= base_url('users/edit/' . $user['id']) ?>" method="post">
                                              <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="<?= $modalId ?>Label">Edit User</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="form-floating mb-3">
                                                      <input type="text" class="form-control" name="name" id="name<?= $user['id'] ?>" value="<?= esc($user['name']) ?>" required>
                                                      <label for="name<?= $user['id'] ?>">Name</label>
                                                  </div>
                                                  <div class="form-floating mb-3">
                                                      <input type="email" class="form-control" name="email" id="email<?= $user['id'] ?>" value="<?= esc($user['email']) ?>" required>
                                                      <label for="email<?= $user['id'] ?>">Email</label>
                                                  </div>
                                                  <div class="form-floating mb-3">
                                                      <input type="text" class="form-control" name="role" id="role<?= $user['id'] ?>" value="<?= esc($user['role']) ?>" required>
                                                      <label for="role<?= $user['id'] ?>">Role</label>
                                                  </div>
                                                  <!-- Add more fields as needed -->
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                              <!-- End Edit Modal -->
                          </td>
                      </tr>
                  <?php endforeach; ?>

              <?php else: ?>
                  <tr><td colspan="7" class="text-center">No users found.</td></tr>
              <?php endif; ?>
          </tbody>
      </table>
    </div>
   <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>