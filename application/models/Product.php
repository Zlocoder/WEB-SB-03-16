<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 30.01.2017
 * Time: 12:06
 */

namespace app\models;

use app\models\Category;
use yii\imagine\Image;

class Product extends \app\base\ActiveRecord
{
    public static function tableName(){
        return 'product';
    }

    private static $sizes = [
        [50,50],
        [100,100],
        [200,200]
    ];

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'min'=>4, 'max'=>100],
            ['categoryId', 'exist', 'targetClass'=> Category::className(), 'targetAttribute' => 'id'],
            ['price', 'number'],
            ['image', 'string', 'min'=>16, 'max'=>16],
            ['description', 'string', 'min'=>10],
            [['createdAt', 'updatedAt'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'categoryId' => 'CategoryName',
            'price' => 'Price',
            'description' => 'Description',
            'createdAt' => 'Date created',
            'updatedAt' => 'Date updated'
        ];
    }
    
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }
    
    public function getCategories(){
        return $this->hasMany(Category::className(), ['id'=>'categoryId'])
                ->viaTable('product_to_category', ['productId'=>'id']);
    }

    public function assignCategories($ids = []){
        if($this->id){
            \Yii::$app->db->createCommand()->delete('product_to_category', ['productId' => $this->id])->execute();

            array_unshift($ids, $this->categoryId);
            array_unique($ids);
            array_walk($ids, function (&$id){
               $id = [$this->id, $id];
            });

            \Yii::$app->db->createCommand()->batchInsert(
                'product_to_category',
                ['productId', 'categoryId'],
                $ids
            )->execute();
        }
    }

    public function getImageUrl($size = null) {
        $size = $size ? "_{$size[0]}_{$size[1]}" : '';

        if ($this->image) {
            return \Yii::getAlias("@web/images/products/{$this->image}{$size}.png");
        }

        return \Yii::getAlias("@web/images/products/default{$size}.png");
    }

    public function deleteImage() {
        if ($this->image) {
            $path = \Yii::getAlias('@webroot/images/products/');

            if (file_exists("{$path}{$this->image}.png")) {
                unlink("{$path}{$this->image}.png");
            }

            foreach (self::$sizes as $size) {
                if (file_exists("{$path}{$this->image}_{$size[0]}_{$size[1]}.png")) {
                    unlink("{$path}{$this->image}_{$size[0]}_{$size[1]}.png");
                }
            }

            $this->image = '';
        }
    }

    public function uploadImage($uploadedImage) {
        $path = \Yii::getAlias('@webroot/images/products/');

        $this->deleteImage();

        $this->image = \Yii::$app->security->generateRandomString(16);

        $uploadedImage->saveAs("{$path}{$this->image}.tmp");
        $image = Image::getImagine()->open("{$path}{$this->image}.tmp");
        $image->save("{$path}{$this->image}.png");

        foreach (self::$sizes as $size) {
            Image::thumbnail("{$path}{$this->image}.png", $size[0], $size[1])->save("{$path}{$this->image}_{$size[0]}_{$size[1]}.png");
        }

        unlink("{$path}{$this->image}.tmp");
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()){
            $this->deleteImage();
            return true;

            \Yii::$app->db->createCommand()->delete('product_to_category', ['productId' => $this->id])->execute();
        }
        return false;
    }

}

