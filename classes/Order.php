<?php

class Order
{
    public $id;
    public $order_id;
    public $User_id;

    public function __construct($order_id, $user_id, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        $this->order_id = $order_id;
        $this->user_id = $user_id;
    }
}
