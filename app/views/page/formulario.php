<?php $env = new Cred99\Env(); ?>
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

                    <form id="create-simulation-form" class="align-middle form-row row-small row">

                        <div class="col label-float large-6">
                            <input type="text" name="full_name" id="nomeCompleto" class="uppercase" placeholder=" "
                                required>
                            <label for="nomeCompleto" class="uppercase">nome completo </label>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="birthday" id="birthDate" class="uppercase" placeholder=" "
                                onfocus="(this.type='date')" onblur="(this.type='text')" required>
                            <label for="birthDate" class="uppercase">data de nascimento </label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="cpf" id="cpf" class="mask-cpf uppercase" placeholder=' '
                                inputmode="numeric">
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
                            <input type="text" name="gross_income" id="renda" class="uppercase mask-money"
                                placeholder=' ' inputmode="numeric">
                            <label for="renda" class="uppercase">informe sua renda bruta </label>
                        </div>
                        <div class="col large-6">
                            <select name="has_second_buyer">
                                <option value="" disabled selected>DESEJA COMPOR RENDA COM ALGUÉM?</option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="second_buyer_full_name" id="segNome" class="uppercase"
                                placeholder=' '>
                            <label for="segNome" class="uppercase">nome completo <span class="lowercase">(2º
                                    Proponente)</span></label>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="second_buyer_birthday" id="segBD" class="uppercase" placeholder=' '
                                onfocus="(this.type='date')" onblur="(this.type='text')">
                            <label for="segBD" class="uppercase">data de nascimento <span class="lowercase">(2º
                                    Proponente)</span></label>

                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="second_buyer_cpf" id="segCpf" class="mask-cpf uppercase"
                                placeholder=' ' inputmode="numeric">
                            <label for="segCpf" class="uppercase">cpf</label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="text" name="second_buyer_phone" id="segPhone" class="mask-phone uppercase"
                                placeholder=' ' inputmode="numeric">
                            <label for="segPhone" class="uppercase">telefone +55</label>
                        </div>
                        <div class="col label-float large-4">
                            <input type="email" name="second_buyer_email" id="segEmail" class="uppercase"
                                placeholder=' '>
                            <label for="segEmail" class="uppercase">e-mail</label>
                        </div>
                        <div class="col label-float large-6">
                            <select name="property_type">
                                <option value="" disabled selected>TIPO DE IMÓVEL</option>
                                <?php $imovelTipos = $env->getUsageProfile() ?>
                                <?php foreach($imovelTipos as $imovelTipo) :?>
                                    <option value="<?= $imovelTipo->id ?>"><?= $imovelTipo->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col label-float large-6">
                            <select name="property_condition" id="condition">
                                <option value="condition" disbled selected>CONDIÇÃO DO IMÓVEL</option>
                                <?php $imovelCondicao = $env->getPropertyConditions() ?>
                                <?php foreach($imovelCondicao as $condicao) :?>
                                    <option value="<?= $condicao->id ?>"><?= $condicao->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="property_price" id="valorImovel" class="mask-money"
                                min="<?= $env->getMinimumSimulationAmount() ?>"
                                max="<?= $env->getMaximumSimulationAmount() ?>" class="uppercase" value="" placeholder=''
                                required>
                            <label for="valorImovel" class="uppercase">valor do imóvel </label>
                        </div>
                        <div class="col label-float large-6">
                            <input type="text" name="initial_payment" id="entrada" class="mask-money" value="" placeholder=''>
                            <label for="entrada" class="uppercase">valor de entrada + fgts <span
                                    class="lowercase hide-for-small">(Mínimo de 10% do valor do imóvel)</span></label>
                        </div>
                        <div class="row inside-form-row">
                            <div class="col inside-form-col large-8">
                                <div class="col large-12">
                                    <input type="checkbox" name="include_itbi_fee" id="financiar" value="1">
                                    <label for="financiar">FINANCIAR VALOR DAS TAXAS ITBI E CARTÓRIO NO FINANCIAMENTO?
                                        (5% Do valor do imóvel)</label>
                                </div>
                                <div class="col large-12">
                                    <select name="property_location">
                                        <option value="" disabled selected>LOCALIZAÇÃO DO IMÓVEL (Estado)</option>
                                        <?php $estados = $env->getBrazilianStates(); ?>
                                        <?php foreach($estados as $estado) :?>
                                        <option value="<?= $estado->id ?>"><?= $estado->name ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col label-float large-4">
                                    <input type="number" name="payment_length" value="" id="prazo" placeholder=" "
                                        min="<?= $env->getMinimumSimulationDuration() ?>"
                                        max="<?= $env->getMaximumSimulationDuration() ?>" step="1">
                                    <label for="prazo" class="uppercase">prazo</label>
                                </div>
                            </div>
                            <div class="col inside-form-col large-4">
                                <div class="col large-12">
                                    <input type="checkbox" name="accept_terms" id="agree" value="1" required>
                                    <label for="agree">Ao clicar no botão de envio, concordo com os termos do site.
                                        <span style="color:red;">*</span></label>
                                </div>
                                <div class="col chk-col large-12">
                                    <input type="checkbox" name="accept_lgpd" id="aceito-lgpd" value="1" required>
                                    <label for="aceito-lgpd">Aceitar LGPD <span style="color:red;">*</span></label>
                                </div>
                                <div class="col button-col large-12 text-right" >
                                    <button class="button mb-0 mr-0">
                                        <span>Próximo</span>
                                        <i class="icon-angle-right"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="action" value="obah/create_simulation">
                                <?php wp_nonce_field('obah/create_simulation') ?>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
