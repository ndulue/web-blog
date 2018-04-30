<?php 

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
    <title>Add new administrator</title>
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
        <div class="container">
            <div class="col-lg-2 col-md-2">

            </div>
            <div class="col-lg-8 col-md-8" id="form">
                <?php
                    if (isset($_POST['addadmin'])) {
                        $uname = $_POST['username'];
                        $uname = htmlentities($uname);

                        $pass = $_POST['password'];
                        $pass = htmlentities($password);

                        $pass2 = $_POST['password2'];
                        $pass2 = htmlentities($pass2);

                        $hashed = password_hash($pass, PASSWORD_DEFAULT);

                        if ($pass != $pass2) {
                            echo '<div class="alert alert-danger">
                                  <a href="" class="close" data-dismiss="alert">&times;</a> You typed in different password
                                  </div>';
                        }
                        if (strlen($pass) < 6 || strlen($pass) > 16) {
                            echo '<div class="alert alert-danger">
                                  <a href="" class="close" data-dismiss="alert">&times;</a> Password must be between 6 and 16 characters only
                                  </div>';
                        }

                        $asquery = "SELECT * FROM admin where username = '$uname' and password = '$pass'";
                        $assql = $db->query($asquery);
                        $num = $assql->num_rows;

                        if ($num > 0) {
                            return false;
                            echo '<div class="alert alert-danger">
                                  <a href="" class="close" data-dismiss="alert">&times;</a> login details already exist in the database
                                  </div>';
                        } else {
                            $iaquery ="INSERT INTO admin('id', 'username', 'password') values ('','$uname','$pass')";
                            $iasql = $db->query($iaquery);
                            if ($iasql) {
                                return true;
                                echo '<p text-center text-primary bg-primary>New admin added</p>';

                            }  else {
                                return false;
                                echo '<div class="alert alert-danger">
                                  <a href="" class="close" data-dismiss="alert">&times;</a>Admin details couldnt be added
                                  </div>';
                            }
                        }
                    }
                ?>
                <h3 class="text-left" id="ana">ADD NEW ADMIN:</h3>
                <form action="new_admin.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="enter username" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="enter password" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password2" class="form-control" placeholder="re-enter password" required>
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" name="addadmin" class="btn btn-info" value="Add user">
                    </div>    
                </form>

            </div>

            <div class="col-lg-2 col-md-2">

            </div>
        </div>
    
    
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>