<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_device_user".
 *
 * @property int $id
 * @property int|null $device_user_id
 * @property int|null $group_id
 *
 * @property DeviceUser $deviceUser
 * @property Group $group
 */
class GroupDeviceUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_device_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_user_id', 'group_id'], 'integer'],
            [['device_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceUser::class, 'targetAttribute' => ['device_user_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'device_user_id' => Yii::t('app', 'Device User ID'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * Gets query for [[DeviceUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceUser()
    {
        return $this->hasOne(DeviceUser::class, ['id' => 'device_user_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }
}
