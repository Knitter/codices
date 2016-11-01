<?php

use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $author \common\models\Author */

$this->title = 'Codices :: ' . Yii::t('codices', 'Author Details');
$this->params = [
    'title' => Yii::t('codices', 'Author Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['authors/update', 'id' => $author->id]) ?>"><i class="fa fa-pencil"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    DetailView::widget([
        'model' => $author,
        'attributes' => [
                [
                'attribute' => 'id',
                'label' => '#'
            ], [
                'attribute' => 'fullName',
                'label' => Yii::t('codices', 'Name')
            ], [
                'attribute' => 'url',
                'label' => Yii::t('codices', 'Website/URL'),
                'format' => 'url'
            ], [
                'attribute' => 'biography',
                'label' => Yii::t('codices', 'Biography')
            ], [
                'attribute' => 'photo',
                'label' => Yii::t('codices', 'Photo')
            ]
        ]
    ])
    ?>
</div>
