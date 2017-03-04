<?php

namespace app\models;

class Cart extends \yii\base\Component
{
    private $_products = [];

    private $_productsCache = null;

    private function save() {
        \Yii::$app->session->set('cart', $this->_products);
        $this->_productsCache = null;
    }

    public function init() {
        $this->_products = \Yii::$app->session->get('cart', []);
    }

    public function getProductsList() {
        if (!$this->_productsCache) {
            $products_ids = array_keys($this->_products);
            $this->_productsCache = Product::find()->andWhere(['id' => $products_ids])->all();
        }

        return $this->_productsCache;
    }

    public function getProductsCount() {
        $totalCount = 0;

        if (!empty($this->_products)) {
            foreach ($this->_products as $quantity) {
                $totalCount += $quantity;
            }
        }

        return $totalCount;
    }

    public function getProductCount($productId) {
        if (isset($this->_products[$productId])) {
            return $this->_products[$productId];
        }

        return 0;
    }

    public function getProductsTotal() {
        $products = $this->getProductsList();

        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price * $this->_products[$product->id];
        }

        return $totalPrice;
    }

    public function add($productId, $quantity) {
        if (isset($this->_products[$productId])) {
            $this->_products[$productId] += $quantity;
        } else {
            $this->_products[$productId] = $quantity;
        }

        if ($this->_products[$productId] == 0) {
            unset($this->_products[$productId]);
        }

        $this->save();
    }

    public function quantity($productId, $quantity) {
        $this->_products[$productId] = $quantity;
        $this->save();
    }

    public function remove($productId) {
        if (isset($this->_products[$productId])) {
            unset($this->_products[$productId]);
        }

        $this->save();
    }
}