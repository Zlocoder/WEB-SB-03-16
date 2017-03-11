<?php

?>

<?php \app\widgets\Modal::begin([
    'header' => 'Вы добавили товар в корзину!'
]) ?>

<div class="product-img"><img src="<?= $product->getImageUrl([100, 100]) ?>" /></div>

<div class="description">
    <ul>
        <li><b>Название: </b> <?= $product->name ?></li>
        <li><b>Количество: </b> <?= $quantity ?></li>
        <li><b>Цена :</b> <?= $product->price ?></li>
        <li><b>Общая стоимость: </b> <?= $product->price * $quantity ?></li>
    </ul>
</div>

<?php \app\widgets\Modal::end(); ?>
