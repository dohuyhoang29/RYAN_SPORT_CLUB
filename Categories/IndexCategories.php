<?php

require_once('DatabaseCategories.php');
require_once('../initialize.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>index categories</title>
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
    </style>
</head>
<body>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('Admin/LoginRYAN.php');
    endif;?>

    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>

    <a href="NewCategories.php">Create new categories</a> <br><br>
    <table class="list">
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>

  	    </tr>

        <?php
        
        $categories_set = find_all_categories();
        $count = mysqli_num_rows($categories_set);
        for ($i = 0; $i < $count; $i++):
            $categories = mysqli_fetch_assoc($categories_set); 
        ?>
            <tr>
                <td><?php echo $categories['Name']; ?></td>

                <td><a href="<?php echo 'EditCategories.php?CategoryID='.$categories['CategoryID']; ?>">Edit</a></td>
                <td><a href="<?php echo 'DeleteCategories.php?CategoryID='.$categories['CategoryID']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($categories_set);
        
        ?>
    </table>
</body>
</html>

<?php
db_disconnect($db);
?>