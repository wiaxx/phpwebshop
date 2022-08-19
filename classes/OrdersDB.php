<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/ProductsDB.php";
require_once __DIR__ . "/Order.php";



class OrdersDB extends Database
{

    //create order from shopcart.php

    public function createOrder(Order $order)

    {
        var_dump($order);
        $query = "INSERT INTO orders (customerID, `status`, orderDate) VALUES (?,?,?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("iss", $order->customerID, $order->status, $order->orderDate);

        $success = $stmt->execute();

        if (!$success) {
            var_dump($stmt->error);
            die("Error creating order");
        }


        return $success;
    }

    public function get_all()
    {
        $query = "SELECT * FROM orders";

        $result = mysqli_query($this->conn, $query);
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {

            $db_id = $db_order["id"];
            $db_customerID = $db_order["customerID"];
            $db_status = $db_order["status"];
            $db_date = $db_order["date"];

            $orders[] = new Order($db_customerID, $db_status, $db_date, $db_id);
        }

        return $orders;
    }



        public function update(Order $order)
        {
            $query = "UPDATE orders SET status = ? WHERE id = ?";

            $stmt = mysqli_prepare($this->conn, $query);

            $stmt->bind_param("si", $order->status, $order->id);

            $success = $stmt->execute();
            
            if (!$success) {
                var_dump($stmt->error);
                die("Error updating order");
            }
            return $success;
        }
    













}
