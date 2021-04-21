<?php
function redirect_to($location) {
    header("Location: " . $location);
    exit;
}

session_start();
?>