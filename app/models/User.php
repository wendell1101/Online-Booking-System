<?php

class User
{
    public $user;
    public static function Auth()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }else{
            return false;
        }
    }
    //I can't reassign $this->user for some reason so I've made an alternative
    public static function getFullName(){
        if(self::Auth()){
            $user = $_SESSION['user'];
            return ucwords($user->firstname) . ' ' . ucwords($user->lastname);
        }else{
            return 'Guess';
        }
    }
}
