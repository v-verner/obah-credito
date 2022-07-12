<?php $env = new Cred99\Env(); ?>
<section class="section hero">
    <div class="col large-12">
        <div class="row row-large align-middle sim-row">
            <div class="col col-top dark large-3">
                <div class="icon-box featured-box icon-box-left text-left">
                    <div class="icon-box-img">
                        <div class="icon">
                            <div class="icon-inner">
                                <i class="icon-checkmark"></i>
                            </div>
                        </div>
                    </div>
                    <div class="icon-box-text last-reset">
                        <h4 class="thin-font">Analise qual a diferença das taxas dos bancos</h4>
                    </div>
                </div>
                <div class="icon-box featured-box icon-box-left text-left">
                    <div class="icon-box-img">
                        <div class="icon">
                            <div class="icon-inner">
                                <i class="icon-checkmark"></i>
                            </div>
                        </div>
                    </div>
                    <div class="icon-box-text last-reset">
                        <h4 class="thin-font">Indentifique a menor parcela</h4>
                    </div>
                </div>
                <div class="icon-box featured-box icon-box-left text-left">
                    <div class="icon-box-img">
                        <div class="icon">
                            <div class="icon-inner">
                                <i class="icon-checkmark"></i>
                            </div>
                        </div>
                    </div>
                    <div class="icon-box-text last-reset">
                        <h4 class="thin-font">Prazo mínimo de 60 meses</h4>
                    </div>
                </div>
                <div class="icon-box featured-box icon-box-left text-left">
                    <div class="icon-box-img">
                        <div class="icon">
                            <div class="icon-inner">
                                <i class="icon-checkmark"></i>
                            </div>
                        </div>
                    </div>
                    <div class="icon-box-text last-reset">
                        <h4 class="thin-font">Prazo máximo de 420 meses(Caixa e Santander)</h4>
                    </div>
                </div>
                <div class="icon-box featured-box icon-box-left text-left">
                    <div class="icon-box-img">
                        <div class="icon">
                            <div class="icon-inner">
                                <i class="icon-checkmark"></i>
                            </div>
                        </div>
                    </div>
                    <div class="icon-box-text last-reset">
                        <h4 class="thin-font">Sua idade pode alterar o valor das parcelas(preencha sempre idade do mais
                            velho)</h4>
                    </div>
                </div>
                <div class="icon-box featured-box icon-box-left text-left">
                    <div class="icon-box-img">
                        <div class="icon">
                            <div class="icon-inner">
                                <i class="icon-checkmark"></i>
                            </div>
                        </div>
                    </div>
                    <div class="icon-box-text last-reset">
                        <h4 class="thin-font">Você pode somar renda com até 04 pessoas</h4>
                    </div>
                </div>
            </div>
            <div class="col sim-col large-9">
                <div class="row">
                    <div class="col large-12 pb-half">
                        <h4 class="uppercase hide-for-small text-center">simulação concluida</h4>
                        <h4 class="uppercase hide-for-large">simulação concluida</h4>
                        <a class="obah-edit-simulation-button" href="#" data-open="#modal-form_edit_simulation" data-pos="left" data-bg="main-menu-overlay"
                            data-color="form_edit_simulation">
                            <p class="edit uppercase"><i class="icon-pen-alt-fill"></i> editar dados</p>
                        </a>
                    </div>
                    <div class="col large-12  hide-for-medium hide-for-small">
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
                            <tr class="bank01">
                                <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                                <td class="bank-img"><img width="62" height="62"
                                        src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-caixa-economica-federal.png') ?>"
                                        alt="Caixa"><span class="uppercase"> bradesco</span></td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>320</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>SAC</p>
                                </td>
                                <td class="text-center">8,89% A.A</td>
                            </tr>
                            <tr class="bank02">
                                <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                                <td class="bank-img"><img width="62" height="62"
                                        src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-itau.png') ?>"
                                        alt="Itaú"><span class="uppercase"> itaú</span></td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>320</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>SAC</p>
                                </td>
                                <td class="text-center">8,89% A.A</td>
                            </tr>
                            <tr class="bank01">
                                <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                                <td class="bank-img"><img width="62" height="62"
                                        src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-caixa-economica-federal.png') ?>"
                                        alt="Caixa"><span class="uppercase"> caixa</span></td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>320</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>SAC</p>
                                </td>
                                <td class="text-center">8,89% A.A</td>
                            </tr>
                            <tr class="bank02">
                                <td class="text-center"><input type="radio" name="bank-select" id=""></td>
                                <td class="bank-img"><img width="62" height="62"
                                        src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-itau.png') ?>"
                                        alt="Itaú"><span class="uppercase"> itaú</span></td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>320</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>R$120.000</p>
                                </td>
                                <td class="text-center">
                                    <p>SAC</p>
                                </td>
                                <td class="text-center">8,89% A.A</td>
                            </tr>

                        </table>
                    </div>

                    <div class="col large-12 hide-for-large text-left">
                        <span class="scroll-for-more-text">Arraste para o lado</span>
                        <i class="icon-angle-right scroll-for-more"></i>

                        <div class="responsive-scroll hide-for-large">
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
                        

                    <div class="col pb-0 close-col large-6 small-6" style="padding-right:0;">
                        <button class="button mb-0 pb-0">
                            <i class="icon-plus"></i>
                            <span>fechar análise</span>
                        </button>
                    </div>
                    <div class="col pb-0 text-right banks-col large-6 small-6"  style="padding-left:0;">
                        <button class="button mb-0 pb-0">
                            <span>selecione o banco para seguir com análise de credito</span>
                            <i class="icon-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-large">
            <div class="col col-bot dark large-12">
                <h5 class="thin-font sub-text">Data desta Simulação: 19/05/2022 12:08:32</h5>
                <h5 class="thin-font sub-text">As taxas aqui apresentadas são do tipo "balcão" e correção de parcelas com taxa
                    Pré-Fixada. No decorrer do processo, condições melhores poderão ser obtidas.</h5>
                <h5 class="thin-font sub-text">Info: As taxas apresentadas acima poderão sofrer alterações no decorrer do
                    processo, por iniciativa dos Bancos conveniadas.</h5>
                <h5 class="thin-font sub-text">Info: De acordo com as contingências de mercado, os Bancos conveniados poderão
                    excluir ou alterar os produtos de financiamentos disponibilizados neste simulador.</h5>
                <h5 class="thin-font sub-text" style="line-height:1;">IMPORTANTE: Os resultados obtidos no presente website não constituem qualquer
                    forma de proposta financeira bem como não vinculam quaisquer partes e/ou instituições financeiras
                    anunciadas. Consideram condições de BALCÃO e são referenciais para negociação inicial com o Cliente.
                    Eventuais diferenças em relação aos simuladores das instituições financeiras devido a critérios de
                    calculo, utilização de tabelas de seguradora, definição de Cliente principal, ou ajustes
                    extemporÃ¢neo realizados nas linhas de financiamento destas instituições serão informadas para o
                    Cliente ao ser inserida a proposta A formalização do crédito e financiamento estão sujeitos a
                    anÃ¡lises e aprovações de crédito, a serem realizadas de forma independente pelas respectivas
                    instituições financeiras.</h5>
            </div>
        </div>
</section>
<?php VVerner\Views::getInstance()->getComponent('modal-form_edit_simulation') ?>
