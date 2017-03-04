<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<h1>Products <a href="<?= Url::to(['product/create']) ?>" class="btn btn-default pull-right">Create Product</a></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'filterModel' => $filter,
    'columns' => [
        'id',
        [
            'attribute' => 'image',
            'value' => function($product) {
                return Html::img($product->getImageUrl([50, 50]));
            },
            'format' => 'html'
        ],
        'name',
        [
            'attribute' => 'category',
            'filter' => $dropDownCategories,
            'filterInputOptions' => [
                'class' => 'form-control',
                'encode' => false
            ],
            'value' => 'category.name'
        ],
        'price',
        'createdAt',
        'updatedAt',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
]) ?>