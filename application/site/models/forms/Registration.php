<?php

namespace site\models\forms;

use app\models\User;

class Registration extends \yii\base\Model {
    public $login;
    public $password;

    public function rules() {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string', 'min' => 3, 'max' => 25],
        ];
    }

    public function run() {
        if ($this->validate()) {
            $user = new User([
                'login' => $this->login,
                'password' => \Yii::$app->security->generatePasswordHash($this->password)
            ]);

            if ($user->save()) {
                \Yii::$app->mailer
                    ->compose('welcome', [
                        'login' => $this->login,
                        'password' => $this->password
                    ])
                    ->setFrom('sadfsdfg@qweqwe.com') // Пользователь увидит что письмо отправлено от этого почтового адреса.
                    ->setTo('sdfgdfg@qwewer.com') // Имейл пользователя
                    ->setSubject('Welcome to yii shop.')
                    ->send();

                return \Yii::$app->user->login($user);
            }
        }

        return false;
    }
}