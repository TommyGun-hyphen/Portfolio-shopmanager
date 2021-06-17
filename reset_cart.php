<?php
session_start();
session_destroy();
session_start();
$_SESSION['items'] = [];
header('location:'.$_SERVER['HTTP_REFERER']);
?>