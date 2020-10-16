<?php session_start();?>
<?php if(!isset($_SESSION['username'])):?>
    <?php header('location:dashboard.php');?>
<?php else:?>
    <?php 
        include("config/db.php");
        $user_id =$_SESSION['id'];
        if(isset($_POST['like'])){
            $post_id = $_POST['id'];
            $sql = "INSERT INTO likes (user_id, post_id) VALUES('$user_id', '$post_id')";
            if($conn -> query($sql)){
                header("location: view.php?id=" . $post_id);
            }
        }
    ?>

<?php endif;?>