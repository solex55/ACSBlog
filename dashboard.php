<?php
    session_start();
?>
<?php
    include("config/db.php");
    $id = $_SESSION['id'];
    $query = "SELECT * FROM profile WHERE id = '$id'";
    $result = mysqli_query($conn, $query) or die('error');
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $avatar = $row['avatar'];
            $profession = $row['profession'];
        }
    }
?>
<?php if(!$_SESSION['username']):?>
    <?php header('Location:login.php');?>
<?php else: ?>
<?php include("inc/header.php"); ?>
<div class="container">
<?php
    $url = $_SERVER['PHP_SELF'];
    $seg = explode('/', $url);
    $path = "http://localhost".$seg[0].'/'.$seg[1];
    $full_path = $path . '/' . 'img' . '/' . 'avatar.png';
    
?>
<?php if($_SESSION['id'] == 1):?>
    <h1>Admin Dashboard</h1>
<?php else:?>
    <h1>User Dashboard</h1>
<?php endif; ?>
    <h1 style="text-align: center;">welcome <?php echo $_SESSION['username'];?></h1>
    <div class="row">
        <div class="col-lg-12">
        <p style="text-align: center;">
        <?php if(isset($avatar)):?>
            <img src=<?php echo $avatar;?> style="width:150px; height:150px; border-raduis:50px;"/>
            <h4 style="text-align: center;"><?php echo $profession; ?></h4>
        <?php else:?>
            <img src=<?php echo $full_path; ?>>
        <?php endif;?>
        </p>
        </div>
        <h1 style="text-align: center;"> ALL POSTS</h1>
    </div>
    <?php 
        $posts_query = "SELECT * FROM posts ORDER BY id DESC";
        $posts_result = mysqli_query($conn, $posts_query);
        if(mysqli_num_rows($posts_result) > 0){
            while($posts = mysqli_fetch_assoc($posts_result)){
                $id = $posts['id'];
                $title = $posts['title'];
                $details = $posts['details'];
                $category = $posts['category'];
                $b_date = $posts['b_date'];
                $post_user = $posts['post_user'];
                $feat_image = $posts['feat_image'];

                ?>
            <div class="row">
                <div class="col-lg-2">
                    <img src=<?php echo $feat_image; ?> style="width:150px; height:150px;">
                </div>
                <div class="col-lg-10">
                    <h3><a href="view.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></h3>
                    <p><?php echo substr($details, 0 , 60) . "....";
                    ?></p>
                    <strong>Posted by: </strong> <?php echo $post_user; ?>  <strong> On: </strong><?php echo $b_date; ?><br>
                    <a href=""><?php echo $category; ?></a><br>
                    <div class="row">
                        <?php if($_SESSION['id'] != 1):?>
                        <div class="col-lg-1"><a href="view.php?id=<?php echo $id; ?>">VIEW</a></div>        
                        
                        <?php else:?>                        
                        <div class="col-lg-1"><a href="view.php?id=<?php echo $id; ?>">VIEW</a></div>        
                        <div class="col-lg-1"><a href="edit.php?id=<?php echo $id; ?>">EDIT</a></div>
                        <div class="col-lg-1">
                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <input type="hidden" name="feat_image" value="<?php echo $feat_image;?>">
                                <input type="submit" class="btn btn-primary" name="delete" value="DELETE" style="background:none; border:none; color:#337ab7;">
                            
                            </form>
                        </div>                    
                        <?php endif;?>
                        <br><br><br>
                    </div>
                </div>
            </div>
                <?php
            }
        }
    ?>
    
</div>
<?php include("inc/footer.php"); ?>
<?php endif; ?>