<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 12.02.2017
 * Time: 19:39
 */

namespace admin\models\forms;

use app\models\User;


class UserForm extends \yii\base\Model
{
    public $id;
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required', 'on' => ['create', 'update']],
            ['login', 'string', 'max' => 100, 'min' => 3, 'on' => ['create', 'update']],
            ['password', 'string', 'max' => 100, 'on' => ['create', 'update']]
        ];
    }

    public function run(){
        if($this->validate()){
            switch ($this->scenario){
                case 'create':
                    $admin = new User([
                        'login' => $this->login,
                        'password' => \Yii::$app->security->generatePasswordHash($this->password)
                    ]);
                    return $admin->save();
                case 'update':
                    if ($this->id and $admin = User::findOne(['id'=>$this->id])) {
                        $admin->login = $this->login;
                        $admin->password = \Yii::$app->security->generatePasswordHash($this->password);
                    }
                    return $admin->save();
            }
        }
        return false;
    }
}