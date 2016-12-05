<?php
/* @var $this \yii\web\View */
/* @var $books \common\models\Book[] */

$this->title = 'Codices :: ' . Yii::t('codices', 'Gallery');
?>

<div class="row">
    <?php foreach ($books as $book) { ?>
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
            <div class="thumbnail">
                <?php if (($url = $book->photoURL)) { ?>
                    <img class="img-rounded" src="<?= $url ?>">
                <?php } ?>
                <div class="caption text-center hidden-xs">
                    <h6><?= $book->title ?></h6>
                </div>
            </div>
        </div>
    <?php } ?>
</div>