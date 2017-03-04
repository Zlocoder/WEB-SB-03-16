<?php

use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

$this->title = 'Login';
?>

<h2>Login</h2>

<form method="post">
    <input type="hidden" name="_csrf" value="<?= \Yii::$app->request->getCsrfToken() ?>" />

    <div class="content_half float_l checkout">
        Login
        <input type="text" name="login" value="<?= $model->login ?>" style="width: 300px;"/>
        <?php if ($model->hasErrors('login')) { ?>
            <p class="error"><?= $model->getErrors('login')[0] ?></p>
        <?php } ?>
        <br/>
        <br/>

        Password
        <input type="password" name="password" value=""  style="width: 300px;"/>
        <?php if ($model->hasErrors('password')) { ?>
            <p class="error"><?= $model->getErrors('password')[0] ?></p>
        <?php } ?>
        <br/>
        <br/>

        <button type="submit">Login</button>
    </div>
</form>
