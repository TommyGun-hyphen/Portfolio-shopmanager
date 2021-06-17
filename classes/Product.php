<?php
class Product{
    private $id;
    private $name;
    private $price;
    private $price_old;
    private $img_url;
    public function __construct($id, $name, $price, $price_old, $img_url){
        $this->id = $id;        
        $this->name = $name;
        $this->price = $price;
        $this->price_old = $price_old;
        $this->img_url = $img_url;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getPriceOld(){
        return $this->price_old;
    }
    public function getImgUrl(){
        return $this->img_url;
    }
}

?>