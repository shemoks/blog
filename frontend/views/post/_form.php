<?php

use common\models\Category;
use common\models\CategoryPost;
use common\models\Post;
use common\models\User;
use dosamigos\ckeditor\CKEditor;
use dosamigos\fileupload\FileUpload;
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

    <?php $form = ActiveForm::begin([
        'id'                   => 'post',
        //    'enableClientValidation' => false,
        //  'enableAjaxValidation' => true,
        'options'              => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'tittle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    <?=$form->field($model, 'category_id')
        ->widget(Select2::classname(), [
            'data' => $modelCategory,
            'options' => ['placeholder' => 'Select a category'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
            ],
        ])->label('category');
    ?>
    <?= FileUpload::widget([
        'model' => $model,
        'attribute' => 'main_photo',
        'url' => ['/post/upload'], // your url, this is just for demo purposes,
        'options' => ['accept' => 'image/*'],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                var responseData = data.response().result;
                                $(".photo").attr("src","' . Post::$photoLink . '"+responseData.filePath);
                                $("#post-photo").val(responseData.filePath);
                                return false;
                            }',
            'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        ],
    ]);?>
<input type="text" class="form-control input-name" readonly="" value="<?= isset($model->main_photo) ? $model->main_photo : '' ?>">
    <img src="<?= isset($model->main_photo) ? Post::$photoLink . $model->main_photo : '' ?>" alt="" class="photo"/>
</div>
<?php echo Html::activeHiddenInput($model, 'main_photo', [
    'id'    => 'post-photo',
    'value' => $model->main_photo
]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();

    if (!empty($model->main_photo)) { ?>
        <div class="image">
            <img src="/images/<?= $model->main_photo ?>">
        </div>
    <?php }
    ?>

</div>
