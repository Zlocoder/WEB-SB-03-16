<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 09.02.2017
 * Time: 10:45
 */

namespace admin\controllers;

use app\models\User;
use admin\models\filters\UserFilter;
use admin\models\forms\UserForm;


class AdminController extends \admin\base\Controller
{
    public function actionIndex(){
        $filter = new UserFilter();
        $filter->load(\Yii::$app->request->get());
        return $this->render('list', [
            'filter' => $filter,
            'dataProvider' => $filter->provider
        ]);
    }

    public function actionCreate(){
        
        $model = new UserForm([
            'scenario' => 'create'
        ]);
        
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());

            if ($model->run()){
                $this->redirect(['admin/index']);
            }
        }
        
        return $this->render('form', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id){
        if($admin = User::findOne($id)){
            $model = new UserForm([
                'scenario' => 'update',
                'id' => $id,
                'login' => $admin->login,
                'password' => $admin->password
            ]);

            if(\Yii::$app->request->isPost){
                $model->load(\Yii::$app->request->post());

                if ($model->run()){
                    $this->redirect(['admin/index']);
                }
            }

        }else{
            $model= null;
        }

        return $this->render('form', [
            'model' => $model
        ]);
    }
    public function actionDelete($id)
    {
        User::deleteAll(['id' => explode(',', $id)]);
        return $this->redirect(['admin/index']);
    }
}