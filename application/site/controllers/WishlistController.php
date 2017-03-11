<?php

namespace site\controllers;

use app\models\Product;

class WishlistController extends \site\base\Controller {
    public $wishlist;

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $this->wishlist = \Yii::$app->session->get('wishlist', []);
            return true;
        }

        return false;
    }

    public function afterAction($action, $result) {
        \Yii::$app->session->set('wishlist', $this->wishlist);
        return parent::afterAction($action, $result);
    }

    public function actionIndex() {
        $products = Product::find()->where(['id' => $this->wishlist])->all();

        return $this->render('/catalog/products', ['products' => $products]);
    }

    public function actionAdd($productId) {
        if (!in_array($productId, $this->wishlist)) {
            $this->wishlist[] = $productId;
        }

        return $this->goBack();
    }

    public function actionRemove($productId) {
        if (array_search($productId, $this->wishlist) !== false) {
            unset($this->wishlist[$productId]);
        }

        return $this->goBack();
    }
}