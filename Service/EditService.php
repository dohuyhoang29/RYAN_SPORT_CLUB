<?php
    require_once('DatabaseService.php');
    require_once('../initialize.php');

    $error = [];

    function checkForm(){
        global $error;

        if(empty($_POST['Name'])){
            $error[] = 'Name must br required';
        }
        if(empty($_POST['Rules'])){
            $error[] = 'Rules must be required';
        }
        if(empty($_POST['Time'])){
            $error[] = 'Time must be required';
        }
        if(empty($_POST['Famous_Players'])){
            $error[] = 'Famous must be required';
        }
    }
    
    function isFormValidated(){
        global $error;

        return count($error) == 0;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        checkForm();

        if(isFormValidated()){
            $service = [];
            $service['ServiceID'] = $_POST['ServiceID'];
            $service['Name'] = $_POST['Name'];
            $service['Rules'] = $_POST['Rules'];
            $service['Time'] = $_POST['Time'];
            $service['Famous_Players'] = $_POST['Famous_Players'];
            $service['CategoryID'] = $_POST['CategoryID'];

            update_service($service);
            redirect_to('IndexService.php');
        }
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
    <title>Create a new Service</title>
</head>
<body>
    <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !isFormValidated()): ?>
        <div>
            <span>Please fix the following errors</span>
            <ul>
                <?php
                    foreach($error as $key => $value){
                        if(!empty($value)){
                            echo "<li>" . $value ." </li>";
                        }
                    }
                ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>
    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>

    <h1>Create a new Service</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="ServiceID" value="<?php echo isFormValidated() ? $service['ServiceID'] : $_POST['ServiceID']; ?>">

        <label for="name">Name </label>
        <input type="text" name="Name" value="<?php echo isFormValidated() ? $service['Name'] : $_POST['Name']; ?>"><br>

        <label for="rules">Rules </label>
        <textarea name="Rules" cols="30" rows="10"><?php echo isFormValidated() ? $service['Rules'] : $_POST['Rules']; ?></textarea><br>
        <label for="time">Time </label>
        <input type="text" name="Time" value="<?php echo isFormValidated() ? $service['Time'] : $_POST['Time']; ?>"><br>

        <label for="famous">Famous Players</label>
        <input type="text" name="Famous_Players" value="<?php echo isFormValidated() ? $service['Famous_Players'] : $_POST['Famous_Players']; ?>"><br>

        <label for="CategoryID">CategoryID </label>
        <input type="text" name="CategoryID" value="<?php echo isFormValidated() ? $service['CategoryID'] : $_POST['CategoryID']; ?>"><br>

        <input type="submit" name="submit" value="Edit">
    </form>

    <a href="IndexService.php">Back to View</a>
</body>
</html>

<?php
    db_disconnect($db);
?>