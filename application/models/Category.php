<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 23.01.2017
 * Time: 20:49
 */

namespace app\models;

use app\models\Product;

class Category extends \app\base\ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }
    
    public function rules() {
        return [
            [['name'], 'required'],
            ['name', 'string', 'min' => 4, 'max' => 100],
            ['name', 'unique'],
            ['parentId', 'integer'],
            ['parentId', 'exist', 'targetAttribute' => 'id'],
            [['createAt', 'updatedAt'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
            'parentId' => 'Parent Category',
            'createdAt' => 'Date created',
            'updatedAt' => 'Date updated'
        ];
    }

    private static function createCategoryTree($categoriesAll, $parentId = 0) {
        $result = [];

        foreach ($categoriesAll as $category) {
            if ($category['parentId'] == $parentId) {
                $category['children'] = self::createCategoryTree($categoriesAll, $category['id']);
                $result[$category['id']] = $category;
            }
        }

        return $result;
    }

    public static function getCategoryTree($query = null) {
        $query = $query ?: self::find();

        $categoriesAll = $query->asArray()->all();

        return self::createCategoryTree($categoriesAll);
    }

    private static function getDropDownTree($tree, $level = 0) {
        $options = [];

        foreach ($tree as $id => $category) {
            $options[$id] = str_repeat('&nbsp;', 4 * $level) . $category['name'];

            if (!empty($category['children'])) {
                $options = \yii\helpers\ArrayHelper::merge($options, self::getDropDownTree($category['children'], $level + 1));
            }
        }

        return $options;
    }

    public static function getDropDownCategories($query = null, $recursive = true) {
        if ($recursive) {
            $tree = self::getCategoryTree($query);

            return self::getDropDownTree($tree);
        } else {
            $query = $query ?: self::find();

            return \yii\helpers\ArrayHelper::map($query->asArray()->all(), 'id', 'name');
        }
        
    }

    public function getParent() {
        return $this->hasOne(self::className(), ['id' => 'parentId']);
    }

    public function getChildren() {
        return $this->hasMany(self::className(), ['parentId' => 'id']);
    }

    public function getProducts(){
        return $this->hasMany(Product::className(), ['categoryId' => 'id']);
    }

}