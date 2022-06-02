<?php

class Product
{
    public $id;
    public $name;
    // public $color;
    // public $size;
    public $description;
    public $price;
    // public $article_nr;

    public function __construct($name, $description, $price, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
}
