<?php

require_once __DIR__ . "/Database.php";


class OrdersDB extends Database
{


    //Create a new order
    public function create($order)
    {
        $query = "INSERT INTO orders (order_id, `user_i``) VALUES (?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('ii', $order->order_id, $order->user_id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    //Get all orders

    public function get_all()
    {
        $query = "SELECT * FROM orders";
        $result = mysqli_query($this->conn, $query);
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {

            $db_id = $db_order["id"];
            $db_order_id = $db_order["order_id"];
            $db_user_id = $db_order["user_id"];

            $orders[] = new Order($db_order_id, $db_user_id, $db_id);
        }

        return $orders;
    }


    //Get all orders by user id

    public function get_all_by_user($user_id)
    {
        $query = "SELECT * FROM orders WHERE `user_id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {

            $db_id = $db_order["id"];
            $db_order_id = $db_order["order_id"];
            $db_user_id = $db_order["user_id"];

            $orders[] = new Order($db_order_id, $db_user_id, $db_id);
        }

        return $orders;
    }



    //Get order by id

    public function get_by_id($id)
    {
        $query = "SELECT * FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $db_order = mysqli_fetch_assoc($result);

        $db_id = $db_order["id"];
        $db_order_id = $db_order["order_id"];
        $db_user_id = $db_order["user_id"];

        return new Order($db_order_id, $db_user_id, $db_id);
    }




    //Update order

    public function update($order)
    {
        $query = "UPDATE orders SET order_id = ?, `user_id` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('iii', $order->order_id, $order->user_id, $order->id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }



    //Delete order

    public function delete($id)
    {
        $query = "DELETE FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }



    //Delete all orders

    public function delete_all()
    {
        $query = "DELETE FROM orders";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }



    //Delete all orders by user id

    public function delete_all_by_user($user_id)
    {
        $query = "DELETE FROM orders WHERE `user_id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }



    //Delete all orders by order id

    public function delete_all_by_order($order_id)
    {
        $query = "DELETE FROM orders WHERE order_id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $order_id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }



    //Delete all orders by user id and order id


    public function delete_all_by_user_and_order($user_id, $order_id)
    {
        $query = "DELETE FROM orders WHERE `user_id` = ? AND order_id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('ii', $user_id, $order_id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }
}
