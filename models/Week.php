<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "week".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property ScenarioUser[] $scenarioUsers
 * @property Scenario[] $scenarios
 */
class Week extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'week';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * Gets query for [[ScenarioUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScenarioUsers()
    {
        return $this->hasMany(ScenarioUser::class, ['week_id' => 'id']);
    }

    /**
     * Gets query for [[Scenarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScenarios()
    {
        return $this->hasMany(Scenario::class, ['week_id' => 'id']);
    }
}
