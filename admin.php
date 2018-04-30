<?php 
    include 'db_connect.php';
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Website</title>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylecms.css" rel="stylesheet">

    
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
        <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-left">
                <a href="index.php">Home</a> &nbsp; &nbsp;
                <a href="#">About</a> &nbsp; &nbsp;
                <a href="contact.php">Contact</a> &nbsp; &nbsp;
            </div>
            <div class="navbar-right">
                <a href="#"><i class="fa fa-facebook fa-lg"></i></a> &nbsp;
                <a href="#"><i class="fa fa-twitter fa-lg"></i></a> &nbsp;
                <a href="#"><i class="fa fa-instagram fa-lg"></i></a> &nbsp;
                <a href="#"><i class="fa fa-android fa-lg"></i></a> &nbsp;
                <a href="#"><i class="fa fa-skype fa-lg"></i></a> &nbsp;
            </div>
            
        </div>
        <div class="container" id="con">
        <a class="navbar-brand" href="#">BLOGA<span>ZINE<span></a>
        </div>
      </nav>
    </head>

    <body id="login">
        <div class="col-md-4 col-lg-4">
        </div> 
        <div class="col-md-4 col-lg-4" id="form">
            <h3>ADMIN LOGIN FORM:</h3><br>
            <?php
            if (isset($_POST['login'])) {
                if ((isset($_POST['username'])) || (isset($_POST['password']))) {

                    $username = $_POST['username'];
                    $username = htmlentities($username);

                    $password = ((isset($_POST['password']))? htmlentities($_POST['password']) : '' );
                    $password = trim($password);
                    
                    $ALquery = "SELECT * from admin WHERE username = '$username'";
                    $ALsql = $db->query($ALquery);
                    $admin = $ALsql->fetch_assoc();
                    $num = $ALsql->num_rows;

                    if ($num == 1) {

                        if (password_verify($password, $admin['password']) == true) {
                            $_SESSION['admin'] = $username;
                            header('location:adminpanel.php');
                        } else{
                        echo "<div class='alert alert-danger alert-sm'><a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <h4>Incorrect password!</h4>
                        </div>";
                    }
                        
                    } else{
                        echo "<div class='alert alert-danger alert-sm'><a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <h4>Incorrect email address</h4>
                        </div>";
                    }
                    
                }
            } else {
                $username = '';
                $password = '';
            }
            ?>
            
            
        <form action="admin.php" method="post">
            <input type="text" name="username" placeholder="username" class="form-control" value="<?php echo $username;?>" required><br>
            <input type="password" name="password" placeholder="password" class="form-control" value="<?php echo $password;?>" required><br>
            <input type="submit" value="Login" name="login" class="btn btn-success text-right">
        </form>
        </div>
        <div class="col-md-4 col-lg-4">
        </div>    
    
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>