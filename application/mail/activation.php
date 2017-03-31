<p>Активируйте свой аккаунт перейдя по
    <a href="http://<?= Yii::$app->request->hostName .  \yii\helpers\Url::to(['site/activate', 'code' => $code]) ?>">ссылке</a>
</p>