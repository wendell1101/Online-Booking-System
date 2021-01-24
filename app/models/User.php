<?php

class User extends Connection
{
    public $user;

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
    //I can't reassign $this->user for some reason so I've made an alternative
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
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $_SESSION['id']]);
        $user = $stmt->fetch();
        return $user;
    }
}
