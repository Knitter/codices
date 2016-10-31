<?php
/* @var $this yii\web\View */
/* @var $categoria \common\models\Categoria */

$this->title = 'Editar Categoria';

$this->params = [
    'tab' => 'categorias',
    'titulo' => 'Editar Categoria',
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
