<?php
/** @var \common\models\Post $model */
//$model
use common\models\AuthItem;
use common\models\Post;
use common\widgets\similar\SimilarWidget;
use common\widgets\social\SocialWidget;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = $model->tittle;
?>
<div class="widget Blog">
    <div class="post-outer">
        <div class="post hentry">

            <h1 class="post-title entry-title">
                <?= $model->tittle?>
            </h1>

            <div class="post-header">
                <div class="post-header-line-1"></div>
                <span class="post-author vcard"><i class="fa fa-user"></i>
                    <span class="fn">
                    <?= $model->user->username?>
                    </span>
                </span>

                <span class="post-timestamp">
                <i class="fa fa-clock-o"></i>
                    <abbr class="published" title="<?= date('Y:m:d H-i-s',$model->created_at)?>">
                        <?php echo date('d F Y H:i',$model->created_at);?>
                    </abbr>
                </span>

                <span class="post-labels"> <i class="fa fa-tags"></i>
                    <?php foreach($model->category as $category) :
                        $categoryIds[] = $category->id;
                        ?>
                <a href="/site/category/<?=$category->id?>" rel="tag">
                    <?=$category->tittle?>
                </a>
                    <?php endforeach;?>
                </span>

                <span class="post-comment-link">
                <a class="comment-link" href="#comment-form">
                    <?= count($model->comments) .' '. Yii::t('app','Комментариев')?>
                </a>
                </span>
            </div>
<!--========================================================================================-->
            <div class="separator" style="clear: both; text-align: center;">
                <a href="#">
                    <img border="0" src="<?= Post::$photoLink . $model->main_photo?>" height="210" width="320">
                </a>
            </div>

            <div dir="ltr" style="text-align: left;">
                    <?= $model->content;?>
            </div>

            <?= SocialWidget::widget()?>

            <?php
            $categoryId = isset($categoryIds) ? $categoryIds : [];
            echo SimilarWidget::widget([
                'categoryId'=>$categoryId
                ])?>



            <div class="clear"></div>

            <div class="post-footer">
                <div class="post-footer-line post-footer-line-1">
                    <span class="post-icons">
                        <span class="item-control blog-admin pid-45177008">
                            <a href="#" title="Edit Post">
                                <img alt="" class="icon-action" height="18" src="http://img2.blogblog.com/img/icon18_edit_allbkg.gif" width="18">
                            </a>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>

<!--=======================================================================================-->

    <div class="comments" id="comments">
        <a name="comments"></a>
        <h4> <?= count($model->comments) .' '. Yii::t('app','Комментариев')?> </h4>

        <div class="comments-content">
            <div id="comment-holder">
                <div>
                    <div>
                        <div class="comment-thread">
                            <ol>
                                <li id="bc_0_6B" class="comment" >
                                    <div class="avatar-image-container">
                                        <img src="#">
                                    </div>
                                    <?php
                                    foreach($model->comments as $comment) :?>
                                    <div class="comment-block">
                                        <div  class="comment-header">
                                            <cite class="user">
                                                <a rel="nofollow" href="#">
                                                    <?=$comment->user->username?>
                                                </a>
                                            </cite>
                                            <span class="icon user"></span>
                                            <span class="datetime secondary-text">
                                                <a rel="nofollow" href="#">
                                                    <?php echo date('d F Y H:i',$comment->created_at);?>
                                                </a>
                                            </span>
                                        </div>
                                            <p class="comment-content">
                                                <?=$comment->text?>
                                            </p>
                                    </div>
                                    <?php ?>

                                    <div class="comment-replybox-single"></div>
                                </li>
                            </ol>

                            <div class="loadmore loaded">
                                <a href="#" >Load more...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="send-comment">
        <?php
        if(!Yii::$app->user->isGuest ){
            $modelComment = new \common\models\Comment();
            $form = ActiveForm::begin([
                'id'                   => 'comment',
                'options'              => ['class' => 'form-horizontal'],
            ]);

            $form->field($modelComment, 'text')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]);
            $form->field($modelComment, 'post_id')->hiddenInput(['value'=>$model->id])->label(false);
            $form->field($modelComment, 'user_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false);

            Html::submitButton('Отправиьь', ['class' => 'btn btn-success']);
            ActiveForm::end();
        }
        ?>
</div>

</div>
