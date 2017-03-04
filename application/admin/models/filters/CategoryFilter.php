<?php

namespace admin\models\filters;

use \yii\base\Model;
use app\models\Category;

class CategoryFilter extends Model
{
    public $id;
    public $name;
    public $parentId;

    public function rules()
    {
        return [
            ['id', 'integer'],
            ['parentId', 'integer'],
            ['name', 'string', 'max'=> 100]
        ];
    }

    public function getProvider(){
        $this->validate();

        $query = Category::find()->with('parent');

        if($this->id && !$this->hasErrors('id')){
            $query->andWhere(['id'=>$this->id]);
        }

        if($this->parentId && !$this->hasErrors('parentId')){
            $query->andWhere(['parentId'=>$this->parentId]);
        }

        if($this->name && !$this->hasErrors('name')){
            $query->andWhere(['LIKE', 'name', $this->name]);
        }

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false
            ],
            'sort'=> [
                'attributes' => [
                    'createdAt' => [
                        'default' => SORT_DESC
                    ],
                    'name' => [
                        'default' => SORT_ASC
                    ]
                ],
                'defaultOrder' => [
                    'createdAt' => SORT_DESC,
                    'name' => SORT_ASC 
                ]
            ]
        ]);
    }
}