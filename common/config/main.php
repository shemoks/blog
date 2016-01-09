<?php
use common\models\AuthItem;

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
            'defaultRoles' => [
                AuthItem::ROLE_USER
            ],
        ],
    ],
];
