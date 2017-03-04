<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

class MyClass extends \yii\base\Object {
    public $var1 = 1;

    private $_var2;

    public function getVar2() {
        return $this->_var2;
    }

    public function setVar2($value) {
        $this->_var2 = $value;
    }
}

$object1 = new MyClass([
    'var1' => 1,
    'var2' => 2
]);

\Yii::configure($object1, [
    'var1' => 3,
    'var2' => 4
]);

\Yii::createObject(MyClass::className(), [
    'var1' => 5,
    'var2' => 6
]);

\Yii::createObject([
    'class' => MyClass::className(),
    'var1' => 7,
    'var2' => 8
]);






/*
$object->var2 = 5;
$var2 = $object->var2;
*/

echo $var2;