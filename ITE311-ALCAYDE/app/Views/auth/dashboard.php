<?= $this->include('templates/header') ?> <!-- Include the header template for consistent layout -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design for mobile devices -->
    <title>Admin Dashboard</title> <!-- Title of the page -->
    <style>
        /* Custom styles for the dashboard layout */
        html, body {
            height: 100vh; /* Full height of the viewport */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            overflow: auto; /* Allow scrolling if content overflows */
        }
        nav {
            display: block; /* Ensure the navigation is displayed as a block element */
        }
        #main-page {
            justify-content: center; /* Center content in the main page */
        }
        .card {
            display: inline-block; /* Allow cards to be displayed inline */
            place-items: center; /* Center items within the card */
        }
        .Anouncements, .deadlines, .activities, .analytics {
            width: 100%; /* Full width for these sections */
        }
        .an-head, .dead-head, .act-head, .ann-head {
            background-color: lightgray; /* Light gray background for section headers */
            padding: 5px; /* Padding around the header */
            display: flex; /* Use flexbox for layout */
        }
        .btn-group {
            margin-left: auto; /* Align button group to the right */
        }
        .courses, .assignments {
            float: left; /* Float to the left for layout */
            width: 30%; /* Set width for courses and assignments sections */
            height: 100%; /* Full height */
            overflow: auto; /* Allow scrolling if content overflows */
            padding: 10px; /* Padding inside the sections */
            background-color: rgb(247, 245, 243); /* Light background color */
        }
        .notifications, .grading {
            float: right; /* Float to the right for layout */
            overflow: auto; /* Allow scrolling if content overflows */
            width: 70%; /* Set width for notifications and grading sections */
            height: 100%; /* Full height */
            padding: 10px; /* Padding inside the sections */
        }
        .ass {
            background-color: blue; /* Blue background for assignments header */
            color: white; /* White text color */
            padding: 5px; /* Padding around the header */
        }
    </style>

