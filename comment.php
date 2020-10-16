<?php session_start();?>
<?php if(!isset($_SESSION['username'])):?>
    <?php header('location:dashboard.php');?>
<?php else: ?>
<?php include("config/db.php");?>
<?php 
    if(isset($_POST['postcomment'])){
        $userid = $_SESSION['id'];
        $postid = $_POST['id'];
        $username = $_SESSION['username'];
        $comment = $_POST['comment'];

        if($comment != ""){
            $sql = "INSERT INTO comment (user_id, post_id, username, comment) VALUES ('$userid', '$postid', '$username', '$comment')";
            $query = $conn -> query($sql);
            if($query){
                header("location: view.php?id=" . $postid);
            }
        }
    }

?>

<?php endif;?>