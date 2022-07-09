<?php

use codices\assets\MainCodicesBundle;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string */

MainCodicesBundle::register($this);

$this->beginPage();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <title><?= Html::encode($this->title) ?></title>

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>
    </head>

    <body class=" border-top-wide border-primary d-flex flex-column">
    <?php $this->beginBody() ?>

    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="#" class="navbar-brand navbar-brand-autodark">
                    <!-- //TODO: Add application logo  <img src="./static/logo.svg" height="36" alt=""> -->
                </a>
            </div>
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage();
