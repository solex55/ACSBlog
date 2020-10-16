    <?php
    include("config/db.php");
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $feat_image = $_POST['feat_image'];
        $seg = explode('/', $feat_image);
        $image = $seg[6];
        $sql = "DELETE FROM posts WHERE id = $id";
        $query = $conn -> query($sql);
        unlink("assets/featuredimages/" . $image);
        if($query){
            header("location: dashboard.php");
        }
    }
    ?>
