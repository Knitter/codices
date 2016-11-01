<?php

use \yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $account \common\models\Account */

$this->title = 'Codices :: ' . Yii::t('codices', 'Series Details');
$this->params = [
    'title' => Yii::t('codices', 'Book Series Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['series/update', 'id' => $series->id]) ?>"><i class="fa fa-pencil"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    DetailView::widget([
        'model' => $series,
        'attributes' => [
                [
                'attribute' => 'id',
                'label' => '#'
            ],
                [
                'attribute' => 'name',
                'label' => Yii::t('codices', 'Name')
            ],
                [
                'attribute' => 'bookCount',
                'label' => Yii::t('codices', 'Total')
            ],
                [
                'attribute' => 'ownCount',
                'label' => Yii::t('codices', 'Owned')
            ],
                [
                'attribute' => 'complete',
                'label' => Yii::t('codices', 'Complete')
            ]
        ]
    ])
    ?>
</div>
