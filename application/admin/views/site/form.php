<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<? if(!empty($name)){?> <p>вы ввели имя: <?= $name ?> email: <?= $email ?></p><?}?>
<?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart\form-data']]); ?>
    <?= $f->field($form, 'name') ?>
    <?= $f->field($form, 'email') ?>
    <?= $f->field($form, 'file')->fileInput() ?>
    <?= Html::submitButton('отправить')?>
<?php $f = ActiveForm::end(); ?>
