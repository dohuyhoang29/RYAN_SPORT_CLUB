<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "ryan_sport_club");

function db_connect(){
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

$db = db_connect();


function db_disconnect(){
    if(isset($connection)){
        mysqli_close($connection);
        return;
    }
}


function confirm_query_result($result){
    global $db;

    if(!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    } else {
        return $result;
    }
}

function insert_picture($picture) {
    global $db;

    $sql = "INSERT INTO Pictures ";
    $sql .= "(Name, URL, ServiceID) ";
    $sql .= "VALUES (";
    $sql .= "'" . $picture['Name'] . "',"; //be careful of single quotes
    $sql .= "'../imgs/" . $picture['URL'] . "',";//be careful of single quotes
    $sql .= "'" . $picture['ServiceID'] . "'";//be careful of single quotes
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

function find_all_picture(){
    global $db;

    $sql  ="SELECT p.PictureID ,s.name ,p.URL, p.Name 
            FROM pictures p INNER JOIN  service s ON p.ServiceID  = s.ServiceID";         
    $result = mysqli_query($db, $sql); 
    return $result;
}

function find_picture_by_id ($pictureID) {
    global $db;
    $sql = "SELECT * FROM Pictures ";
    $sql .= "WHERE PictureID='" .$pictureID. "'";
    $result = mysqli_query($db, $sql);

    confirm_query_result($result);

    $picture = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $picture; 
}

function Update_Picture($picture) {
    global $db;

    // $sql = "UPDATE Pictures SET ";
    // $sql .= "Name='" . $Picture['Name'] . "', ";
    // $sql .= "ServiceID='" . $Picture['ServiceID'] . "', ";
    // $sql .= "URL='" . $Picture['URL'] . "' ";
    // $sql .= "WHERE PictureID='" . $Picture['PictureID']. "' ";
    // $sql .= "LIMIT 1";

        $sql = "UPDATE Pictures p INNER JOIN service s ON p.PictureID = s.ServiceID ";
        $sql .= "SET ";
        $sql .= "p.Name = '" . $picture['Name'] . "', ";
        $sql .= "p.Famous_Players = '" . $picture['ServiceID'] . "', ";
        $sql .= "p.CategoryID = '" . $picture['URL'] . "' ";
        $sql .= "WHERE p.PictureID = '" . $picture['PictureID'] . "' ";
        $sql .= "LIMIT 1;";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

    function Delete_Picture($picture) {
    global $db;

    $sql = "DELETE FROM Pictures ";
    $sql .= "WHERE PictureID='" . $picture. "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}


?>