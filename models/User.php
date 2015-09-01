<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:45
 */

namespace models;


use classes\Db;
use classes\F;

class User {

    public $id;
    public $username;
    public $password;
    public $date_created;
    public static function tableName()
    {
        return 'users';
    }

    public function save()
    {

        $sql = 'INSERT  INTO ' . $this->tableName() . ' (`username`, `password`, `date_created`) VALUES (:username, :password, :date_created)';
        $db = F::$app->db;
        $dbh = $db->prepare($sql);
        $dbh->bindParam(':username',$this->username);
        $dbh->bindParam(':password', $this->password);
        $dbh->bindParam(':date_created', $this->date_created);
        echo $dbh->queryString;
        return $dbh->execute();

    }

    public static function findByUserName($userName)
    {
        $sql = 'SELECT * FROM ' . self::tableName() . ' WHERE username=:username';
        $query = F::$app->db->prepare($sql);
        $query->bindParam(':username', $userName);
        $query->execute();
        $userObj =  $query->fetch(Db::FETCH_OBJ);

        if ($userObj) {
            $user = new User();
            $user->id = $userObj->id;
            $user->username = $userObj->username;
            $user->password = $userObj->password;
            $user->date_created = $userObj->date_created;
        } else {
            $user = false;
        }
        return $user;

    }

    public static function findUserById($id)
    {
        $sql = 'SELECT * FROM ' . self::tableName() . ' WHERE id=:id';
        $query = F::$app->db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        $userObj =  $query->fetch(Db::FETCH_OBJ);

        if ($userObj) {
            $user = new User();
            $user->id = $userObj->id;
            $user->username = $userObj->username;
            $user->password = $userObj->password;
            $user->date_created = $userObj->date_created;
        } else {
            $user = false;
        }
        return $user;

    }

}

