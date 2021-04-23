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
        $errors[] = 'Book Name is required';
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
        $result = insert_Picture($picture);
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