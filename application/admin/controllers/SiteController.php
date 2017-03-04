<?php

namespace admin\controllers;

use yii;
use admin\models\forms\AdminLogin;

class SiteController extends \admin\base\Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /*
    public function actionCreateAdmin() {
        $admin = new \app\models\Admin;
        $admin->login = 'admin1';
        $admin->password = Yii::$app->security->generatePasswordHash('admin1');
        $admin->save();
    }
    */

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->admin->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLogin();

        if (\Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->run()) {
                return $this->goHome();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->admin->logout();

        return $this->redirect(['site/login']);
    }
}
