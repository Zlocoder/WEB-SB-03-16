<?php
use yii\helpers\Url;

$this->title = 'Create category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => Url::to(['category/index'])];
$this->params['breadcrumbs'][] = 'New category';
?>

<div class="row">
    <h1 class="text-center">New category</h1>
</div>

<div class="row">
    <?php if ($model) { ?>
        <div class="col-lg-6 col-lg-offset-3">
            <?php $form = \yii\bootstrap\ActiveForm::begin([
                'enableClientValidation' => false
            ]) ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'parentId')->dropDownList($dropDownCategories, [
                    'prompt' => 'Choose parent category...',
                    'encode' => false
            ]) ?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>

            <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    <?php } else { ?>
        <p class="text-danger">Нет модели формы</p>
    <?php } ?>
</div>



