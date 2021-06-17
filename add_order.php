<?php
session_start();
if(!isset($_SESSION['items'])){
    header('location:products.php');
}
require_once($_SERVER['DOCUMENT_ROOT']."/shopmanager/config/connection.php");
if( isset($_POST['full_name'], $_POST['phone_number'], $_POST['email'], $_POST['address']) ){
    //check if client already exists
    $query = "SELECT * FROM clients WHERE phone=? OR email=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_POST['phone_number'], $_POST['email'] ]);
    //add client
    if($stmt->rowCount() == 0){
        $query = "INSERT INTO clients(full_name, phone, email, address) values(?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->execute([ $_POST['full_name'], $_POST['phone_number'], $_POST['email'], $_POST['address'] ]);
        $client_id = $conn->lastInsertId();
    }else{
        $client_id = $stmt->fetch()['id'];
    }
    //add order
    $query = "INSERT INTO orders(client_id, date) VALUES(?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([ $client_id, $date=date("Y-m-d",strtotime(date("Y-m-d"))) ]);
    $order_id = $conn->lastInsertId();
    //add all items
    foreach($_SESSION['items'] as $product_id){
        $query = "INSERT INTO order_details(order_id, product_id, quantity) VALUES(?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([ $order_id, $product_id, 1 ]);
    }
    session_destroy();
    header('location:index.php');
}


?>