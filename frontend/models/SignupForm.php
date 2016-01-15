<?php
namespace frontend\models;

use common\models\AuthItem;
use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $needToBlog = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['needToBlog','safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'needToBlog' => Yii::t('app', 'Хочу писать посты'),
            'username'   => Yii::t('app', 'Имя'),
            'email'      => Yii::t('app', 'email'),
            'password'   => Yii::t('app', 'Пароль'),
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if($this->needToBlog) {
                $user->role = AuthItem::ROLE_BLOGGER;
            }
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
