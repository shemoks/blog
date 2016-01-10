<?php
use yii\db\Schema;
use yii\db\Migration;

class m160110_213117_post extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%post}}', [
            'id'               => $this->primaryKey(),
            'tittle'           => $this->string()->notNull(),
            'content'          => $this->string(),
            'main_photo'       => $this->string(),
            'meta_description' => $this->string(),
            'meta_keywords'    => $this->string(),
            'status'           => Schema::TYPE_SMALLINT . ' DEFAULT NULL',
            'created_at'       => $this->integer(),
            'updated_at'       => $this->integer(),
            'deleted_at'       => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}

