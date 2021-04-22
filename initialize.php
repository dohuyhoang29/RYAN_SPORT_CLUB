<?php
function redirect_to($location) {
    header("Location: " . $location);
    exit;
    //liolkolko
}

session_start();
?>