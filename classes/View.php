<?php

namespace classes;

/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:17
 */

class View  {

    private $_viewFiles;
    public $context;
    public function renderFile($file, $params = [], $context = null)
    {
        $oldContext = $this->context;
        if ($context !== null) {
            $this->context = $context;
        }
        $this->_viewFiles[] = $file;
        $output =  $this->renderPhpFile($file, $params);
        array_pop($this->_viewFiles);
        $this->context = $oldContext;

        return $output;

    }

    public function renderPhpFile($_file_, $_params_ = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        require($_file_);

        return ob_get_clean();
    }

    public function render($view, $params = [], $context = null)
    {
        $viewFile = $this->findViewFile($view, $context);
        return $this->renderFile($viewFile, $params, $context);
    }

    public function findViewFile($view, $context = null)
    {
        if ($context) {
            $reflection = new \ReflectionClass($context);
            $viewFile = F::$baseDir . '/' . 'views' . '/' . strtolower($reflection->getShortName()) . '/' . $view . '.php';

        } elseif (($currentViewFile = $this->getViewFile()) !== false) {
            $viewFile = dirname($currentViewFile) . DIRECTORY_SEPARATOR . $view . '.php';
        }

        return $viewFile;

    }


    public function getViewFile()
    {
        return end($this->_viewFiles);
    }



}