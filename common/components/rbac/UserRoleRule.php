<?php
namespace common\components\rbac;
use common\models\AuthItem;
use Yii;
use yii\rbac\Rule;
class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
            if ($item->name === 'admin') {
                return $role == AuthItem::ROLE_ADMIN;
            } elseif ($item->name === 'moder') {
                //moder является потомком admin, который получает его права
                return $role == AuthItem::ROLE_ADMIN || $role == AuthItem::ROLE_MODER;
            } elseif ($item->name === 'blogger') {
                return $role == AuthItem::ROLE_ADMIN || $role == AuthItem::ROLE_MODER
                || $role == AuthItem::ROLE_BLOGGER;
            } elseif ($item->name === 'user') {
                return $role == AuthItem::ROLE_ADMIN || $role == AuthItem::ROLE_MODER
                || $role == AuthItem::ROLE_BLOGGER || $role == AuthItem::ROLE_USER;
            }
        }
        return false;
    }
}
