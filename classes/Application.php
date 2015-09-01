<?php

namespace classes;
use models\User;

/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:17
 */


class Application
{
    /**
     * @var \classes\Db the databasePdo instance
     */
    public $db;
    private $_request;
    private $_response;
    private $_user;

    private static $_view;

    public function __construct()
    {
        F::$app = $this;
        F::$app->setView(new View());


    }

    public function run($config)
    {
        $this->db = new \classes\Db($config['db']['dsn'], $config['db']['username'], $config['db']['password']);

        session_start();
        $this->createUserObject($config);
        $response =  $this->handleRequest($this->getRequest());

        $response->send();


    }

    public function createUserObject($config)
    {
        $this->_user = new \classes\User($config);
        if (isset($_SESSION['__identityId'])){
            $user = User::findByUserName($_SESSION['__identityId']);
            $this->_user->identity = $user;
        }



    }

    public function handleRequest($request)
    {

        list($route, $params) = $request->resolve();
        $response = $this->getResponse();

        $response->data =  $this->runAction($route, $params);

        return $response;
    }
    public function runAction($route, $params)
    {
        list($controller,$action) = F::createController($route);
        return $controller->runAction($action, $params);

    }



    /**
     * @var \classes\View the view instance
     */

    public function getView()
    {
       return $this->_view;
    }

    public function setView($view)
    {
        $this->_view = $view;
    }

    public function getRequest()
    {
        if (isset($this->_request)){
            return $this->_request;
        }

        $this->_request = new Request();

        return $this->_request;

    }

    public function getResponse()
    {
        if (isset($this->_response)){
            return $this->_response;
        }

        $this->_response = new Response();

        return $this->_response;

    }
    /**
     * @var \classes\User the web user instance
     */

    public function getUser()
    {

        return $this->_user;
    }
}