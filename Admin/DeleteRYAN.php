<?php
require_once('DatabaseRYAN.php');
require_once('../initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    
    delete_admin($_POST['username']);
    redirect_to('IndexRYAN.php');
} else { 
    if(!isset($_GET['username'])) {
        redirect_to('IndexRYAN.php');
    }
    $username = $_GET['username'];
    $admin = find_admin_by_id($username);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete admin</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <?php 
        if($admin['username'] === $_SESSION['username']){
            // $_SESSION['delete'] = 'You cannot delete your name!';
            redirect_to('IndexRYAN.php');
        }else{
            unset($_SESSION['delete']);
        }
    ?>

    <?php if(!isset($_SESSION['username'])):
        redirect_to('LoginRYAN.php');
    endif;?>

    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>
    <h1>Delete admin</h1>
    <h2>Are you sure you want to delete this admin?</h2>
    <p><span class="label">Username </span><?php echo $admin['username']; ?></p>
    <p><span class="label">Password </span><?php echo $admin['pass']; ?></p>
    <p><span class="label">FUllname </span><?php echo $admin['fullname']; ?></p>
    <p><span class="label">email </span><?php echo $admin['email']; ?></p>
    <p><span class="label">Phone </span><?php echo $admin['phone']; ?></p>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="username" value="<?php echo $admin['username']; ?>" >
     
        <input type="submit" name="submit" value="Delete Admin">
     
    </form>
    
    <br><br>
    <a href="IndexRYAN.php">Back to Index Admin </a>

    
    
</body>
</html>


<?php
db_disconnect($db);
?>