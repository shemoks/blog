<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4 hide-home-sidebar'>
    <div class='sidebox'>
        <div class='sidebar section' id='sidebar'>

            <div class='widget Label' id='Label1'>
                <h2>
                    Labels
                </h2>

                <div class='widget-content list-label-widget-content'>
                    <ul>
                        <!--ПОВТОР-->
                        <?php
                        foreach($categories as $category) {
                        ?>
                        <li>
                            <a dir='ltr' href='/site/category/<?=$category->id?>'>
                                <?=$category->tittle?>
                            </a>
                        </li>
                        <?php
                        } ?>
                        <!--ПОВТОР-->
                    </ul>

                    <div class='clear'></div>
                </div>
            </div>

        </div>
    </div>
</div>