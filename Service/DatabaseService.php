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

    function insert_service($service){
        global $db;

        $sql = "INSERT INTO Service ";
        $sql .= "(`Name`, Rules, `Time`, Famous_Players, CategoryID) ";
        $sql .= "VALUES (";
        $sql .= "'" . $service['Name']       . "', ";
        $sql .= "'" . $service['Rules']      . "', ";
        $sql .= "'" . $service['Time']       . "', ";
        $sql .= "'" . $service['Famous_Players'] . "', ";
        $sql .= "'" . $service['CategoryID'] . "' ";
        $sql .= ");";
        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }

    function find_all_service(){
        global $db;

        $sql = "SELECT s.ServiceID, s.name, s.Rules, s.Time, s.Famous_Players, c.Name
                FROM service s INNER JOIN categories c ON s.CategoryID = c.CategoryID; ";
        $result = mysqli_query($db, $sql);

        return $result;
        
    }

    function find_service_by_id($ServiceID){
        global $db;

        $sql = "SELECT * FROM Service ";
        $sql .= " WHERE ServiceID = '" . $ServiceID . "';";
        $result = mysqli_query($db, $sql);

        confirm_query_result($result);

        $service = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $service;
    }

    // UPDATE service s INNER JOIN categories c ON s.CategoryID = c.CategoryID
    // SET s.Name = 'hoang', s.Rules = 'deo biet', s.Time = '123', s.Famous_Players = 'Hoang super pro', s.CategoryID = '1'
    // WHERE s.ServiceID = '5';

    function update_service($service){
        global $db;

        $sql = "UPDATE service s INNER JOIN categories c ON s.CategoryID = c.CategoryID ";
        $sql .= "SET ";
        $sql .= "s.Name = '" . $service['Name'] . "', ";
        $sql .= "s.Rules = '" . $service['Rules'] ."', ";
        $sql .= "s.Time = '" . $service['Time'] . "', ";
        $sql .= "s.Famous_Players = '" . $service['Famous_Players'] . "', ";
        $sql .= "s.CategoryID = '" . $service['CategoryID'] . "' ";
        $sql .= "WHERE s.ServiceID = '" . $service['ServiceID'] . "' ";
        $sql .= "LIMIT 1;";

        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }

    function delete_service($service){
        global $db;

        $sql = "DELETE FROM Service ";
        $sql .= "WHERE ServiceID = '" . $service . "' ";
        $sql .= "LIMIT 1;";
        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }
?>