</head>
<body>
  <?php if (session()->get('user_role') === 'admin'): ?> <!-- Check if the logged-in user is an admin -->
    <!-- Admin dashboard main container -->
    <div id="main-page" class="navbar navbar-expand-lg bg-transparent">
        <!-- Total Users Card -->
        <div class="card" style="border: none">
            <div class="card text-bg-primary mb-3" style="max-width: 50rem; max-height: 10rem; margin: 20px;">
                <div class="card-header">Total Users</div> <!-- Card header -->
                <div class="card-body">
                    <h5 class="card-title">0</h5> <!-- Placeholder for total users count -->
                    <p class="card-text">Number of registered users.</p> <!-- Description -->
                </div>
            </div>

            <!-- Active Classes Card -->
            <div class="card text-bg-success mb-3" style="max-width: 50rem; max-height: 10rem; margin: 20px;">
                <div class="card-header">Active Classes</div> <!-- Card header -->
                <div class="card-body">
                    <h5 class="card-title">0</h5> <!-- Placeholder for active classes count -->
                    <p class="card-text">Number of active classes.</p> <!-- Description -->
                </div>
            </div>
      
            <!-- Total Courses Card -->
            <div class="card text-bg-warning mb-3" style="max-width: 50rem; margin: 20px; max-height: 10rem;">
                <div class="card-header">Total Courses</div> <!-- Card header -->
                <div class="card-body">
                    <h5 class="card-title">0</h5> <!-- Placeholder for total courses count -->
                    <p class="card-text">Number of available courses.</p> <!-- Description -->
                </div>
            </div>

            <!-- Upcoming Events Card -->
            <div class="card text-bg-info mb-3" style="max-width: 50rem; margin: 20px; max-height: 10rem;">
                <div class="card-header">Upcoming Events</div> <!-- Card header -->
                <div class="card-body">
                    <h5 class="card-title">0</h5> <!-- Placeholder for upcoming events count -->
                    <p class="card-text">Upcoming Event this month.</p> <!-- Description -->
                </div>
            </div>

            <!-- Notifications Card -->
            <div class="card text-bg-danger mb-3" style="max-width: 50rem; margin: 20px; max-height: 10rem;">
                <div class="card-header">Notifications</div> <!-- Card header -->
                <div class="card-body">
                    <h5 class="card-title">0</h5> <!-- Placeholder for notifications count -->
                    <p class="card-text">Upcoming Event this month.</p> <!-- Description -->
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Section -->
    <div class="Anouncements">
        <div class="an-head">
            <h3>Announcements</h3> <!-- Section title -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Date <!-- Button to filter announcements by date -->
                </button>
                <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET"> <!-- Form for date filtering -->
                        <div class="mb-3">
                            <label for="filterDate" class="form-label fw-semibold">Select Date</label> <!-- Date label -->
                            <input type="date" id="filterDate" name="date" class="form-control"> <!-- Date input -->
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button> <!-- Clear button -->
                            <button type="submit" class="btn btn-sm btn-primary">Apply</button> <!-- Apply filter button -->
                        </div>
                    </form>
                </ul>
            </div>
        </div>
        <h5>No Announcements at the Moment</h5> <!-- Placeholder message for announcements -->
    </div>

    <!-- Deadlines and Events Section -->
    <div class="deadlines">
        <div class="dead-head">
            <h3>Events and Deadlines</h3> <!-- Section title -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Date <!-- Button to filter events and deadlines by date -->
                </button>
                <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET"> <!-- Form for date filtering -->
                        <div class="mb-3">
                            <label for="filterDate" class="form-label fw-semibold">Select Date</label> <!-- Date label -->
                            <input type="date" id="filterDate" name="date" class="form-control"> <!-- Date input -->
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button> <!-- Clear button -->
                            <button type="submit" class="btn btn-sm btn-primary">Apply</button> <!-- Apply filter button -->
                        </div>
                    </form>
                </ul>
            </div>
        </div>
        <h5>No Events or Deadlines at the Moment</h5> <!-- Placeholder message for events and deadlines -->
    </div>

    <!-- Activities Section -->
    <div class="activities">
        <div class="act-head">
            <h3>Recent Activities</h3> <!-- Section title -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Date <!-- Button to filter activities by date -->
                </button>
                <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET"> <!-- Form for date filtering -->
                        <div class="mb-3">
                            <label for="filterDate" class="form-label fw-semibold">Select Date</label> <!-- Date label -->
                            <input type="date" id="filterDate" name="date" class="form-control"> <!-- Date input -->
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button> <!-- Clear button -->
                            <button type="submit" class="btn btn-sm btn-primary">Apply</button> <!-- Apply filter button -->
                        </div>
                    </form>
                </ul>
            </div>
        </div>
        <h5>No Activities at the Moment</h5> <!-- Placeholder message for activities -->
    </div>

    <!-- Analytics Section -->
    <div class="analytics">
        <div class="ann-head">
            <h3>Recent Analytics</h3> <!-- Section title -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Date <!-- Button to filter analytics by date -->
                </button>
                <ul class="dropdown-menu p-3" style="min-width: 250px;">
                    <form action="" method="GET"> <!-- Form for date filtering -->
                        <div class="mb-3">
                            <label for="filterDate" class="form-label fw-semibold">Select Date</label> <!-- Date label -->
                            <input type="date" id="filterDate" name="date" class="form-control"> <!-- Date input -->
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-sm btn-outline-secondary">Clear</button> <!-- Clear button -->
                            <button type="submit" class="btn btn-sm btn-primary">Apply</button> <!-- Apply filter button -->
                        </div>
                    </form>
                </ul>
            </div>
        </div>
        <h5>Nothing to show at the moment</h5> <!-- Placeholder message for analytics -->
    </div>

  <?php endif; ?> <!-- End of admin role check -->

  <?php if (session()->get('user_role') === 'teacher'): ?> <!-- Check if the logged-in user is a teacher -->
      <div class="courses">
        <h4>My Teached Courses</h4> <!-- Section title for courses -->
        <ul class="list-group mb-4">
        <?php foreach ($courses ?? [] as $c): ?> <!-- Loop through courses array -->
          <li class="list-group-item"><?= esc($c['title']) ?></li> <!-- Display course title -->
        <?php endforeach; ?>
       </ul>
      <a href="<?= base_url('#') ?>" class="btn btn-primary">Add new Course</a> <!-- Button to add a new course -->
      </div>
      
      <div class="notifications">
        <h4>Notifications</h4> <!-- Section title for notifications -->
        <div class="alert alert-info">You have <?= esc($newAssignments ?? 0) ?> new assignments submitted.</div> <!-- Display number of new assignments -->
      </div>
    <?php endif; ?> <!-- End of teacher role check -->

  <?php if (session()->get('user_role') === 'student'): ?> <!-- Check if the logged-in user is a student -->
    <div class="assignments">
        <h4 class="ass">Assignments</h4> <!-- Section title for assignments -->
        <ul class="list-group mb-4">
          <?php foreach ($deadlines ?? [] as $d): ?> <!-- Loop through deadlines array -->
            <li class="list-group-item"><?= esc($d['course']) ?> - <?= esc($d['date']) ?></li> <!-- Display course and deadline date -->
          <?php endforeach; ?>
        </ul>
    </div>

    <div class="grading">
      <h4>Recent Grades</h4> <!-- Section title for recent grades -->
      <table class="table table-bordered"> <!-- Table for displaying grades -->
        <thead>
          <tr>
            <th>Course</th> <!-- Column for course name -->
            <th>Grade</th> <!-- Column for grade -->
            <th>Feedback</th> <!-- Column for feedback -->
          </tr>
        </thead>
        <tbody>
          <?php foreach ($grades ?? [] as $g): ?> <!-- Loop through grades array -->
            <tr>
              <td><?= esc($g['course']) ?></td> <!-- Display course name -->
              <td><?= esc($g['grade']) ?></td> <!-- Display grade -->
              <td><?= esc($g['feedback']) ?></td> <!-- Display feedback -->
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?> <!-- End of student role check -->
</body>
</html>
