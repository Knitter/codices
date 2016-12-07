<?php

use common\models\Book;

/* @var $this \yii\web\View */
/* @var $books \common\models\Book[] */

$ordered = [];
foreach ($books as $book) {
    $key = mb_strtoupper(mb_substr($book->title, 0, 1));
    if (is_numeric($key)) {
        $ordered['#'][] = $book;
    } else {
        $ordered[$key][] = $book;
    }
}

ksort($ordered, SORT_STRING);

$keys = array_keys($ordered);
?>

<div class="panel">
    <div class="panel-body text-center">
        <?php foreach ($keys as $key) { ?>
            <a class="book-index-key" href="#<?= $key ?>"><?= $key ?></a>
        <?php } ?>
    </div>
</div>
<?php foreach ($ordered as $key => $rows) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-info"><div class="panel-body"><a name="<?= $key ?>"></a><strong><?= $key ?></strong></div></div>
        </div>

        <?php foreach ($rows as $book) { ?>

            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                <div class="thumbnail">
                    <?php if ($book->isCoverFileAvailable) { ?>
                        <img class="img-rounded" src="<?= $book->coverURL ?>">
                    <?php } ?>
                    <div class="caption text-center hidden-xs">
                        <h6><?= $book->title ?></h6>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>