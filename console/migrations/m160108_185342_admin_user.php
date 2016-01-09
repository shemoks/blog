<?php

use yii\db\Schema;
use yii\db\Migration;

class m160108_185342_admin_user extends Migration
{
    public function up()
    {
        $this->insert('user', [
            'email'         => 'shemshur@ukr.net',
            'username'      => 'shemshur',
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'created_at'    => time(),
            'updated_at'    => time(),
        ]);
        return true;
    }

    public function down()
    {
        $this->delete('user', [
            'email' => 'shemshur@ukr.net'
        ]);
        return true;
    }
}
