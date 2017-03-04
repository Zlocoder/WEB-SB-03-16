<?php
use yii\helpers\Url;

$this->title = 'Create product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => Url::to(['product/index'])];
$this->params['breadcrumbs'][] = 'New product';
?>

<div class="row">
    <h1 class="text-center">New product</h1>
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

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'image')->fileInput([
                'class' => 'form-control',
                'accept' => 'image/jpg, image/png, image/jpeg'
            ]) ?>

            <?php if ($model->image) { ?>
                <div class="form-group">
                    <img src="<?= $model->image ?>" />
                </div>

                <?= $form->field($model, 'deleteImage')->checkbox() ?>
            <?php } ?>

            <?= $form->field($model, 'categoryId')->dropDownList($dropDownCategories, [
                'prompt' => 'Choose parent category...',
                'encode' => false
            ]) ?>

            <?= $form->field($model, 'categories')->dropDownList($dropDownCategories, [
                'encode' => false,
                'multiple' => true,
                'size' => 10
            ]); ?>

            <?= $form->field($model, 'price') ?>

            <?= $form->field($model, 'description')->textarea() ?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>

            <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    <?php } else { ?>
        <p class="text-danger">Нет модели формы</p>
    <?php } ?>
</div>
