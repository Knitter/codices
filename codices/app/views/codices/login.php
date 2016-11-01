<?php

use yii\helpers\Html;
use yii\helpers\Url;

echo Html::beginForm(Url::to(['codices/login']), 'POST', ['class' => 'form-signin', 'role' => 'form'])
?>

<h3 class="form-signin-heading"><?= Yii::t('codices', 'Please Sign In') ?></h3>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-user"></i></div>
        <input type="text" class="form-control" name="Login[email]" placeholder="<?= Yii::t('codices', 'E-mail') ?>" autocomplete="off" />
    </div>
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
        <input type="password" class="form-control" name="Login[password]" placeholder="<?= Yii::t('codices', 'Password') ?>" autocomplete="off" />
    </div>
</div>

<button class="btn btn-lg btn-primary btn-block" type="submit"><?= Yii::t('codices', 'Sign in') ?></button>

<?= Html::endForm() ?>