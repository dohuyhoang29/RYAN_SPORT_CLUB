
<?php 
require_once('DatabaseRYAN.php');
require_once('../initialize.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}
//alkdjlfajsl;fjas;lkf

function checkForm(){
    global $errors;
    $username = $_POST['username'];
    if (empty($_POST['username'])){
        $errors[] = 'Username is required';
    }

    if(!empty($_POST['username']) && find_all_admin_different($username)){
        $error[] = 'Username must be different';
    }

    if (empty($_POST['password'])){
        $errors[] = 'Password is required';
    }
    if (empty($_POST['fullname'])){
        $errors[] = 'fullname is required';
    }
    if (empty($_POST['email'])){
        $errors[] = 'email is required';
    }
    
    if (empty($_POST['phone'])){
        $errors[] = 'Phone is required';
    }else{
        if(!empty($_POST['phone'])&& !is_numeric($_POST['phone']) == 1){
            $errors[] = "Phone must be number!";
        }else{
            if(!empty($_POST['phone'])&& count((str_split($_POST['phone'])))!=10){
                $errors[] = 'Phone must have 10 number!';
            }
        }
    }
    
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){

        $admin_set = find_ADMIN_by_USE();
        $ADMIN = mysqli_fetch_assoc($admin_set);
        
        $admin = [];
        $admin['USE'] = $ADMIN['username'];
        $admin['username'] = $_POST['username'];
        $admin['password'] = sha1($_POST['password']);
        $admin['fullname'] = $_POST['fullname'];
        $admin['email'] = $_POST['email'];
        $admin['phone'] = $_POST['phone'];
        $admin['pass'] = $_POST['password'];

        Update_admin($admin);
        redirect_to('IndexRYAN.php');
    }
} else { // form loaded
    if(!isset($_GET['username'])) {
        redirect_to('IndexRYAN.php');
    }
    $username = $_GET['username'];
    $admin = find_admin_by_id($username);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit admin</title>
  <meta charset="utf-8">
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

<body>

<?php if(!isset($_SESSION['username'])):
        redirect_to('LoginRYAN.php');
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
                <li><a href="../Categories/IndexCategories.php">Categories</a></li>
                <li><a href="../Service/IndexService.php">Service</a></li>
                <li><a href="../Pictures/IndexPicture.php">Pictures</a></li>
                <li><a href="IndexRYAN.php">Admin</a></li>

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
<h2>Edit Admin</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username" name="username" 
    value="<?php echo isFormValidated()? $admin['username']: $_POST['username'] ?>">
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="password"
    value="<?php echo isFormValidated()? $admin['pass']: $_POST['password'] ?>">
  </div>

  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Fullname" name="fullname" 
    value="<?php echo isFormValidated()? $admin['fullname']: $_POST['fullname'] ?>">
  </div>

  <div class="input-container">
    <i class="fa fa-envelope-o icon"></i>
    <input class="input-field" type="email" placeholder="Email" name="email" 
    value="<?php echo isFormValidated()? $admin['email']: $_POST['email'] ?>">
  </div>

  <div class="input-container">
    <i class="fa fa-phone icon"></i>
    <input class="input-field" type="phone" placeholder="Phone" name="phone" 
    value="<?php echo isFormValidated()? $admin['phone']: $_POST['phone'] ?>">
  </div>

  <button type="submit" class="ltn">Submit</button>

  <button type="reset" class="n">Reset</button>

</form>



    <a href="IndexRYAN.php">Back to Index</a> <br><br>


<br><br>


    <script src="../js/jquery-2.2.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

<?php
    db_disconnect($db);
?>