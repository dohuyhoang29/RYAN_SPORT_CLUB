<?php
require_once('DatabasePicture.php');
require_once('../initialize.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //db delete
    Delete_Picture($_POST['PictureID']);
    redirect_to('IndexPicture.php');
} else { // form loaded
    if(!isset($_GET['PictureID'])) {
        redirect_to('IndexPicture.php');
    }
    $pictureID = $_GET['PictureID'];
    $picture = find_picture_by_id($pictureID);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Picture</title>
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
    <h1>Delete Picture</h1>
    <h2>Are you sure you want to delete this Picture?</h2>
    <p><span class="label">Name: </span><?php echo $Picture['Name']; ?></p>
    <p><span class="label">ServiceID: </span><?php echo $Picture['ServiceID']; ?></p>
    <p><span class="label">URL: </span><?php echo $Picture['URL']; ?></p>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="PictureID" value="<?php echo $Picture['PictureID']; ?>" >
     
        <input type="submit" name="submit" value="Delete Picture">
     
    </form>
    
    <br><br>
    <a href="IndexPicture.php">Back to Index Picture </a>
</body>
</html>


<?php
db_disconnect($db);
?>