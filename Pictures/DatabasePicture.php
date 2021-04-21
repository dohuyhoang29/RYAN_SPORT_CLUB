<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "RYAN_SPORT_CLUB");

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

/******
 * Open connection to database
 */
$db = db_connect();


function db_disconnect($connection) { //call at the end of each page
    if(isset($connection)) {
      mysqli_close($connection);
    }
}

function confirm_query_result($result){
    global $db;
    if (!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit; //terminate php
    } else {
        return $result;
    }
}

function insert_Picture($Picture) {
    global $db;

    $sql = "INSERT INTO Pictures ";
    $sql .= "(Name, URL, ServiceID) ";
    $sql .= "VALUES (";
    $sql .= "'" . $Picture['Name'] . "',"; //be careful of single quotes
    $sql .= "'../imgs/" . $Picture['URL'] . "',";//be careful of single quotes
    $sql .= "'" . $Picture['ServiceID'] . "'";//be careful of single quotes
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

function find_all_picture(){
    global $db;
    // SELECT p.PictureID, p.URL, p.Name, s.Name
    // FROM pictures p INNER JOIN 
	// service s ON p.ServiceID = s.ServiceID;

    $sql = "SELECT  s.name,p.URL, p.Name  FROM pictures p INNER JOIN  service s ";
    $sql .="ON p.ServiceID = s.ServiceID";
    // $sql .= "ORDER BY Name ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_Picture_by_id($id) {
    global $db;
    $sql = "SELECT * FROM Pictures ";
    $sql .= "WHERE PictureID='" .$id. "'";
    $result = mysqli_query($db, $sql);

    confirm_query_result($result);

    $Picture = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $Picture; // returns an assoc. array
}

function Update_Picture($Picture) {
    global $db;

    $sql = "UPDATE Pictures SET ";
    $sql .= "Name='" . $Picture['Name'] . "', ";
    $sql .= "ServiceID='" . $Picture['ServiceID'] . "', ";
    $sql .= "URL='" . $Picture['URL'] . "' ";
    $sql .= "WHERE PictureID='" . $Picture['PictureID']. "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function Delete_Picture($id) {
    global $db;

    $sql = "DELETE FROM Pictures ";
    $sql .= "WHERE PictureID='" . $id. "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}


?>