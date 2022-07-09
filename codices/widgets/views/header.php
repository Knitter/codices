<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
?>
<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="<?= Yii::$app->homeUrl ?>">
                <img src="" width="110" height="32" alt="Codices" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                   aria-label="Open user menu">
                    <span class="avatar avatar-sm avatar-element"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= Yii::$app->user->identity->login ?></div>
                        <div class="mt-1 small text-muted"><?= Yii::$app->user->identity->name ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="<?= Url::to(['/account/profile']) ?>"
                       class="dropdown-item"><?= Yii::t('codices', 'Account') ?></a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= Url::to(['/site/logout']) ?>"
                       class="dropdown-item"><?= Yii::t('codices', 'Logout') ?></a>
                </div>
            </div>
        </div>
    </div>
</header>