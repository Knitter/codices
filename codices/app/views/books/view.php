<?php

use \yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $book \common\models\Book */

$this->title = 'Codices :: ' . Yii::t('codices', 'Book Details');
$this->params = [
    'title' => Yii::t('codices', 'Book Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['books/update', 'id' => $book->id]) ?>"><i class="fa fa-pencil"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    DetailView::widget([
        'model' => $book,
        'attributes' => [
                [
                'attribute' => 'id',
                'label' => '#'
            ],
                [
                'attribute' => 'title',
                'label' => Yii::t('codices', 'Title')
            ],
            [
                'attribute' => 'isbn',
                'label' => Yii::t('codices', 'ISBN')
            ],
            [
                'attribute' => 'pageCount',
                'label' => Yii::t('codices', 'Pages')
            ],
            [
                'attribute' => 'publicationDate',
                'label' => Yii::t('codices', 'Published at')
            ],
            [
                'attribute' => 'formatLabel',
                'label' => Yii::t('codices', 'Format')
            ],
            [
                'attribute' => 'language',
                'label' => Yii::t('codices', 'Language')
            ],
            [
                'attribute' => 'edition',
                'label' => Yii::t('codices', 'Edition')
            ],
            [
                'attribute' => 'series.name',
                'label' => Yii::t('codices', 'Series')
            ],
            [
                'attribute' => 'order',
                'label' => Yii::t('codices', 'Order')
            ],
            [
                'attribute' => 'plot',
                'label' => Yii::t('codices', 'Plot')
            ],
            [
                'attribute' => 'publisher',
                'label' => Yii::t('codices', 'Publisher')
            ],
            [
                'attribute' => 'read',
                'label' => Yii::t('codices', 'Read')
            ],
            [
                'attribute' => 'rating',
                'label' => Yii::t('codices', 'Rating')
            ],
            [
                'attribute' => 'url',
                'label' => Yii::t('codices', 'Website/URL')
            ],
            [
                'attribute' => 'review',
                'label' => Yii::t('codices', 'Review')
            ],
            [
                'attribute' => 'cover',
                'label' => Yii::t('codices', 'Cover')
            ],
            
                
        ]
    ])
    ?>
</div>
