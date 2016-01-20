<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" <?php if ($data['count'] > 0) : ?> data-toggle="dropdown" <?php endif ?>>
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning"><?= $data['count'] ?></span>
    </a>
    <?php if ($data['count'] > 0) : ?>
        <ul class="dropdown-menu">
            <li class="header"><?= $data['countText'] ?></li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <?php foreach ($data['posts'] as $post): ?>
                        <li>
                            <a href="<?= \yii\helpers\Url::to('/post/view/' . $post->id) ?>">
                                <i class="fa fa-file-text text-aqua"></i>
                                <?= $post->tittle ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>
            <li class="footer">
                <a href="<?= \yii\helpers\Url::to('/post') ?>"><?= Yii::t('app', 'посмотреть все посты') ?></a>
            </li>
        </ul>
    <?php endif; ?>
</li>
