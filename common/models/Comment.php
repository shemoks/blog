<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $status
 * @property string $text
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'text'], 'required'],
            [['post_id', 'status', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [
                [
                    'text',
                    'post_id',
                    'user_id'
                ],
                'safe']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'post_id'    => Yii::t('app', 'Post ID'),
            'status'     => Yii::t('app', 'Status'),
            'text'       => Yii::t('app', 'Text'),
            'user_id'    => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getNewComments()
    {
        return $this->find()->where($this->tableName() . '.`status` IS NULL')->joinWith('user')->all();
    }
}
