<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class ScenarioForm extends Model
{
    public $name;
    public $time_on;
    public $time_off;
    public $brightness;
    public $week_id;
    public $type_id;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'time_on', 'time_off', 'type_id'], 'required'],

            [['time_on', 'time_off'], 'safe'],
            [['brightness', 'week_id', 'type_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
        ];
    }

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


    public function save(){
        if(!$this->validate()){
            return null;
        }

        $scenario = new Scenario();
        $scenario->name = $this->name;
        $scenario->time_on = $this->time_on;
        $scenario->time_off = $this->time_off;
        $scenario->type_id = $this->type_id;
        $scenario->brightness = $this->brightness;
        $scenario->week_id = $this->week_id;

        return $scenario->save() ? $scenario:null;
   }
}
