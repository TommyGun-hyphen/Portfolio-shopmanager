<?php

session_start();
$_SESSION['items'] = array_values($_SESSION['items']);
if(isset($_POST['product_id'])){
    var_dump($_POST['product_id']);
    var_dump($_SESSION['items']);
    for($i = 0; $i < count($_SESSION['items']); $i = $i + 1){
        if($_SESSION['items'][$i] == (int) $_POST['product_id']){
            unset($_SESSION['items'][$i]);
            break;
        }
    }
}

header('location:'. $_SERVER['HTTP_REFERER']);
?>