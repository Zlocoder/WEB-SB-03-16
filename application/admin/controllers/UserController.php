<?php

namespace admin\controllers;

use admin\models\filters\UserFilter;
use admin\models\forms\UserForm;
use app\models\User;

class UserController extends \admin\base\Controller
{
    public function actionIndex()
    {
        $filter = new UserFilter();
        $filter->load(\Yii::$app->request->get());

        return $this->render('list', [
            'filter' => $filter,
            'provider' => $filter->provider,
        ]);
    }

    public function actionCreate()
    {
        $model = new UserForm([
            'scenario' => 'create'
        ]);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run())
                return $this->redirect(['user/index']);
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        if ($user = User::findOne($id)) {
            $model = new UserForm([
                'scenario' => 'update',
                'id' => $id,
                'login' => $user->login,
                'password' => $user->password
            ]);

            if (\Yii::$app->request->isPost) {
                $model->load(\Yii::$app->request->post());

                if ($model->run())
                    return $this->redirect(['user/index']);
            }

            return $this->render('form', ['model' => $model]);
        } else {
            $model = null;
        }
    }

    public function actionDelete($id)
    {
        User::deleteAll(['id' => explode(',', $id)]);
        return $this->redirect(['user/index']);
    }
}