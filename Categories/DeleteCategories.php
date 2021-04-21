<?php
require_once('DatabaseCategories.php');
require_once('../initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    
    delete_categories($_POST['CategoryID']);
    redirect_to('IndexCategories.php');
} else {
    if(!isset($_GET['CategoryID'])){
        redirect_to('IndexCategories.php');
    }

    $id = $_GET['CategoryID'];
    $categories = find_categories_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete categories</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
    </style>
</head>
<body>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>
    
    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>
    <h1>Delete categories</h1>
    <h2>Are you sure you want to delete this categories?</h2>
    <p><span class="label">Name: </span><?php echo $categories['Name']; ?></p>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

        <input type="hidden" name="CategoryID" value="<?php echo $categories['CategoryID']; ?>" >
     
        <input type="submit" name="submit" value="Delete categories">
     
    </form>
    
    <br><br>
    <a href="IndexCategories.php">Index categories</a> 
</body>
</html>


<?php
db_disconnect($db);
?>