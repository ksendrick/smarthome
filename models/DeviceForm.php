<?php

namespace app\models;

use Yii;
use yii\base\Model;


class DeviceForm extends Model
{
    public $user_id;
    public $name;
    public $type_id;
    public $scenario_id;
    public $checkBox = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['user_id', 'name'], 'required'],

            ['name', 'string'],
            ['checkBox', 'boolean'],

            [['user_id', 'type_id', 'scenario_id'], 'integer'],

        ];
    }

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


    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $device = new Device();
        $device->name = $this->name;
        $device->type_id = $this->type_id;
        $device->scenario_id = $this->scenario_id;
        $device->user_id = Yii::$app->user->id;
        return $device->save() ? $device : null;
    }
}
