<?php
/* @var $this \yii\web\View */
/* @var $books \common\models\Book[] */

$this->title = 'Codices :: ' . Yii::t('codices', 'Gallery');
?>

<div class="row">
    <?php foreach ($books as $book) { ?>
        <?php if (($url = $book->photoURL)) { ?>
            <div class="col-xs-3 col-md-2 col-lg-1">
                <div class="thumbnail">
                    <img class="img-rounded" src="<?= $url ?>">
                    <div class="caption text-center">
                        <h3><?= $book->title ?></h3>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>