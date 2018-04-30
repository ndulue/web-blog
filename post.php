<?php
    include 'db_connect.php';
    if (!($_GET)) {
            header('location:index.php');
        } else {
            $id = $_GET['id'];
            $id = (int)$_GET['id'];
            $Pquery = "SELECT * FROM post where id = '$id'";
            $Psql = $db->query($Pquery);
            if (!$Psql){
                    return false;
                    echo "<p class='text-center bg-danger text-danger'>This page does not exist!!</p>";
                    exit();
            }
        }
    $Mquery = "SELECT * from post order by date";
    $Msql = $db->query($Mquery);
    while($Mresult = $Msql->fetch_assoc()){
        $Mid = $Mresult['id'];
    };

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
        <div class="container">
            <div class="navbar-left">
                <a href="index.php">Home</a> &nbsp; &nbsp;
                <a href="#">About</a> &nbsp; &nbsp;
                <a href="contact.php">Contact Us</a> &nbsp; &nbsp;
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
        <a href="index.php" class="navbar-brand" >BLOGA<span>ZINE<span></a>
        </div>
      </nav>
      <header>
          <div class="container" id="cont">
            <a href="index.php"><i class="fa fa-home fa-lg"></i></a> &nbsp; &nbsp; &nbsp; &nbsp;
            <?php 
                $Aquery = "SELECT * FROM category order by id";
                $Asql = $db->query($Aquery);
                while($cate = $Asql->fetch_assoc()):
            ?>

            <a href="category.php?category=<?php echo $cat['categories'];?>"><?php echo $cate['categories'];?></a> &nbsp; &nbsp; &nbsp;
            <?php endwhile;?>
            <div class="form-group">
                <form action="index.post" method="post">
                <input type="text" id="text" placeholder="search" class="form-control">
                </form>
            </div>    
          </div>
      </header>
    </head>

    <body>

    <div class="container" id="con1">
            <div class="row"><br>
                <div class="col-lg-9 col-md-9" id="post-bar">
                    <div class="container-fluid">
                        <?php while($post = $Psql->fetch_assoc()):?>
                        <h2 class="text-center"><?php echo $post['title'];?></h2>
                        <p class="text-center" id="author">By <span>Emeka Ndulue</span> / <?php echo $post['categories']?> / <?php echo $post['date'];?></p>
                        <img src="<?php echo $post['headimage'];?>" alt="forest" height="400px" width="800px" class="img-responsive"><br><br><br><br><br><br><br><br>
                        <p id="post-para"><?php echo $post['content'];?></p>
                            <hr>
                            <?php endwhile;?>

                            <p id="share">
                                <span>Share on:</span>
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x" id="fb"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>

                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x" id="ig"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>

                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x" id="twitter"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>

                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x" id="gp"></i>
                                    <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                </span> 
                                
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x" id="enve"></i>
                                    <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                </span> 
                            </p>
                            <hr>
                            
                            

                            <?php
                                $Comquery = "SELECT * FROM comments where postid = '$id'";
                                $Comsql = $db->query($Comquery);
                                $num = $Comsql->num_rows;

                            ?>
                            <H3>Comments (<?php echo $num;?>):</H3>
                            <?php while($Comment = $Comsql->fetch_assoc()):?> 
                            <div class="well well-sm">
                                <p id="name"><b><?php echo $Comment['name'];?></b> &nbsp;<i class="fa fa-tag"></i> &nbsp; <?php echo $Comment['email'];?></p>
                                <p><?php echo $Comment['comment']?></p>
                            </div>
                            <?php endwhile;?>

                        <?php 
                            if (isset($_POST['submit_comment'])) {
                                $name = $_POST['name'];
                                $name = htmlentities($name);

                                $email = $_POST['email'];
                                $email = htmlentities($email);

                                $comment = $_POST['comment'];
                                $comment = htmlentities($comment);

                                $lower = strtolower($comment);

                                $word = array('shit', 'fuck', 'fucked', 'fucking', 'moron', 'mad', 'a mad');
                                $censor = array('poo', 'bleep', 'bleeped', 'bleeping', 'dunce', 'insane', 'an insane');
                            
                                $censoredcomment = str_replace($word, $censor, $lower);

                                $SCquery = "SELECT * FROM comments where comment = '$comment'";
                                $SCsql = $db->query($SCquery);
                                $SCnum = $SCsql->num_rows;

                                if ($SCnum > 0) {
                                    echo "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>&times</span>comment already submitted!</div>";
                                } else{
                                    $ACquery = "INSERT INTO `comments` (`id`, `name`, `email`, `comment`,`postid`) 
                                                VALUES ('', '$name', '$email', '$censoredcomment', '$id')";
                                    $ACsql = $db->query($ACquery);

                                    if (!$ACquery) {
                                        echo "<p class='text-center text-danger bg-danger'>ERROR in database connection</p>";
                                    }            
                                }


                            } else {
                                $name = '';
                                $email = '';
                                $comment = '';
                            }

                        ?>
                        
                        <div class="well well-sm">
                            <h3>Add a comment:</h3>
                            <form action="post.php?id=<?php echo $id;?>" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" rows="4" cols="30" placeholder="comment" required></textarea>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" name="submit_comment" class="btn btn-danger"> <i class="fa fa-send"></i> &nbsp; Submit </button>
                                </div>
                            </form>
                        </div> <hr>
                        <h3>Recent Posts:</h3> 
                        <?php

                        $RPquery = "SELECT * FROM post where id != '$id' order by rand()";
                        $RPsql = $db->query($RPquery);
                        while($Recent = $RPsql->fetch_assoc()):

                        ?> 
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <img src="<?php echo $Recent['headimage'];?>" alt="image" class="img-responsive">
                                </div>
                                <div class="col-lg-10 col-md-10">
                                    <a href="post.php?id=<?php echo $Recent['id'];?>"><h3><?php echo $Recent['title'];?></h3></a>
                                </div>
                            </div>    
                        </div>

                        <?php endwhile;?>     
                    </div>
                    
                </div>

                <div class="col-lg-3 col-md-3" id="side-bar">
                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Subscribe
                                </h3>
                            </div>
                            <div class="panel-body">
                                <p>Be the first to get our news by simply submiting your email below</p>

                                <?php
                                    if (isset($_POST['submit_mail'])) {
                                        $sub = $_POST['subscribe'];
                                        $sub = htmlentities($sub);
                                        $query = "SELECT * FROM subcriber where Email = '$sub'";
                                        $sql = $db->query($query);
                                        $num = $sql->num_rows;
                                        if ($num > 0) {
                                            echo "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>&times</span><b>$sub</b> already exist!</div>";
                                            return false;
                                        } else{
                                            $Iquery = "INSERT INTO `subcriber`(`id`, `Email`) VALUES ('','$sub')";
                                            $Isql = $db->query($Iquery);
                                            if ($Isql) {
                                                echo "<div class='alert alert-info'><span class='close' data-dismiss='alert'>&times</span><b>$sub</b> has successfully subscribed</div>";
                                            }else {
                                                echo "<p class='bg-danger text-danger text-center'>Error in database connection!</p>";
                                            }                                            
                                        }
                                    } else {
                                        $sub = '';
                                    }

                                ?>

                                <form action="index.php" method="post">
                                    <input type="text" name="subscribe" placeholder="Enter Email" class="form-control" required><br>
                                    <input type="submit" name="submit_mail" class="btn btn-primary btn-block" value="Subscribe">
                                </form>
                            </div>    
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Social media
                                </h3>
                            </div>
                            <div class="panel-body text-center">
                                <p>Kindly follow us on the various social media platforms below</p>
                                <p id="icon"><a href="#"><i class="fa fa-facebook fa-lg"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-twitter fa-lg"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-instagram fa-lg"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-android fa-lg"></i></a> &nbsp;
                                    <a href="#"><i class="fa fa-skype fa-lg"></i></a> &nbsp;
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    News categories
                                </h3>
                            </div>
                            <div class="panel-body text-center">
                                <p>
                                    <a><kbd>Lifestyle</kbd></a>
                                    <a><kbd>Fashion</kbd></a>
                                    <a><kbd>Sport</kbd></a>
                                    <a><kbd>Travel</kbd></a>
                                    <a><kbd>Technology</kbd></a>
                                    <a><kbd>Food</kbd></a>
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    About me
                                </h3>
                            </div>
                            <div class="panel-body" id="by">
                                <img src="img/avatar.png" alt="about me" height="251px" width="291px" class="img">
                                <p class="text-center" id="about">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus eius
                                   voluptate deleniti officiis ratione sed magni accusantium tempora nulla 
                                   ipsa enim quam cum explicabo, fugit, animi tempore reiciendis nihil, molestias.
                                </p>
                            </div>    
                        </div>
                    </div>



                </div>

            </div>    
        </div> 
    
    <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <h3>STAY CONNECTED</h3>
                        <p>Join over 10,000 fellas who recieve our exclusive daily news</p>

                        <?php
                            if (isset($_POST['submit_mail2'])) {
                                $sub = $_POST['email'];
                                $sub = htmlentities($sub);
                                $query = "SELECT * FROM subcriber where Email = '$sub'";
                                $sql = $db->query($query);
                                $num = $sql->num_rows;
                                if ($num > 0) {
                                    echo "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>&times</span><b>$sub</b> already exist!</div>";
                                    return false;
                                } else{
                                    $Iquery = "INSERT INTO `subcriber`(`id`, `Email`) VALUES ('','$sub')";
                                    $Isql = $db->query($Iquery);
                                    if ($Isql) {
                                        echo "<div class='alert alert-info'><span class='close' data-dismiss='alert'>&times</span><b>$sub</b> has successfully subscribed</div>";
                                    }else {
                                        echo "<p class='bg-danger text-danger text-center'>Error in database connection!</p>";
                                    }                                            
                                }
                            } else {
                                $sub = '';
                            }
                        ?>

                        <form action="post.php?id=<?php echo $id;?>" method="post">
                            <div class="input-group">    
                                <input type="text" name="email" class="form-control" placeholder="Email address" value="<?php echo $sub;?>"> <br>
                                <div class="input-group-btn">
                                <button type="submit" name="submit_mail2" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form><br>
                        <p id="fi">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-android fa-stack-1x fa-inverse"></i>
                            </span>
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-skype fa-stack-1x fa-inverse"></i>
                            </span>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h3>COMMITTED TO SERVE</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                           Reiciendis facilis rerum velit illum cumque maxime asperiores, 
                           provident harum, eaque, magni aspernatur nemo consequatur earum, 
                           voluptatum quas quia. Voluptatum, molestiae, excepturi.</p>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <h3>NAVIGATE</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <a href="">Porfolio</a><br>
                                <a href="">Blog</a><br>
                                <a href="">About us</a><br>
                                <a href="">Our team</a><br>
                                <a href="">Contact us</a><br>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <a href="">Careers</a><br>
                                <a href="">Support</a><br>
                                <a href="">Exclusive news</a><br>
                                <a href="">Porfolio</a><br>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>  <hr>
            <p class="text-center">
                Privacy policy &nbsp; &nbsp; &nbsp; &copy; 2017 BLOGAZINE
            </p><br>
    </footer> 
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>