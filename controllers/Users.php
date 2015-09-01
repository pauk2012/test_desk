<?php

namespace controllers;
use classes\Controller;
use classes\F;
use models\LoginForm;
use models\User;

/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:05
 */

class Users extends Controller{


    public function loginAction()
    {
        if (F::$app->getRequest()->getIsPost())
        {
            $loginForm = new LoginForm();
            $loginForm->username = $_POST['username'];
            $loginForm->password = $_POST['password'];
            $userIdentity  = $loginForm->login();
            if ( $userIdentity instanceof User)
            {
                if (F::$app->getUser()->login($userIdentity)){
                    $returnUrl = F::$app->getUser()->getReturnUrl();
                    F::$app->getResponse()->redirect($returnUrl);
                };

            };






        }
     return   $this->render('login');
    }

    public function logoutAction()
    {
        F::$app->getUser()->logout();
        F::$app->getResponse()->redirect(['items/index']);

    }

    public function registerAction()
    {
        if (F::$app->getRequest()->getIsPost())
        {
            $item = new User();
            $item->username = $_POST['username'];
            $item->password = $_POST['password'];
            $item->repassword = $_POST['repassword'];

            $item->date_created = time();

            if ($item->save())
                return "User was registered";
            else
                return "User was not registered";


        }

        return   $this->render('register');
    }

    public function profileAction()
    {
        $user = User::findByUserName(F::$app->getUser()->getId());
        return $this->render('profile', ['user' => $user]);
    }


}