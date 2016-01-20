<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" <?php if ($data['count'] > 0) : ?> data-toggle="dropdown" <?php endif ?>>
        <i class="fa fa-envelope-o"></i>
        <span class="label label-success"><?= $data['count'] ?></span>
    </a>
    <?php if ($data['count'] > 0) : ?>
        <ul class="dropdown-menu">
            <li class="header"><?= $data['countText'] ?></li>
            <li>
                <ul class="menu">
                    <?php foreach ($data['comments'] as $comment): ?>
                        <li><!-- start message -->
                            <a href="<?= \yii\helpers\Url::to('/comment/view/' . $comment->id) ?>">
                                <div class="pull-left">
                                    <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                         alt="User Image"/>
                                </div>
                                <h4><?= $comment->user->username ?></h4>
                                <p><?= $comment->text ?></p>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <!-- end message -->
                </ul>
            </li>
            <li class="footer"><a href="<?= \yii\helpers\Url::to('/comment') ?>"><?= Yii::t('app', 'посмотреть все коментарии') ?></a></li>
        </ul>
    <?php endif; ?>
</li>
