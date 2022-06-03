<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Product.php';

class ProductsDB extends Database
{


    public function get_all_products()
    {
        $query = 'SELECT * FROM products';
        $result = mysqli_query($this->conn, $query);
        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $products = [];

        foreach ($db_products as $db_product) {

          $db_id = $db_product['id'];
          $db_name = $db_product['productName'];
          $db_description = $db_product['description'];
          $db_price = $db_product['price'];

          $products[] = new Product($db_name, $db_description, $db_price, $db_id);
        }

        return $products;
    }


    
    public function get_one_product($id)
    {
          $query = "SELECT * FROM products WHERE id = ?";

          $stmt = mysqli_prepare($this->conn, $query);
          $stmt->bind_param("i", $id);
          $stmt->execute();
    
          $result = $stmt->get_result();
          $db_product = mysqli_fetch_assoc($result);
     
          $id = $db_product["id"];
          $name = $db_product["name"];
          $description = $db_product["description"];
          $price = $db_product["price"];
    
          $product = new Product($name, $description, $price, $id);
    
        return $product;
    }



    public function create_product($user_id, Product $product)
  {
      $query = "INSERT INTO products (productname, ´description´, price, userId) VALUES (?,?,?,?)";

      $stmt = mysqli_prepare($this->conn, $query);
      $name = $product->name;
      $description = $product->description;
      $price = $product -> price;

      $stmt->bind_param("ssii", $name, $description, $price, $user_id);

      $success = $stmt->execute();

      return $success;
  }



   public function update_product(Product $product)
 {
    $query = "UPDATE products SET name = ? AND SET descpription = ? AND SET price = ? WHERE id = ?";

    $stmt = mysqli_prepare($this->conn, $query);
    $name = $product -> name;
    $description = $product -> description;
    $price = $product -> price;
    $id = $product -> id;

    $stmt->bind_param("ssii", $name, $description, $price, $id);

    $success = $stmt -> execute();

    return $success;
}


 public function delete_product($id)
{
      $query = "DELETE FROM products WHERE id = ?";
  
      $stmt = mysqli_prepare($this->conn, $query);
      $stmt->bind_param("i", $id);
  
      $success = $stmt->execute();
  
      return $success;
    }

}
