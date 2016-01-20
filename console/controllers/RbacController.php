<?php
namespace console\controllers;

use common\components\rbac\UserRoleRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit($id = null)
    {
        $role = Yii::$app->authManager;
        $role->removeAll(); //удаляем старые данные
        $groupRule = new UserRoleRule();
        $role->add($groupRule);

        $admin = Yii::$app->authManager->createRole('admin');
        $admin->description = 'Admin';
        $admin->ruleName = $groupRule->name;
        $role->add($admin);

        $moder = Yii::$app->authManager->createRole('moder');
        $moder->description = 'Moderator';
        $moder->ruleName = $groupRule->name;
        $role->add($moder);
        $role->addChild($admin, $moder);

        $blogger = Yii::$app->authManager->createRole('blogger');
        $blogger->description = 'Blogger';
        $blogger->ruleName = $groupRule->name;
        $role->add($blogger);
        $role->addChild($moder, $blogger);

        $user = Yii::$app->authManager->createRole('user');
        $user->description = 'User';
        $user->ruleName = $groupRule->name;
        $role->add($user);
        $role->addChild($blogger, $user);

        if ($id !== null) {
            $role->assign($admin, $id);
        }
    }
}