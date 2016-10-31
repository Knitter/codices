<?php
/* @var $this yii\web\View */
/* @var $categoria \common\models\Categoria */

$this->title = 'Nova Categoria';

$this->params = [
    'tab' => 'categorias',
    'titulo' => 'Nova Categoria',
    'accoes' => [
        ['Nova categoria', ['categoria/create']]
    ]
];
?>

<div class="row">
    <div class="col-xs-12">
        <?= $this->render('_form', [ 'categoria' => $categoria]) ?>
    </div>
</div>