<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property int $id
 * @property string $name
 * @property string $img
 *
 * @property Device[] $devices
 * @property ScenarioUser[] $scenarioUsers
 * @property Scenario[] $scenarios
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'img'], 'string', 'max' => 256],
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
            'img' => Yii::t('app', 'Фото'),
        ];
    }

    /**
     * Gets query for [[Devices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[ScenarioUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScenarioUsers()
    {
        return $this->hasMany(ScenarioUser::class, ['type_id' => 'id']);
    }

    /**
     * Gets query for [[Scenarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScenarios()
    {
        return $this->hasMany(Scenario::class, ['type_id' => 'id']);
    }
}
