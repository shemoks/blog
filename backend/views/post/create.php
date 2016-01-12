<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $modelCategory common\models\CategoryPost */
$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelCategory' => $modelCategory
    ]) ?>

</div>