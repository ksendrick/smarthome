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
class GroupForm extends Model
{
    public $id;
    public $user_id;
    public $name;
    public $group_img_id;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'group_img_id'], 'required'],

            [['user_id', 'group_img_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
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

        $group = new Group();
        $group->user_id = Yii::$app->user->id;
        $group->name = $this->name;
        $group->group_img_id = $this->group_img_id;

        return $group->save() ? $group : null;
    }
}
