<?php
    require_once('Admin/DatabaseRYAN.php');
    require_once('initialize.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Menu</title>
    <style>
        
    </style>
</head>
<body>
    <table>
        <header>
            <h1 style = "background: blue;padding: 10px 0 10px 0; width: 50%; text-align: center;">RYAN Sport Club</h1>
        </header>
        <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
        endif;?>
        <?php include('shareadminMenu.php'); ?>
        <main>
            <h2>Main Menu</h2>
            <ul>
                <li><a href="Categories/IndexCategories.php">Categories</a></li>
                <li><a href="Service/IndexService.php">Service</a></li>
                <li><a href="Pictures/IndexPicture.php">Pictures</a></li>
                <li><a href="Admin/IndexRYAN.php">Admin</a></li>
            </ul>
        </main>
    </table>
</body>
</html>