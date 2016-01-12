<?php

use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $modelCategory common\models\CategoryPost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Post',
]) . ' ' . $model->tittle;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="post-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelCategory' => ArrayHelper::map(Category::find()->all(),'id','tittle')
    ]) ?>

</div>
