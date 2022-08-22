<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/ProductsDB.php";
require_once __DIR__ . "/Order.php";
require_once __DIR__ . "/OrdersDB.php";



class OrdersDB extends Database
{

    public function createOrder(Order $order)

    {

        $query = "INSERT INTO orders (customerID, `status`, orderDate) VALUES (?,?,?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("iss", $order->customerID, $order->status, $order->orderDate);

        $products = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $success = $stmt->execute();

        if (!$success) {
            var_dump($stmt->error);
            die("Error creating order");
        }

        //insert orderID and productID into ordersproducts table and foreach product in cart

        $orderID = $this->conn->insert_id;
        foreach ($products as $product) {
            $query = "INSERT INTO ordersproducts (orderID, productID) VALUES (?,?)";
            $stmt = mysqli_prepare($this->conn, $query);
            $stmt->bind_param("ii", $orderID, $product->id);
            $success = $stmt->execute();
            if (!$success) {
                var_dump($stmt->error);
                die("Error creating ordersproducts entry");
            }
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
            $db_date = $db_order["orderDate"];

            $orders[] = new Order($db_customerID, $db_status, $db_date, $db_id);
        }

        return $orders;
    }


    public function update($orderID)
    {
        $query = "UPDATE orders SET status = 'SENT' WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $orderID);
        $success = $stmt->execute();
        if (!$success) {
            var_dump($stmt->error);
            die("Error updating order");
        }
        return $success;
    }



    public function get_all_by_user()
    {
        $query = "SELECT * FROM orders WHERE customerID = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $_SESSION['user']->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $orders = [];
        foreach ($db_orders as $db_order) {
            $db_id = $db_order["id"];
            $db_customerID = $db_order["customerID"];
            $db_status = $db_order["status"];
            $db_date = $db_order["orderDate"];
            $orders[] = new Order($db_customerID, $db_status, $db_date, $db_id);
        }
        return $orders;
    }
}
