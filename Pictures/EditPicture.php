<?php
require_once('DatabasePicture.php');
require_once('../initialize.php');

$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;
    if (empty($_POST['Name'])){
        $errors[] = 'Name is required';
    }

    if (empty($_POST['URL'])){
        $errors[] = 'URL is required';
    }    
    
    if (empty($_POST['ServiceID'])){
        $errors[] = 'ServiceID is required';
    }   
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    checkForm();
    if (isFormValidated()){
        //do update
        $Picture = [];
        $Picture['PictureID'] = $_POST['PictureID'];
        $Picture['Name'] = $_POST['Name'];
        $Picture['URL'] = $_POST['URL'];
        $Picture['ServiceID'] = $_POST['ServiceID'];

        Update_Picture($Picture);
        redirect_to('IndexPicture.php');
    }
} else { // form loaded
    if(!isset($_GET['PictureID'])) {
        redirect_to('IndexPicture.php');
    }
    $id = $_GET['PictureID'];
    $Picture = find_Picture_by_id($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Picture</title>
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
    </style>
</head>
<body>
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
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>
    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>
    
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    
        <input type="hidden" name="PictureID" 
        value="<?php echo isFormValidated()? $Picture['PictureID']: $_POST['PictureID'] ?>" >

        <label for="Name">Name</label> <!--required-->
        <input type="text" id="Name" name="Name"  
        value="<?php echo isFormValidated()? $Picture['Name']: $_POST['Name'] ?>">
        <br><br>

        <label for="URL">URL</label> <!--required-->
        <input type="text" id="URL" name="URL"  
        value="<?php echo isFormValidated()? $Picture['URL']: $_POST['URL'] ?>">
        <input type="file" id="URL" name="URL"  
        value="<?php echo isFormValidated()? $Picture['URL']: $_POST['URL'] ?>">
        <br><br>
        <label for="ServiceID">Subject:</label>
            <select name="ServiceID">
            <option value="1"
            <?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='1') echo 'selected' ?>
            >Indoor Sports</option>              
            <option value="2"
            <?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='2') echo 'selected' ?>
            >Outdoor Sports</option>
            <option value="3"
            <?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='3') echo 'selected' ?>
            >Recreation</option>                        
            </select>       
      
        
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    
    </form>
    
    <br><br>
    <a href="IndexPicture.php">Back to Index Picture </a> 
</body>
</html>


<?php
db_disconnect($db);
?>