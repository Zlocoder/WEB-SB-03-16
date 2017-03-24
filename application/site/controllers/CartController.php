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
        $this->layout = false;
        if ($product = Product::findOne($productId)) {
            $cart = new Cart();
            $cart->add($productId, $quantity);
        }

        return $this->render('modal', [
            'product' => $product,
            'quantity' => $quantity
        ]);
    }

    public function actionQuantity($productId, $quantity) {
        $this->layout = false;
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
        $this->layout = false;
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
                $payment = \Yii::$app->onpay->createPayment([
                    'price' => $model->order->sum,
                    'pay_for' => (string) $model->order->id,
                ]);

                $url = $payment->url;

                if ($url) {
                    \Yii::$app->session->remove('cart');
                    return $this->redirect($url);
                }
            }
        }

        return $this->render('order', ['cart'=>$cart, 'model'=>$model]);
    }
}