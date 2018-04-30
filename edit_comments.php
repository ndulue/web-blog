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
    <title>Bootstrap Website</title>
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
        <div class="container">
            <?php
                    if (isset($_GET['delete'])) {
                        $delete = $_GET['delete'];

                        $dcquery = "DELETE * FROM comments where id = '".$delete."'";
                        $dpsql = $db->query($dcquery);
                            echo "<div class='alert alert-danger'>
                                    <a href='' class='close' data-dismiss='alert'>&times;</a>Comment has been successfully deleted!
                                  </div>";
                            header('location:edit_comments.php');
                    }

                    if (isset($_GET['edit'])) {
                        $edit = $_GET['edit'];
                        $edit = (int)$edit;

                        $secquery = "SELECT * from comments where id = '$edit'";
                        $secsql = $db->query($secquery);
                        while($secom = $secsql->fetch_assoc()){
                        $selected_comment = $secom['comment'];}

                        if (isset($_POST['editcomment'])) {
                            $postcomment = $_POST['postcomment'];
                            $udquery = "UPDATE comments SET comment = '".$postcomment."' where id = '$edit'";
                            $udsql = $db->query($udquery);
                                echo "<p class='text-center text-primary bg-primary'>Comment has been successfully updated!</p>";
                            }
                    } else {
                        $selected_comment = '';
                    }
            ?>
            <h3 class="text-center">ALL COMMENTS:</h3>
            <form action="edit_comments.php?id=<?php echo $com['id'];?>" method="post">
            <div class="form-group">
                <input type="text" name="postcomment" id="postcomment" class="form-control" value="<?php echo $selected_comment?>" <?php echo ((!$_GET)? 'disabled' : '')?> required 231>
            </div>
            <div class="form-group text-right">
                <input type="submit" name="editcomment" class="btn btn-info" value="Edit comment">
            </div>
            </form>
            <table class="table table-bordered table-hover table-striped text-center">
                <tbody>
                    <tr>
                        <td>Edit</td><td>Post title</td><td>Poster name</td><td>Email</td><td>Comment</td><td>Time</td><td>Delete</td>
                    </tr>
                    <?php 
                        $scquery = "SELECT * FROM comments";
                        $scsql = $db->query($scquery);
                        while($com = $scsql->fetch_assoc()):
                        $postid = $com['postid'];
                    ?>
                    <tr>
                        <td><a href="edit_comments.php?edit=<?php echo $com['id'];?>"><i class="fa fa-pencil"></i></a></td>
                        
                        <?php 
                            $spquery = "SELECT * FROM post where id = '$postid'"; 
                            $spsql = $db->query($spquery);
                            $post = $spsql->fetch_assoc();
                        ?>
                        <td><?php echo $post['title'];?></td>
                        <td><?php echo $com['name'];?></td>
                        <td><?php echo $com['email'];?></td>
                        <td><?php echo $com['comment'];?></td>
                        <td><?php echo $com['date'];?></td>
                        <td><a href="edit_comments.php?delete=<?php echo $com['id'];?>"><i class="fa fa-remove"></i></a></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>    
        </div>    
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>