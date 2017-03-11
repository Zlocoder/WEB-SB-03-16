<?php


namespace admin\models\forms;

use app\models\Product;
use app\models\Category;

class ProductForm extends \yii\base\Model
{
    public $id;
    public $name;
    public $categoryId;
    public $price;
    public $description;
    public $image;
    public $deleteImage;
    public $categories;
    public $bestseller;

    public function rules()
    {
        return [
            ['name', 'required', 'on' => ['create', 'update']],
            ['name', 'string', 'length' => [4, 24], 'on' => ['create', 'update']],
            ['categoryId', 'integer', 'on' => ['create', 'update']],
            ['price', 'number', 'on' => ['create', 'update']],
            ['image', 'image', 'mimeTypes' => 'image/jpg, image/png, image/jpeg', 'maxSize' => '100500000',
                'maxFiles' => 1, 'on' => ['create', 'update']],
            ['categories', 'each', 'rule' => ['exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id', 'on' => ['create', 'update']]],
            ['description', 'string', 'on' => ['create', 'update']],
            ['deleteImage', 'boolean'],
            ['bestseller', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'categoryId' => 'Category Id',
            'price' => 'Price',
            'description' => 'Description',
            'bestseller' => 'Bestseller'
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
                        'description' => $this->description,
                        'bestseller' => $this->bestseller
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
                        $product->bestseller = $this->bestseller;

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