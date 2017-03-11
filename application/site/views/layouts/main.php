<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use site\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div id="templatemo_body_wrapper">
        <div id="templatemo_wrapper">
            <div id="templatemo_header">
                <div id="site_title"><h1><a href="#">Online Shoes Store</a></h1></div>

                <div id="header_right">
                    <p>
                        <a href="#">My Wishlist</a> |
                        <a href="#" id="colProduct">My Cart</a> |
                        <a href="#">Checkout</a> |
                        <?php if(\Yii::$app->user->isGuest){?>
                            <a href="<?= Url::to(['site/login'])?>">Log In</a></p>
                        <?php }else{ ?>
                            <a href="#">My Account (<?= \Yii::$app->user->identity->login ?>)</a>
                            <a href="<?= Url::to(['site/logout']) ?>">Logout</a>
                        <?php } ?>
                    <p>
                        Shopping Cart: <strong id="cart-count"><?= $this->params['cartQuantity'] ?>
                            items</strong> ( <a href="<?= Url::to(['cart/index']) ?>">Show Cart</a> )
                    </p>
                </div>
                <div class="cleaner"></div>
            </div>

            <div id="templatemo_menubar">
                <div id="top_nav" class="ddsmoothmenu">
                    <ul>
                        <li><a href="<?=Yii::$app->homeUrl?>" class="selected">Home</a></li>
                        <li><a href="<?=Url::to(['catalog/products'])?>">Products</a>
                            <ul>
                                <li><a href="#submenu1">Sub menu 1</a></li>
                                <li><a href="#submenu2">Sub menu 2</a></li>
                                <li><a href="#submenu3">Sub menu 3</a></li>
                                <li><a href="#submenu4">Sub menu 4</a></li>
                                <li><a href="#submenu5">Sub menu 5</a></li>
                            </ul>
                        </li>
                        <li><a href="about.html">About</a>
                            <ul>
                                <li><a href="#submenu1">Sub menu 1</a></li>
                                <li><a href="#submenu2">Sub menu 2</a></li>
                                <li><a href="#submenu3">Sub menu 3</a></li>
                            </ul>
                        </li>
                        <li><a href="faqs.html">FAQs</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                    <br style="clear: left" />
                </div>

                <div id="templatemo_search">
                    <form action="<?= Url::to(['catalog/search'])?>" method="get">
                        <input type="text"  name="keyword" id="keyword" title="keyword"  class="txt_field" />
                        <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
                    </form>
                </div>
            </div>

            <div id="templatemo_main">
                <div id="sidebar" class="float_l">
                    <?php if (!empty($this->params['asideCategories'])) { ?>
                        <div class="sidebar_box"><span class="bottom"></span>
                            <h3>Categories</h3>
                            <div class="content">
                                <ul class="sidebar_list">
                                    <?php foreach ($this->params['asideCategories'] as $category) { ?>
                                        <li><a href="<?= Url::to(['catalog/products'])?>?category=<?= $category->id?>"><?= $category->name ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($this->params['bestsellers'])) { ?>
                    <div class="sidebar_box"><span class="bottom"></span>
                        <h3>Bestsellers </h3>
                        <div class="content">
                            <?php foreach ($this->params['bestsellers'] as $product) { ?>
                            <div class="bs_box">
                                <a href="<?= Url::to(['catalog/product-details', 'productId' => $product->id]) ?>"><img src="<?= $product->getImageUrl([50, 50]) ?>" alt="<?= $product->name ?>" /></a>
                                <h4><a href="<?= Url::to(['catalog/product-details', 'productId' => $product->id]) ?>"><?= $product->name ?></a></h4>
                                <p class="price">$ <?= $product->price ?></p>
                                <div class="cleaner"></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div id="content" class="float_r">
                    <?= $content ?>
                </div>

                <div class="cleaner"></div>
            </div>

            <div id="templatemo_footer">
                <p><a href="#">Home</a> | <a href="#">Products</a> | <a href="#">About</a> | <a href="#">FAQs</a> | <a href="#">Checkout</a> | <a href="#">Contact Us</a>
                </p>

                Copyright © 2072 <a href="#">Your Company Name</a>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

