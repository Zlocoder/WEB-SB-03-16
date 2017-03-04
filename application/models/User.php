<?php

namespace app\models;

use app\base\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 100, 'min' => 3],
            ['password', 'string', 'max' => 60],
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }
}