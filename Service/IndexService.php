<?php
    require_once('DatabaseService.php');
    require_once('../initialize.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Service</title>
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
        redirect_to('Admin/LoginRYAN.php');
    endif;?>
    <a href="../AdminMenu.php"><img src="../imgs/r.svg" alt="logo"></a><?php include('../sharesession.php'); ?><br><br>

    <a href="NewService.php">Create a new Service</a>
    <table class="list">
        <tr>
            <th>Name</th>
            <th>Rules</th>
            <th>Time</th>
            <th>Famous Players</th>
            <th>CategoryID</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>

        <?php
            $service_set = find_all_service();
            $count = mysqli_num_rows($service_set);
            for($i = 0; $i < $count; $i++):
                $service = mysqli_fetch_assoc($service_set);
        ?>

        <tr>
            <td><?php echo $service['name']; ?></td>
            <td><?php echo $service['Rules']; ?></td>
            <td><?php echo $service['Time']; ?></td>
            <td><?php echo $service['Famous_Players']; ?></td>
            <td><?php echo $service['Name']; ?></td>
            <td><a href="<?php echo "EditService.php?ServiceID=". $service['ServiceID']; ?>">Edit</a></td>
            <td><a href="<?php echo "DeleteService.php?ServiceID=". $service['ServiceID']; ?>">Delete</a></td>
        </tr>

        <?php 
            endfor;
            mysqli_free_result($service_set);
        ?>
    </table>
</body>
</html>

<?php   
    db_disconnect($db);
?>