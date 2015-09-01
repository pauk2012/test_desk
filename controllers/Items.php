<?php

namespace controllers;

/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 12:03
 */


use classes\Controller;
use classes\F;
use models\Item;

class Items extends Controller {

    public function indexAction()
    {

        $items = Item::find();
        return $this->render('index', ['items'=>$items]);

    }

    public function createAction()
    {
         F::$app->getUser()->accessDenied();
        if (F::$app->getRequest()->getIsPost())
        {
            $item = new Item();
            $item->title = $_POST['title'];
            $item->description = $_POST['description'];
            $item->date_created = time();

            if ($item->save())
               F::$app->getResponse()->redirect(['items/index']);
            else
                return "Item was not added";


        }
       return $this->render('create');
    }


}