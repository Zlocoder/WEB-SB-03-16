<?php

namespace site\controllers;

use app\models\Product;
use yii\data\Pagination;
use site\models\forms\UserLogin;

class SiteController extends \site\base\Controller {
    public function actionIndex() {
        return $this->render('index', [
            'products' => Product::find()->orderBy(['createdAt' => SORT_DESC])->limit(6)->all()
        ]);
    }
    public function actionProducts($id = null){
        $models = (empty($id))? Product::find(): Product::find()->andWhere(['categoryId'=>$id]);
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $models->count()
        ]);

        return $this->render('products', [
            'products' => $models->offset($pagination->offset)->limit($pagination->limit)->all(),
            'pagination' => $pagination
        ]);
    }

    public function actionDetail($id){
        $product = Product::findOne($id);

        return $this->render('detail', [
            'product'=>$product,
            'productSimilar'=>Product::find()->andWhere(['categoryId'=>$product->categoryId])->andWhere(['!=', 'id', $id])->limit(3)->all()
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

        return $this->render('login', [
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