<div id='list-main'>
    <?php
    use common\models\Post;
    use yii\helpers\Url;
    use yii\widgets\LinkPager;

    foreach ($model as $data) {
        ?>
        <div class='post-div'>
            <h2 class='jqmaintitle'>
                <a href="/site/view/<?=$data->id?>">
                <?= $data->tittle; ?>
                </a>
            </h2>
         <div class='post-header-home'>
                                <span class='post-author vcard'>
                                <i class='fa fa-user'></i>
                                <span class='fn'>
                                <?= $data->user->username;?>
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
                        <a href="/site/view/<?=$data->id?>">
                        <p>
                            <?= $data->content; ?><br/>
                        </p>
                        </a>
                    </div>
                    <div class='s-clear'>
                    </div>
                    <div class='rmlink'>
                        <a href='/site/view/<?=$data->id?>'>
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
                    <?php
                    if (isset($data->category)) {
                        foreach ($data->category as $category) {
                            ?>
                            <a href='#' rel='tag'>
                                <?=$category->tittle?>
                            </a>
                        <?php
                        }
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php } ?>
</div>

<?php
echo LinkPager::widget([
    'pagination' => $pages,
]);?>
