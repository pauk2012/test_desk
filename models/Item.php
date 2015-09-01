<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:26
 */

namespace models;


use classes\F;
use classes\Model;

class Item extends Model
{
    public $title;
    public $description;
    public $date_created;
    public $owner;

    public static function find()
    {
        $sql = 'SELECT * FROM ' . self::tableName();
        return F::$app->db->query($sql);
    }

    public static function tableName()
    {
        return 'items';
    }

    public function save()
    {

        $sql = 'INSERT  INTO ' . $this->tableName() . ' (`title`, `description`, `date_created`, `owner`) VALUES (:title, :description, :date_created, :owner)';
        $db = F::$app->db;
        $dbh = $db->prepare($sql);
        $dbh->bindParam(':title',$this->title);
        $dbh->bindParam(':description', $this->description);
        $dbh->bindParam(':date_created', $this->date_created);
        $dbh->bindParam(':owner', F::$app->getUser()->identity->id);
        echo $dbh->queryString;
        return $dbh->execute();




    }

}