<?php session_start();?>
<?php if(!isset($_SESSION['username'])):?>
    <?php header('location:dashboard.php');?>
<?php else: ?>
<?php include("config/db.php");?>
<?php include("inc/header.php");?>

    <div class="container">
        <h1>VIEW POST</h1>
        <?php $id = $_GET['id']; ?>

        <?php
        $posts_query = "SELECT * FROM posts WHERE id = '$id'";
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
            }
        }
        ?>

                    <h1 style="text-align: center;"><?php echo $title; ?></h1><br><br><br>

        <div class="row">
            <div class="col-lg-4">
                <img src=<?php echo $feat_image; ?> style="width:200px; heigth:2000px;"/>
            </div>
            <div class="col-lg-8">
                <p><?php echo $details; ?></p>
                <strong>Posted by: </strong> <?php echo $post_user; ?>  <strong> On: </strong><?php echo $b_date; ?><br>
                <a href=""><?php echo $category; ?></a>
                
                <div class="row">
                    <div class="col-lg-9">
                        <div class="col-sm-2">
                            <form action="likes.php" method="post">
                                <input type="hidden" name="id" value=<?php echo $id;?>>
                                <?php
                                    $sql = "SELECT * FROM likes WHERE post_id = '$id'";
                                    $query = mysqli_query($conn, $sql) or die('error');
                                    $cnt_likes = mysqli_num_rows($query);
                                ?>
                                <input type="submit" value="Like" name="like" style="color:#337ab; border:none; background:none;">
                                <?php echo $cnt_likes;?>
                            </form>
                        </div>
                        
                        <div class="col-lg-3">
                        <form action="dislike.php" method="post">
                                <input type="hidden" name="id" value=<?php echo $id;?>>
                                <?php
                                    $sql = "SELECT * FROM dislikes WHERE post_id = '$id'";
                                    $query = mysqli_query($conn, $sql) or die('error');
                                    $cnt_dislikes = mysqli_num_rows($query);
                                ?>
                                <input type="submit" value="Disike" name="dislike" style="color:#337ab; border:none; background:none;">
                                <?php echo $cnt_dislikes;?><br><br>
                            </form></div>
                        
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-6">
                <form action="comment.php" method="post" class="form-horizontal">
                    <input type="hidden" value=<?php echo $id;?> name="id">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"> Add comment</label>
                        <div class="col-lg-9">
                            <textarea name="comment" placeholder="Comment" class="form-control" cols="10" rows="5"></textarea>
                        </div>
                 </div>
                 <input type="submit" name="postcomment" class="btn btn-primary" value="Comment">
                <a href="dashboard.php" class="btn btn-default">Go Back</a>
                </form>
            </div>
        </div>
        
        <div class="row">
        
        <div class="col-lg-4">

        </div>
        <div class="col-lg-6">
        <br><hr>
            <h4>All Comments</h4>
            <?php 
            $com_query = "SELECT * FROM comment WHERE post_id = '$id' ORDER BY id DESC ";
            $comm_result = mysqli_query($conn, $com_query);
            if(mysqli_num_rows($comm_result) > 0){
                while($com = mysqli_fetch_assoc($comm_result)){
                    $username = $com['username'];
                    $comment = $com['comment'];
                    ?>

                    <p><?php echo $comment;?></p>
                    <p><b>By:</b> <?php echo $username;?></p>
                    <hr>
                    <?php
                }
            }
    
            ?>
            
        </div>

        </div>

    </div>


<?php include("inc/footer.php");?>
    <?php endif;?>