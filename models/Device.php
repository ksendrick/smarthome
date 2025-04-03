<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property int|null $other
 * @property int|null $user_id
 * @property string $name
 * @property string|null $img
 * @property int $type_id
 * @property int|null $scenario_id
 *
 * @property DeviceUser[] $deviceUsers
 * @property Scenario $scenario0
 * @property Type $type
 * @property User $user
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['other', 'user_id', 'type_id', 'scenario_id'], 'integer'],
            [['name', 'type_id'], 'required'],
            [['name', 'img'], 'string', 'max' => 256],
            [['scenario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scenario::class, 'targetAttribute' => ['scenario_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'other' => Yii::t('app', 'Другое'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'name' => Yii::t('app', 'Название'),
            'img' => Yii::t('app', 'Фото'),
            'type_id' => Yii::t('app', 'Тип устройства'),
            'scenario_id' => Yii::t('app', 'Сценарий'),
            'checkBox' => Yii::t('app', 'Изменить'),
        ];
    }
    /**
     * Gets query for [[DeviceUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceUsers()
    {
        return $this->hasMany(DeviceUser::class, ['device_id' => 'id']);
    }

    /**
     * Gets query for [[Scenario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScenario0()
    {
        return $this->hasOne(Scenario::class, ['id' => 'scenario_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
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
