<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 07.02.2017
 * Time: 20:46
 */

namespace app\models;



class Admin extends \app\base\ActiveRecord implements \yii\web\IdentityInterface {
    public static function tableName() {
        return 'admin';
    }

    public function rules() {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 100, 'min' => 3],
            ['password', 'string', 'min' => 60, 'max' => 60],
            ['login', 'unique'],
            [['createdAt', 'updatedAt'], 'safe']
        ];
    }

    public function attributeLabels() {

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