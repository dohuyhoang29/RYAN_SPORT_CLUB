<?php
    require_once('DatabaseService.php');
    require_once('../initialize.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        delete_service($_POST['ServiceID']);
        redirect_to('IndexService.php');
    } else {
        if(!isset($_GET['ServiceID'])){
            redirect_to('IndexService.php');
        }

        $serviceID = $_GET['ServiceID'];
        $service = find_service_by_id($serviceID);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Service</title>
</head>
<body>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>
    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>

    <h1>Delete Service</h1>
    <h2>Are you sure you want to delete this service?</h2>
    <p>Name: <?php echo $service['Name'] ?></p>
    <p>Time: <?php echo $service['Time'] ?></p>
    <p>Rules: <?php echo $service['Rules'] ?></p>
    <p>Famous Players: <?php echo $service['Famous_Players'] ?></p>
    <p>CategoryID: <?php echo $service['CategoryID'] ?></p>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="ServiceID" value="<?php echo $service['ServiceID'] ?>">
        <input type="submit" name="submit" value="Delete Service">
    </form>

    <a href="IndexService.php">Back to View</a>
</body>
</html>

<?php
    db_disconnect($db);
?>