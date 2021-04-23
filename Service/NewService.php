<?php
    require_once('DatabaseService.php');
    require_once('../initialize.php');

    $error = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
    }

    function isFormValidated(){
        global $error;

        return count($error) == 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a new Service</title>
    <style>
        
    </style>
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
    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?>

    <h1>Create a new Service</h1>
    
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="name">Name </label>
            <input type="text" name="Name" value="<?php echo isFormValidated() ? '' : $_POST['Name']; ?>"><br>
            
            <label for="CategoryID">Categories </label>
            <select name="CategoryID">
                <option value="1"<?php if(!empty($_POST['CategoryID']) && $_POST['CategoryID'] =='1') echo 'selected' ?>>Indoor Sports</option>              
                <option value="2"<?php if(!empty($_POST['CategoryID']) && $_POST['CategoryID'] =='2') echo 'selected' ?>>Outdoor Sports</option>
                <option value="3"<?php if(!empty($_POST['CategoryID']) && $_POST['CategoryID'] =='3') echo 'selected' ?>>Recreation</option>   
            </select><br>
            
            <label for="time">Time </label>
            <input type="text" name="Time" value="<?php echo isFormValidated() ? '' : $_POST['Time']; ?>"><br>

            <label for="famous">Famous Players</label>
            <input type="text" name="Famous_Players" value="<?php echo isFormValidated() ? '' : $_POST['Famous_Players']; ?>"><br>

            <label for="rules">Rules </label>
            <textarea name="Rules" cols="30" rows="10"><?php echo isFormValidated() ? '' : $_POST['Rules']; ?></textarea><br>

            <input type="submit" name="submit" value="Create">
        </form>
    </div>

    <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isFormValidated()): ?>
        <?php 
            $service = [];
            $service['Name'] = $_POST['Name'];
            $service['Rules'] = $_POST['Rules'];
            $service['Time'] = $_POST['Time'];
            $service['Famous_Players'] = $_POST['Famous_Players'];
            $service['CategoryID'] = $_POST['CategoryID'];
            
            $result = insert_service($service);
            redirect_to('IndexService.php');
        ?>
    <?php endif; ?>

    <a href="IndexService.php">Back to View</a>
</body>
</html>

<?php
    db_disconnect($db);
?>