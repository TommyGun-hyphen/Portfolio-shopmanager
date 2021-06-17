<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
class ProductsRepository{
    public static function getAll(){
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Product.php');
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $products_info = $stmt->fetchAll();
        $products = [];
        foreach($products_info as $info){
            $products[] = new Product($info['id'], $info['name'], $info['price'], $info['price_old'], $info['img_url']);
        }
        return $products;
    }
    public static function getFeatured($limit){
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');

        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Product.php');
        $stmt = $conn->prepare('SELECT product_id FROM featured_products LIMIT ?;');
        $stmt->execute([$limit]);
        $product_ids = $stmt->fetchAll();
        //var_dump($product_ids);
        $products = [];
        
        foreach($product_ids as $product_id){
            $stmt = $conn->prepare('SELECT * FROM products WHERE id=?');
            $stmt->execute([$product_id['product_id']]);
            $product_info = $stmt->fetch();
            $product = new Product($product_info['id'],$product_info['name'],$product_info['price'],
                $product_info['price_old'], $product_info['img_url'] );
            $products[] = $product;
        }
        return $products;
    }
    public static function getFiltered($order_by, $order_direction, $max_price){
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Product.php');
        $allowed = [null, "price", "name"];
        if(!in_array($order_by, $allowed)){
            die('can\'t use filter');
        }
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
        require_once($_SERVER['DOCUMENT_ROOT'].'/shopmanager/classes/Product.php');
        //$query = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare("SELECT * FROM products where id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        return new Product($id, $product['name'], $product['price'],$product['price_old'],$product['img_url']);
    }
    public static function nameExists($name){
        require($_SERVER['DOCUMENT_ROOT'].'/shopmanager/config/connection.php');
        $query = "SELECT id from products where name=?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$name]);
        if($stmt->rowCount() == 1){
            return true;
        }
        else{
            return false;
        }
    }
}


?>