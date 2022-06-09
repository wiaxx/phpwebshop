<?php

class Product
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $img_url;

    public function __construct($name, $description, $price, $img_url, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img_url = $img_url;
    }

    public function __toString(){
        return  "{$this -> name}  
                ({$this -> description}) 
                ({$this -> price})";

    }

}
