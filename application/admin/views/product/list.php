<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<h1>Products <a href="<?= Url::to(['product/create'])?>" class="btn btn-default pull-right">create product</a></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider'=>$provider,
    'filterModel'=>$filter,
    'columns'=> [
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
            'attribute' => 'categoryId',
            'filter' => $dropDownCategories,
            'filterInputOptions' => [
                'class' => 'form-control',
                'encode' => false
            ],
            'value'=> 'category.name'
        ],
        'price',
        'description',
        'createdAt',
        'updatedAt',
        [
                'attribute' => 'bestseller',
                'value' => function($product){
                    if ($product->bestseller){
                        return "bestseller";
                    }else{
                        return "";
                    }
                }

        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
]) ?>
