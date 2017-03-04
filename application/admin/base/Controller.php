<?php
namespace admin\base;


class Controller extends \app\base\Controller
{
    public function init()
    {
        $this->attachBehavior('access', [
            'class' => 'yii\filters\AccessControl',
            'user' => 'admin',
            'except' => ['login'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@']
                ]
            ]
        ]);
    }
}