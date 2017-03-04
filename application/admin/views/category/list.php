<?php

use yii\helpers\Url;
?>

<h1>Categories <a href="<?= Url::to(['category/create']) ?>" class="btn btn-default pull-right">Create category</a></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'filterModel' => $filter,
    'columns' => [
        'id',
        'name',
        [
            'attribute' => 'parentId',
            'filter' => $dropDownCategories,
            'filterInputOptions' => [
                'class' => 'form-control',
                'encode' => false
            ],
            'value' => 'parent.name'
        ],
        'createdAt',
        'updatedAt',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
]) ?>