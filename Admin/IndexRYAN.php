<?php
    require_once('DatabaseRYAN.php');
    require_once('../initialize.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Admin</title>
    <style>
        table{
            border-collapse: collapse;
            vertical-align: top;
        }
        table.list{
            width: 100%;
        }

        table.list tr td {
            border: 1px solid #999999;
        }

        table.list tr th{
            border: 1px solid #0055DD;
            background: #0055DD;
            color: white;
            text-align: left;
        }
    </style>
</head>
<body>
<?php if(!isset($_SESSION['username'])):
    redirect_to('LoginRYAN.php');
endif;?>

    <a href="../AdminMenu.php"><img src="../imgs/logo.jpg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>
    <a href="RegistrationRYAN.php">Create a Admin</a>
    <table class="list">
        <tr>
            <th>User Name</th>
            <th>Password</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>

        <?php
            $admin_set = find_all_admin();
            $count = mysqli_num_rows($admin_set);
            for($i = 0; $i < $count; $i++):
                $admin = mysqli_fetch_assoc($admin_set);
        ?>

        <tr>
                <td><?php echo $admin['username'];?></td>
                <td><?php echo $admin['pass'];?></td>
                <td><?php echo $admin['fullname'];?></td>
                <td><?php echo $admin['phone'];?></td>
                <td><?php echo $admin['email'];?></td>
                <td><a href="<?php echo 'EditRYAN.php?username='.$admin['username']; ?>">Edit</a></td>
                <td><a href="<?php echo 'DeleteRYAN.php?username='.$admin['username']; ?>">Delete</a></td>
        </tr>

        

        <?php
            endfor;
            mysqli_free_result($admin_set);
        ?>
    </table>

    <p>
        <?php 
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
            }
        ?>
    </p>

</body>
</html>


<?php
    db_disconnect($db);
?>