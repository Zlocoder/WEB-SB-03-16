<?php

use yii\helpers\Url;

?>

<hi>Admins list <a href="<?= Url::to(['admin/create'])?>" class="btn btn-default pull-right"> Create User</a></hi>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filter,
    'columns' =>[
        'id',
        'login',
        'createdAt',
        'updatedAt',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
])?>
