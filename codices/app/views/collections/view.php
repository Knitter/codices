<?php

use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $account \common\models\Collection */

$this->title = 'Codices :: ' . Yii::t('codices', 'Collection Details');
$this->params = [
    'title' => Yii::t('codices', 'Book Collection Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['collections/update', 'id' => $collection->id]) ?>"><i class="fa fa-pencil"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    DetailView::widget([
        'model' => $collection,
        'attributes' => [
                [
                'attribute' => 'id',
                'label' => '#'
            ], [
                'attribute' => 'name',
                'label' => Yii::t('codices', 'Name')
            ], [
                'attribute' => 'bookCount',
                'label' => Yii::t('codices', 'Total')
            ], [
                'attribute' => 'ownCount',
                'label' => Yii::t('codices', 'Owned')
            ], [
                'attribute' => 'complete',
                'label' => Yii::t('codices', 'Complete')
            ]
        ]
    ])
    ?>
</div>
