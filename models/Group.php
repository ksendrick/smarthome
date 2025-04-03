<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property int|null $group_img_id
 *
 * @property GroupDeviceUser[] $groupDeviceUsers
 * @property GroupImg $groupImg
 * @property User $user
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'group_img_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['group_img_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupImg::class, 'targetAttribute' => ['group_img_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'group_img_id' => Yii::t('app', 'Group Img ID'),
        ];
    }

    /**
     * Gets query for [[GroupDeviceUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupDeviceUsers()
    {
        return $this->hasMany(GroupDeviceUser::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[GroupImg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupImg()
    {
        return $this->hasOne(GroupImg::class, ['id' => 'group_img_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
