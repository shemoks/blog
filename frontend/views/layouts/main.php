<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\AuthItem;
use common\widgets\Alert;
use common\widgets\footer\FooterWidget;
use common\widgets\menu\MenuWidget;
use common\widgets\rightColumn\RightColumn;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php


if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->role == AuthItem::ROLE_BLOGGER) {
        $menuItems[] = [
            'text'        => Yii::t('app', 'Управление'),
            'subMenuData' => [
                [
                    'link' => Url::to(['#']),
                    'text' => Yii::t('app', 'Мои посты'),
                ],
                [
                    'link' => Url::to(['#']),
                    'text' => Yii::t('app', 'Коментарии к постам'),
                ],
                [
                    'link' => Url::to(['#']),
                    'text' => Yii::t('app', 'Написать пост'),
                ],
            ],
        ];
    }
    $menuItems[] = [
        'link' => Url::to(['/site/logout']),
        'text' => Yii::t('app', 'Выход'),
        'linkOptions' => ['data-method' => 'post', 'clas'=>'test']
//                            кей           опшинс    кей     опшинс
    ];
} elseif (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'link' => Url::to(['/site/login']),
            'text' => Yii::t('app', 'Вход'),
        ];
        $menuItems[] = [
            'link' => Url::to(['/site/signup']),
            'text' => Yii::t('app', 'Регистрация'),
        ];
    }
echo MenuWidget::widget([
    'menuItems' => $menuItems
]) ?>
<div class='clearfix'></div>
<header id='main-header-wrapper'>
    <div class='container container-slash'>
        <div id='header-wrapper'>
            <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 head-col'>
                <div class='section' id='blog-title'>
                    <div class='widget Header' id='Header1'>
                        <div id='header-inner'>
                            <div class='titlewrapper'>
                                <h1 class='h-title'>
                                    <?=Yii::$app->name?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6' id='top-ad'>
                <div class='top-ad section' id='top-ad'>
                </div>
            </div>
        </div>
    </div>
</header>

<div class='clearfix'></div>
<div class="container">
    <?php /*echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) */?>
    <?php /*echo Alert::widget() */?>
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
                <div class='main section' id='main'>
                    <div class='widget Blog'>
    <?= $content ?>
                        <div class='clear'></div>
                        <!--КНОПКИ  ПЕРЕДЕЛАТЬ ПОТОМ-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="blog-pager" id="blog-pager">
                                    <div class="blogger-pager"><span class="blog-pager-p">1</span>
                                        <span class="blog-pager-element"><a href="#">2</a></span>
                                        <span class="blog-pager-element"><a href="#">3</a></span>
                                        <span class="blog-pager-element"> <a href="#">Next</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!--КНОПКИ-->
                        <div class='clear'></div>
                    </div>
                </div>
            </div>
            <?= RightColumn::widget()?>
</div>

<?/*= FooterWidget::widget()*/?>

<div id='footer'>
    <p class='footer-link'>
        &#169;
        <a href='#'>
            <strong>
                Standard
            </strong>
        </a>
        <?=date('Y')?> Powered by
        <a href='https://github.com/shemoks' title='Shemoks'>
           Shemoks
        </a>
        .
    </p>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
