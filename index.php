<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 11:52
 */

require(__DIR__ . '/classes/F.php');

$app = new \classes\Application();

$config = require(__DIR__ . '/config/main.php');
$app->run($config);