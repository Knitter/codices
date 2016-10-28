<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body no-padding">
                <?=
                GridView::widget([
                    'dataProvider' => $filter->search(Yii::$app->request->get()),
                    'filterModel' => $filter,
                    'layout' => '{items} {summary} {pager}',
                    'columns' => [
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>