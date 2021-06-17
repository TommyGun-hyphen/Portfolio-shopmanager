<?php
    require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
    if(isset($_POST['id'])){
        $query = 'DELETE FROM products WHERE id = ?';
        $stmt = $conn->prepare($query);
        $stmt->execute([$_POST['id']]);
        unlink($_SERVER['DOCUMENT_ROOT'].'/shopmanager/'.$_POST['image_url']);
    }
    header('location:products.php');
?>