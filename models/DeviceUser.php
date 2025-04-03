<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $device_id
 * @property int|null $is_click
 * @property string|null $click_time
 * @property string|null $time_on
 * @property string|null $time_off
 * @property int|null $status
 * @property string|null $read_at
 *
 * @property Device $device
 * @property Notification[] $notifications
 * @property User $user
 */
class DeviceUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'device_id'], 'required'],
            [['user_id', 'device_id', 'is_click', 'status'], 'integer'],
            [['click_time', 'time_on', 'time_off', 'read_at'], 'safe'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::class, 'targetAttribute' => ['device_id' => 'id']],
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
            'user_id' => Yii::t('app', 'Пользователь'),
            'device_id' => Yii::t('app', 'Устройство'),
            'is_click' => Yii::t('app', 'Вкл/выкл'),
            'click_time' => Yii::t('app', 'Время включения'),
            'time_on' => Yii::t('app', 'Время включения'),
            'time_off' => Yii::t('app', 'Время отключения'),
            'status' => Yii::t('app', 'Статус'),
            'read_at' => Yii::t('app', 'Прочитано'),
        ];
    }

    /**
     * Gets query for [[Device]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::class, ['id' => 'device_id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::class, ['device_user_id' => 'id']);
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

    public function getGroupDeviceUsers()
    {
        return $this->hasMany(GroupDeviceUser::class, ['device_user_id' => 'id']);
    }

}
