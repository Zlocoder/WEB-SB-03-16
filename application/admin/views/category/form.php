<?php

use yii\helpers\Url;

    $this->title = ($model->scenario == 'update') ? 'update category' : 'create category' ;
    $this->params['breadcrumbs'][] = ['label'=>'categories', 'url'=>Url::to(['category/index'])];
    $this->params['breadcrumbs'][] = ($model->scenario == 'update') ? 'Update category' : 'New category' ;

?>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<div class="row">
<?php if ($model) { ?>
    <div class="col-lg-6 col-lg-offset-3">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'enableClientValidation' => false,
        ]) ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'parentId')->dropDownList($dropDownCategories, [
            'prompt' => 'Choose parent category...',
            'encode' => false
        ]) ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right"><?= $model->scenario == 'update'? 'edit': 'save'; ?></button>
        </div>

        <?php \yii\bootstrap\ActiveForm::end() ?>
    </div>
<?php } else { ?>
    <p class="text-danger">Нет модели формы</p>
<?php } ?>
</div>
