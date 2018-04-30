<?php
    include 'db_connect.php';
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

    <body id="bap">


        <div class="container"><br><br><br><br><br>
            <div class="rows">
                <div class="col-lg-2 col-md-2">
                </div>

                <div class="col-lg-8 col-md-8" id="adpanel">
                    <ul class="nav nav-stacked nav-justified">
                        <li><a href="addpost.php">Add new post</a></li><br>
                        <li><a href="edit_post.php">View/Edit posts</a></li><br>
                        <li><a href="add_edit_category.php">Add/Edit category</a></li><br>
                        <li><a href="new_admin.php">Add new Admin</a></li><br>
                        <li><a href="edit_comments.php">Edit comments</a></li><br>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>    
                </div>

                <div class="col-lg-2 col-md-2">
                </div>

            </div>    
        </div>

    
    
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>