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
        $picture = [];
        $picture['PictureID'] = $_POST['PictureID'];
        $picture['Name'] = $_POST['Name'];
        $picture['URL'] = $_POST['URL'];
        $picture['ServiceID'] = $_POST['ServiceID'];

        Update_Picture($picture);
        redirect_to('IndexPicture.php');
    }
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
        value="<?php echo isFormValidated()? $picture['PictureID']: $_POST['PictureID'] ?>" >

        <label for="Name">Name</label> <!--required-->
        <input type="text" id="Name" name="Name"  
        value="<?php echo isFormValidated()? $picture['Name']: $_POST['Name'] ?>">
        <br><br>

        <label for="URL">URL</label> <!--required-->
        <input type="text" id="URL" name="URL"  
        value="<?php echo isFormValidated()? $picture['URL']: $_POST['URL'] ?>">
        <input type="file" id="URL" name="URL"  
        value="<?php echo isFormValidated()? $picture['URL']: $_POST['URL'] ?>">
        <br><br>
        <label for="ServiceID">Subject:</label>
        <select>
            <option value="1"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='1') echo 'selected' ?>>Cầu Lông</option>              
            <option value="2"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='2') echo 'selected' ?>>Bóng Chuyền</option>
            <option value="3"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =="3") echo 'selected' ?>>Bóng Rổ</option>
            <option value="4"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =="4") echo 'selected' ?>>Đấu Kiếm</option>              
            <option value="5"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='5') echo 'selected' ?>>Bóng Bàn</option>
            <option value="6"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='6') echo 'selected' ?>>Đá Cầu</option>
            <option value="7"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='7') echo 'selected' ?>>Bóng Đá</option>              
            <option value="8"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='8') echo 'selected' ?>>Quần Vợt</option>
            <option value="9"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='9') echo 'selected' ?>>Nhảy xa</option>
            <option value="10"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='10') echo 'selected' ?>>Bóng Chày</option>              
            <option value="11"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='11') echo 'selected' ?>>Điền Kinh</option>
            <option value="12"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='12') echo 'selected' ?>>Bơi Lội</option>
            <option value="13"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='13') echo 'selected' ?>>Food</option>              
            <option value="14"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='14') echo 'selected' ?>>Massage</option>
            <option value="15"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='15') echo 'selected' ?>>Bi-a</option>
            <option value="16"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='16') echo 'selected' ?>>Bar</option>              
            <option value="17"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='17') echo 'selected' ?>>Xông Hơi</option>
            <option value="18"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='18') echo 'selected' ?>>Yoga</option> 
            <option value="19"<?php if(!empty($picture['ServiceID']) && $picture['ServiceID'] =='19') echo 'selected' ?>>Movie</option>                      
        </select>       
      
        
        <input type="submit" name="submit" value="Submit">
    
    </form>
    
    <br><br>
    <a href="IndexPicture.php">Back to Index Picture </a> 
</body>
</html>


<?php
db_disconnect($db);
?>