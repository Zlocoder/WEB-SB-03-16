<?php

namespace admin\controllers;

use app\models\Category;
use app\models\Product;
use admin\models\forms\ProductForm;
use admin\models\filters\ProductFilter;

class ProductController extends \admin\base\Controller {

    public function actionIndex() {
        $filter = new ProductFilter();
        $filter->load(\Yii::$app->request->get());

        return $this->render('list', [
            'filter' => $filter,
            'provider' => $filter->provider,
            'dropDownCategories' => Category::getDropDownCategories()
        ]);
    }

    public function actionCreate() {
        $model = new ProductForm([
            'scenario' => 'create'
        ]);

        if (\Yii::$app->request->isPost) {

            $model->load(\Yii::$app->request->post());
            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');

            if ($model->run()) {
                return $this->redirect(['product/index']);
            }
        }

        return $this->render('form', [
            'model' => $model,
            'dropDownCategories' => Category::getDropDownCategories()
        ]);
    }

    public function actionUpdate($id) {
        if ($product = Product::findOne($id)) {
            $categories = $product->categories;
            array_walk($categories, function(&$element) {
                $element = $element->id;
            });

            $model = new ProductForm([
                'scenario' => 'update',
                'id' => $id,
                'name' => $product->name,
                'categoryId' => $product->categoryId,
                'categories' => $categories,
                'price' => $product->price,
                'description' => $product->description,
                'image' => $product->image ? $product->getImageUrl([200,200]) : '',
            ]);

            if (\Yii::$app->request->isPost) {
                $model->load(\Yii::$app->request->post());
                $model->image = \yii\web\UploadedFile::getInstance($model, 'image');

                if ($model->run()) {
                    return $this->redirect(['product/index']);
                }
            }
        } else {
            $model = null;
        }

        return $this->render('form', [
            'model' => $model,
            'dropDownCategories' =>  Category::getDropDownCategories()
        ]);
    }

    public function actionDelete($id) {
        if ($product = Product::findOne($id)) {
            $product->delete();
        };

        return $this->redirect(['product/index']);
    }
}