<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scenario".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $time_on
 * @property string|null $time_off
 * @property int|null $brightness
 * @property int|null $week_id
 * @property int|null $type_id
 *
 * @property Device[] $devices
 * @property ScenarioUser[] $scenarioUsers
 * @property Type $type
 * @property Week $week
 */
class Scenario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scenario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time_on', 'time_off'], 'safe'],
            [['brightness', 'week_id', 'type_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
            [['week_id'], 'exist', 'skipOnError' => true, 'targetClass' => Week::class, 'targetAttribute' => ['week_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'time_on' => Yii::t('app', 'Время включения'),
            'time_off' => Yii::t('app', 'Время отключения'),
            'brightness' => Yii::t('app', 'Яркость'),
            'week_id' => Yii::t('app', 'Повтор'),
            'type_id' => Yii::t('app', 'Тип устройства'),
        ];
    }

    /**
     * Gets query for [[Devices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::class, ['scenario_id' => 'id']);
    }

    /**
     * Gets query for [[ScenarioUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScenarioUsers()
    {
        return $this->hasMany(ScenarioUser::class, ['scenario_id' => 'id']);
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
     * Gets query for [[Week]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWeek()
    {
        return $this->hasOne(Week::class, ['id' => 'week_id']);
    }
}
