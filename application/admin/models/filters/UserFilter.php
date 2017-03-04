<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 09.02.2017
 * Time: 10:51
 */

namespace admin\models\filters;

use app\models\User;

class UserFilter extends \yii\base\Model
{
    public  $id;
    public  $login;

    public function rules()
    {
        return [
            ['id', 'integer'],
            ['login', 'string']
        ];
    }

    public function getProvider(){
        $this->validate();
        
        $query = User::find();
        
        if($this->id and !$this->hasErrors('id')){
            $query->andWhere(['id'=>$this->id]);
        }

        if($this->login and !$this->hasErrors('login')){
            $query->andWhere(['LIKE', 'login', $this->login]);
        }

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false
            ]
        ]);

    }
}