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
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $surname;
    public $patronymic;
    public $email;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'name', 'surname', 'email'], 'required'],

            [['username', 'email'], 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такие данные уже зарегистрированы'],

            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/[а-яА-ЯёЁ]+$/u', 'message' => 'Используйте только символы кириллицы'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
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

    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->patronymic = $this->patronymic;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);

        return $user->save() ? $user : null;
    }
}
