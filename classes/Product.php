<?php

class Product extends \db
{

    public $pdo;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = parent::getConnection();
    }

    public function getAllProducts()
    {
        $products = array();
        $sql = <<<SQL
        SELECT product_img, product_title, product_description, product_name, product_year FROM products
SQL;
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push( $products, $row );
            }
            return $products;
        } else {
            return "No prodcts found!";
        }
    }

    public function getProductById($id)
    {
        if (! filter_var($id, FILTER_VALIDATE_INT))
            throw new Exception('Product not found!');
        
        $sql = <<<SQL
        SELECT product_img, product_title, product_description FROM products where product_id = :id
SQL;
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
        
        if ($stmt->rowCount() > 0) {
            $product = $stmt->fetch();
            return $product[0];
        } else {
            return "Product not found!";
        }
    }
}

?>