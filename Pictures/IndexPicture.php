<?php
require_once('DatabasePicture.php');
require_once('../initialize.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Book</title>
    <style>
        table {
        border-collapse: collapse;
        vertical-align: top;
        }

        table.list {
        width: 100%;
        }

        table.list tr td {
        border: 1px solid #999999;
        }

        table.list tr th {
        border: 1px solid #0055DD;
        background: #0055DD;
        color: white;
        text-align: left;
        }
        img{
            text-align:array_multisort;
            height: 150px;
            width: 150px;
        }
    </style>
</head>
<body>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>
    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>

    <a href="NewPicture.php">Create New Picture</a> <br><br>
    <table class="list">
        <tr>
            <th>Name</th>
            <th>URL</th>
            <th>Name_Sport</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $picture_set = find_all_picture();
        $count = mysqli_num_rows($picture_set);
        for ($i = 0; $i < $count; $i++):
            $picture = mysqli_fetch_assoc($picture_set); 
        ?>
            <tr>
                <td><?php echo $picture['Name']; ?></td>
                <td class="img"><img src="<?php echo '../imgs/'.$picture['URL']; ?>"></td>
                <td><?php echo $picture['name']; ?></td>
                <td><a href="<?php echo 'EditPicture.php?PictureID='.$picture['PictureID']; ?>">Edit</a></td>
                <td><a href="<?php echo 'DeletePicture.php?PictureID='.$picture['PictureID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($picture_set);
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
?>