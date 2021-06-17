<?php
class OrderDetails{
    private $order_id;  //1   -    1    
    private $product_id;//3   -    4
    private $quantity;  //3   -    1
    public function _construct($order_id, $product_id, $quantity){
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity =$quantity;
    }
}


?>