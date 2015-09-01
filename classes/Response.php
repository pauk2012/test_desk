<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 19:09
 */

namespace classes;


use helpers\Url;

class Response {


    public $data;
    public function send()
    {
        echo $this->data;
    }

    public function redirect($url)
    {
        $url = Url::to($url);
        header('Location: ' .$url);
    }
}