<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BLOGAZINE</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
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
                    <a href="http://www.facebook.com/blogazine"><i class="fa fa-facebook fa-lg"></i></a> &nbsp;
                    <a href="http://www.twitter.com/blogazine"><i class="fa fa-twitter fa-lg"></i></a> &nbsp;
                    <a href="http://www.instagram.com/blogazine"><i class="fa fa-instagram fa-lg"></i></a> &nbsp;
                    <a href="http://playstore/blogazine"><i class="fa fa-android fa-lg"></i></a> &nbsp;
                    <a href="http://www.skype.com/blogazine"><i class="fa fa-skype fa-lg"></i></a> &nbsp;
                </div>
                
            </div>
            <div class="container" id="con">
                <a href="index.php" class="navbar-brand">BLOGA<span>ZINE<span></a>
            </div>
        </nav>
        <?php include 'db_connect.php';
            $Cquery = "SELECT * from category order by id";
            $sql = $db->query($Cquery);
            
        ?>
        <header>
          
          <div class="container" id="cont">
            <a href="index.php"><i class="fa fa-home fa-lg"></i></a> &nbsp; &nbsp; &nbsp; &nbsp;
            <?php while($cat = $sql->fetch_assoc()): ?>
            <a href="category.php?category=<?php echo $cat['categories'];?>"><?php echo $cat['categories'];?></a> &nbsp; &nbsp; &nbsp;
            <?php endwhile; ?>
            
            <div class="form-group">
                <form action="index.php" method="post">
                <input type="text" id="text" placeholder="search" class="form-control">
                </form>
            </div>    
          </div>
        </header>
    
    </head>

    <body>
    
        <div class="container" id="con1">
            <div class="row"><br>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" id="main-bar">
                    <div class="container-fluid">
                    <!--main bar-->
                    <?php
                        $Pquery = "SELECT * FROM post order by date desc";
                        $Psql = $db->query($Pquery);
                        
                        
                    ?>
                    <?php while($Presult = $Psql->fetch_assoc()):
                        $id = $Presult['id'];
                        $title = $Presult['title'];
                        $Ptitle = explode('_',$title);
                    ?>
                    <div class="row">
                        <div class="col-lg-5 col-lg-5 col-sm-12 col-xs-12">
                            <a href="post.php?id=<?php echo $id;?>,title=<?php echo $title;?>"><img src="<?php echo $Presult['headimage'];?>" alt="forest" height="170px" width="320px" class="img-responsive"></a>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <a href="post.php?id=<?php echo $id;?>,title=<?php echo $title;?>"><h3><?php echo $title;?></h3></a>
                            <p><a href="#">Emeka Ndulue</a>  &nbsp; &nbsp; <i class="fa fa-spinner fa-spin fa-fw"></i>&nbsp; 
                               <span class="date"><?php echo $Presult['date'];?></span> &nbsp; &nbsp; <i class="fa fa-spinner fa-spin fa-fw"></i>&nbsp;
                               <span>
                                   <?php 
                                        $coquery = "SELECT * from comments where postid = '$id'";
                                        $cosql = $db->query($coquery);
                                        $num = $cosql->num_rows;
                                        echo $num." Comments";
                                    ?>
                                </span> 
                            </p>
                            <?php
                                $Postquery = "SELECT `id`, LEFT(`content`, 280) FROM `post` where id= $id";
                                $Postsql = $db->query($Postquery);
                                while($Postresult = $Postsql->fetch_assoc()):
                            ?>
                                
                                    <p class="text"><?php echo $Postresult['LEFT(`content`, 280)'];?></p>
                                

                            <?php endwhile;?>
                        </div>    
                    </div>
                    <br>
                    <?php endwhile;?>
                    </div>
                    <br>              
                    
                </div>

                <!--side bar-->


                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="side-bar">
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
                                    if (isset($_POST['submit_email'])) {
                                        $sub = $_POST['subscribe'];
                                        $sub = htmlentities($sub);
                                        $query = "SELECT * FROM subcriber where Email = '$sub'";
                                        $sql = $db->query($query);
                                        $num = $sql->num_rows;
                                        if ($num > 0) {
                                            echo "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>&times</span><b>$sub</b> already exist!</div>";
                                        } else{
                                            $Iquery = "INSERT INTO `subcriber`(`id`, `Email`) VALUES ('','$sub')";
                                            $Isql = $db->query($Iquery);
                                            if ($Isql) {
                                                echo "<div class='alert alert-info'><span class='close' data-dismiss='alert'>&times</span><b>$sub</b> has successfully subscribed!</div>";
                                            }else {
                                                echo "<p class='bg-danger text-danger text-center'>Error in database connection!</p>";
                                            }                                            
                                        }
                                    } else {
                                        $sub = '';
                                    }

                                ?>

                                <form action="index.php" method="post">
                                    <input type="email" placeholder="Enter Email" name="subscribe" class="form-control" value="<?php echo $sub;?>" required><br>
                                    <input type="submit" name="submit_email" class="btn btn-primary btn-block" value="Subscribe">
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
                                <p id="icon">
                                    <a href="http://www.facebook.com/blogazine"><i class="fa fa-facebook fa-lg"></i></a> &nbsp;
                                    <a href="http://www.twitter.com/blogazine"><i class="fa fa-twitter fa-lg"></i></a> &nbsp;
                                    <a href="http://www.instagram.com/blogazine"><i class="fa fa-instagram fa-lg"></i></a> &nbsp;
                                    <a href="http://playstore/blogazine"><i class="fa fa-android fa-lg"></i></a> &nbsp;
                                    <a href="http://www.skype.com/blogazine"><i class="fa fa-skype fa-lg"></i></a> &nbsp;
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
                                <img src="img/avatar.png" alt="about me" height="251px" width="291px" class="img-responsive">
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
        <!-- Pagination --> 
        <div class="container">
                <div class="col-lg-5 col-md-5">
                </div>  
                <div class="col-lg-2 col-md-2">
                <ul class="pagination"> 
                <li class="active"><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                </ul>
                </div>
                <div class="col-lg-5 col-md-5">
                </div> 
        </div>    
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <h3>STAY CONNECTED</h3>
                        <p>Join over 10,000 fellas who recieve our exclusive daily news</p>
                        <?php
                            if (isset($_POST['submit_email'])) {
                                $sub = $_POST['email'];
                                $sub = htmlentities($sub);
                                $query = "SELECT * FROM subcriber where Email = '$sub'";
                                $sql = $db->query($query);
                                $num = $sql->num_rows;
                                if ($num > 0) {
                                    echo "<div class='alert alert-danger'><span class='close' data-dismiss='alert'>&times</span><b>$sub</b> already exist!</div>";
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
                        
                        <form method="post" action="index.php">
                            <div class="input-group">    
                                <input type="text" class="form-control" name="email" placeholder="Email address" required> <br>
                                <div class="input-group-btn">
                                <input type="submit" name="submit_email" class="btn btn-success" value="subscribe">
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
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h3>COMMITTED TO SERVE</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                           Reiciendis facilis rerum velit illum cumque maxime asperiores, 
                           provident harum, eaque, magni aspernatur nemo consequatur earum, 
                           voluptatum quas quia. Voluptatum, molestiae, excepturi.</p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
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