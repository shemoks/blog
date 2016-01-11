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
            'content'          => $this->text()->notNull(),
            'user_id'          => $this->integer(),
            'main_photo'       => $this->string(),
            'meta_description' => $this->string(),
            'meta_keywords'    => $this->string(),
            'status'           => $this->smallInteger(),
            'created_at'       => $this->integer(),
            'updated_at'       => $this->integer(),
            'deleted_at'       => $this->integer(),
        ], $tableOptions);
        $this->createIndex('idx_post_user_id', '{{%post}}', 'user_id');
        $this->addForeignKey('fk_post_user_id', '{{%post}}', 'user_id', '{{%user}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}

