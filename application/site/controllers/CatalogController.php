<?php

namespace site\controllers;

use app\models\Product;

class CatalogController extends \site\base\Controller {
    public function actionProducts($category = null) { // Автоматическая привязка гет параметра
        //\Yii::$app->request->get('category'); - получаем гет параметр category
        // \Yii::$app->request->get(); - получаем все гет параметры

        $products = Product::find()->orderBy(['createdAt' => SORT_DESC])->limit(12);

        if ($category) {
            $products->andWhere(['categoryId' => $category]);
        }

        return $this->render('/products', [
            'products' => $products->all()
        ]);
    }

    public function actionProductDetails($productId) {
        $product = Product::findOne($productId);

        return $this->render('/productdetails', [
            'product' => $product,
            'relateds' => Product::find()->limit(3)
                ->orderBy('createdAt')
                ->andWhere(['categoryId' => $product->categoryId])
                ->andWhere(['id' => $productId])->all()
        ]);

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