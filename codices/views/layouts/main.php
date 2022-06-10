<?php

use codices\assets\MainCodicesBundle;
use codices\widgets\Footer;
use codices\widgets\HeaderNavbar;
use codices\widgets\MenuNavbar;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string */

MainCodicesBundle::register($this);

$subtitle = isset($this->params['subtitle']) ? $this->params['subtitle'] : '';
$tab = isset($this->params['tab']) ? $this->params['tab'] : '';

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

        <?= MenuNavbar::widget(['tab' => $tab]) ?>

        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle"><?= $subtitle ?></div>
                            <h2 class="page-title"><?= $this->title ?></h2>
                        </div>
                        <!-- Page actions -->
                        <!-- //TODO: Support page actions widget -->
                        <!--                        <div class="col-12 col-md-auto ms-auto d-print-none">-->
                        <!--                            <div class="btn-list">-->
                        <!--                  <span class="d-none d-sm-inline">-->
                        <!--                    <a href="#" class="btn btn-white">-->
                        <!--                      New view-->
                        <!--                    </a>-->
                        <!--                  </span>-->
                        <!--                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"-->
                        <!--                                   data-bs-target="#modal-report">-->
                        <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"-->
                        <!--                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"-->
                        <!--                                         stroke-linecap="round" stroke-linejoin="round">-->
                        <!--                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>-->
                        <!--                                        <line x1="12" y1="5" x2="12" y2="19"/>-->
                        <!--                                        <line x1="5" y1="12" x2="19" y2="12"/>-->
                        <!--                                    </svg>-->
                        <!--                                    Create new report-->
                        <!--                                </a>-->
                        <!--                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"-->
                        <!--                                   data-bs-target="#modal-report" aria-label="Create new report">-->
                        <!--                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"-->
                        <!--                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"-->
                        <!--                                         stroke-linecap="round" stroke-linejoin="round">-->
                        <!--                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>-->
                        <!--                                        <line x1="12" y1="5" x2="12" y2="19"/>-->
                        <!--                                        <line x1="5" y1="12" x2="19" y2="12"/>-->
                        <!--                                    </svg>-->
                        <!--                                </a>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!-- ./page actions -->
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
