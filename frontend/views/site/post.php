<div id='list-main'>
    <?php
    use common\models\Post;
    use yii\widgets\LinkPager;
    $this->title = 'Posts ' . $model->tittle;
    foreach ($model->categoryPosts as $data) {
        ?>
        <div class='post-div'>
            <h2 class='jqmaintitle'>
                <?= $data->tittle; ?>

            </h2>
            <div class='post-header-home'>
                                <span class='post-author vcard'>
                                <i class='fa fa-user'></i>
                                <span class='fn'>
                                <?= $data->user->username; ?>
                                </span>
                                </span>
            </div>
            <div class='homapge-thumb'>
                <div class='post hentry'>
                    <div class='post-min-content'>
                        <div class="separator">
                            <a href="#">
                                <img border="0"
                                     src="<?= Post::$photoLink . $data->main_photo ?>"/>
                            </a>
                        </div>
                        <p>
                            <?= $data->content; ?><br/>
                        </p>
                    </div>
                    <div class='s-clear'>
                    </div>
                    <div class='rmlink'>
                        <a href='#'>
                            Read More
                        </a>
                    </div>
                    <div class='s-clear'>
                    </div>
                </div>
            </div>
            <div class='post-header-label'>
                <span class='post-timestamp'>
                    <i class='fa fa-clock-o'></i>
                    <abbr class='published' title='2014-03-15T10:00:00-07:00'>
                        <?= strtotime('Y-m-d', $data->created_at); ?>
                    </abbr>
                </span>
                <span class='post-labels'>
                                    <i class='fa fa-tags'></i>
                            <a href='#' rel='tag'>
                                <?=$model->tittle?>
                            </a>
                </span>
            </div>
        </div>
    <?php } ?>
</div>

<?php
echo LinkPager::widget([
    'pagination' => $pages,
]);?>
