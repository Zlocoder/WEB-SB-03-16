<?php

namespace site\controllers;

use ejen\payment\onpay\ApiAction;

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
        $currency = 'RUR';

        if ($request->order_currency != $currency)
        {
            $response->code = 3;
            return false;
        }

        return true;
    }

    public function payCallback() {
        
    }
}