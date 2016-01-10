<?php
use yii\db\Schema;
use yii\db\Migration;
class m160110_213528_category_post extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%category_post}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx_category_post_category_id', '{{%category_post}}', 'category_id');
        $this->createIndex('idx_category_post_post_id', '{{%category_post}}', 'post_id');
        $this->addForeignKey('fk_category_post_category_category_id',
            '{{%category_post}}',
            'category_id',
            '{{%category}}',
            'id',
            'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_category_post_post_post_id',
            '{{%category_post}}',
            'post_id',
            '{{%post}}',
            'id',
            'NO ACTION', 'NO ACTION');
    }
    public function down()
    {
        $this->dropTable('{{%category_post}}');
    }
}

