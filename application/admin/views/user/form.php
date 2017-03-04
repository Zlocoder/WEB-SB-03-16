<?php
use yii\helpers\Url;

$this->title = 'Create user';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => Url::to(['user/index'])];
$this->params['breadcrumbs'][] = 'New user';
?>

<div class="row">
    <h1 class="text-center">New user</h1>
</div>

<div class="row">
    <?php if ($model) { ?>
        <div class="col-lg-6 col-lg-offset-3">
            <?php $form = \yii\bootstrap\ActiveForm::begin([
                'enableClientValidation' => false,
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]) ?>

            <?= $form->field($model, 'login') ?>

            <?= $form->field($model, 'password') ?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>

            <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    <?php } else { ?>
        <p class="text-danger">Нет модели формы</p>
    <?php } ?>
</div>
