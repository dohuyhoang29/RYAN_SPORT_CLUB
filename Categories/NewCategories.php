<?php
require_once('DatabaseCategories.php');
require_once('../initialize.php');
$errors =[];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST['name'])  ){
        $errors[] = "Name must be required.";
    }
    
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Index Categories</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        .input-container {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        width: 100%;
        margin-bottom: 15px;
        }

        .icon {
        padding: 10px;
        background: dodgerblue;
        color: white;
        min-width: 50px;
        text-align: center;
        }

        .input-field {
        width: 100%;
        padding: 10px;
        outline: none;
        }

        .input-field:focus {
        border: 2px solid dodgerblue;
        }

        /* Set a style for the submit button */
        .ltn {
        background-color: dodgerblue;
        color: white;
        padding: 15px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        }
        .n{
        background-color: blue;
        color: white;
        padding: 15px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        }

        .btn:hover {
        opacity: 1;
        }
    </style>
</head>
<body>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>

<nav class="navbar navbar-inverse">

    <div class="container-fluid">
        <div class="navbar-header">
            <img src="../imgs/L.png" alt="logo">
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
                    redirect_to('LoginRYAN.php');
                    endif;?>>
            <!-- <span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
            <li><?php include('../sharesession.php'); ?></li>
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
    
<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" style="max-width:500px;margin:auto">
<div class="imgcontainer">
      <img src="../imgs/logo.svg" alt="Avatar" class="avatar">
    </div>
<h2>New Categories</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Name" name="name" value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
  </div>
  
  <button type="submit" class="ltn">Submit</button>

  <button type="reset" class="n">Reset</button>
<br>
  <button><a href="IndexCategories.php">Back to Index</a></button> <br><br>

</form>

    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?>
            <?php
                $categories = [];
                $categories['name'] = $_POST['name'];

                $result = insert_categories($categories);
                $NewcategoriesID = mysqli_insert_id($db);
            
            ?>
            <div class="categories">
            <h3> A new categories (ID: <?php echo  $NewcategoriesID ?>)</h3>
            <ul>
            <?php
                foreach ($categories as $key => $value) {
                    
                    echo '<li>', $key.': '.$value, '</li>'; 
                }
            ?>
            </ul>
            </div>
        <?php endif; ?>
        <br><br>
        <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="error">
            <span> Please fix the following errors </span>
            <ul>
                <?php
                foreach ($errors as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <script src="../js/jquery-2.2.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>


<?php 
db_disconnect($db);
?>