<?php

session_start();
if(isset($_POST['product']['id']) && ! in_array($_POST['product']['id'], $_SESSION['items'])){
    $_SESSION['items'][] = $_POST['product']['id'];
}
header('location:'.$_SERVER['HTTP_REFERER']);
?>