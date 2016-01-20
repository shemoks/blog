<?php
use yii\db\Schema;
use yii\db\Migration;

class m160110_214355_comment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%comment}}', [
            'id'         => $this->primaryKey(),
            'post_id'    => $this->integer()->notNull(),
            'status'     => $this->smallInteger(),
            'text'       => $this->text()->notNull(),
            'user_id'    => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->createIndex('idx_comment_post_id', '{{%comment}}', 'post_id');
        $this->createIndex('idx_comment_user_id', '{{%comment}}', 'user_id');
        $this->addForeignKey('fk_comment_post_post_id', '{{%comment}}', 'post_id', '{{%post}}', 'id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_comment_post_user_id', '{{%comment}}', 'user_id', '{{%user}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%comment}}');
    }
}
