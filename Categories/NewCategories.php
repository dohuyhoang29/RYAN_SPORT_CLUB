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
    <style>
        .s,label{
            float:left;
            clear:left;
        }
        label{
            width:10%;
        }
        input{
            float:left;
        }
        .s{
            margin-right: 7%;
        }
        input,label{
            margin:5px;

        }
        .categories{
            float:left;
            clear:left;

        }
        label {
            font-weight: bold;
        }
        .error {
            color: blue;
        }
        div.error{
            border: thin solid blue; 
            display: inline-block;
            padding: 5px;
            background: darkgray;
        }
        fieldset{
            background: lightgray;
            border:  1px solid blue;
            /* margin:  30px 0; */
            padding:  15px;
        }
        form{
            width: 40%;
            
        }
    </style>
</head>
<body>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>

    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>
    <a href="IndexCategories.php">Index categories</a><br><br>
    
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    <fieldset>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" 
        value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
        
        <input type="submit" class="s">
        <input type="reset">
    </fieldset>
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


</body>
</html>


<?php 
db_disconnect($db);
?>