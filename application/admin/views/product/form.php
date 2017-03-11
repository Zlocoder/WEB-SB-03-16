<?php

use yii\helpers\Url;

    $this->title = ($model->scenario == 'update')? 'edit product':'new product';
    $this->params['breadcrumbs'][] = ['label' => 'products', 'url' => Url::to(['product/index'])];
    $this->params['breadcrumbs'][] = ($model->scenario == 'update')? 'edit product': 'new product';

?>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <h1><?= $this->title ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'enableClientValidation' => false
        ])?>
        
        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'image')->fileInput([
            'class'=>'form-control',
            'accept'=>'image/jpg, image/png, image/jpeg'
        ])?>

        <?php if ($model->image) { ?>
            <div class="form-group">
                <img src="<?= $model->image ?>" />
            </div>

            <?= $form->field($model, 'deleteImage')->checkbox() ?>
        <?php } ?>
        
        <?= $form->field($model, 'categoryId')->dropDownList($dropDownCategories, [
            'prompt' => 'choose category',
            'encode' => false
        ]) ?>

        <?= $form->field($model, 'categories')->dropDownList($dropDownCategories, [
            'encode' => false,
            'multiple' => true,
            'size' => 10
        ]); ?>

        <?= $form->field($model, 'price') ?>

        <?= $form->field($model, 'description') ?>

        <?= $form->field($model, 'bestseller')->checkbox() ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right"><?= $model->scenario == 'update'? 'edit': 'save'; ?></button>
        </div>

        <? \yii\bootstrap\ActiveForm::end()?>
    </div>
</div>


    