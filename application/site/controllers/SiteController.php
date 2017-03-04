<?php

namespace site\controllers;

use app\models\Product;
use site\models\forms\UserLogin;

class SiteController extends \site\base\Controller {
    public function actionIndex() {
        return $this->render('/index', [
            'products' => Product::find()->orderBy(['createdAt' => SORT_DESC])->limit(6)->all()
        ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new UserLogin();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post(), '');

            if ($model->run()) {
                return $this->goHome();
            }
        }

        return $this->render('/login', [
            'model' => $model,
        ]);
    }

    public function actionLogout() {
        if (!\Yii::$app->user->isGuest) {
            \Yii::$app->user->logout();
        }

        return $this->goHome();
    }
}