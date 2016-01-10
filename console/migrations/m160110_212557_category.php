<?php
use yii\db\Schema;
use yii\db\Migration;
class m160110_212557_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'tittle' => $this->string()->notNull(),
            'description' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keywords' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}