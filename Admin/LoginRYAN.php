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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
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
    .btn {
    background-color: dodgerblue;
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

<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" style="max-width:500px;margin:auto">
<div class="imgcontainer">
      <img src="../imgs/logo.svg" alt="Avatar" class="avatar">
    </div>
<h2>Login Form</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username" name="username" value="<?php echo isFormValidated()? '': $_POST['username'] ?>">
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="password">
  </div>

  <button type="submit" class="btn">Login</button>

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
            </div><br><br>
        <?php endif; ?>

    <br>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()){
            $username = $_POST['username'];
            $Login = find_usenmae($username);
            if($Login['Password'] === sha1($_POST['password'])){
                $_SESSION['username'] = $username;
                redirect_to('../AdminMenu.php');
                // echo "Ban Da Dang Nhap Thanh Cong";
            }else{
                echo "Username or Password wrong!";
            }
        }
   ?>
</form>

    <script src="../js/jquery-2.2.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>

<?php
    db_disconnect($db);
?>
