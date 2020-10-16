<?php session_start();?>
<?php 
    include("config/db.php");
    if(isset($_FILES['feat_image'])){
        $title = $_POST['title'];
        $category = $_POST['category'];

        $details = $_POST['details'];
        $date = date('l dS F\, Y');

        if($title != '' && $details != '' && $category !=''){
            $uploadok =1;
            $file_name = $_FILES['feat_image']['name'];
            $file_size = $_FILES['feat_image']['size'];
            $file_tmp = $_FILES['feat_image']['tmp_name'];
            $file_type = $_FILES['feat_image']['type'];
            $target_dir = "assets/featuredimages";
            $target_file = $target_dir . basename($_FILES['feat_image']['name']);
            $check = getimagesize($_FILES['feat_image']['tmp_name']);
            $file_ext = strtolower(end(explode('.', $file_name)));

            //$file_ext = strtolower(end(explode('.', $_FILES['avatar']['name'])));
            $extensions = array("jpeg", "jpg", "png");
            if(in_array($file_ext, $extensions) == false){
              $msg = "please choose the image which has extension jpeg, jpg, png";
            }
            if(file_exists($target_file)){
              $msg = "sorrry file already exist";
            }
            if($check == false){
              $msg = "file is not an image";
            }
            if(empty($msg) == true){
              move_uploaded_file($file_tmp, "assets/featuredimages/" . $file_name);
              $url = $_SERVER['HTTP_REFERER'];
              $seg = explode('/', $url);
              $path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
              $full_path =$path.'/'.'assets/featuredimages/'.$file_name;
              $id = $_SESSION['id'];
              $post_user = $_SESSION['username'];
              $sql = "INSERT INTO posts(title, details, category, b_date, post_user, feat_image, user_role) VALUES('$title', '$details', '$category', '$date', '$post_user', '$full_path', '$id' )";
              $query = $conn->query($sql);
              if($query){
                header('location:dashboard.php');
              }else{
                $msg = "failed to upload image";
              }
            }
            
            
        }
        else{
            $msg = "fill all details";
        }
    }
?>
<?php if(!isset($_SESSION['username'])):?>
    <?php header('Location:dashboard.php');?>
<?php else: ?>
<?php include("inc/header.php"); ?>

  <div class="container">
    <form class="form-horizontal" action="post.php" method="POST" enctype="multipart/form-data">
      <fieldset>
        <h1>Add Post</h1>
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
                  <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="details" class="col-lg-3 col-form-label">Details</label>
                <div class="col-lg-9">
                  <textarea name="details" class="form-control" cols="10" rows="5" placeholder="Details..."></textarea>
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
                    <option>Select</option>
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
                  <input type="submit" name="post" value="Add post" class="btn btn-primary">
                  <button type="reset" class="btn btn-default">Cancel</button>
                </div>
              </div>
            </div>
        </div>
        
      </fieldset>
    </form>

  </div>

<?php include("inc/footer.php"); ?>
<?php endif;?>