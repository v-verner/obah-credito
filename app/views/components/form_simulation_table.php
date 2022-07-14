<?php global  $currentSimulationId; ?>
<?php $simulationResults = getSimulationStoredResults($currentSimulationId) ?>
<?php $currentSimulation = $simulationResults[0] ?>

<div class="hide-for-medium hide-for-small">
        <div class="responsive-scroll">
            <table>
                <tr class="table-title">
                    <th class="text-center">seleção</th>
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
                    <?php $title = explode('-', trim($bank->Titulo)); ?>
                    <?php $title = trim(array_shift($title)); ?>
                    <tr class="bank">
                        <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                        <td style="text-transform: uppercase">
                        <img width="62" height="62"
                                src="<?= $bank->logo_banco ?>"
                                alt="Caixa">
                        <span title="<?= $bank->Titulo ?>"><?= $title ?></span>
                        </td>  
                        <td class="text-center">
                            <p>R$<?= number_format($bank->_Valor_Financiado, '2', ',' , '.') ?></p>
                        </td>
                        <td class="text-center">
                            <p>R$<?= number_format($bank->_Valor_Entrada, '2', ',' , '.') ?></p>
                        </td>
                        <td class="text-center">
                            <p><?= $bank->_Prazo ?></p>
                        </td>
                        <td class="text-center">
                            <p>R$<?= number_format($bank->Valor_Primeira_Parcela, '2', ',' , '.') ?></p>
                        </td>
                        <td class="text-center">
                            <p>R$<?= number_format($bank->Valor_Ultima_Parcela, '2', ',' , '.') ?></p>
                        </td>
                        <td class="text-center">
                            <p>R$<?= number_format($bank->Valor_Renda_Minima, '2', ',' , '.') ?></p>
                        </td>
                        <td class="text-center">
                            <p><?= $bank->Modalidade ?></p>
                        </td>
                        <td class="text-center"><?= $bank->Taxa_Nominal ?>% A.A</td>
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
                    <th>seleção</th>
                    <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                    <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                    <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                    <td class="text-center"><input type="radio" name="bank-select" id=""></td>

                </tr>
                <tr>
                    <th>banco</th>
                    <td class="bank-img"><img width="62" height="62"
                            src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-caixa-economica-federal.png') ?>"
                            alt="Caixa"></td>
                    <td class="bank-img"><img width="62" height="62"
                            src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-itau.png') ?>"
                            alt="Itaú"></td>
                    <td class="bank-img"><img width="62" height="62"
                            src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-caixa-economica-federal.png') ?>"
                            alt="Caixa"></td>
                    <td class="bank-img"><img width="62" height="62"
                            src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-itau.png') ?>"
                            alt="Itaú"></td>
                </tr>
                <tr>
                    <th><p class="mb-0">valor</p><p class="mb-0">financiado</p></th>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                </tr>
                <tr>
                    <th>entrada</th>
                    <td class="text-center"><p>R$120.000</p>
                    </td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                </tr>
                <tr>
                    <th>prazo</th>
                    <td class="text-center"><p>320</p></td>
                    <td class="text-center"><p>320</p></td>
                    <td class="text-center"><p>320</p></td>
                    <td class="text-center"><p>320</p></td>
                </tr>
                <tr>
                    <th><p class="mb-0">primeira</p><p class="mb-0">parcela</p></th>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                </tr>
                <tr>
                    <th><p class="mb-0">última</p><p class="mb-0">parcela</p></th>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                </tr>
                <tr>
                    <th><p class="mb-0">renda</p><p class="mb-0">mínima</p></th>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                    <td class="text-center"><p>R$120.000</p></td>
                </tr>
                <tr>
                    <th><p class="mb-0">taxa</p><p class="mb-0">efetiva</p></th>
                    <td class="text-center">8,89% A.A</td>
                    <td class="text-center">8,89% A.A</td>
                    <td class="text-center">8,89% A.A</td>
                    <td class="text-center">8,89% A.A</td>
                </tr>
                <tr>
                    <th><p class="mb-0">sistema de</p><p class="mb-0">amortização</p></th>
                    <td class="text-center"><p>SAC</p></td>
                    <td class="text-center"><p>SAC</p></td>
                    <td class="text-center"><p>SAC</p></td>
                    <td class="text-center"><p>SAC</p></td>
                </tr>

            </table>
        </div>
    </div>
