<?php
use yii\bootstrap\Html;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs"><?= Yii::$app->user->identity->username?></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <p>
                <?= Yii::$app->user->identity->username?>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <?= Html::a(
                    'Sign out',
                    ['/site/logout'],
                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                ) ?>
            </div>
        </li>
    </ul>
</li>