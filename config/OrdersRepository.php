<?php
class OrdersRepository{
public static function getAll(){
    require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Order.php');
    $stmt = $conn->prepare("SELECT * FROM orders");
    $stmt->execute();
    $orders_info = $stmt->fetchAll();
    $orders = [];
    foreach($orders_info as $info){
        $orders[] = new Order($info['id'], $info['client_id'], $info['date']);
    }
    return $orders;

    }
    public static function getById($id){
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Order.php');
        //$query = "SELECT * FROM orders WHERE id = ?";
        $stmt = $conn->prepare("SELECT * FROM orders where id = ?");
        $stmt->execute([$id]);
        $order = $stmt->fetch();
        return new Order($info['id'], $info['client_id'], $info['date']);
    }
    public static function getItems($id){//returns array of Product items associated with specified order.
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Order.php');
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Product.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/ProductsRepository.php');
        $stmt = $conn->prepare("SELECT product_id FROM order_details where order_id = ?");
        $stmt->execute([$id]);
        $products_id = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $products = [];
        foreach($products_id as $product_id){
            $products[] = ProductsRepository::getById($product_id);
        }
        return $products;
    }
}
?>