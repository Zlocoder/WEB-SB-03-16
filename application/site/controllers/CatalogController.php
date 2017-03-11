<?php

namespace site\controllers;

use app\models\Product;
use yii\data\Pagination;

class CatalogController extends \site\base\Controller {
    public function actionProducts($id = null){
        $models = (empty($id))? Product::find(): Product::find()->andWhere(['categoryId'=>$id]);
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $models->count()
        ]);

        return $this->render('products', [
            'products' => $models->offset($pagination->offset)->limit($pagination->limit)->all(),
            'pagination' => $pagination
        ]);
    }

    public function actionDetail($id){
        $product = Product::findOne($id);

        return $this->render('detail', [
            'product'=>$product,
            'productSimilar'=>Product::find()->andWhere(['categoryId'=>$product->categoryId])->andWhere(['!=', 'id', $id])->limit(3)->all()
        ]);
    }

    public function actionSearch($keyword, $autocomplete = false){
        if(!empty($keyword)){
            $models = Product::find()->andWhere(['LIKE', 'name', trim($keyword)]);

            if ($autocomplete) {
                $result = [];
                foreach ($models->all() as $model) {
                    $result[] = $model->name;
                }

                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return $result;
            }

            $pagination = new Pagination([
                'defaultPageSize' => 6,
                'totalCount' => $models->count()
            ]);
            return $this->render('products', [
                'products' => $models->offset($pagination->offset)->limit($pagination->limit)->all(),
                'pagination' => $pagination
            ]);
        }else{
            return $this->redirect(['site/products']);
        }
    }
}