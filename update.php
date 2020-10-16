<?php session_start();?>
<?php 
    include("config/db.php");
    if(isset($_FILES['feat_image'])){
        $post_id = $_POST['id'];
        $upl_feat_image = $_POST['feat_image'];
        $title = $_POST['title'];
        $category = $_POST['category'];

        $details = $_POST['details'];

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
              $image_path = explode('/', $upl_feat_image);
              $image = $image[6]; 
              $full_path =$path.'/'.'assets/featuredimages/'.$file_name;
              $id = $_SESSION['id'];
              $sql = "UPDATE posts SET title = '$title', details = '$details', category = '$category', feat_image = '$full_path' WHERE id = '$post_id'";
              unlink("assets/featuredimages/" . $image);
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