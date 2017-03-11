<?php

namespace site\base;

use app\models\Category;
use app\models\Cart;
use app\models\Product;

class Controller extends \app\base\Controller {
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $this->view->params['asideCategories'] = Category::find()->all();
            $this->view->params['cartQuantity'] = (new Cart())->getProductsCount();
            $this->view->params['bestsellers'] = Product::find()->where(['bestseller' => '1'])->limit(4)->all();
            return true;
        }

        return false;
    }
}