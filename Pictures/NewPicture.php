<?php
require_once('DatabasePicture.php'); 
require_once('../initialize.php');
$errors = [];

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_POST['Name'])){
        $errors[] = 'Name is required';
    }

    if (empty($_POST['URL'])){
        $errors[] = 'URL is required';
    }    
    

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New Book</title>
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
        form{
            border: 3px solid green;
            padding: 10px;
            width: 30%;
        }

        label{
            font-weight: bold;
            float: left;
            padding-bottom: 5px;
            width: 30%;
        }

        input{
           width: 60%;
            margin: 5px;
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
        <label for="Name">Name</label> <!--required-->
        <input type="text" id="Name" name="Name"  
        value="<?php echo isFormValidated()? '': $_POST['Name'] ?>">
        <br><br>

        <!-- <label for="ServiceID">ServiceID</label> required -->
        <!-- <input type="number" id="ServiceID" name="ServiceID"  -->
        <!-- value="<
            ?php  echo isFormValidated()? '': $_POST['ServiceID'] ?>"> -->
        <label for="ServiceID">Subject:</label>
            <select name="ServiceID">
                <option value="1"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='1') echo 'selected' ?>>Cầu Lông</option>              
                <option value="2"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='2') echo 'selected' ?>>Bóng Chuyền</option>
                <option value="3"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =="3") echo 'selected' ?>>Bóng Rổ</option>
                <option value="4"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =="4") echo 'selected' ?>>Đấu Kiếm</option>              
                <option value="5"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='5') echo 'selected' ?>>Bóng Bàn</option>
                <option value="6"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='6') echo 'selected' ?>>Đá Cầu</option>
                <option value="7"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='7') echo 'selected' ?>>Bóng Đá</option>              
                <option value="8"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='8') echo 'selected' ?>>Quần Vợt</option>
                <option value="9"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='9') echo 'selected' ?>>Nhảy xa</option>
                <option value="10"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='10') echo 'selected' ?>>Bóng Chày</option>              
                <option value="11"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='11') echo 'selected' ?>>Điền Kinh</option>
                <option value="12"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='12') echo 'selected' ?>>Bơi Lội</option>
                <option value="14"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='13') echo 'selected' ?>>Food</option>              
                <option value="15"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='14') echo 'selected' ?>>Massage</option>
                <option value="15"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='15') echo 'selected' ?>>Bi-a</option>
                <option value="16"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='16') echo 'selected' ?>>Bar</option>              
                <option value="17"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='17') echo 'selected' ?>>Xông Hơi</option>
                <option value="18"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='18') echo 'selected' ?>>Yoga</option> 
                <option value="19"<?php if(!empty($_POST['ServiceID']) && $_POST['ServiceID'] =='19') echo 'selected' ?>>Movie</option>                      
            </select>       
        <br><br>
        <input type="file" name="URL" id="URL"
        value = "<?php echo isFormValidated()? $_POST['URL']: $_POST['URL'] ?>">
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">

    </form>
        <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()): ?> 
        <?php 
        $picture = [];
        $picture['Name'] = $_POST['Name'];
        $picture['ServiceID'] = $_POST['ServiceID'];
        $picture['URL'] = $_POST['URL'];
        $result = insert_picture($picture);
        $newPictureID = mysqli_insert_id($db);
        ?>
        <h2>A new Picture (ID: <?php echo $newPictureID ?>) has been created:</h2>
        <ul>
        <?php 
            foreach ($_POST as $key => $value) {
                if ($key == 'submit') continue;
                if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
            }        
        ?>
        </ul>
    <?php endif; ?>
    
    <br><br>
    <a href="IndexPicture.php">Back to Picture Index</a> 
</body>
</html>


<?php
db_disconnect($db);
?>