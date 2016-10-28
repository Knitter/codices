<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap\Modal;
//-
use app\assets\CodicesBundle;

/* @var $this yii\web\View */
/* @var $content string */

CodicesBundle::register($this);

$title = isset($this->params['title']) ? $this->params['title'] : 'Codices';

$this->beginPage();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= Html::encode($this->title) ?></title>

        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="app app-blue">
            <aside class="app-sidebar" id="sidebar">
                <div class="sidebar-header">
                    <a class="sidebar-brand" href="#">CODICES</a>
                    <button type="button" class="sidebar-toggle">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="sidebar-menu">
                    <ul class="sidebar-nav">
                        <li class="active">
                            <a href="<?= Url::to(['books/index']) ?>">
                                <div class="icon">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                </div>
                                <div class="title"><?= Yii::t('codices', 'Books') ?></div>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?= Url::to(['authors/index']) ?>">
                                <div class="icon">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </div>
                                <div class="title"><?= Yii::t('codices', 'Authors') ?></div>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?= Url::to(['collections/index']) ?>">
                                <div class="icon">
                                    <i class="fa fa-boxes" aria-hidden="true"></i>
                                </div>
                                <div class="title"><?= Yii::t('codices', 'Collections') ?></div>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?= Url::to(['series/index']) ?>">
                                <div class="icon">
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                </div>
                                <div class="title"><?= Yii::t('codices', 'Series') ?></div>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?= Url::to(['accounts/index']) ?>">
                                <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                <div class="title"><?= Yii::t('codices', 'Accounts') ?></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <div class="app-container">

                <nav class="navbar navbar-default" id="navbar">
                    <div class="container-fluid">
                        <div class="navbar-collapse collapse in">
                            <ul class="nav navbar-nav navbar-mobile">
                                <li>
                                    <button type="button" class="sidebar-toggle">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                </li>
                                <li class="logo">
                                    <a class="navbar-brand" href="#">CODICES</a>
                                </li>
                                <li>
                                    <button type="button" class="navbar-toggle">
                                        <img class="profile-img" src="#">
                                    </button>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-left">
                                <li class="navbar-title"><?= $title ?></li>
                                <li class="navbar-search hidden-sm">
                                    <input id="search" type="text" placeholder="<?= Yii::t('codices', 'search ...') ?>">
                                    <button class="btn-search"><i class="fa fa-search"></i></button>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown profile">
                                    <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
                                        <img class="profile-img" src="">
                                        <div class="title"><?= Yii::t('codices', 'Profile') ?></div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="profile-info">
                                            <h4 class="username">@name</h4>
                                        </div>

                                        <ul class="action">
                                            <li><a href="#"><?= Yii::t('codices', 'Profile') ?></a></li>
                                            <li><a href="#"><?= Yii::t('codices', 'Logout') ?></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <?= $content ?>

                <footer class="app-footer"> 
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="footer-copyright">
                                &copy; <?= date('Y') ?> Codices. <?= Yii::t('codices', 'AGPL Licensed.') ?>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
