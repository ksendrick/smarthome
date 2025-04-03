<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $email
 * @property int|null $is_admin
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $authKey;
    public $accessToken;

    public static function tableName()
    {
        return 'user';
    }

    private static $users;


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getDeviceUsers()
    {
        return $this->hasMany(DeviceUser::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Devices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::class, ['user_id' => 'id']);
    }

    public function getScenarioUsers()
    {
        return $this->hasMany(ScenarioUser::class, ['user_id' => 'id']);
    }

    public function getNotifications()
    {
        return $this->hasMany(Notification::class, ['user_id' => 'id']);
    }

    public function getGroups()
    {
        return $this->hasMany(Group::class, ['user_id' => 'id']);
    }


}
