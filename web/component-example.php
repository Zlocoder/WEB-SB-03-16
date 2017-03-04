<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

class VarChangeEvent extends yii\base\Event {
    public $oldValue;
    public $newValue;
}

class MyClass1 extends \yii\base\Component {
    private $_var = 0;

    public function behaviors() {
        return [
            'my-class-2' => [
                'class' => 'MyClass2'
            ]
        ];
    }

    public function setVar($value) {
        if ($value !== $this->_var) {
            $event = new VarChangeEvent([
                'oldValue' => $this->_var,
                'newValue' => $value
            ]);

            $this->_var = $value;

            $this->trigger('varChange', $event);
        }
    }
}

class MyClass2 extends \yii\base\Behavior {
    public function events() {
        return [
            'varChange' => 'onVarChange'
        ];
    }

    public $behaviorVar;

    public function behaviorMethod() {
        echo 'this is behavior method<br/>';
    }

    public function onVarChange($event) {
        echo "var changed from {$event->oldValue} to {$event->newValue}<br/>";
    }
}

$object1 = new MyClass1();
$object2 = new MyClass2();
$object3 = new MyClass1();

//$object1->on('varChange', [$object2, 'onVarChange']);
//\yii\base\Event::on('MyClass1', 'varChange', [$object2, 'onVarChange']);

//$object1->attachBehavior('my-class-2', $object2);

$object1->var = 5;
$object1->var = 5;
$object1->var = 10;
$object1->var = 15;

$object3->var = 5;
$object3->var = 5;
$object3->var = 10;
$object3->var = 15;

$object1->behaviorVar = 5;
echo $object1->behaviorVar . '<br/>';
$object1->behaviorMethod();

$object4 = new MyClass1([
    'var' => 5,
    'behaviorVar' => 10,
    'on varChange' => function() {
        echo 'other method<br/>';
    },
]);

$object4->var = 10;



