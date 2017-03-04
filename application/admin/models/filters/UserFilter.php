<?php

namespace admin\models\filters;

use app\models\User;

class UserFilter extends \yii\base\Model
{
    public $id;
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 100, 'min' => 3],
            ['password', 'string', 'max' => 100],
        ];
    }

    public function getProvider()
    {
        $query = User::find();

        if ($this->id && !$this->hasErrors('id'))
            $query->andWhere(['id' => $this->id]);

        if ($this->login && !$this->hasErrors('login'))
            $query->andWhere(['login' => $this->login]);

        if ($this->password && !$this->hasErrors('password'))
            $query->andWhere(['password' => $this->password]);

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
                'pageSizeParam' => false,
            ],
            'sort' => [
                'defaultOrder' => [
                    'createdAt' => SORT_DESC,
                    'login' => SORT_ASC
                ]
            ]
        ]);

    }
}