<?php
/* @var $this yii\web\View */
/* @var $movel app\models\forms\Movel */
/* @var $processo common\models\Processo */

$verba = $movel->verba;
$processo = $verba->processo;

$this->title = $processo->referencia . ': Verba Móvel N/' . $verba->numeroVerba;

$url = \Yii::$app->getUrlManager();
$this->params = [
    'tab' => 'moveis',
    'processo' => $processo,
    'titulo' => 'Verba Móvel N/' . $verba->numeroVerba,
    'subtitulo' => $processo->identificacao,
    'accoes' => [
        ['Editar detalhes', ['movel/update', 'id' => $movel->id], 'fa-pencil'],
        ['--'],
        ['Adicionar bem móvel', ['movel/create', 'id' => $processo->id]],
        ['--'],
        ['Gerar documentos', '#', 'fa-briefcase', ['data-toggle' => 'modal', 'data-target' => '#modal-docs-moveis']],
    ]
];

$this->registerCssFile($url->baseUrl . '/plugins/lightbox/lightbox.min.css');
$this->registerJsFile($url->baseUrl . '/plugins/lightbox/lightbox.min.js', ['depends' => 'yii\web\JqueryAsset']);
?>
<div class="row">
    <div class="col-xs-12">
        <section class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">Geral</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-bold"style="width: 25%;">N/Verba</td>
                        <td class="text-bold text-danger text-uppercase"><?= $verba->numeroVerba ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Aditamento</td>
                        <td>
                            <?php
                            if ($verba->idAditamento) {
                                $aditamento = $verba->aditamento;
                                echo $aditamento->numAditamento, ' - ', $aditamento->labelTipoDocumento();
                            } else {
                                echo 'Sem aditamento';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">Descrição</td>
                        <td class="text-justify"><?= $verba->descricaoComposta ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Localização das Chaves</td>
                        <td><?= $movel->localizacaoChaves ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Localização</td>
                        <td><?= $movel->localizacao ?></td>
                    </tr>
                    <tr>
                        <td>Localização em Venda</td>
                        <td><?= $movel->localizacaoVenda ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Coordenadas</td>
                        <td><?= ($movel->latitude && $movel->longitude) ? $movel->latitude . '; ' . $movel->longitude : '' ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Verba de Terceiros</td>
                        <td><?= $verba->titularTerceiro ? : 'Não' ?></td>
                    </tr>

                    <tr>
                        <td class="text-bold">Apreensão plena</td>
                        <td><?= $verba->apreensaoPlenaCIRE ? 'Sim' : 'Não' ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Excluída de Documentos</td>
                        <td><?= $verba->excluida ? 'Sim' : 'Não' ?></td>
                    </tr>

                    <tr>
                        <td class="text-bold">Observações</td>
                        <td><?= $verba->observacoes ?></td>
                    </tr>

                    <td class="text-bold">Nota em Venda</td>
                    <td><?= $verba->notaSite ?></td>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="box box-danger">
            <div class="box-header with-border"><h3 class="box-title">Valores</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-bold" style="width: 25%;">Valor de Liquidação</td>
                        <td style="width: 25%;"><?= number_format($verba->valorLiquidacao, 2, ',', '.') ?> &euro;</td>
                        <td class="text-bold" style="width: 25%;">Valor de Continuidade</td>
                        <td style="width: 25%;"><?= number_format($movel->valorContinuidade, 2, ',', '.') ?> &euro;</td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="box box-warning">
            <div class="box-header with-border"><h3 class="box-title">Outras Informações</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-bold">N/Série</td>
                        <td><?= $movel->numeroSerie ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Estado de Conservação</td>
                        <td><?= $movel->verba->labelEstadoConservacao() ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">N/Horas</td>
                        <td><?= $movel->numeroHoras ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">IVA</td>
                        <td><?= $movel->iva ?></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="box box-warning">
            <div class="box-header with-border"><h3 class="box-title">Ónus</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-bold">Locador</td>
                        <td style="width: 25%;"><?= $movel->locador ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold">Credor(es) Hipotecário(s)</td>
                        <td>
                            <?php
                            $credores = [];
                            foreach ($verba->credores as $credor) {
                                $credores[] = $credor->nome . ' - ' . $credor->contactos;
                            }

                            echo implode('<br />', $credores);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">Outros Ónus</td>
                        <td><?= $movel->onus ?></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="box box-info">
            <div class="box-header with-border"><h3 class="box-title">Fotografias</h3></div>
            <div class="box-body">
                <?php
                $fotografias = $movel->verba->getFotos()->orderBy('ordem')->all();
                if (count($fotografias) > 0) {
                    foreach ($fotografias as $foto) {
                        ?>
                        <div style="display: inline-block; float: left;margin: 2px 1px 1px 2px;">
                            <a href="<?= $url->createUrl(['foto/versao-privada', 'id' => $foto->id]) ?>" data-lightbox="fotos">
                                <img class="img-responsive" style="width: 154px; height: 115px;" src="<?= $url->createUrl(['foto/versao-privada', 'id' => $foto->id]) ?>" alt="Foto nr. <?= $foto->ordem ?> do imóvel."/>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>

<?php
if ($processo->isProcessoInsolvencia()) {
    if ($processo->processoJudicial->proprietario->codigoDocumentos == 'apd') {
        echo $this->render('_modal-docs-insolvencia-angelo-dias', ['processo' => $processo]);
    } else {
        echo $this->render('_modal-docs-insolvencia', ['processo' => $processo]);
    }
} else {
    echo $this->render('_modal-docs', ['processo' => $processo]);
}