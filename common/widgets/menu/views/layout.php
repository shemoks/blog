<nav class='navbar navbar-default main-top-nav' role='navigation'>
    <div class='container'>
        <div class='navbar-header'>
            <a class='navbar-brand' href='/'><i class='fa fa-home'></i></a>

            <button class='navbar-toggle' data-target='#bs-example-navbar-collapse-1' data-toggle='collapse' type='button'>
                <span class='sr-only'>Toggle navigation</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
            <ul class='nav navbar-nav'>
                <?php
                foreach ($menuItems as $item) {
                    $url = isset($item['link']) ? $item['link'] : '#';
                    $linkOptions = '';
                    if(isset($item['linkOptions'])){
                        foreach($item['linkOptions'] as $key=>$options) {
                            $linkOptions .= $key . '="' . $options .'" ';
                        }
                    }
                    $isDropdown = !isset($item['link'])
                    ?>
                    <li <?php echo $isDropdown ? 'class="dropdown"' : '' ?>>
                        <a href="<?= $url ?>" <?= $linkOptions ?>>
                            <?= $item['text'] ?>
                            <?php echo $isDropdown ? '<b class="caret"></b>' : '' ?>
                        </a>
                        <?php if ($isDropdown) { ?>
                            <ul class="dropdown-menu">
                                <?php foreach ($item['subMenuData'] as $subMenuItems) { ?>
                                    <li>
                                        <a href="<?= $subMenuItems['link'] ?>"  <?= $linkOptions ?>>
                                            <?= $subMenuItems['text'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
            <!--форма пошуку - поки що скрию -->
            <!--<form action='/search' class='navbar-form navbar-right' method='get' role='search'>
                <div class='form-group'>
                    <input class='form-control form-main-search' name='q' placeholder='Search' type='text'/>
                </div>
                <button class='btn btn-def' type='submit'>
                    Submit
                </button>
            </form>-->
            <ul class='nav nav-pills navbar-right'>
                <li>
                    <a href='https://www.facebook.com/'>
                        <i class='fa fa-facebook'>
                        </i>
                    </a>
                </li>
                <li>
                    <a href='https://twitter.com/'>
                        <i class='fa fa-twitter'>
                        </i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>