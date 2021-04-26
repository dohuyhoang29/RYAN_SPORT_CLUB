<?php
    require_once('DatabaseService.php');
    require_once('../initialize.php');

    $error = [];

    function checkForm(){
        global $error;

        
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
    <a href="../AdminMenu.php"><img src="../imgs/r.svg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>

    <h1>Create a new Service</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="ServiceID" value="<?php echo isFormValidated() ? $service['ServiceID'] : $_POST['ServiceID']; ?>">

        <label for="name">Name </label>
        <input type="text" name="Name" value="<?php echo isFormValidated() ? $service['Name'] : $_POST['Name']; ?>"><br>

        <label for="CategoryID">CategoryID </label>
        <!-- <select name="CategoryID">
            <option value="1"<?php if(!empty($service['CategoryID']) && $service['CategoryID'] =='1') echo 'selected' ?>>Indoor Sports</option>              
            <option value="2"<?php if(!empty($service['CategoryID']) && $service['CategoryID'] =='2') echo 'selected' ?>>Outdoor Sports</option>
            <option value="3"<?php if(!empty($service['CategoryID']) && $service['CategoryID'] =='3') echo 'selected' ?>>Recreation</option>   
        </select><br> -->

        <select name="CateroryID">
        <?php
        $service_set = find_all_service();
        $count = mysqli_num_rows($service_set);
        for ($i = 0; $i < $count; $i++):
            $service = mysqli_fetch_assoc($service_set); 
        ?>
            
            <option 
            value="<?php echo $service['ServiceID'] ?>" ><?php echo $service['Name'] ?></option>
        <?php 
        endfor; 
        mysqli_free_result($service_set);
        ?>
        </select>

        <label for="time">Time </label>
        <input type="text" name="Time" value="<?php echo isFormValidated() ? $service['Time'] : $_POST['Time']; ?>"><br>

        <label for="famous">Famous Players</label>
        <input type="text" name="Famous_Players" value="<?php echo isFormValidated() ? $service['Famous_Players'] : $_POST['Famous_Players']; ?>"><br>

        <label for="rules">Rules </label>
        <textarea name="Rules" cols="30" rows="10"><?php echo isFormValidated() ? $service['Rules'] : $_POST['Rules']; ?></textarea><br>

        <input type="submit" name="submit" value="Edit">
    </form>

    <a href="IndexService.php">Back to View</a>
</body>
</html>

<?php
    db_disconnect($db);
?>