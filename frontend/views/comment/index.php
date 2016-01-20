<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'format'    => 'text',
                'value'     => function ($model) {
                    return $model->user->username;
                },
            ],
            [
                'attribute' => 'post_id',
                'format'    => 'text',
                'value'     => function ($model) {
                    return $model->post_id;
                },
            ],
            'status',
            'text:ntext',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {create}'
            ],
        ],
    ]); ?>

</div>
