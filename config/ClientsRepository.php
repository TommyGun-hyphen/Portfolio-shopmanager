<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
class ProductsRepository{
    public static function getAll(){
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Client.php');
        $stmt = $conn->prepare("SELECT * FROM clients");
        $stmt->execute();
        $client_info = $stmt->fetchAll();
        $clients = [];
        foreach($client_info as $client){
            $clients[] = new Client($client_info['id'], $client_info['full_name'], $client_info['phone'], $client_info['email'], $client_info['address']);
        }
        return $clients;
    }
    public static function getFiltered($order_by, $order_direction, $max_price){
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');

        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Client.php');
        $query = "SELECT * FROM products";
        $options = [];
        if(is_numeric($max_price) && $max_price != '' && $max_price != null){
            $query = $query." WHERE price < ?";
            $options[] = $max_price;
        }
        if(isset($order_by, $order_direction)){
            $query = $query . " ORDER BY $order_by $order_direction;";
        }
        
        $stmt = $conn->prepare($query);
        $stmt->execute($options);
        $products_info = $stmt->fetchAll();
        $products = [];
        foreach($products_info as $info){
            $products[] = new Product($info['id'], $info['name'], $info['price'], $info['price_old'], $info['img_url']);
        }
        return $products;
    }

    public static function getById($id){
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Client.php');
        //$query = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare("SELECT * FROM clients where id = ?");
        $stmt->execute([$id]);
        $client = $stmt->fetch();
        return new Client($client['id'], $client['full_name'], $client['phone'], $client['email'], $client['address']);
    }

}


?>