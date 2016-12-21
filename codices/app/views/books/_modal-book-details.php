<?php

use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$btnClose = Yii::t('codices', 'Close');

Modal::begin([
    'id' => 'bookdetails',
    'header' => '<h4 class="model-title"></h4>'
]);
?>

<!-- //NOTE: Content loaded from an AJAX call -->

<?php
Modal::end();
