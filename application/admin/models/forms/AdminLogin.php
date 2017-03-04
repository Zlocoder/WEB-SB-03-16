<?php

namespace admin\models\forms;

use app\models\Admin;

class AdminLogin extends \yii\base\Model {
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
            if ($admin = Admin::findOne(['login' => $this->login])) {
                if (\Yii::$app->security->validatePassword($this->password, $admin->password)) {
                    return \Yii::$app->admin->login($admin);
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