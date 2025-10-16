<?= $this->include('templates/header') ?>

<!--<!DOCTYPE html>
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
</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
     
    <style>
        html, body{
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: auto;
        }
        nav{
            display: block;
        }
        #main-page{
            justify-content: center;
        }
        .card{
            display: inline-block;
            place-items: center;
        }
        .Anouncements, .deadlines, .activities, .analytics{
            width: 100%;
        }
        .an-head, .dead-head, .act-head, .ann-head{
            background-color: lightgray;
            padding: 5px;
            display: flex;
        }
        .btn-group{
            margin-left: auto;
        }
       
    </style>

</head>
<body>
  <?php if (session()->get('user_role') === 'admin'): ?>
    <!--Admin dashboard main container-->
    <div id="main-page" class="navbar navbar-expand-lg bg-transparent">
    <!-- Total Users Card -->
           <div class="card" style="border: none">
             <div class="card text-bg-primary mb-3" style="max-width: 50rem;  max-height: 10rem; margin: 20px;">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                <h5 class="card-title">0</h5>
                <p class="card-text">Number of registered users.</p>
                </div>
            </div>

    <!--Active Classes -->
            <div class="card text-bg-success mb-3" style="max-width: 50rem;  max-height: 10rem; margin: 20px;">
                <div class="card-header">Active Classes</div>
                <div class="card-body">
                <h5 class="card-title">0</h5>
                <p class="card-text">Number of active classes.</p>
                </div>
            </div>
      
     <!-- Total Courses Card -->
           <div class="card text-bg-warning mb-3" style="max-width: 50rem; margin: 20px; max-height: 10rem;">
                <div class="card-header">Total Courses</div>
                <div class="card-body">
                <h5 class="card-title">0</h5>
                <p class="card-text">Number of available courses.</p>
                </div>
            </div>
            <!--Upcoming Events-->
             <div class="card text-bg-info mb-3" style="max-width: 50rem; margin: 20px; max-height: 10rem;">
                <div class="card-header">Upcoming Events</div>
                <div class="card-body">
                <h5 class="card-title">0</h5>
                <p class="card-text">Upcoming Event this months.</p>
                </div>
            </div>
            <!--Notifications-->
              <div class="card text-bg-danger mb-3" style="max-width: 50rem; margin: 20px; max-height: 10rem;">
                <div class="card-header">Notifications</div>
                <div class="card-body">
                <h5 class="card-title">0</h5>
                <p class="card-text">Upcoming Event this months.</p>
                </div>
            </div>
        </div>
    </div>
    <!--Announcements-->
    <div class="Anouncements">
        <div class="an-head">
            <h3>Announcements</h3>
            <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by Date
            </button>
            <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET">
                    <div class="mb-3">
                        <label for="filterDate" class="form-label fw-semibold">Select Date</label>
                        <input type="date" id="filterDate" name="date" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button>
                        <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                    </div>
                    </form>
                </ul>
                </div>
            </div>
        </div>
        <h5>No Announcements at the Moment</h5>
    </div>
    <!--Deadlines and Events-->
    <div class="deadlines">
       <div class="dead-head">
             <h3>Events and Deadlines</h3>
              <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by Date
            </button>
            <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET">
                    <div class="mb-3">
                        <label for="filterDate" class="form-label fw-semibold">Select Date</label>
                        <input type="date" id="filterDate" name="date" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button>
                        <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                    </div>
                    </form>
                </ul>
                </div>
       </div>
         <h5>No Events or Deadlines at the Moment</h5>
    </div>
    <!--Activities-->
     <div class="activities">
       <div class="act-head">
             <h3>Recent Activities</h3>
              <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by Date
            </button>
            <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET">
                    <div class="mb-3">
                        <label for="filterDate" class="form-label fw-semibold">Select Date</label>
                        <input type="date" id="filterDate" name="date" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button>
                        <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                    </div>
                    </form>
                </ul>
                </div>
       </div>
         <h5>No Activities at the Moment</h5>
    </div>
    <!--Analytics-->
     <div class="analytics">
       <div class="ann-head">
             <h3>Recent Activities</h3>
              <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by Date
            </button>
            <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET">
                    <div class="mb-3">
                        <label for="filterDate" class="form-label fw-semibold">Select Date</label>
                        <input type="date" id="filterDate" name="date" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button>
                        <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                    </div>
                    </form>
                </ul>
                </div>
       </div>
         <h5>Nothing to show at the moment</h5>
    </div>
  <?php endif; ?>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
