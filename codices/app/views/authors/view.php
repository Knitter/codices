<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $author \common\models\Author */

$this->title = 'Codices :: ' . Yii::t('codices', 'Author Details');
$this->params = [
    'title' => Yii::t('codices', 'Author Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['authors/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['authors/update', 'id' => $author->id]) ?>"><i class="fa fa-pencil"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['authors/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <td><?= $author->id ?></td>
            <td rowspan="4" class="text-center" style="width: 180px;">
                <?php if (($url = $author->photoURL)) { ?>
                    <img class="img-rounded preview" src="<?= $url ?>">
                <?php } ?>
            </td>
        </tr>

        <tr><th><?= Yii::t('codices', 'Name') ?></th><td><?= $author->fullName ?></td></tr>

        <tr>
            <th><?= Yii::t('codices', 'Website/URL') ?></th>
            <td>
                <?php if ($author->url) { ?>
                    <a href="<?= $author->url ?>" target="_blank"><?= $author->url ?> <i class="fa fa-external-link"></i></a>
                    <?php }  ?>
            </td>
        </tr>

        <tr><th><?= Yii::t('codices', 'Biography') ?></th><td><?= $author->biography ?></td></tr>
    </table>
</div>
