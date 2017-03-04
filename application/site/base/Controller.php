<?php

namespace site\base;

use app\models\Category;
use app\models\Cart;

class Controller extends \app\base\Controller {
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $this->view->params['asideCategories'] = Category::find()->all();
            $this->view->params['cartQuantity'] = (new Cart())->getProductsCount();
            return true;
        }

        return false;
    }
}