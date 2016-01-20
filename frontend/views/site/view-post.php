
<div class='post-div'>
    <h2 class='jqmaintitle'>
        <?php
        use common\models\Post;
     //  $data = $model->category;
      echo  $model->tittle; ?>

    </h2>
    <div class='post-header-home'>
                                <span class='post-author vcard'>
                                <i class='fa fa-user'></i>
                                <span class='fn'>
                                <?= $model->user->username;?>
                                </span>
                                </span>
    </div>
    <div class='homapge-thumb'>
        <div class='post hentry'>
            <div class='post-min-content'>
                <div class="separator">
                    <a href="#">
                        <img border="0"
                             src="<? echo Post::$photoLink . $model->main_photo ?>"/>
                    </a>
                </div>
                <p>
                    <?php  echo $model->content ;
                    if  (!Yii::$app->user->isGuest) {?>
                    <div class='rmlink'>
                        <a href='/../comment/'<?=$model->id?>'>
                        Просмотреть комментарий
                    </a>
                    </div>
                    <?php }


                    ?><br/>
                </p>
            </div>
            <div class='s-clear'>
            </div>