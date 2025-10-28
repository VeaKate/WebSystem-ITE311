<?= $this->include('templates/header') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        html, body {
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        nav {
            display: block;
        }
        .find-use, .users {
            overflow: auto;
            width: 100%;
        }
        .btn-group {
            margin-left: auto;
            gap: 10px;
        }
        .op1 {
            overflow: visible;
            padding: 5px;
        }
        .users {
            overflow: visible;
            width: 100%;
            text-align: center;
        }
        .opt2 {
            background: none;
            border: none;
            font-size: 18px;
            width: 200px;
            padding: 5px;
        }
        .opt2:hover {
            background-color: rgb(29, 29, 176);
            color: white;
        }
        #switchCheckDefault{
            height: 30px;
            width: 70px;    
            border: 1px solid black;
        }
        .form-check-label{
            font-size: 25px;
        }
    </style>
</head>
<body>
    <?php if (isset($validation_ad)): ?>
        <div class="alert alert-danger">
            <?= $validation_ad->listErrors() ?>
        </div>
    <?php endif; ?>
    <?php if (isset($success_ad)): ?>
        <div class="alert alert-success">
            <?= $success_ad->listErrors() ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error_ad')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error_ad')) ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('info')) ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error_edit')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error_edit')) ?>
        </div>
    <?php endif; ?>

    <!--Search User-->
    <div class="find-use">
        <nav class="navbar bg-body-tertiary">
            <form class="container-fluid" action="<?= site_url('search-users') ?>" method="post">
                <?= csrf_field() ?>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input name="search_term" type="text" class="form-control" placeholder="Enter Names...." aria-label="Username" aria-describedby="basic-addon1"/>
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
                <form action="<?= site_url('search-users') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="search_term" value=" ">
                    <button type="submit" class="btn btn-success">
                        Refresh
                    </button>
                </form>
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
                            <form action="<?= site_url('addNewUser') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com" required pattern="[A-Za-z\s]+">
                                    <label for="floatingInput">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                    <label for="floatingInput">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="role" list="roles" type="text" class="form-control" id="floatingInput" placeholder="name@example.com" required pattern="[A-Za-z\s]+">
                                    <label for="floatingInput">Role</label>
                                    <datalist id="roles">
                                        <option value="Admin"></option>
                                        <option value="Teacher"></option>
                                        <option value="Student"></option>
                                    </datalist>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Users Table-->
    <div class="users">
        <?php
        $users = session('allUsers');
        $searchUsers = session('searchUsers');
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
                <?php if (!empty($searchUsers)): ?>
                    <?php foreach ($searchUsers as $searchUser): ?>
                        <?php $modalId = 'editInfo' . $searchUser['id']; ?>
                        <tr style="text-align: center;">
                            <th scope="row"><?= esc($searchUser['id']) ?></th>
                            <td><?= esc($searchUser['name']) ?></td>
                            <td><?= esc($searchUser['email']) ?></td>
                            <td><?= esc($searchUser['role']) ?></td>
                            <td><?= esc($searchUser['created_at']) ?></td>
                            <td><?= esc($searchUser['updated_at']) ?></td>
                            <td>
                                <?php if ($searchUser['id'] == session('user_id')): ?>
                                    <!-- Display "You" for the logged-in user -->
                                    <span class="text-muted">You</span>

                                <?php elseif($searchUser['account_status'] == 'restricted'): ?>
                                     <form action="<?= base_url('users/unrestrict/' . $searchUser['id'])?>" method="post">
                                         <?= csrf_field() ?>
                                         <button class="btn btn-warning">Unrestrict</button>
                                   </form>
                                <?php else: ?>
                                    <!-- Show dropdown for other users -->
                                    <div class="dropdown" data-bs-display="static">
                                        <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Options
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="opt2" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">Edit User Information</button>
                                            </li>
                                            <li>
                                                <form action="<?= base_url('users/restrict/' . $searchUser['id']) ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="opt2" onclick="return confirm('Are you sure you want to restrict this user?');">
                                                        Restrict this User
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <!-- Edit Modal (only show if not the current user) -->
                                <?php if ($searchUser['id'] != session('user_id')): ?>
                                    <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?= base_url('users/edit/' . $searchUser['id']) ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="<?= $modalId ?>Label">Edit User</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="name" id="name<?= $searchUser['id'] ?>" value="<?= esc($searchUser['name']) ?>" required>
                                                            <label for="name<?= $searchUser['id'] ?>">Name</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="email" class="form-control" name="email" id="email<?= $searchUser['id'] ?>" value="<?= esc($searchUser['email']) ?>" required>
                                                            <label for="email<?= $searchUser['id'] ?>">Email</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="role" id="role<?= $searchUser['id'] ?>" value="<?= esc($searchUser['role']) ?>" required>
                                                            <label for="role<?= $searchUser['id'] ?>">Role</label>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <input name="defpass" class="form-check-input" type="hidden" 
                                                            value="defaultpassword" role="switch" id="switchCheckDefault">
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
                                <?php endif; ?>
                                <!-- End Edit Modal -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif (!empty($users)): ?>
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
                                <?php if ($user['id'] == session('user_id')): ?>
                                    <!-- Display "You" for the logged-in user -->
                                    <span class="text-muted">You</span>
                                <?php elseif($user['account_status'] == 'restricted'): ?>
                                   <form action="<?= base_url('users/unrestrict/' . $user['id']) ?>" method="post">
                                        <?= csrf_field() ?>
                                         <button type="submit" class="btn btn-warning">Unrestrict</button>
                                   </form>
                                <?php else: ?>
                                    <!-- Show dropdown for other users -->
                                    <div class="dropdown" data-bs-display="static">
                                        <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Options
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="opt2" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">Edit User Information</button>
                                            </li>
                                            <li>
                                                <form action="<?= base_url('users/restrict/' . $user['id']) ?>" method="post" style="display:inline;">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="opt2" onclick="return confirm('Are you sure you want to restrict this user?');">
                                                        Restrict This User
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <!-- Edit Modal (only show if not the current user) -->
                                <?php if ($user['id'] != session('user_id')): ?>
                                    <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?= base_url('users/edit/' . $user['id']) ?>" method="post">
                                                    <?= csrf_field() ?>
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
                                                       <div class="form-check form-switch">
                                                        <input class="form-check-input" type="hidden" 
                                                        value="defaultpassword" role="switch" id="switchCheckDefault">
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
                                <?php endif; ?>
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
</body>
</html>
