<?php

use yii\helpers\Url;
//-
use common\models\Conta;

/* @var $this yii\web\View */
/* @var $colaborador \common\models\Colaborador */

$this->title = 'Detalhes do Colaborador';

$img = Url::base() . '/images/placeholder.jpg';
if ($colaborador->fotografia) {
    $img = Url::to(['colaborador/fotografia', 'id' => $colaborador->id]);
}

$this->params = [
    'tab' => 'colaboradores',
    'titulo' => 'Detalhes do Colaborador',
    'accoes' => [
        ['Editar detalhes', ['colaborador/update', 'id' => $colaborador->id]],
        ['--'],
        ['Adicionar colaborador', ['colaborador/create']]
    ]
];
?>
<div class="row">
    <div class="col-xs-12">
        <section class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">Geral</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-bold">Nome</td>
                        <td><?= $colaborador->nome ?></td>
                        <td rowspan="5" style="width: 260px;text-align: center;"><img src="<?= $img ?>" style="width: 240px; height: auto;" /></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Franchisado(s)</td>
                        <td><?= ($grupos = $colaborador->labelListaGrupos()) ? $grupos : '- Avalibérica -' ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Telemóvel</td>
                        <td><?= $colaborador->telemovel ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Iniciais</td>
                        <td><?= $colaborador->iniciais ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Reg./Página</td>
                        <td><?= $colaborador->registos ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Administrador</td>
                        <td colspan="2"><?= $colaborador->administrador ? 'Sim' : 'Não' ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Equipas</td>
                        <td colspan="2">
                            <?php
                            if (count(($equipas = $colaborador->getEquipas()))) {
                                foreach ($equipas as $equipa) {
                                    $comercial = $equipa->getElementoComercial();
                                    echo $equipa->getElementos(), ($comercial ? ' - Contacto Comercial: <strong>' . $comercial->nome . ' </strong>' : ''), '<br />';
                                }
                            } else {
                                echo '- Não pertence a nenhuma equipa -';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="box box-primary">
            <div class="box-header with-border"><h3 class="box-title">Conta</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-bold">Conta Activa</td>
                        <td><?= $colaborador->conta->estado == Conta::ESTADO_APROVADO ? 'Sim' : 'Não' ?></td>
                    </tr>

                    <tr>
                        <td class="text-bold">E-mail</td>
                        <td><?= $colaborador->conta->email ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">N/Tentativas</td>
                        <td><?= $colaborador->conta->tentativas ?></td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="box box-warning">
            <div class="box-header with-border"><h3 class="box-title">Acessos</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <?php if (count($colaborador->conta->acessos)) { ?>
                        <tr>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th>Agente</th>
                            <th>IP</th>
                        </tr>
                        <?php foreach ($colaborador->conta->acessos as $acesso) { ?>
                            <tr>
                                <td><?= $acesso->data ?></td>
                                <td><?= $acesso->saida ?></td>
                                <td><?= $acesso->agente ?></td>
                                <td><?= $acesso->ip ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td>Sem acessos registados.</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
    </div>
</div>