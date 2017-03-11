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
                ->andFilterCompare('id', $productId, $defaultOperator = '<>')
//                ->andWhere(['id' => $productId])
                ->all()

        ]);

    }
}