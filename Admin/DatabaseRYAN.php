<?php 
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "RYAN_SPORT_CLUB");

    function db_connect(){
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        return $connection;
    }

    $db = db_connect();

    function db_disconnect($connection){
        if(isset($connection)){
            mysqli_close($connection);
        }
    }
    function confirm_query_result($result){
        global $db;
        if (!$result){
            echo mysqli_error($db);
            db_disconnect($db);
            exit; 
        } else {
            return $result;
        }
    }
    function insert_admin($admin){
        global $db;

        $sql = "INSERT INTO admin ";
        $sql .= "(Username,Password,Fullname,Email,Phone,pass) ";
        $sql .= "VALUES (";
        $sql .= "'" . $admin['username'] . "',"; 
        $sql .= "'" . $admin['password'] . "',";
        $sql .= "'" . $admin['fullname'] . "',";
        $sql .= "'" . $admin['email'] . "',";
        $sql .= "'" . $admin['phone'] . "',";
        $sql .= "'" . $admin['pass'] . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo "USERNAME already!";
            db_disconnect($db);
            exit;
        }
        return confirm_query_result($result);
    }

    function find_usenmae($username) {
        global $db;
        $sql = "SELECT Password FROM admin ";
        $sql .= "WHERE username='" . $username . "'";
        $result = mysqli_query($db, $sql);
        confirm_query_result($result);
        $Login = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $Login; 
    }

    function find_all_admin(){
        global $db;

        $sql = "SELECT * FROM admin ";
        $result = mysqli_query($db, $sql);

        return $result;
    }

    function find_all_admin_different(){
        global $db;

        $sql = "SELECT * FROM admin ";
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result)){
            
            return true;
        } else {
            return false;
        }
    }

    function find_admin_by_id($username){
        global $db;

        $sql = "SELECT * FROM admin ";
        $sql .= "WHERE username = '" . $username . "' ";
        $result = mysqli_query($db, $sql);
        confirm_query_result($result);
        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin;
    }
//     UPDATE admin SET  username = 'hoang12',
//     `password` = '123456',
//     fullname = 'Do Huy Hoang',
//     phone = '0866539370',
//     email = 'hoangdohuy29092002@gmail.com'
//     WHERE username = 'Đỗ Huy Hoàng';
    function update_admin($admin){
        global $db;

        $sql  = "UPDATE admin SET ";
        $sql .= "username = '" . $admin['username'] . "', ";
        $sql .= "password = '" . $admin['password'] . "', ";
        $sql .= "fullname = '" . $admin['fullname'] . "', ";
        $sql .= "email = '" . $admin['email'] . "', ";
        $sql .= "phone = '" . $admin['phone'] . "', ";
        $sql .= "pass = '" . $admin['pass'] . "'";
        $sql .= "WHERE username = '" . $admin['USE'] . "' ";
        $sql .= "LIMIT 1;";

        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }

    function delete_admin($username){
        global $db;

        $sql = "DELETE FROM admin ";
        $sql .= "WHERE username='" . $username . "' ";
        $sql .= "LIMIT 1;";
        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }

    function find_ADMIN_by_USE() {
        global $db;
        $sql = "SELECT username FROM admin ";
        $sql .= "ORDER BY username";
        $result = mysqli_query($db,$sql);
        return $result;
    }
?>