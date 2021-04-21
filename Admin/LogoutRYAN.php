<?php 
require_once('../initialize.php');

unset($_SESSION['username']);

redirect_to('LoginRYAN.php');
exit;

?>