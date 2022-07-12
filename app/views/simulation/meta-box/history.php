<?php
defined('ABSPATH') || exit('No direct script access allowed');
$simulationHistory = getSimulationStoredResults(get_the_ID());
$api = new Cred99\API();
?>

       
<?php foreach ($simulationHistory as $k => $historyItem) : ?>
    <h3>Simulação <?= str_pad($k +1, 3, '0', STR_PAD_LEFT) ?></h3>

    <table class="widefat striped">
        <thead>
            <tr>
                <th scope="col"><abbr title="ID da simulação na API 99Cred">ID</abbr></th>
                <th scope="col">Valor financiado</th>
                <th scope="col">Entrada</th>
                <th scope="col">Prazo</th>
                <th scope="col">1º parcela</th>
                <th scope="col">Última parcela</th>
                <th scope="col">Renda Mín.</th>
                <th scope="col">Amortização</th>
                <th scope="col">CET</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($historyItem as $item) :  ?>
                <?php $title = explode('-', trim($item->Titulo)); ?>
                <?php $title = trim(array_shift($title)); ?>

                <tr class="obah-history-row bank-<?= $k ?>">
                    <td style="text-transform: uppercase">
                        <abbr title="<?= $item->Titulo ?>"><?= $title ?></abbr>
                    </td>
                    <td>
                        <p>R$<?= str_replace('.', ',', $item->_Valor_Financiado) ?></p>
                    </td>
                    <td>
                        <p>R$<?= str_replace('.', ',', $item->_Valor_Entrada) ?></p>
                    </td>
                    <td>
                        <p><?= $item->_Prazo ?></p>
                    </td>
                    <td>
                        <p>R$<?= str_replace('.', ',', $item->Valor_Primeira_Parcela) ?></p>
                    </td>
                    <td>
                        <p>R$<?= str_replace('.', ',', $item->Valor_Ultima_Parcela) ?></p>
                    </td>
                    <td>
                        <p>R$<?= str_replace('.', ',', $item->Valor_Renda_Minima) ?></p>
                    </td>
                    <td>
                        <p><?= $item->Modalidade ?></p>
                    </td>
                    <td><?= str_replace('.', ',', $item->CET) ?>% A.A</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <hr>

<?php endforeach; ?>

