<?php
class Products extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDrinks()
    {
        $sql = "SELECT * FROM categories WHERE name=:drinks";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['drinks' => 'drinks']);
        $drink = $stmt->fetch();
        $category_id = $drink->id;

        $sql = "SELECT * FROM products WHERE category_id=:category_id";
        $stmt = $this->conn->prepare($sql);
        $drinks = 'drinks';
        $stmt->execute(['category_id' => $category_id]);
        $drinks = $stmt->fetchAll();
        return $drinks;
    }
    public function getPastries()
    {
        $sql = "SELECT * FROM categories WHERE name=:pastries";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pastries' => 'pastries']);
        $pastry = $stmt->fetch();
        $category_id = $pastry->id;

        $sql = "SELECT * FROM products WHERE category_id=:category_id";
        $stmt = $this->conn->prepare($sql);
        $pastries = 'pastries';
        $stmt->execute(['category_id' => $category_id]);
        $pastries = $stmt->fetchAll();
        return $pastries;
    }

    public function getDesserts()
    {
        $sql = "SELECT * FROM categories WHERE name=:desserts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['desserts' => 'desserts']);
        $dessert = $stmt->fetch();
        $category_id = $dessert->id;

        $sql = "SELECT * FROM products WHERE category_id=:category_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['category_id' => $category_id]);
        $desserts = $stmt->fetchAll();
        return $desserts;
    }
}
