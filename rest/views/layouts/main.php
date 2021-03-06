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
                <div id="navmenu" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?= Yii::t('codices', 'Gallery') ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?= Url::to(['books/gallery']) ?>"><?= Yii::t('codices', 'All Books') ?></a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header"><?= Yii::t('codices', 'Grouped by') ?></li>
                                <li><a href="<?= Url::to(['books/gallery', 'mode' => 'author']) ?>"><?= Yii::t('codices', 'Author') ?></a></li>
                                <li><a href="<?= Url::to(['books/gallery', 'mode' => 'genre']) ?>"><?= Yii::t('codices', 'Genre') ?></a></li>
                                <li><a href="<?= Url::to(['books/gallery', 'mode' => 'series']) ?>"><?= Yii::t('codices', 'Series') ?></a></li>
                                <li><a href="<?= Url::to(['books/gallery', 'mode' => 'title']) ?>"><?= Yii::t('codices', 'Title') ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-user"></i> <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li class="dropdown-header"><?= Yii::$app->user->identity->name ?></li>
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
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
                    <ul class="list-group panel">
                        <li class="list-group-item"><i class="fa fa-align-justify"></i> <b><?= Yii::t('codices', 'MENU') ?></b></li>

                        <!-- SEARCH FORM -->
                        <!-- <li class="list-group-item">
                            <input type="text" class="form-control search-query" placeholder="<?= Yii::t('codices', 'search ...') ?>">
                        </li> -->

                        <li class="list-group-item"><a href="<?= Url::to(['codices/dashboard']) ?>"><i class="fa fa-home"></i><?= Yii::t('codices', 'Dashboard') ?></a></li>
                        <li class="list-group-item"><a href="<?= Url::to(['books/index']) ?>"><i class="fa fa-book"></i><?= Yii::t('codices', 'Books') ?></a></li>
                        <li class="list-group-item"><a href="<?= Url::to(['authors/index']) ?>"><i class="fa fa-pencil"></i><?= Yii::t('codices', 'Authors') ?></a></li>
                        <li class="list-group-item"><a href="<?= Url::to(['series/index']) ?>"><i class="fa fa-bookmark"></i><?= Yii::t('codices', 'Series') ?></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-9 content">

                    <?php
                    if (Yii::$app->session->hasFlash('failure') || Yii::$app->session->hasFlash('success')) {
                        $type = 'success';
                        $msg = Yii::$app->session->getFlash('success');
                        if (($msg2 = Yii::$app->session->getFlash('failure'))) {
                            $type = 'warning';
                        }

                        $msg = $msg2 ?: $msg;
                        $this->registerJs('setTimeout(function(){ $("#msg-alert").alert("close"); }, 3000);');
                        ?>

                        <div id="msg-alert" class="alert alert-dismissible fade in alert-<?= $type ?>">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?= nl2br($msg) ?>
                        </div>
                    <?php } ?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa "></i> </a> <?= $title ?></h3>
                        </div>

                        <div class="panel-body">
                            <div class="content-row"><?= $content ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="site-footer">
            <div class="container">
                <div class="copyright clearfix">&copy; <?= date('Y') ?> Codices. v<?= Yii::$app->version ?></div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
