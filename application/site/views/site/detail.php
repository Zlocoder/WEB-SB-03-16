

<div id="content" class="float_r">
    <h1>Product Detail</h1>
    <div class="content_half float_l">
        <a  rel="lightbox[portfolio]" href="#"><img src="<?= $product->getImageUrl([200,200])?>" alt="image" /></a>
    </div>
    <div class="content_half float_r">
        <table>
            <tr>
                <td width="160">Price:</td>
                <td>$<?=$product->price?></td>
            </tr>
            <tr>
                <td>Availability:</td>
                <td>In Stock</td>
            </tr>
            <tr>
                <td>Model:</td>
                <td><?=$product->name?></td>
            </tr>
            <tr>
                <td>Manufacturer:</td>
                <td></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="text" value="1" style="width: 20px; text-align: right" /></td>
            </tr>
        </table>
        <div class="cleaner h20"></div>

        <a href="shoppingcart.html" class="addtocart"></a>

    </div>
    <div class="cleaner h30"></div>

    <h5>Product Description</h5>
    <p> <?=$product->description?> <a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow">CSS</a>.</p>

    <div class="cleaner h50"></div>

    <h3>Related Products</h3>
    <?php
    foreach($productSimilar as $similar){
        ?>
        <div class="product_box">
            <a href="productdetail.php"><img src="<?= $similar->getImageUrl([200,200])?>" alt="" /></a>
            <h3><?= $similar->name ?></h3>
            <p class="product_price"><?= $similar->price?></p>
            <a href="<?= Url::to(['cart/add', 'productId'=>$product->id , 'quantity' => 1])?>" class="addtocart"></a>
            <a href="productdetail.php?num=<?= $similar->id ?>" class="detail"></a>
        </div>
    <?php }?>
</div>
