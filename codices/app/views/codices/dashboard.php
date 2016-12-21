<?php
/* @var $topAuthors array */
/* @var $readPercent float */
/* @var $topLanguages array */

$this->title = 'Codices :: ' . Yii::t('codices', 'Dashboard');
$this->params = [
    'title' => Yii::t('codices', 'Dashboard'),
    'tab' => 'dashboard'
];

$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js');

$names = [];
$authorTotals = [];
foreach ($topAuthors as $row) {
    $names[] = "'" . $row['name'] . ($row['surname'] ? ' ' . $row['surname'] : '') . "'";
    $authorTotals[] = $row['total'];
}

$names = implode(', ', $names);
$label = Yii::t('codices', 'Top 5 Authors');
$authorTotals = implode(', ', $authorTotals);
$authorsData = "{ labels: [ {$names} ], datasets: [{ label: '{$label}', data: [{$authorTotals}], backgroundColor: [ 'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)' ], borderColor: [ 'rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)' ], borderWidth: 1 }] }";

$languages = [];
$languagesTotals = [];
foreach ($topLanguages as $row) {
    $languages[] = "'" . $row['language'] . "'";
    $languagesTotals[] = $row['total'];
}

$languages = implode(', ', $languages);
$languagesTotals = implode(', ', $languagesTotals);
$languagesData = "{ labels: [ {$languages} ], datasets: [ { data: [{$languagesTotals}], backgroundColor: [  'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)' ], hoverBackgroundColor: [ 'rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)' ] }] }";


$js = <<<JS
    Chart.defaults.global.responsive = true;
    new Chart($('#topautors').get(0).getContext('2d'), { type: 'bar', data: {$authorsData}, options: { scales: { yAxes: [{ ticks: {  beginAtZero: true } }] }} });
    new Chart($('#languages').get(0).getContext('2d'), { type: 'pie', data: {$languagesData} });
JS;

$this->registerJs($js);
?>

<div class="progress">
    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $readPercent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $readPercent ?>%">
        <?= $readPercent ?>% <?= Yii::t('codices', 'Read') ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <canvas id="topautors"></canvas>
    </div>

    <div class="col-xs-12 col-sm-6">
        <canvas id="languages" height="260"></canvas>
    </div>
</div>