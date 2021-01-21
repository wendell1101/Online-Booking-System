<?php

// constants
define('TITLE', 'Booking APP');
define('APPROOT', dirname(dirname(__FILE__)));

// Setup database Connection
class Connection{
    public $conn;
    public function __construct()
    {
        try {
            // Set DSN
            $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;
            // Create a PDO instance
            $this->conn = new PDO($dsn, USERNAME, PASSWORD);

            // Set default fetch attribute to object
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For limits in query

        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->conn ;
    }

}
