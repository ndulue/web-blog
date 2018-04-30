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

    <body>
        
        <?php 

                        
                if ($_GET) {
                    if ((isset($_GET['edit']))) {
                        $edit = $_GET['edit'];
                        $edit = (int)$edit;
                        $caquery = "SELECT * from category where id = '".$edit."'";
                        $casql = $db->query($caquery);

                        while($cati = $casql->fetch_assoc()){
                            $val = $cati['categories'];
                        }

                        if (isset($_POST['addcat'])) {
                        $val = $_POST['category'];
                        $val = htmlentities($val);
                        }

                        $csquery = "SELECT * from category where categories = '$val'";
                        $cssql = $db->query($csquery);

                        $num = $cssql->num_rows;

                        if ($num > 0) {
                            echo "<div class='alert alert-danger'>
                                     <a href='' class='close' data-dismiss='alert'>&times;</a> '.$val.' already exist
                                  </div>";
                        } else {
                            $iquery = "INSERT into category ('id', 'categories') value '', '".$val."'";
                            $isql = $db->query($iquery);
                            if ($isql) {
                                return true;
                                echo "<p class='text-center text-success bg-success'> '.$val.' added successfully</p>";
                            } else {
                                echo "<div class='alert alert-danger'>
                                     <a href='' class='close' data-dismiss='alert'>&times;</a>couldnt add category
                                  </div>";
                            }
                            
                        }
                    }
                    

                    if ((isset($_GET['delete']))) {
                        $delete = $_GET['delete'];
                        $delete = (int)$delete;
                        $dquery = "DELETE * FROM category where id = '".$delete."'";
                        $dsql = $db->query($dquery);

                    }
                } else {
                    $val = '';
                }

            ?>
        <div class="container"><br><br><br><br><br>

            
            <form class="form-inline text-center" action="add_edit_category.php" method="post">
                <div class="form-group text-center">
                    <input type="text" name="category" class="form-control" placeholder="Add category" value="<?php echo $val;?>">
                    <?php echo ((isset($edit))? '<a href="add_edit_category.php" class="btn btn-danger">Cancel</a>':'')?>
                    <input type="submit" name="addcat" class="btn btn-primary" value="<?php echo ((isset ($edit))? 'Edit' : 'Add')?> category">
                </div>

            </form><br><br>

            
            
            <h4 class="text-center">CATEGORIES:</h4>
            <table class="table table-firm table-bordered table-striped table-hover text-center">
                <tbody>
                    <?php 
                        $cquery = "SELECT * from category order by id";
                        $csql = $db->query($cquery);
                        while($cat = $csql->fetch_assoc()):
                    ?>
                    <tr>
                        <td><a href="add_edit_category.php?edit=<?php echo $cat['id']?>"><i class="fa fa-pencil"></a></i></td>
                        <td><?php echo $cat['categories'];?></td>
                        <td><a href="add_edit_category.php?delete=<?php echo $cat['id']?>"><i class="fa fa-remove"></i></a></td>
                    </tr>
                    <?php endwhile;?>
                    
                </tbody>
            </table>
        </div>
    
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>