<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $books \common\models\Book[] */

$this->registerJs('codices.initGalleryModal("#bookdetails");');
?>

<div class="row">
    <?php foreach ($books as $book) { ?>
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
            <div class="thumbnail">
                <?php if ($book->isCoverFileAvailable) { ?>
                    <a href="<?= Url::to(['books/details', 'id' => $book->id]) ?>" data-remote="false" data-toggle="modal" data-target="#bookdetails">
                        <img class="img-rounded" src="<?= $book->coverURL ?>">
                    </a>
                <?php } else { ?>

                <?php } ?>
                <div class="caption text-center hidden-xs">
                    <h6><?= $book->title ?></h6>
                </div>
            </div>
        </div>
    <?php } ?>
</div>