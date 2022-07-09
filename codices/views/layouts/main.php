<?php

use codices\assets\MainCodicesBundle;
use codices\widgets\Footer;
use codices\widgets\HeaderNavbar;
use codices\widgets\MenuNavbar;
use codices\widgets\PageActionBar;
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

    <body>
    <?php $this->beginBody() ?>

    <div class="page">

        <?= HeaderNavbar::widget() ?>

        <?= MenuNavbar::widget(['tab' => $this->params['tab'] ?? '']) ?>

        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle"><?= $this->params['subtitle'] ?? '' ?></div>
                            <h2 class="page-title"><?= $this->title ?></h2>
                        </div>

                        <?= PageActionBar::widget(['actions' => $this->params['actions'] ?? []]) ?>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <?= $content ?>
                </div>

                <?= Footer::widget() ?>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage();
