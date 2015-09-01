<?php

namespace classes;

/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:18
 */


class Controller {

    private $_view;

    public function render($view, $params=[])
    {
        $content = $this->getView()->render($view, $params, $this);
        return $this->renderContent($content);
    }

    public function renderContent($content)
    {
        $layoutFile = $this->findLayoutFile($this->getView());
        if ($layoutFile !== false) {
            return $this->getView()->renderFile($layoutFile, ['content' => $content], $this);
        } else {
            return $content;
        }
    }

    public function renderFile($file, $params = [])
    {
        return $this->getView()->renderFile($file, $params, $this);
    }


    public function findLayoutFile($view)
    {
        return F::$baseDir . '/' . 'views' . '/' . 'layouts' . '/' . 'main.php';
    }

    public function runAction($action, $params)
    {
        $action = strtolower($action) . 'Action';
//        $this->_accessControlFilter($action);
       return $this->$action($params);
    }

    private function _accessControlFilter($action)
    {
        if ($this->_accessRules['$action'] === 'loginRequired')
        {
         //   F::$app->user->loginRequired
        }
    }

    /**
     * @var \classes\View the view instance
     */
    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = F::$app->getView();
        }
        return $this->_view;
    }

    public function setView($view)
    {
        $this->_view = $view;
    }
}