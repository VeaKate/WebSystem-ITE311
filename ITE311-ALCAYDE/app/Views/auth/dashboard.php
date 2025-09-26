<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <style>
       html,body{
        margin: 0;
        height: 100vh;
        padding: 5px;
        overflow: hidden;
      }
      .courses,
      .assignments{
        float: left;
        width:30%;
        height: 100%;
        overflow: auto;
        padding: 10px;
        background-color: rgb(247, 245, 243);
      }
      .notifications,
      .grading{
        float: right;
        overflow: auto;
        width: 70%;
        height: 100%;
        padding: 10px;
      }
      .ass{
        background-color: blue;
        color: white;
        padding: 5px;
      }
</style>
    </style>
</head>
<body>
    <?php if (session()->get('user_role') === 'teacher'): ?>
      <div class="courses">
        <h4>My Teached Courses</h4>
        <ul class="list-group mb-4">
        <?php foreach ($courses ?? [] as $c): ?>
          <li class="list-group-item"><?= esc($c['title']) ?></li>
        <?php endforeach; ?>
       </ul>
      <a href="<?= base_url('#') ?>" class="btn btn-primary">Add new Course</a>
      </div>
    <div class="notifications">
      <h4>Notifications</h4>
      <div class="alert alert-info">You have <?= esc($newAssignments ?? 0) ?> new assignments submitted.</div>
    </div>
    <?php endif; ?>

  <?php if (session()->get('user_role') === 'student'): ?>
    <div class="assignments">
        <h4 class="ass">Assignments</h4>
        <ul class="list-group mb-4">
          <?php foreach ($deadlines ?? [] as $d): ?>
            <li class="list-group-item"><?= esc($d['course']) ?> - <?= esc($d['date']) ?></li>
          <?php endforeach; ?>
        </ul>
    </div>

    <div class="grading">
      <h4>Recent Grades</h4>
      <table class="table table-bordered">
        <thead><tr><th>Course</th><th>Grade</th><th>Feedback</th></tr></thead>
        <tbody>
          <?php foreach ($grades ?? [] as $g): ?>
            <tr>
              <td><?= esc($g['course']) ?></td>
              <td><?= esc($g['grade']) ?></td>
              <td><?= esc($g['feedback']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

   <?php if (session()->get('user_role') === 'admin'): ?>
    <div class="row">
      <div class="col-md-4">
        <div class="card text-bg-primary mb-3">
          <div class="card-body">
            <h5 class="card-title">Total Users</h5>
            <p class="card-text fs-3"><?= esc($totalUsers ?? 0) ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-bg-success mb-3">
          <div class="card-body">
            <h5 class="card-title">Total Courses</h5>
            <p class="card-text fs-3"><?= esc($totalCourses ?? 0) ?></p>
          </div>
        </div>
      </div>
    </div>
    <h4>Recent Activity</h4>
    <table class="table table-striped">
      <thead><tr><th>User</th><th>Action</th><th>Date</th></tr></thead>
      <tbody>
        <?php if (!empty($activities)): ?>
          <?php foreach ($activities as $a): ?>
            <tr>
              <td><?= esc($a['user']) ?></td>
              <td><?= esc($a['action']) ?></td>
              <td><?= esc($a['created_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="3">No recent activity</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
