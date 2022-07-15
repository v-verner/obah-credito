<?php global $currentSimulationId; ?>
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
                        <h4 class="thin-font">Prazo mínimo de <?= $env->getMinimumSimulationDuration() ?> meses</h4>
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
                        <h4 class="thin-font">Prazo máximo de <?= $env->getMaximumSimulationDuration() ?> meses(Caixa e Santander)</h4>
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
                    <div class="col large-12 pb-half text-right">
                        <h4 class="uppercase hide-for-small hide-for-medium text-center">simulação concluida</h4>
                        <h4 class="uppercase hide-for-large text-left">simulação concluida</h4>
                        <a class="obah-edit-simulation-button" href="#" data-open="#modal-form_edit_simulation" data-pos="left" data-bg="main-menu-overlay"
                            data-color="form_edit_simulation">
                            <button class="button is-link edit uppercase"><i class="icon-pen-alt-fill"></i> editar dados</button>
                        </a>
                    </div>
                    

                    <div class="col pb-0 small-12">
                        <div class="col-inner" id="container-form_simulation_table">
                            <?= VVerner\Views::getInstance()->getComponent('form_simulation_table') ?>
                        </div>
                    </div>

                    
                        

                    <div class="col pb-0 close-col large-6 small-12" style="padding-right:0;">
                        <button class="button mb-0 pb-0">
                        <a href="<?= get_permalink(getObahPageId('formulário')) ?>">
                            <i class="icon-plus"></i>
                            <span>fechar análise</span>
                        </a>
                        </button>
                    </div>
                    <!-- <div class="col pb-0 text-right banks-col large-6 small-6"  style="padding-left:0;">
                        <button class="button mb-0 pb-0 text-right">
                            <span>selecione o banco para seguir com análise de credito</span>
                            <i class="icon-angle-right"></i>
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row row-large">
            <div class="col col-bot dark large-12">
                <h5 class="thin-font sub-text">Data desta Simulação: <?= get_the_date('d/m/Y H:i', $currentSimulationId) ?></h5>
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
