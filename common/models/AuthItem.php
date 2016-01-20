<?php
namespace common\models;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property User[] $users
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 */
class AuthItem extends ActiveRecord
{
    const ROLE_USER = 'user';
    const ROLE_MODER = 'moder';
    const ROLE_ADMIN = 'admin';
    const ROLE_BLOGGER = 'blogger';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'        => 'Name',
            'type'        => 'Type',
            'description' => 'Description',
            'rule_name'   => 'Rule Name',
            'data'        => 'Data',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('auth_assignment', ['item_name' => 'name']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }
    /**
     * Возвращает список ролей
     *
     * @param bool $withoutAdmin - добавить роль админа в список или нет (по умолчанию - нет)
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRoles($withoutAdmin = true)
    {
        $query = self::find();
        if ($withoutAdmin) {
            $query->where(
                'name != :name',
                ['name' => self::ROLE_ADMIN]
            );
        }
        return $query->all();
    }
    /**
     * Возвращает список ролей для выпадающего списка без роли админа
     * @return array
     */
    public static function getRolesForDropDown()
    {
        return ArrayHelper::map(self::getRoles(), 'name', 'description');
    }
}