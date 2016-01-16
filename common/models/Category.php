<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $tittle
 * @property string $description
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 * @property CategoryPost[] $categoryPosts
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tittle'], 'required'],
            [['status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['tittle', 'description', 'meta_description', 'meta_keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tittle' => Yii::t('app', 'Tittle'),
            'description' => Yii::t('app', 'Description'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('category_post',['category_id' => 'id']);
    }
    public function getCategoryList($isActive = true, $asObject = false)
    {
        $users = $this->find();
        if ($isActive) {
            $users->where(['status' => self::STATUS_ACTIVE]);
        }
        if ($asObject) {
            $users = $users->all();
        }

        return $users;
    }
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE  => 'Активный',
            self::STATUS_DELETED => 'Не активный',
        ];
    }
}
