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
    <h1>Welcome, Admin</h1>
</body>
</html>