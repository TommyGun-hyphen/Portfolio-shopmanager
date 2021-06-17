<?php

class Order{
    private $id;
    private $client_id;
    private $date;
    public function __construct($id, $client_id, $date){
        $this->id = $id;
        $this->client_id = $client_id;
        $this->date = $date;
    }

}



?>