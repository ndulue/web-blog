<?php

    include'db_connect.php';

    session_start();

    if ((!isset($_SESSION['admin']))) {
        header('location:admin.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit post</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylee.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <nav class="navbar navbar-inverse">
            <div class="container" id="admincont">
                <a href="adminpanel.php" class="navbar-brand">BLOGA<span>ZINE<span></a>
                <div class="navbar-right"><br>
                    <b>You are logged in as <span><?php echo $_SESSION['admin']?></span></b>
                </div> 
            </div>
               
        </nav>
    </head>

    <body><br><br><br>
        <div>
            <?php
                if ($_GET) {
                    if (isset($_GET['delete'])) {
                        $delete = $_GET['delete'];
                        $delete = (int)$delete;

                        $dcquery = "DELETE * FROM post where id = '".$delete."'";
                        $dpsql = $db->query($dcquery);
                        if ($dpsql) {
                            echo "<p class='text-center text-primary bg-primary'>Comment has been successfully deleted!</p>";
                            header('location:edit_comments.php');
                        } else {
                            echo "<div class='alert alert-danger'>
                                    <a href='' class='close' data-dismiss='alert'>&times;</a>Cant delete the comment at the moment
                                  </div>";
                            header('location:edit_comments.php');      
                        }
                    }

                    if (isset($_GET['edit'])) {
                        $edit = $_GET['edit'];
                        $edit = (int)$edit;

                        $sepquery = "SELECT * from post where id = '$edit'";
                        $sepsql = $db->query($sepquery);
                        while($secom = $sepsql->fetch_assoc()){
                        $selected_title = $secom['title'];
                        $selected_content = $secom['content'];
                        }

                        if  (isset($_POST['edit_content'])) {
                            $post_title = $_POST['post_title'];
                            $post_content = $_POST['post_content'];
                            $udquery = "UPDATE post SET title = '".$post_title."', content = '".$post_content."' where id = '".$edit."'";
                            $udsql = $db->query($udquery);
                            if ($udsql) {
                                echo "<p class='text-center text-primary bg-primary'>Comment has been successfully updated!</p>";
                            } else {  
                                echo "<div class='alert alert-danger'>
                                        <a href='' class='close' data-dismiss='alert'>&times;</a>Cant update the comment at the moment
                                    </div>";
                            }
                        }
                    }
                } else {
                    $selected_title = '';
                    $selected_comment = '';
                }
            ?>
            <h3 class="text-center">ALL COMMENTS:</h3>
            <form action="edit_post.php" method="post">
            <div class="form-group">
                <input type="text" name="post_title" class="form-control" value="<?php echo $selected_title;?>" <?php echo ((!$_GET)? 'disabled' : '')?>>
            </div>
            <div class="form-group">
                <input type="text" name="post_content" class="form-control" value="<?php echo $selected_comment?>" <?php echo ((!$_GET)? 'disabled' : '')?>>
            </div>
            <div class="form-group text-right">
                <input type="submit" name="edit_content" class="btn btn-info" value="Edit content">
            </div>
            </form>
            <table class="table table-bordered table-hover table-striped text-center">
                <tbody>
                    <tr>
                        <td>Edit</td><td>Post title</td><td>Category</td><td>Post</td><td>Time</td><td>Delete</td>
                    </tr>
                    <tr>
                        <td><a href="edit_comments.php?edit=<?php echo $post['id'];?>"><i class="fa fa-pencil"></i></a></td>
                        <td><?php echo $post['title'];?></td>
                        <td><?php echo $post['categories'];?></td>
                        <td><?php echo $post['content'];?></td>
                        <td><?php echo $post['date'];?></td>
                        <td><a href="edit_comments.php?delete=<?php echo $post['id'];?>"><i class="fa fa-remove"></i></a></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>    
        </div>    
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>