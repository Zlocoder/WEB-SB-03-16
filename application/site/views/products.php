<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>

<h1> Products</h1>

<?php foreach ($products as $product) { ?>
    <div class="product_box">
        <h3><?= $product->name ?></h3>
        <a href="#"><img src="<?= $product->getImageUrl([200, 200]) ?>" alt="<?= $product->name ?>" /></a>
        <p><?= $product->description ?></p>
        <p class="product_price">$ <?= $product->price ?></p>
        <a href="shoppingcart.html" class="addtocart"></a>
        <a href="<?= \yii\helpers\Url::to(['catalog/product-details', 'productId' => $product->id]) ?>" class="detail"></a>
    </div>
<?php } ?>
