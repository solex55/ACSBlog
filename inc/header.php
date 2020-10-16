<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACS Blog App</title>
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.css"/>

    <script src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="col-lg-10">
    <a class="navbar-brand" href="#" style="color: #fff;">ASC Blog App</a>
  </div>
  <div class="col-lg-2" style="margin-top:8px;">
    <div class="btn-group">
      <?php if (isset($_SESSION['id'])): ?>
        <a href="#" class="btn btn-light"><?php echo $_SESSION['username']; ?></a>

      <?php else: ?>
        <a href="#" class="btn btn-light">Settings</a>
      <?php endif; ?>
        <a href="#" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <span class="caret"></span>
        </a>
      <ul class="dropdown-menu">
        <?php $login_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?>
        <?php if ($login_url == 'http://localhost/phpblog/index.php'):?>
        <li><a href="login.php">Login</a></li>
          <?php elseif (isset($_SESSION['username'])):?>
            <li><a href=dashboard.php>Dashboard</a></li>
            <li><a href=profile.php>Add Profile</a></li>
            <li><a href=post.php>Add Post</a></li>
            <?php if($_SESSION['id'] == 1):?>
              <li><a href=users.php>All Users</a></li>
            <?php else:?>

            <?php endif;?>
            <li><a href=changedpwd.php>Reset password</a>
            <li><a href=logout.php>Logout</a>
          
          <?php else:?>  
            <li><a href="index.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>