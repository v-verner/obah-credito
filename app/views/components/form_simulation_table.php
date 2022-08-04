<?php global  $currentSimulationId; ?>
<?php $currentSimulation = getLastSimulationResult($currentSimulationId) ?>

<div class="hide-for-medium hide-for-small">
    <div class="responsive-scroll">
        <table>
            <tr class="table-title">
                <th class="text-center">banco</th>
                <th class="text-center">
                    <p class="mb-0">valor</p>
                    <p class="mb-0">financiado</p>
                </th>
                <th class="text-center">entrada</th>
                <th class="text-center">prazo</th>
                <th class="text-center">
                    <p class="mb-0">primeira</p>
                    <p class="mb-0">parcela</p>
                </th>
                <th class="text-center">
                    <p class="mb-0">última</p>
                    <p class="mb-0">parcela</p>
                </th>
                <th class="text-center">
                    <p class="mb-0">renda</p>
                    <p class="mb-0">mínima</p>
                </th>
                <th class="text-center">
                    <p class="mb-0">sistema de</p>
                    <p class="mb-0">amortização</p>
                </th>
                <th class="text-center">taxa efetiva</th>
            </tr>
            
            <?php foreach($currentSimulation as $bank) :?>
                <pre>
                    <?php var_dump(getBankName($bank->Titulo)) ?>
                </pre>
                <tr class="bank">
                    <td class="result-bank-col text-center" style="text-transform: uppercase">
                        <img width="62" height="62" src="<?= $bank->logo_banco ?>" alt="<?= $bank->Titulo ?>" title="<?= $bank->Titulo ?>" >
                    </td>  
                    <td class="text-center">
                        <p><strong>R$<?= number_format($bank->_Valor_Financiado, '2', ',' , '.') ?></strong></p>
                    </td>
                    <td class="text-center">
                        <p>R$<?= number_format($bank->_Valor_Entrada, '2', ',' , '.') ?></p>
                    </td>
                    <td class="text-center">
                        <p><?= $bank->_Prazo ?></p>
                    </td>
                    <td class="text-center">
                        <p><strong>R$<?= number_format($bank->Valor_Primeira_Parcela, '2', ',' , '.') ?></strong></p>
                    </td>
                    <td class="text-center">
                        <p>R$<?= number_format($bank->Valor_Ultima_Parcela, '2', ',' , '.') ?></p>
                    </td>
                    <td class="text-center">
                        <p><strong>R$<?= number_format($bank->Valor_Renda_Minima, '2', ',' , '.') ?></strong></p>
                    </td>
                    <td class="text-center amortization-col">
                        <p><?= $bank->Modalidade ?></p>
                    </td>
                    <td class="text-center"><?= $bank->Taxa_Nominal ?>% a.a</td>
                </tr>    
            <?php endforeach;?>  
                                            
        </table>
    </div>
</div>
<div class="col large-12 hide-for-large text-left">
    <span class="scroll-for-more-text">Arraste para o lado</span>
    <i class="icon-angle-right scroll-for-more"></i>

    <div class="responsive-scroll">
        <table>
            
            <tr>
                <th>Banco</th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td>
                        <img width="62" height="62" src="<?= $bank->logo_banco ?>" alt="<?= $bank->Titulo ?>" title="<?= $bank->Titulo ?>">
                    </td> 
                <?php endforeach;?>
            </tr>
            <tr>
                <th>
                    <p class="mb-0">Valor</p>
                    <p class="mb-0">Financiado</p>
                </th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center"><p>R$<?= number_format($bank->_Valor_Financiado, '2', ',' , '.') ?></p></td>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>Entrada</th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center">
                        <p>R$<?= number_format($bank->_Valor_Entrada, '2', ',' , '.') ?></p>
                    </td>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>prazo</th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center">
                        <p><?= $bank->_Prazo ?></p>
                    </td>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>
                    <p class="mb-0">primeira</p>
                    <p class="mb-0">parcela</p>
                </th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center">
                        <p>R$<?= number_format($bank->Valor_Primeira_Parcela, '2', ',' , '.') ?></p>
                    </td>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>
                    <p class="mb-0">última</p>
                    <p class="mb-0">parcela</p>
                </th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center">
                        <p>R$<?= number_format($bank->Valor_Ultima_Parcela, '2', ',' , '.') ?></p>
                    </td>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>
                    <p class="mb-0">renda</p>
                    <p class="mb-0">mínima</p>
                </th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center">
                        <p>R$<?= number_format($bank->Valor_Renda_Minima, '2', ',' , '.') ?></p>
                    </td>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>
                    <p class="mb-0">taxa</p>
                    <p class="mb-0">efetiva</p>
                </th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center"><?= $bank->Taxa_Nominal ?>% A.A</td>
                <?php endforeach;?>
            </tr>
            <tr>
                <th>
                    <p class="mb-0">sistema de</p>
                    <p class="mb-0">amortização</p>
                </th>
                <?php foreach($currentSimulation as $bank) :?>
                    <td class="text-center">
                        <p><?= $bank->Modalidade ?></p>
                    </td>
                <?php endforeach;?>
            </tr>

        </table>
    </div>
</div>
