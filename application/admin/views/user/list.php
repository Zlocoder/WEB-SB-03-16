<?php

use yii\helpers\Url;

?>
    <h1>Users <a href="<?= Url::to(['user/create']) ?>" class="btn btn-default pull-right">Create new user</a></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'filterModel' => $filter,
    'columns' => [
        'id',
        'login',
        'password',
        'createdAt',
        'updatedAt',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
]) ?>