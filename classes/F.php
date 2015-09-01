<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:54
 */

namespace classes;




class F {

    /**
     * @var \classes\Application the application instance
     */
 public static $app;
 public static $baseDir;
    public function createController($route){
        list($id, $action) = explode('/', $route , 2);
        $controllerClass = "\\controllers\\" . ucfirst($id);
        $controller  = new $controllerClass;
        return [$controller, $action];

    }

}


spl_autoload_register(function ($class) {



    // project-specific namespace prefix
    $prefix = '';

    // base directory for the namespace prefix
    $base_dir = realpath(__DIR__ . '/..') . '/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

F::$baseDir = realpath(__DIR__ . '/..');