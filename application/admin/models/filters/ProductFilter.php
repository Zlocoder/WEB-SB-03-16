<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 31.01.2017
 * Time: 9:19
 */

namespace admin\models\filters;

use app\models\Product;

class ProductFilter extends \yii\base\Model
{
    public $id;
    public $name;
    public $categoryId;
    public $price;
    public $description;

    public function rules()
    {
        return [
            ['id', 'integer'],
            ['name', 'string', 'max'=>100],
            ['categoryId', 'integer'],
            ['description', 'string']
        ];
    }

    public function getProvider(){
        $this->validate();

        $query = Product::find()->with('category');
        
        if($this->id && !$this->hasErrors('id')){
            $query->andWhere(['id'=>$this->id]);
        }

        if($this->name && !$this->hasErrors('name')){
            $query->andWhere(['LIKE', 'name', $this->name]);
        }

        if($this->description && !$this->hasErrors('description')){
            $query->andWhere(['LIKE', 'description', $this->description]);
        }

        if($this->categoryId && !$this->hasErrors('categoryId')){
            $query->andWhere(['categoryId' => $this->categoryId]);
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