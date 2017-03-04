<?php

namespace admin\models\forms;

use app\models\Category;

class CategoryForm extends \yii\base\Model
{
    public $id;
    public $name;
    public $parentId;

    public function rules(){
        return [
            [['name'], 'required', 'on' => ['create', 'update']],
            ['name', 'string', 'min'=>4, 'max'=>100, 'on' => ['create', 'update']],
            ['name', 'unique', 'targetClass' => Category::className(), 'on' => ['create']],
            ['name', 'unique', 'targetClass' => Category::className(), 'filter' => ['!=', 'id', $this->id], 'on' => ['update']],
            ['parentId', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id', 'on' => ['create', 'update']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'parentId' => 'Parent category'
        ];
    }

    public function run() {
        if ($this->validate()) {
            switch ($this->scenario) {
                case 'create' :
                    $category = new Category([
                        'name' => $this->name,
                        'parentId' => $this->parentId
                    ]);
                    return $category->save();
                case 'update' :
                    if ($this->id && $category = Category::findOne($this->id)) {
                        $category->name = $this->name;
                        $category->parentId = $this->parentId;
                        return $category->save();
                    }
            }
        }

        return false;
    }
    
}