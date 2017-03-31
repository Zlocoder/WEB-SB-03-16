<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 13.02.2017
 * Time: 8:51
 */

namespace app\models;


class User extends \app\base\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['email', 'login', 'password'], 'required'],
            [['email','login'], 'string', 'max' => 100, 'min' => 3],
            ['password', 'string', 'min' => 60, 'max' => 60],
            ['email', 'email'],

            //[['activation'], 'boolean', 'strict' => true, 'trueValue' => 1, 'falseValue' => 0],
            [['activation'], 'boolean'],

            [['login', 'email'], 'unique'],
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