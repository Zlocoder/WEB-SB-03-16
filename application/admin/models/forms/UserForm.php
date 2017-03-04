<?php

namespace admin\models\forms;

use \yii\base\Model;
use app\models\User;

class UserForm extends Model
{
    public $id;
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required', 'on' => ['create', 'update']],
            ['login', 'string', 'max' => 100, 'min' => 3, 'on' => ['create', 'update']],
            ['login', 'unique', 'targetClass' => User::className(), 'on' => ['create']],
            ['password', 'string', 'max' => 100, 'on' => ['create', 'update']],
        ];
    }

    public function run()
    {
        if ($this->validate()) {
            switch ($this->scenario) {
                case 'create':
                    $user = new User([
                        'login' => $this->login,
                        'password' => \Yii::$app->security->generatePasswordHash($this->password)
                    ]);
                    return $user->save();
                case 'update':
                    if ($this->id && $user = User::findOne($this->id)) {
                        $user->login = $this->login;
                        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
                        return $user->save();
                    }
            }
        }
        return false;
    }
}