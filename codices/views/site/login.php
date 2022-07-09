<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<?= Html::beginForm(['login'], 'POST', ['class' => 'card card-md', 'autocomplete' => 'off']) ?>
    <div class="card-body">
        <h2 class="card-title text-center mb-4"><?= Yii::t('codices', 'Codices Access') ?></h2>
        <div class="mb-3">
            <label class="form-label" for="email-field"><?= Yii::t('codices', 'Login or Email address') ?></label>
            <input type="text" class="form-control"
                   placeholder="<?= Yii::t('codices', 'Enter account login or email') ?>"
                   id="email-field"
                   autocomplete="off"
                   name="Authentication[accessId]">
        </div>
        <div class="mb-2">
            <label class="form-label" for="password-field">
                <?= Yii::t('codices', 'Password') ?>
                <?php if (false) { ?>
                    <!-- //TODO: Add password reset feature -->
                    <span class="form-label-description">
                    <a href="#"><?= Yii::t('codices', 'I forgot password') ?></a>
                </span>
                <?php } ?>
            </label>
            <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="<?= Yii::t('codices', 'Password') ?>"
                       autocomplete="off" id="password-field" name="Authentication[password]">

                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="<?= Yii::t('codices', 'Show password') ?>"
                     data-bs-toggle="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
                    </svg>
                  </a>
                </span>
            </div>
        </div>
        <?php if (false) { ?>
            <!-- TODO: Add "remember me" feature -->
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input"/>
                    <span class="form-check-label"><?= Yii::t('codices', 'Remember me on this device') ?></span>
                </label>
            </div>
        <?php } ?>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100"><?= Yii::t('codices', 'Sign in') ?></button>
        </div>
    </div>
<?= Html::endForm();