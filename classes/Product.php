<?php

class Product
{
    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($name, $description, $price, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function __toString(){
        return  "{$this -> name}  
                ({$this -> description}) 
                ({$this -> price})";
    }

}
