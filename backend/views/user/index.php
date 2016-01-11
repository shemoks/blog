<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    if (Yii::$app->user->can('admin')) {
        $template = '{view} {update} {delete}';
    } else {
        $template = '{view}{update}';
    }
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            [
                'attribute' => 'status',
                'format'    => 'text',
                'value'     => function ($model) {
                    return \common\models\User::getStatuses()[$model->status];
                },
            ],
            'role',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => $template
            ],
        ],
    ]); ?>

</div>
