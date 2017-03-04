<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 23.01.2017
 * Time: 10:32
 */

namespace admin\controllers;

use admin\models\forms\CategoryForm;
use app\models\Category;
use admin\models\filters\CategoryFilter;


class CategoryController extends \admin\base\Controller
{
    public function actionIndex(){
        $filter = new CategoryFilter();
        $filter->load(\Yii::$app->request->get());

        return $this->render('list', [
            'filter' => $filter,
            'provider' => $filter->provider,
            'dropDownCategories' => Category::getDropDownCategories()
        ]);
    }

    public function actionCreate(){
        $model = new CategoryForm([
            'scenario' => 'create'
        ]);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run()) {
                return $this->redirect(['category/index']);
            }
        }

        return $this->render('form', [
            'model' => $model,
            'dropDownCategories' => Category::getDropDownCategories()
        ]);
    }

    public function actionUpdate($id){
        if ($category = Category::findOne($id)) {
            $model = new CategoryForm([
                'scenario' => 'update',
                'id' => $id,
                'name' => $category->name,
                'parentId' => $category->parentId
            ]);

            if (\Yii::$app->request->isPost) {
                $model->load(\Yii::$app->request->post());

                if ($model->run($id)) {
                    return $this->redirect(['category/index']);
                }
            }
        } else {
            $model = null;
        }

        return $this->render('form', [
            'model' => $model,
            'dropDownCategories' => Category::getDropDownCategories(Category::find()->andWhere(['!=', 'id', $id]))
        ]);
    }

    public function actionDelete($id){
        Category::deleteAll(['id' => explode(',', $id)]);

        return $this->redirect(['category/index']);
    }
}