<?php
require_once('DatabaseRYAN.php');
require_once('../initialize.php');

$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;
    if (empty($_POST['username'])){
        $errors[] = 'Username is required';
    }

    if (empty($_POST['password'])){
        $errors[] = 'Password is required';
    }  
    
    if (empty($_POST['fullname'])){
        $errors[] = 'Fullname is required';
    }
    if (empty($_POST['email'])){
        $errors[] = 'Email is required';
    }
    if (empty($_POST['phone'])){
        $errors[] = 'Phone is required';
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
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit admin</title>
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
    </style>
</head>
<body>
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
        </div><br><br>
    <?php endif; ?>
    <?php if(!isset($_SESSION['username'])): ?>
    redirect_to('LoginRYAN.php');
    <?php endif;?>
    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>
    
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

        <label for="username">UserName</label>
        <input type="text" id="username" name="username"  
        value="<?php echo isFormValidated()? $admin['username']: $_POST['username'] ?>">
        <br><br>

        <label for="password">Password</label>
        <input type="text" id="password" name="password"  
        value="<?php echo isFormValidated()? $admin['pass']: $_POST['password'] ?>">
        <br><br>

        <label for="fullname">Fullname</label>
        <input type="text" id="fullname" name="fullname"  
        value="<?php echo isFormValidated()? $admin['fullname']: $_POST['fullname'] ?>">
        <br><br>

        <label for="email">Email</label>
        <input type="text" id="email" name="email"  
        value="<?php echo isFormValidated()? $admin['email']: $_POST['email'] ?>">
        <br><br>


        <label for="phone">Phone</label> <!--required-->
        <input type="text" id="phone" name="phone"  
        value="<?php echo isFormValidated()? $admin['phone']: $_POST['phone'] ?>">
        <br><br>

        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>
    
    <br><br>
    <a href="IndexRYAN.php">Back to Index admin </a> 
</body>
</html>


<?php
db_disconnect($db);
?>