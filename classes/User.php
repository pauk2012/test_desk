<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 18:20
 */

namespace classes;


class User {

    public $loginUrl;
    public $identity;
    public $returnUrlParam = '__returnUrl';

    public function accessDenied()
    {
        if (F::$app->getUser()->getIsGuest()){
            $this->loginRequired();
        }
    }
    public function loginRequired()
    {
        $_SESSION[$this->returnUrlParam] = F::$app->getRequest()->getUrl();
        F::$app->getResponse()->redirect(F::$app->getUser()->loginUrl);
    }

    public function getReturnUrl()
    {
        return $_SESSION[$this->returnUrlParam];
    }

    public function __construct($config)
    {
        $this->loginUrl = $config['user']['loginUrl'];
    }
    public function getIsGuest()
    {
        return $this->identity === null;
    }
    public function login($identity)
    {

        $this->identity = $identity;
        $_SESSION['__identityId'] = $this->getId();
        return $this->getIsGuest()==false;
    }

    public function logout()
    {
        $this->identity = null;
        unset($_SESSION['__identityId']);
    }

    public function getId()
    {
        if ($this->identity)
           return $this->identity->username;
    }


}