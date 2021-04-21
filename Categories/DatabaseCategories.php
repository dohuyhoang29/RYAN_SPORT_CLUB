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
    if(isset($connection)) {
        mysqli_close($connection);
    }
    return;
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

function insert_categories( $categories){
    global $db;

    $sql = "INSERT INTO categories ";

    $sql .= "(Name) ";
    
    $sql .= "VALUES (";

    $sql .= "'" . $categories['name'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function find_all_categories() {
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "ORDER BY Name";

    $result = mysqli_query($db,$sql);

    return $result;
}

function find_categories_by_id($CategoryID) {
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "WHERE CategoryID='" . $CategoryID . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $categories = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $categories; // returns an assoc. array
}

function update_categories($categories) {
    global $db;

    $sql = "UPDATE categories SET ";
    $sql .= "name='" . $categories['name'] . "' ";
    $sql .= "WHERE CategoryID='" . $categories['CategoryID'] . "'";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function delete_categories($CategoryID) {
    global $db;

    $sql = "DELETE FROM categories ";
    $sql .= "WHERE CategoryID='" . $CategoryID . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

?>