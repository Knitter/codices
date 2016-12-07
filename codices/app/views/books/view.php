<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $book \common\models\Book */

$this->title = 'Codices :: ' . Yii::t('codices', 'Book Details');
$this->params = [
    'title' => Yii::t('codices', 'Book Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['books/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['books/update', 'id' => $book->id]) ?>"><i class="fa fa-pencil"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['books/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <td><?= $book->id, ' - ', $book->addedOn ?></td>
            <td rowspan="7" class="text-center" style="width: 180px;">
                <?php if ($book->isCoverFileAvailable) { ?>
                    <img class="img-rounded preview" src="<?= $book->coverURL ?>">
                <?php } ?>
            </td>
        </tr>

        <tr><th><?= Yii::t('codices', 'Title') ?></th><td><?= $book->title ?></td></tr>

        <tr>
            <th><?= Yii::t('codices', 'Website/URL') ?></th>
            <td>
                <?php if ($book->url) { ?>
                    <a href="<?= $book->url ?>" target="_blank"><?= $book->url ?> <i class="fa fa-external-link"></i></a>
                <?php } ?>
            </td>
        </tr>

        <tr><th><?= Yii::t('codices', 'ISBN') ?></th><td><?= $book->isbn ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Rating') ?></th><td><?= $book->rating ?></td></tr>

        <tr>
            <th><?= Yii::t('codices', 'Author') ?></th>
            <td>
                <?php if ($book->authorId) { ?>
                    <a href="<?= Url::to(['authors/view', 'id' => $book->authorId]) ?>"><?= $book->author->fullName ?></a>
                <?php } else { ?>
                    //TODO: action button to add author
                <?php } ?>
            </td>
        </tr>

        <tr>
            <th><?= Yii::t('codices', 'Series') ?></th>
            <td>
                <?php if ($book->seriesId) { ?>
                    #<?= $book->order ?>, <a href="<?= Url::to(['series/view', 'id' => $book->seriesId]) ?>"><?= $book->series->name ?></a>
                <?php } else { ?>
                    //TODO: action button to add series
                <?php } ?>
            </td>
        </tr>
        <tr><th><?= Yii::t('codices', 'Plot') ?></th><td colspan="2"><?= $book->plot ?></td></tr>

        <tr>
            <th><?= Yii::t('codices', 'Publication') ?></th>
            <td colspan="2">
                <?=
                ($book->edition ? ($book->edition . ', ') : ''),
                ($book->publicationDate ? ($book->publicationDate . ', ') : ''),
                ($book->publisher ?: '')
                ?>
            </td>
        </tr>

        <tr><th><?= Yii::t('codices', 'Language') ?></th><td colspan="2"><?= $book->language ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Format') ?></th><td colspan="2"><?= $book->formatLabel ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Pages') ?></th><td colspan="2"><?= $book->pageCount ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Read') ?></th><td colspan="2"><i class="fa <?= $book->read ? 'fa-check' : 'fa-times' ?>"></i></td></tr>
                <?php if ($book->copies > 1) { ?>
            <tr><th><?= Yii::t('codices', 'Copies') ?></th><td colspan="2"><?= $book->copies ?></td></tr>
        <?php } ?>
        <tr><th><?= Yii::t('codices', 'Review') ?></th><td colspan="2"><?= $book->review ?></td></tr>
    </table>
</div>