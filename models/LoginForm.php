<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 21:07
 */

namespace models;


class LoginForm {

    public $username;
    public $password;
    public function login()
    {
        $user = User::findByUserName($this->username);
        if ($user)
            if ($user->password === $this->password)
            {
                return $user;
            }

        return false;
    }
}