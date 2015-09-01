<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 14:38
 */

namespace classes;


class Db  extends \PDO{

    public $dsn;
    public $username;
    public $password;

    public function __construct($dsn, $username, $passwd, $options=[])
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $passwd;

        parent::__construct($dsn,$username,$passwd, $options);
        $this->setAttribute(self::ATTR_ERRMODE, self::ERRMODE_EXCEPTION);

    }
}