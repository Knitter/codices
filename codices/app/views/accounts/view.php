<?php

use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $account \common\models\Account */

$this->title = 'Codices :: ' . Yii::t('codices', 'Account Details');
$this->params = [
    'title' => Yii::t('codices', 'Account Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['accounts/update', 'id' => $account->id]) ?>"><i class="fa fa-pencil"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    DetailView::widget([
        'model' => $account,
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
                'attribute' => 'email',
                'label' => Yii::t('codices', 'E-mail'),
                'format' => 'email'
            ]
        ]
    ])
    ?>
</div>
