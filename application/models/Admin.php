<?php

namespace app\models;

use yii\web\IdentityInterface;

class Admin extends \app\base\ActiveRecord implements \yii\web\IdentityInterface {
    public static function tableName() {
        return 'admin';
    }

    public function rules() {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 100, 'min' => 3],
            ['password', 'string', 'max' => 100],
        ];
    }

    public function attributeLabels() {
        return [
            'createdAt' => 'Date created',
            'updatedAt' => 'Date updated'
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }
}