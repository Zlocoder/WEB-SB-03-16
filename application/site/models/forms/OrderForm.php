<?php
/**
 * Created by PhpStorm.
 * User: миша
 * Date: 27.02.2017
 * Time: 20:21
 */

namespace site\models\forms;

use app\models\Order;
use app\models\Cart;

class OrderForm extends \yii\base\Model
{
    public $name;
    public $email;
    public $phone;
    public $address;
    
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            ['name', 'string', 'min'=>3, 'max'=>100],
            ['email', 'email'],
            ['phone', 'number'],
            ['address', 'string', 'min'=>3, 'max'=>200]
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
    
    public function run(){
        if($this->validate()){
            $cart = new Cart(); 
            $order = new Order();
            $order->name = $this->name;
            $order->email = $this->email;
            $order->phone = $this->phone;
            $order->address = $this->address;
            $order->sum = $cart->getProductsTotal();
            $order->qty = $cart->getProductsCount();
            if($order->save()){
                return true;
            }else{
                return false;
            }
        }
    }
}