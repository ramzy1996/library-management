<?php
session_start();
$link = $_SERVER["REQUEST_URI"];
if (!isset($_SESSION['other'])) {
    echo "<script type='text/javascript'>window.open('login.php?continue=$link','_self')</script>";
}
