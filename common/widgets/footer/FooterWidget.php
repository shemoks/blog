<?php
namespace common\widgets\footer;

use yii\bootstrap\Widget;

class FooterWidget extends Widget
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub

        echo $this->render('layout');
    }
}