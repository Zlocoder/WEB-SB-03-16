<?php
use yii\helpers\Url;

$this->title = ($model->scenario == 'update')? 'edit User': 'new User';
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => Url::to(['admin/index'])];
$this->params['breadcrumbs'][] = ($model->scenario == 'update')? 'edit User': 'new User';

?>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <h1><?= $this->title ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <?php $form = \yii\bootstrap\ActiveForm::begin()?>

        <?= $form->field($model, 'login')?>

        <?= $form->field($model, 'password')->passwordInput()?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right"><?= $model->scenario == 'update'? 'edit': 'save'; ?></button>
        </div>

        <? \yii\bootstrap\ActiveForm::end()?>
    </div>
</div>
