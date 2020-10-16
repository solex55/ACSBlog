<?php session_start();?>
<?php if(!isset($_SESSION['username'])):?>
    <?php header('location:dashboard.php');?>
<?php else: ?>
<?php
    include("config/db.php");
    $id = $_GET['id'];
    $posts_query = "SELECT * FROM posts WHERE id = '$id'";
        $posts_result = mysqli_query($conn, $posts_query);
        if(mysqli_num_rows($posts_result) > 0){
            while($posts = mysqli_fetch_assoc($posts_result)){
                $id = $posts['id'];
                $title = $posts['title'];
                $details = $posts['details'];
                $category = $posts['category'];
                $feat_image = $posts['feat_image'];
            }
        }
?>
<?php include("inc/header.php"); ?>

  <div class="container">
    <form class="form-horizontal" action="update.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <input type="hidden" name="feat_image" value="<?php echo $feat_image;?>">
      <fieldset>
        <h1>Edit Post</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <div class="col-lg-12">
                <?php if (isset($_POST['post'])): ?>
                    <div class="alert alert-dismissible alert-warning">
                        <p><?php echo $msg; ?></p>
                    </div>  
                <?php  endif; ?></div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="title" class="col-lg-3 col-form-label">Title</label>
                <div class="col-lg-9">
                  <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" placeholder="Title">
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="details" class="col-lg-3 col-form-label">Details</label>
                <div class="col-lg-9">
                  <textarea name="details" class="form-control" cols="10" rows="5" placeholder="Details..."><?php echo $details; ?></textarea>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="category" class="col-lg-3 col-form-label">Category</label>
                <div class="col-lg-9">
                  <select name="category" class="form-control">
                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                    <option value="entertainment">Entertainment</option>
                    <option value="sports">Sports</option>
                    <option value="news">News</option>
                    <option value="politics">Politics</option>
                  </select>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="featuredimage" class="col-lg-3 col-form-label">Featured Image</label>
                <div class="col-lg-9">
                  <input type="file" name="feat_image" class="form-control" placeholder="Featured Image">
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <div class="col-lg-10">
                  <input type="submit" name="post" value="Update Post" class="btn btn-primary">
                  <a href="dashboard.php" class="btn btn-default">Back</a>
                  </div>
              </div>
            </div>
        </div>
        
      </fieldset>
    </form>

  </div>

<?php include("inc/footer.php"); ?>

<?php endif;?>