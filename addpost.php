<?php 
    session_start();
    if ((!isset($_SESSION['admin']))) {
        header('location:admin.php');
    }
    include 'db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Website</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylecms.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>

      <nav class="navbar navbar-inverse">
            <div class="container" id="admincont">
                <a href="adminpanel.php" class="navbar-brand">BLOGA<span>ZINE<span></a>
            </div>
        </nav>
    
    </head>

    <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2">

            </div>

            <div class="col-lg-8 col-md-8" id="addpost">
                <h3 class="text-center">ADD A POST:</h3><br>
                <?php
                    if (isset($_POST['addpost'])) {
                        $title = $_POST['title'];
                        $title = htmlentities($title);


                        $post = $_POST['post'];
                        $post = htmlentities($post);

                        $category = $_POST['categories'];
                        $category = htmlentities($category);

                        if ($_FILES) {
                            $himage = $_FILES['headimage']['name'];
                            $himagesize = $_FILES['headimage']['size'];
                            $himagetype = $_FILES['headimage']['type'];
                            $himagetmp  = $_FILES['headimage']['tmp_name'];

                            if ($himagesize > 2000000) {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        Image is too large!
                                    </div>";
                            }

                            if ($himagetype != image/png || image/jpeg || image/jpg || image/gif){
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        Image type is invalid!
                                    </div>";               
                            }
                            $hupimage = '/cms/image/'.$himage;

                            if (is_uploaded_file($himagetmp)) {
                                if (!move_uploaded_file($himagetmp,$hupimage)) {
                                    echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        Error in moving the uploaded file
                                    </div>"; 
                                }
                            } else {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        Error uploading file!
                                    </div>"; 
                            }

                            

                            $img1 = $_FILES['image1']['name'];
                            $img1size = $_FILES['image1']['size'];
                            $img1type = $_FILES['image1']['type'];
                            $img1tmp = $_FILES['image1']['tmp_name'];

                            if ($img1size > 2000000) {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img1;?> size is large!
                                    </div>"; 
                            }
                            if($img1type != image/jpg || image/jpeg || image/png || image/gif){
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img1;?> type is invalid!
                                    </div>"; 
                            }

                            $upload1 = '/cms/image'.$img1;

                            if (is_uploaded_file($img1tmp)) {
                                if (!move_uploaded_file($img1tmp,$upload1)) {
                                    echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        couldnt move <?php echo $img1;?>
                                    </div>"; 
                                }
                            } else {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        Error in uploading <?php echo $img1;?>
                                    </div>"; 
                            }

                            $img2 = $_FILES['image2']['name'];
                            $img2size = $_FILES['image2']['size'];
                            $img2type = $_FILES['image2']['type'];
                            $img2tmp = $_FILES['image2']['tmp_name'];

                            if ($img2size > 2000000) {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img2;?> size is large!
                                    </div>"; 
                            }
                            if ($img2type != 'image/png' || 'image/jpg' || 'image/jpeg' || 'image/gif') {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img2;?> type is invalid
                                    </div>"; 
                            }
                            $upload2 = '/cms/image'.$img2;
                            if (is_uploaded_file($img2tmp)) {
                                if (!move_uploaded_file) {
                                    echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        couldnt move <?php echo $img2;?>
                                    </div>"; 
                                }
                            } else {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img2;?> was not uploaded
                                    </div>"; 
                            }

                            $img3 = $_FILES['image3']['name'];
                            $img3size = $_FILES['image3']['size'];
                            $img3type = $_FILES['imag3']['type'];
                            $img3tmp = $_FILES['imag3']['tmp_name'];

                            if ($img3size > 2000000) {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img3;?> size is large!
                                    </div>"; 
                            }
                            if ($img3type != 'image/png' || 'image/jpg' || 'image/jpeg' || 'image/gif') {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img3;?> type is invalid
                                    </div>"; 
                            }
                            $upload3 = '/cms/image'.$img3;
                            if (is_uploaded_file($img3tmp)) {
                                if (!move_uploaded_file) {
                                    echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        couldnt move <?php echo $img3;?>
                                    </div>"; 
                                }
                            } else {
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        <?php echo $img3;?> was not uploaded
                                    </div>"; 
                            }

                        }

                        $postquery = "SELECT * FROM post where title = '".$title."' and content = '".$post."'";
                        $postsql = $db->query($postquery);
                        $num = $postsql->num_rows;

                        if($num > 0){
                            echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>
                                        post already exist
                                    </div>"; 
                        } else {
                            $ipquery = "INSERT into post (id, title, headimage, content, categories, postimage1, postimage2, 
                                        postimage3) value ('', '".$title."', '".$himage."', '".$post."', '".$category."', '".$img1."', '".$img2."', '".$img3."')";
                            $ipsql = $db->query($ipquery);
                            if ($ipsql) {
                                return true;
                                echo "<div class='text-success bg-success'>
                                        Post has been successfully added
                                    </div>"; 
                            } else {
                                return false;
                                echo "<div class='alert alert-danger'><a href='' class='close' data-dismiss='alert'>&times;</a>
                                        Error in adding post to database
                                    </div>"; 
                            }            
                        }

                    }
                ?>
                <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Post title" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="file" name="headimage" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea name="post" id="post" rows="6" cols="20" class="form-control" placeholder="Enter post" required></textarea>
                    </div>    
                    <div class="form-group">
                        <select name="categories" id="cat" class="form-control" required>
                            <option value="">Select categories</option>
                            <?php 
                                $squery = "SELECT * FROM category order by id";
                                $ssql = $db->query($squery);
                                while($cat = $ssql->fetch_assoc()):
                                ?>
                            <option value="<?php echo $cat['categories']?>"><?php echo $cat['categories']?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image1" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image2" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image3" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addpost" class="form-control btn btn-success" value="Add post">
                    </div>
                </form>
            </div>

            <div class="col-lg-2 col-md-2">

            </div>
        </div>
    </div>
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>