<?php

namespace site\controllers;

use app\models\Cart;
use app\models\Product;
use site\models\forms\OrderForm;

class CartController extends \site\base\Controller {
    public function actionIndex() {
        return $this->render('cart', ['cart' => new Cart()]);
    }

    public function actionAdd($productId, $quantity) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Product::findOne($productId)) {
            $cart = new Cart();
            $cart->add($productId, $quantity);

            return [
                'status' => 'success',
                'count' => $cart->getProductsCount(),
                'cartTotal' => $cart->getProductsTotal()
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Product not found'
        ];
    }

    public function actionQuantity($productId, $quantity) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($product = Product::findOne($productId)) {
            $cart = new Cart();
            $cart->quantity($productId, $quantity);

            return [
                'status' => 'success',
                'price' => $product->price,
                'total' => $product->price * $quantity,
                'cartTotal' => $cart->getProductsTotal()
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Product not found'
        ];
    }

    public function actionDelete($productId) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Product::findOne($productId)) {
            $cart = new Cart();
            $cart->remove($productId);

            return [
                'status' => 'success',
                'cartTotal' => $cart->getProductsTotal()
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Product not found'
        ];
    }

    public function actionOrder(){
        $cart = new Cart();
        $model = new OrderForm();
        
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if($model->run()){
                return $this->goHome();
            }
        }

        return $this->render('order', ['cart'=>$cart, 'model'=>$model]);
    }
}