<?php

use yii\helpers\Html;
//-
use app\assets\CodicesBundle;

/* @var $this yii\web\View */
/* @var $content string */

CodicesBundle::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta content = "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name = "viewport">
        <title>Codices</title>

        <!-- TODO: Download -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">

        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>

        <style>
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #303641;
                color: #C1C3C6
            }
        </style>
    </head>

    <body>
        <?php $this->beginBody() ?>

        <div class="container"><?= $content ?></div>

        <div class="clearfix"></div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
