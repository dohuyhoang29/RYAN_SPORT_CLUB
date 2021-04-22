<?php 
require_once('DatabaseRYAN.php');
require_once('../initialize.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}
//alkdjlfajsl;fjas;lkf

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>registration </title>
    <style>
        form{
            border: 3px solid green;
            padding: 10px;
            width: 30%;
            margin: 0 auto;
        }

        label{
            font-weight: bold;
            float: left;
            padding-bottom: 5px;
            width: 30%;
        }

        input{
           width: 60%;
            margin: 5px;
        }
    </style>
</head>
<body>
<!-- hoang ngu beo nhu lon -->

<a style = "margin: auto;" href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>

<h2>Registration Form</h2>

<form action="<?php  echo $_SERVER["PHP_SELF"];?>" method="post">

        <label for="">UserName</label>
        <input type="text" name="username" value="<?php echo isFormValidated()? '': $_POST['username'] ?>">

        <label for="">Password</label>
        <input type="password" name="password">

        <label for="">FullName</label>
        <input type="text" name="fullname" value="<?php echo isFormValidated()? '': $_POST['fullname'] ?>">

        <label for="">Email</label>
        <input type="email" name="email" value="<?php echo isFormValidated()? '': $_POST['fullname'] ?>">
        
        <label for="">Phone</label>
        <input type="text" name="phone" value="<?php echo isFormValidated()? '': $_POST['phone'] ?>" >

        <input type="submit" class="s" value="Registration">
        
    </form>

     <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <div class="error">
        <?php 
        $admin = [];
        $admin['username'] = $_POST['username'];
        $admin['password'] = sha1($_POST['password']);
        $admin['fullname'] = $_POST['fullname'];
        $admin['email'] = $_POST['email'];
        $admin['phone'] = $_POST['phone'];
        $admin['pass'] = $_POST['password'];

        $result = insert_admin($admin);
        $newadminID = mysqli_insert_id($db);
        ?>
        </div>
    <?php endif; ?>

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

    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <div class="Registration">
        <p>  New Registration</p>
            <ul>
            <li><?php echo 'Username:'.$_POST['username']; ?></li>
            <li><?php echo 'Fullname:'.$_POST['fullname'];?></li>
            <li><?php echo 'Email:'.$_POST['email'];?></li>
            <li><?php echo 'Phone:'.$_POST['phone'];?></li>
            
            </ul>
        </div>
    <?php endif; ?>

    <a href="IndexRYAN.php">Back to Index</a> <br><br>


<br><br>
</body>
</html>
<?php 
db_disconnect($db);
?>