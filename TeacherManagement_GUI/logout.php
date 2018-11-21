<?php
//Huy session
session_start();
unset($_SESSION['username']);


//Chuyen den trang login
header('Location: login.php');

?>