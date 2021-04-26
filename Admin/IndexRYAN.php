
<?php
    require_once('DatabaseRYAN.php');
    require_once('../initialize.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index Admin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
<body>

<?php if(!isset($_SESSION['username'])):
        redirect_to('LoginRYAN.php');
endif;?>


<nav class="navbar navbar-inverse">

        <div class="container-fluid">
            <div class="navbar-header">
                <img src="../imgs/L.png" alt="logo">
            </div>

            <ul class="nav navbar-nav">
                <li class="active">

                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="Categories/IndexCategories.php">Category
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="#">Page 1-1</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>         -->
                <li><a href="Categories/IndexCategories.php">Categories</a></li>
                <li><a href="Service/IndexService.php">Service</a></li>
                <li><a href="Pictures/IndexPicture.php">Pictures</a></li>
                <li><a href="Admin/IndexRYAN.php">Admin</a></li>

            </ul>
                

            <ul class="nav navbar-nav navbar-right">
                <!-- <li><a href="Admin/LoginRYAN.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
                <li><a <?php if(!isset($_SESSION['username'])):
                        redirect_to('LoginRYAN.php');
                        endif;?>>
                <!-- <span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
                <li><?php include('../sharesession.php'); ?></li>
            </ul>

            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
                <!-- <span class="glyphicon glyphicon-search"></span> -->
        </form> 
        


        </div>
      </nav>



<div class="container">
 <table class="table table-striped">
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
                <td><a href="<?php echo 'EditRYAN.php?username='.$admin['username']; ?>"><span class="glyphicon glyphicon-edit">Edit</span></a></td>
                <td><a href="<?php echo 'DeleteRYAN.php?username='.$admin['username']; ?>"><span class="glyphicon glyphicon-trash"></span>Delete</a></td>
        </tr>

        

        <?php
            endfor;
            mysqli_free_result($admin_set);
        ?>
  </table>
</div>

    <script src="../js/jquery-2.2.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

<?php
    db_disconnect($db);
?>