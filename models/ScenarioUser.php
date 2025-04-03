<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scenario_user".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $scenario_id
 * @property string|null $name
 * @property string|null $time_on
 * @property string|null $time_off
 * @property int|null $brightness
 * @property int|null $week_id
 * @property int|null $type_id
 *
 * @property Scenario $scenario0
 * @property Type $type
 * @property User $user
 * @property Week $week
 */
class ScenarioUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scenario_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'scenario_id', 'brightness', 'week_id', 'type_id'], 'integer'],
            [['time_on', 'time_off'], 'safe'],
            [['name'], 'string', 'max' => 256],
            [['scenario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scenario::class, 'targetAttribute' => ['scenario_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
