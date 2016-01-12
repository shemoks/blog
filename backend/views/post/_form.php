<?php

use common\models\Category;
use common\models\CategoryPost;
use common\models\Post;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelCategory array */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tittle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')
        ->dropDownList(ArrayHelper::map((new User())->getUserList()->asArray()->all(),'id','username')) ?>
    <?=
    $form->field($model, 'category_id')
        ->widget(Select2::classname(), [
            'data' => $modelCategory,
            'options' => ['placeholder' => 'Select a category'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
            ],
        ])->label('category');
    ?>

    <?= $form->field($model, 'main_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
