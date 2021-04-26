<?php
    require_once('Admin/DatabaseRYAN.php');
    require_once('initialize.php');//khang nghien vaof beo va gay
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Menu</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
</head>
<body>

<!-- <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
        endif;?> -->
        

    <nav class="navbar navbar-inverse">

        <div class="container-fluid">
            <div class="navbar-header">
                <img src="imgs/L.png" alt="logo">
            </div>

            <ul class="nav navbar-nav">
                <li class="active">

                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="Categories/IndexCategories.php">Category
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="#">Page 1-1</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>         -->
                <li><a href="Categories/IndexCategories.php">Categories</a></li>
                <li><a href="Service/IndexService.php">Service</a></li>
                <li><a href="Pictures/IndexPicture.php">Pictures</a></li>
                <li><a href="Admin/IndexRYAN.php">Admin</a></li>

            </ul>
                

            <ul class="nav navbar-nav navbar-right">
                <!-- <li><a href="Admin/LoginRYAN.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
                <li><a <?php if(!isset($_SESSION['username'])):
                        redirect_to('Admin/LoginRYAN.php');
                        endif;?>>
                <!-- <span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
                <li><?php include('shareadminMenu.php'); ?></li>
            </ul>

            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
                <!-- <span class="glyphicon glyphicon-search"></span> -->
        </form> 
        


        </div>
      </nav>

      

      

      <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

