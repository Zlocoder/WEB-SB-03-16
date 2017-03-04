<?php

namespace site\models\forms;

use app\models\User;

class UserLogin extends \yii\base\Model {
    public $login;
    public $password;

    public function rules() {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 100, 'min' => 3],
            ['password', 'string', 'max' => 100],
        ];
    }

    public function run() {
        if ($this->validate()) {
            if ($user = User::findOne(['login' => $this->login])) {
                if (\Yii::$app->security->validatePassword($this->password, $user->password)) {
                    return \Yii::$app->user->login($user);
                } else {
                    $this->addError('password', 'Wrong password');
                }
            } else {
                $this->addError('login', 'Administrator not found');
            }
        }

        return false;
    }
}