<?php

include 'namespace1.php';
include 'namespace2.php';

use my1\MyClass as MyClass1;
use my2\MyClass as MyClass2;

$obj1 = new MyClass1;
$obj2 = new MyClass2;

echo '<pre>';
var_dump($obj1, $obj2);