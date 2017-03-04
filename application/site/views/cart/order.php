
<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'My order';
?>

<h1>Order</h1>

<table width="680px" cellspacing="0" cellpadding="5">
    <tbody>
    <tr bgcolor="#ddd">
        <th width="220" align="left">Image </th>
        <th width="180" align="left">Description </th>
        <th width="100" align="center">Quantity </th>
        <th width="60" align="right">Price </th>
        <th width="60" align="right">Total </th>
        <th width="90"> </th>
    </tr>

    <?php foreach ($cart->getProductsList() as $product) { ?>
        <tr>
            <td><img src="<?= $product->getImageUrl([100, 100]) ?>" alt="<?= $product->name ?>"></td>
            <td><a href="<?= Url::to(['site/detail', 'productId' => $product->id]) ?>" rel="nofollow"><?= $product->name ?></a></td>
            <td align="center">
                <input class="cart-quantity" data-url="<?= Url::to(['cart/quantity', 'productId' => $product->id]) ?>" type="text" value="<?= $cart->getProductCount($product->id) ?>" style="width: 20px; text-align: right">
            </td>
            <td align="right"><?= $product->price ?></td>
            <td align="right"><?= $product->price * $cart->getProductCount($product->id) ?></td>
            <td align="center"><a class="cart-remove" href="<?= Url::to(['cart/delete', 'productId' => $product->id]) ?>"><img src="images/remove_x.gif" alt="remove"><br>Remove</a> </td>
        </tr>
    <?php } ?>

    <tr>
        <td colspan="3" align="right" height="30px">Have you modified your basket? Please click here to <a href="shoppingcart.html"><strong>Update</strong></a>&nbsp;&nbsp;</td>
        <td align="right" style="background:#ddd; font-weight:bold"> Total </td>
        <td id="cart-total" align="right" style="background:#ddd; font-weight:bold"><?= $cart->getProductsTotal() ?></td>
        <td style="background:#ddd; font-weight:bold"></td>
    </tr>
    </tbody>
</table>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'address') ?>
    <?= Html::submitButton('оформить')?>

<?php  ActiveForm::end() ?>