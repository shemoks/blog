<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $tittle
 * @property string $content
 * @property integer $user_id
 * @property string $main_photo
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 * @property CategoryPost[] $categoryPost
 * @property Comment[] $comments
 * @property User $user
 * @property mixed category
 */
class Post extends \yii\db\ActiveRecord
{
    public $category_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tittle', 'content'], 'required'],
            [['content'], 'string'],
            [['user_id', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['tittle', 'main_photo', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
            ['category_id','safe']
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
            'content' => Yii::t('app', 'Content'),
            'user_id' => Yii::t('app', 'User ID'),
            'main_photo' => Yii::t('app', 'Main Photo'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'status' => Yii::t('app', 'Status'),
            'category_id' => Yii::t('app', 'Category id'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('category_post',['post_id' => 'id']);
    }
    public function getCategoryPost()
    {
        return $this->hasMany(CategoryPost::className(), ['post_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getNewPosts()
    {
        return $this->find()->where($this->tableName() . '.`status` IS NULL')->joinWith('user')->all();

    }
}