<?php
namespace common\widgets\menu;

use yii\bootstrap\Widget;

class MenuWidget extends Widget
{
    public $search = false;

    public $menuItems;


    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        echo $this->render('layout', [
            'menuItems' => $this->menuItems,
        ]);
    }
}