<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>

<h1>Products</h1>

<?php foreach ($products as $product) { ?>
 <div class="product_box">
  <h3><?= $product->name ?></h3>
  <a href="#"><img src="<?= $product->getImageUrl([200, 200]) ?>" alt="<?= $product->name ?>" /></a>
  <p><?= $product->description ?></p>
  <p class="product_price">$ <?= $product->price ?></p>
  <a href="<?= Url::to(['cart/add', 'productId'=>$product->id , 'quantity' => 1])?>" class="addtocart"></a>
  <a href="<?= Url::to(['site/detail', 'id'=>$product->id])?>" class="detail"></a>
 </div>
<?php } ?>

<?= LinkPager::widget(['pagination'=>$pagination])?>
