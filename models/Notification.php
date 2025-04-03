<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int $user_id
 * @property int $device_user_id
 * @property string $message
 * @property string|null $created_at
 * @property int|null $is_read
 *
 * @property DeviceUser $deviceUser
 * @property User $user
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'device_user_id', 'message'], 'required'],
            [['user_id', 'device_user_id', 'is_read'], 'integer'],
            [['created_at'], 'safe'],
            [['message'], 'string', 'max' => 255],
            [['device_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceUser::class, 'targetAttribute' => ['device_user_id' => 'id']],
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
            'device_user_id' => Yii::t('app', 'Device User ID'),
            'message' => Yii::t('app', 'Message'),
            'created_at' => Yii::t('app', 'Created At'),
            'is_read' => Yii::t('app', 'Is Read'),
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
