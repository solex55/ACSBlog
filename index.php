<?php include("config/db.php"); 
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    if($username != '' && $email != '' && $password != ''){
      $pwd_hash = sha1($password);
      $sql = "INSERT INTO users(username, email, password, user_role) VALUES('$username', '$email', '$pwd_hash', 0)";
      $query =$conn->query($sql);
      if(query){
        header('Location:login.php');
      }
      else{
        $error = 'failed to register user';
      }
    }
    else{
     $error = 'please fill all details';
    }
  }
?>
<?php include("inc/header.php"); ?>
<div class="container">
    <form class="form-horizontal" action="index.php" method="POST" autocomplete="off">
      <fieldset>
        <legend>Register User</legend>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <div class="col-lg-12">
                <?php if (isset($_POST['register'])): ?>
                    <div class="alert alert-dismissible alert-warning">
                        <p><?php echo $error; ?></p>
                    </div>  
                <?php  endif; ?></div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="username" class="col-lg-2 col-form-label">Username</label>
                <div class="col-lg-10">
                  <input type="text" name="username" class="form-control" placeholder="username">
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="Email" class="col-lg-2 col-form-label">Email</label>
                <div class="col-lg-10">
                  <input type="email" name="email" class="form-control" placeholder="email">
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="password" class="col-lg-2 col-form-label">Password</label>
                <div class="col-lg-10">
                  <input type="password" name="password" class="form-control" placeholder="password">
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <div class="col-lg-10">
                  <input type="submit" name="register" value="Register" class="btn btn-primary">
                  <button type="reset" class="btn btn-default">Cancel</button>
                </div>
              </div>
            </div>
        </div>
        
        </fieldset>
    </form>

  </div>
<?php include("inc/footer.php"); ?>