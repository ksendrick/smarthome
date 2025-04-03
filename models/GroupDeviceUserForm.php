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
class GroupDeviceUserForm extends Model
{
    public $device_user_id;
    public $group_id;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['device_user_id', 'group_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль'),
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'email' => Yii::t('app', 'Эл. почта'),
            'is_admin' => Yii::t('app', 'Is Admin'),
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $group = new GroupDeviceUser();
        $group->device_user_id = $this->device_user_id;
        $group->group_id = $this->group_id;

        return $group->save() ? $group : null;
    }
}
