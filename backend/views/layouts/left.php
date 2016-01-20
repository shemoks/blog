<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items'   => [
                    ['label' => 'Блог', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Категории',
                        'icon'  => 'fa fa-code-fork',
                        'url'   => '/category',
                    ], [
                        'label' => 'Коментарии',
                        'icon'  => 'fa fa-comments',
                        'url'   => '/comment',
                    ], [
                        'label' => 'Посты',
                        'icon'  => 'fa fa-file-text',
                        'url'   => '/post',
                    ], [
                        'label' => 'Пользователи',
                        'icon'  => 'fa fa-user',
                        'url'   => '/user',
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
