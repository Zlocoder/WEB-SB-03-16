<?php

namespace app\models;

use app\models\Cart;

class Order extends \app\base\ActiveRecord
{

    public static function tableName()
    {
        return 'order';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address', 'status'], 'required'],
            [['qty'], 'integer'],
            [['sum'], 'number'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 100],
            [['email', 'address'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 25]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
        ];
    }
    
    public function getOrderItems(){
        return $this->hasMany(OrderItems::className(), ['orderId'=>'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $orderItems = [];
        $cart = new Cart();
        foreach ($cart->getProductsList() as $product){
            $orderItems[] = [
                $this->id,
                $product->id,
                $product->name,
                $product->price,
                $cart->getProductCount($product->id),
                $cart->getProductCount($product->id) * $product->price
            ];
        }
        \Yii::$app->db->createCommand()->batchInsert(
            'orderitems',
            ['orderId', 'productId', 'name', 'price', 'qty', 'sum'],
            $orderItems
        )->execute();
    }
}