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
            header('Location: ../login.php');
            exit();
        } else {
            $id = $_SESSION['id'];
            $active = 1;
            $sql = "SELECT * FROM users WHERE id=:id AND active=:active";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id, 'active' => $active]);
            if ($stmt->rowCount() === 0) {
                header("location:javascript://history.go(-1)");
            }
        }
    }
}
