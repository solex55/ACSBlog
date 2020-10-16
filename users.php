<?php session_start();?>
<?php if(!isset($_SESSION['username'])):?>
    <?php header('location:dashboard.php');?>
<?php elseif($_SESSION['id'] == 1): ?>
<?php include("config/db.php");?>
<?php include("inc/header.php");?>
<div class="container">
    <h1 style="text-align:center;">view all users</h1>

    <?php
        $sql = "SELECT * FROM users INNER JOIN  profile ON users.id = profile.user_role WHERE users.user_role != 1";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($users = mysqli_fetch_assoc($result)){
                $id = $users['id'];
                $username = $users['username'];
                $email = $users['email'];
                $avatar = $users['avatar'];
            ?>
            <div class="row">
                <div class="col-lg-4">
                    <img src="<?php echo $avatar; ?>" style="height:200px; width:200px; border-radius:50%;"/>
                </div>
                <div class="col-lg-8">
                    <h3><?php echo $username; ?></h3>
                    <p><?php echo $email; ?></p>
                </div>
            </div>
            <hr>
            <?php
            
            }
        }
        ?>
</div>
    <?php else:?>
    <?php header('location:dashboard.php');?>

<?php include("inc/footer.php");?>
<?php endif;?>