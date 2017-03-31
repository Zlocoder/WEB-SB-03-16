<?php

namespace site\models\forms;

use app\models\User;

class Registration extends \yii\base\Model {
    public $login;
    public $password;
    public $email;
    public $confirm;

    public function rules() {
        return [
            //[['email','login', 'password', 'confirm'], 'class' => '\app\validators\Requred', 'message' => '123'],
            [['email','login', 'password', 'confirm'], 'required', 'message' => '123'],
            [['login', 'password'], 'string', 'min' => 3, 'max' => 25, 'message' => '123', 'tooLong' => '123', 'tooShort' => '123'],
            ['confirm', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            [['email'], 'email'],

            [['login'], 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'login'],
            [['email'], 'unique', 'targetClass' => User::className()],
        ];
    }

    public function run() {
        if ($this->validate()) {
            $user = new User([
                'email' => $this->email,
                'login' => $this->login,
                'password' => \Yii::$app->security->generatePasswordHash($this->password)
            ]);

            if ($user->save()) {
                new \yii\swiftmailer\Mailer();
                \Yii::$app->mailer
                    ->compose('welcome', [
                        'login' => $this->login,
                        'password' => $this->password
                    ])
                    ->setFrom('sadfsdfg@qweqwe.com') // Пользователь увидит что письмо отправлено от этого почтового адреса.
                    ->setTo($this->email) // Имейл пользователя
                    ->setSubject('Welcome to yii shop.')
                    ->send();

                \Yii::$app->mailer
                    ->compose('activation', [
                        'code' => md5($this->email)
                    ])
                    ->setFrom('sadfsdfg@qweqwe.com') // Пользователь увидит что письмо отправлено от этого почтового адреса.
                    ->setTo($this->email) // Имейл пользователя
                    ->setSubject('Activate your account.')
                    ->send();

                return \Yii::$app->user->login($user);
            }
        }

        return false;
    }
}