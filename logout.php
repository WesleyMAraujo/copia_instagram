<?php 
if (!isset($_SESSION)) {
    session_start();
}
session_destroy(); /* destroi a sessão */
header('location: login.php');
?>