<?php

namespace admin\models\filters;

use app\models\Product;

class ProductFilter extends \yii\base\Model {
    public $id;
    public $name;
    public $category;
    public $price;

    public function rules() {
        return [
            ['id', 'integer'],
            ['category', 'integer'],
            ['name', 'string', 'max' => 100],
            ['price', 'double']
        ];
    }

    public function getProvider() {
        $this->validate();

        $query = Product::find()->with('category');

        if ($this->id && !$this->hasErrors('id')) {
            $query->andWhere(['id' => $this->id]);
        }

        if ($this->name && !$this->hasErrors('name')) {
            $query->andWhere(['LIKE', 'name', $this->name]);
        }

        if ($this->category && !$this->hasErrors('category')) {
            $query->andWhere(['categoryId' => $this->category]);
        }

        if ($this->price && !$this->hasErrors('price')) {
            $query->andWhere(['price' => $this->price]);
        }

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false
            ],
            'sort' => [
                'attributes' => [
                    'name',
                    'category' => [
                        'asc' => ['categoryId' => SORT_ASC],
                        'desc' => ['categoryId' => SORT_DESC]
                    ],
                    'price',
                    'createdAt',
                    'updatedAt'
                ],
                'defaultOrder' => [
                    'createdAt' => SORT_DESC,
                    'name' => SORT_ASC
                ]
            ]
        ]);
    }


}