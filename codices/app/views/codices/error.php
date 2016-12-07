<?php
/* @var $name string */
/* @var $message string */
/* @var $exception \Exception */
/* @var $this \yii\web\View */

$name = $exception->getCode();
$code = filter_var($name, FILTER_SANITIZE_NUMBER_INT);

$this->title = 'Codices :: ' . Yii::t('codices', 'Error {error}', ['error' => $code]);
$this->params = [
    'title' => $message,
    'tab' => 'dashboard'
];
?>

<div class="box-body">
    <p class="well"><?= nl2br($exception) ?></p>
</div>