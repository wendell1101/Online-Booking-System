<?php

class User extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }
    public static function Auth()
    {
        if (isset($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getFullName()
    {
        if (self::Auth()) {
            $user = $this->getUser();
            return ucwords($user->firstname) . ' ' . ucwords($user->lastname);
        } else {
            return 'Guess';
        }
    }

    public function getUser()
    {
        if(self::Auth()){
            $sql = "SELECT * FROM users WHERE id=:id AND active=1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $_SESSION['id']]);
            $user = $stmt->fetch();
            return $user;
        }

    }
}
