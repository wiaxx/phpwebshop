<?php

class Order
{
    public $id;
    public $customerID;
    public $status;
    public $orderDate;

    public function __construct($customerID, $status, $orderDate, $id = 0)
    {


        if ($id > 0) {
            $this->id = $id;
        }

        $this->status = $status;
        $this->customerID = $customerID;
        $this->orderDate = $orderDate;
    }
}
