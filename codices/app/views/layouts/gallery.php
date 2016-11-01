<?php

use yii\helpers\Html;
use yii\helpers\Url;
//-
use app\assets\CodicesBundle;

/* @var $this yii\web\View */
/* @var $content string */

CodicesBundle::register($this);

$title = isset($this->params['title']) ? $this->params['title'] : 'Codices';
$tab = isset($this->params['tab']) ? $this->params['tab'] : '';

$this->beginPage();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta content = "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name = "viewport">
        <title><?= Html::encode($this->title) ?></title>

        <!-- TODO: Download -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">

        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>

        <!--nav-->
        <nav role="navigation" class="navbar navbar-custom">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button data-target="#navmenu" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only"><?= Yii::t('codices', 'Toggle navigation') ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">Codices</a>
                </div>

                <div id="navmenu" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= Url::to(['books/gallery']) ?>"><?= Yii::t('codices', 'Gallery') ?></a></li>
                        <?php if (!Yii::$app->user->isGuest) { ?>

                            <li><a href="<?= Url::to(['codices/dashboard']) ?>"><?= Yii::t('codices', 'Dashboard') ?></a></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-user"></i> <b class="caret"></b></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li class="dropdown-header">@name</li>
                                    <li><a href="<?= Url::to(['accounts/my-account']) ?>"><?= Yii::t('codices', 'My Account') ?></a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?= Url::to(['codices/logout']) ?>"><?= Yii::t('codices', 'Logout') ?></a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-cogs"></i> <b class="caret"></b></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li class="dropdown-header"><?= Yii::t('codices', 'System') ?></li>
                                    <li><a href="<?= Url::to(['accounts/index']) ?>"><?= Yii::t('codices', 'User Accounts') ?></a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a href="<?= Url::to(['codices/login']) ?>"><i class="fa fa-lock"></i></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <?= $content ?>
        </div>

        <div class="clearfix"></div>

        <div class="site-footer">
            <div class="container">
                <div class="copyright clearfix">&copy; <?= date('Y') ?> Codices.</div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
