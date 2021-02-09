<?php
class Dashboard extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsersCount()
    {
        $stmt = $this->conn->query("SELECT * FROM users");
        return $stmt->rowCount();
    }
    public function getCategoriesCount()
    {
        $stmt = $this->conn->query("SELECT * FROM categories");
        return $stmt->rowCount();
    }
    public function getProductsCount()
    {
        $stmt = $this->conn->query("SELECT * FROM products");
        return $stmt->rowCount();
    }
    public function getReservationsCount()
    {
        $stmt = $this->conn->query("SELECT * FROM reservations");
        return $stmt->rowCount();
    }
}
