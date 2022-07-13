<?php 
$env = new Cred99\Env();
$minAgeDate = new DateTime(current_time('Y-m-d'));
$minAgeDate->modify('- '. $env->getMinimumAgeForSimulation() .' years');
$maxAgeDate = new DateTime(current_time('Y-m-d'));
$maxAgeDate->modify('- '. $env->getMaximumAgeForSimulation() .' years');
?>
<section class="section hero">
    <div class="hero-overlay absolute-fill">
        <div class="col large-12">
            <div class="row align-bottom">
                <div class="col dark text-center  large-3 small-12">
                    <h3 class="mb-0">Inclua seus dados e obtenha</h3>
                    <h3>a simulação dos bancos</h3>
                </div>
                <div class="col form-col large-9">
                    <h2 class="uppercase mb">precisamos de alguns dados para fazer sua simulação personalizada</h2>

                    <form id="create-simulation-form" class="align-top form-row row-small row">

                        <div class="col label-float large-6">
                            <input type="text" name="full_name" id="full_name" class="uppercase" placeholder=" "
                                required>
                            <label for="full_name" class="uppercase">nome completo </label>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="birthday" id="birthday" class="uppercase" placeholder=" "
                                onfocus="(this.type='date')" min="<?= $maxAgeDate->format('Y-m-d') ?>" max="<?= $minAgeDate->format('Y-m-d') ?>" required>
                            <label for="birthday" class="uppercase">data de nascimento </label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="cpf" id="cpf" class="mask-cpf uppercase" placeholder=' '
                                inputmode="numeric"  required>
                            <label for="cpf" class="uppercase">cpf</label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="phone" id="phone" class="mask-phone uppercase" placeholder=' '
                                inputmode="numeric" required>
                            <label for="phone" class="uppercase">Telefone +55 </label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="email" name="email" id="email" class="uppercase" placeholder=' ' required>
                            <label for="email" class="uppercase">e-mail </label>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="gross_income" id="gross_income" class="uppercase mask-money"
                                placeholder=' ' inputmode="numeric" required>
                            <label for="gross_income" class="uppercase">informe sua renda bruta </label>
                        </div>
                        <div class="col large-6">
                            <select name="has_second_buyer">
                                <option value="" disabled selected>DESEJA COMPOR RENDA COM ALGUÉM?</option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="second_buyer_full_name" id="second_buyer_full_name" class="uppercase"
                                placeholder=' '>
                            <label for="second_buyer_full_name" class="uppercase">nome completo <span class="lowercase">(2º
                                    Proponente)</span></label>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="second_buyer_birthday" id="second_buyer_birthday" class="uppercase" placeholder=' '
                                onfocus="(this.type='date')" min="<?= $maxAgeDate->format('Y-m-d') ?>" max="<?= $minAgeDate->format('Y-m-d') ?>">
                            <label for="second_buyer_birthday" class="uppercase">data de nascimento <span class="lowercase">(2º
                                    Proponente)</span></label>

                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="second_buyer_cpf" id="second_buyer_cpf" class="mask-cpf uppercase"
                                placeholder=' ' inputmode="numeric">
                            <label for="second_buyer_cpf" class="uppercase">cpf <span class="lowercase">(2º
                                    Proponente)</span></label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="second_buyer_phone" id="second_buyer_phone" class="mask-phone uppercase"
                                placeholder=' ' inputmode="numeric">
                            <label for="second_buyer_phone" class="uppercase">telefone <span class="lowercase">(2º
                                    Proponente) </span> +55 </label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="email" name="second_buyer_email" id="second_buyer_email" class="uppercase"
                                placeholder=' '>
                            <label for="second_buyer_email" class="uppercase">e-mail <span class="lowercase">(2º
                                    Proponente)</span></label>
                        </div>
                        <div class="col label-float large-4">
                            <select name="property_type" id="property_type"  required>
                                <option value="" disabled selected>TIPO DE IMÓVEL *</option>
                                <?php $imovelTipos = $env->getUsageProfile() ?>
                                <?php foreach($imovelTipos as $imovelTipo) :?>
                                    <option value="<?= $imovelTipo->id ?>"><?= $imovelTipo->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col label-float large-4">
                            <select name="property_condition" id="property_condition" class="property_condition" required>
                                <option value="" disabled selected><span>CONDIÇÃO DO IMÓVEL <span class="required">*</span></span></option>
                                <?php $imovelCondicao = $env->getPropertyConditions() ?>
                                <?php foreach($imovelCondicao as $condicao) :?>
                                    <option value="<?= $condicao->id ?>"><?= $condicao->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col label-float large-4">
                            <select name="property_location" id="property_location"  required>
                                <option value="" disabled selected>LOCALIZAÇÃO DO IMÓVEL (Estado) *</option>
                                <?php $estados = $env->getBrazilianStates(); ?>
                                <?php foreach($estados as $estado) :?>
                                <option value="<?= $estado->id ?>"><?= $estado->name ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>                

                        <div class="col label-float large-4">
                            <input type="text" name="property_price" id="property_price" class="mask-money mb-0"
                                min="<?= $env->getMinimumSimulationAmount() ?>"
                                max="<?= $env->getMaximumSimulationAmount() ?>" class="uppercase" value="" placeholder=' '
                                required>
                            <label for="property_price" class="uppercase">valor do imóvel </label>

                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="initial_payment" id="initial_payment" class="mask-money mb-0" value="" placeholder=' '  required>
                            <label for="initial_payment" class="uppercase">valor de entrada + fgts </label>
                            <small class="initial-payment-rule-text"></small>
                        </div>
                        <div class="col label-float large-4">
                            <input type="number" name="payment_length" value="" id="payment_length" class="mb-0" placeholder=" "
                                min="<?= $env->getMinimumSimulationDuration() ?>"
                                max="<?= $env->getMaximumSimulationDuration() ?>" step="1"  required>
                            <label for="payment_length" class="uppercase">prazo </label>
                            <p class="mb-0">Prazo mínimo de <?= $env->getMinimumSimulationDuration() ?> meses</p>
                            <p class="mb-0">Prazo mínimo de <?= $env->getMaximumSimulationDuration() ?> meses</p>
                        </div>                          
                        <div class="col large-12">
                            <input type="checkbox" name="include_itbi_fee" id="include_itbi_fee" value="1">
                            <label for="include_itbi_fee">FINANCIAR VALOR DAS TAXAS ITBI E CARTÓRIO NO FINANCIAMENTO?
                                (5% Do valor do imóvel)</label>
                        </div>           
                        <div class="col large-12">
                            <input type="checkbox" name="accept_terms" id="accept_terms" value="1" required>
                            <label for="accept_terms">Ao clicar no botão de envio, concordo com os termos do site.
                                <span style="color:red;">*</span></label>
                        </div>
                        <div class="col chk-col large-12">
                            <input type="checkbox" name="accept_lgpd" id="accept_lgpd" value="1" required>
                            <label for="accept_lgpd">Aceitar LGPD <span style="color:red;">*</span></label>
                        </div>
                        <div class="col button-col large-12 text-right" >
                            <button class="button mb-0 mr-0">
                                <span>Próximo</span>
                                <i class="icon-angle-right"></i>
                            </button>
                        </div>
                        <input type="hidden" name="action" value="obah/create_simulation">
                        <?php wp_nonce_field('obah/create_simulation') ?>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
