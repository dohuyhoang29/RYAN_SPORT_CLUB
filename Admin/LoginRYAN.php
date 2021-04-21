<?php
require_once('DatabaseRYAN.php');
require_once('../initialize.php');
$errors=[];

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_POST['username'])){
        $errors[] = 'Username is required';
    }
    if (empty($_POST['password'])){
        $errors[] = 'Password is required';
    }
}
function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
     .s,label{
            float:left;
            clear:left;
        }
        label{
            width:30%;
        }
        input{
            float:left;
        }
        .s{
            /* margin-left: 85%; */
        }
        input,label{
            margin:5px;

        }
        form{
            float :left;
            clear:left;
            width:50%;

        }
        fieldset{
            width:50%;
            margin:0 auto;
            
        }
        h2{
            text-align:center;
        }
        label,input{
            margin:1%;
        }  
        a{
            float:left;
            clear:left;
            margin:5px;

        }
        .error {
            color: blue;
            float :left;
            width:45%;
            display: inline-block;
            padding: 5px;

        }
    </style>
</head>
<body>
   <fieldset>
   
   <h2>Login Form</h2>
   <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
    <label for="">Username</label>
    <input type="text" name="username" value="<?php echo isFormValidated()? '': $_POST['username'] ?>">
    <label for="">Password</label>
    <input type="password" name="password">
    
    <input type="submit" value="login in" class="s">

   </form>
   <?php
        if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()){
            $username = $_POST['username'];
            $Login = find_usenmae($username);
            if($Login['Password'] === sha1($_POST['password'])){
                $_SESSION['username'] = $username;
                redirect_to('../AdminMenu.php');
                // echo "Ban Da Dang Nhap Thanh Cong";
            }else{
                echo "Username Hoac Password Ko Dung!";
            }
        }
   ?>

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
   <a href="RegistrationRYAN.php">Registration</a> <br><br>
   </fieldset> 
</body>
</html>

<?php
    db_disconnect($db);
?>

