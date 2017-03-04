<?php

namespace admin\models\forms;

use app\models\Product;
use app\models\Category;

class ProductForm extends \yii\base\Model {
    public $id;
    public $name;
    public $categoryId;
    public $categories;
    public $price;
    public $description;
    public $image;
    public $deleteImage;


    public function rules() {
        return [
            [['name', 'categoryId', 'price'], 'required', 'on' => ['create', 'update']],
            ['name', 'string', 'min' => 4, 'max' => 100, 'on' => ['create', 'update']],
            ['categoryId', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id', 'on' => ['create', 'update']],
            ['price', 'double', 'on' => ['create', 'update']],
            ['description', 'safe', 'on' => ['create', 'update']],
            ['image', 'image', 'mimeTypes' => 'image/jpg, image/png, image/jpeg', 'maxSize' => '100500000', 'maxFiles' => 1, 'on' => ['create', 'update']],

            ['categories', 'each', 'rule' => ['exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id', 'on' => ['create', 'update']]],

            ['name', 'unique', 'targetClass' => Product::className(), 'on' => ['create']],

            ['name', 'unique', 'targetClass' => Product::className(), 'filter' => ['!=', 'id', $this->id], 'on' => ['update']],
            ['deleteImage', 'boolean']
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
            'categoryId' => 'Default category',
            'categories' => 'Additional categories',
            'price' => 'Price',
            'description' => 'Description',
        ];
    }

    public function run() {
        if ($this->validate()) {
            switch ($this->scenario) {
                case 'create' :
                    $product = new Product([
                        'name' => $this->name,
                        'categoryId' => $this->categoryId,
                        'price' => $this->price,
                        'description' => $this->description
                    ]);

                    if ($this->image) {
                        $product->uploadImage($this->image);
                    }

                    if ($product->save()) {
                        $product->assignCategories($this->categories ?: []);
                        return true;
                    }

                    return false;
                case 'update' :
                    if ($this->id && $product = Product::findOne($this->id)) {
                        $product->name = $this->name;
                        $product->categoryId = $this->categoryId;
                        $product->price = $this->price;
                        $product->description = $this->description;

                        if ($this->image) {
                            $product->uploadImage($this->image);
                        } else if ($this->deleteImage) {
                            $product->deleteImage();
                        }

                        if ($product->save()) {
                            $product->assignCategories($this->categories ?: []);
                            return true;
                        }

                        return false;
                    }
            }
        }

        return false;
    }
}
