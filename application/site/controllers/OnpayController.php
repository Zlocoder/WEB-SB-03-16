<?php

namespace site\controllers;

use ejen\payment\onpay\ApiAction;
use app\models\Order;

class OnpayController extends \yii\web\Controller {
    public function actions() {
        return [
            'index' => [
                'class' => ApiAction::className(),
                'payCallback' => [$this, 'payCallback'],
                'checkCallback' => [$this, 'checkCallback'],
            ]
        ];
    }

    public function checkCallback($request, $response) {
        $order = Order::findOne($request['pay_for']);

        if (!$order) {
            $response->code = 3;
            $response->comment = 'Заказ не найден';
            return;
        }

        if (!$order->status == 'payed') {
            $response->code = 3;
            $response->comment = 'Заказ уже оплачен';
        }
    }

    public function payCallback($request, $response) {
        $order = Order::findOne($request['pay_for']);

        if (!$order) {
            $response->code = 3;
            $response->comment = 'Заказ не найден';
            return;
        }

        if (!$order->status == 'payed') {
            $response->code = 3;
            $response->comment = 'Заказ уже оплачен';
        }

        $amount1 = (float) $order->sum;
        $amount2 = (float) $request->amount;

        if ($amount1 != $amount2) {
            $response->code = 3;
            $response->comment = 'Сумма оплаты не совпадает с суммой заказа';
        }
    }
}