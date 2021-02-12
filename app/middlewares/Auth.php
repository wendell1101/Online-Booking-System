<?php
class Auth extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }
    public function restrict()
    {
        if (!isset($_SESSION['id'])) {
            if (strpos(CURRENT_URL, 'admin') !== false) {
                header('Location: ../login.php');
                exit();
            } else {
                header('Location: login.php');
                exit();
            }
        } else {
            $id = $_SESSION['id'];
            $active = 1;
            $sql = "SELECT * FROM users WHERE id=:id AND active=:active";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id, 'active' => $active]);
            if ($stmt->rowCount() === 0) {
                header('Location: login.php');
            }
        }
    }
}
