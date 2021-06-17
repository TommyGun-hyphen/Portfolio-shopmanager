<?php

class Client{
    private $id;
    private $full_name;
    private $phone;
    private $email;
    private $address;
    public function __construct($id, $full_name, $phone, $email, $address){
        $this->id = $id;
        $this->full_name = $full_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
    }

}


?>