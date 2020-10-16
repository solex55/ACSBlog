<?php session_start();?>
<?php if(!isset($_SESSION['username'])):?>
    <?php header('location:dashboard.php');?>
<?php else: ?>

<?php include("inc/header.php");?>
<?php include("config/db.php");?>
<?php 
    if(isset($_POST['resetpwd'])){
        $email = $_POST['email'];
        $curpwd = $_POST['curpwd'];
        $newpwd = $_POST['newpwd'];
        $user_id = $_SESSION['id'];
        if($email != '' && $curpwd != '' && $newpwd != ''){
            if($curpwd != $newpwd){
                $hashcurpwd = sha1($curpwd);
                $hashnewpwd = sha1($newpwd);
                
                $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashcurpwd'";
                $query = mysqli_query($conn, $sql) or die('error');
                if(mysqli_num_rows($query) > 0){
                    $updsql = "UPDATE users SET password = '$hashnewpwd' WHERE id = $user_id";
                    if($conn -> query($updsql)){
                        $msg = "password updated successfully";
                    }else{
                        $msg = "failed to update password";
                    }
                }else{
                    $msg = "Credential not found";
                }
            }else{
                $msg = "Sorry both password are the same";
            }
        }else{
            $msg = "please fill all the details";
        }
    }
?>
    <div class="container">

    <form class="form-horizontal" action="changedpwd.php" method="POST">
      <fieldset>
        <legend>Reset Password</legend>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="email" class="col-lg-4 col-form-label">Email</label>
                <div class="col-lg-8">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="password" class="col-lg-4 col-form-label">Current password</label>
                <div class="col-lg-8">
                  <input type="text" name="curpwd" class="form-control" placeholder="Current password">
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="password" class="col-lg-4 col-form-label">New password</label>
                <div class="col-lg-8">
                  <input type="text" name="newpwd" class="form-control" placeholder="New password">
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <div class="col-lg-10">
                  <input type="submit" name="resetpwd" value="Change password" class="btn btn-primary">
                  <button type="reset" class="btn btn-default">Cancel</button>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <div class="col-lg-12">
                <?php if (isset($_POST['resetpwd'])): ?>
                    <div class="alert alert-dismissible alert-warning">
                        <p><?php echo $msg; ?></p>
                    </div>  
                <?php  endif; ?></div>
              </div>
            </div>
        </div>
        
      </fieldset>
    </form>

    </div>

<?php include("inc/footer.php");?>
<?php endif;?>
