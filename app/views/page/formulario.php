<?php $env = new Cred99\Env(); ?>
<section class="section hero">
    <div class="hero-overlay absolute-fill">    
        <div class="col large-12">  
                <div class="row align-bottom align-left">
                    <div class="col dark text-center  large-3 small-12">
                        <h2>Inclua seus dados e obtenha</h2>
                        <h2>a simulação dos bancos</h2>
                    </div>
                    <div class="col form-col large-9">                
                        <h2 class="uppercase mb">precisamos de alguns dados para fazer sua simulação personalizada</h2>
                        
                        <form class="align-middle form-row row-small row">
                            
                            <div class="col label-float large-6">
                                <input type="text" id="nomeCompleto" class="uppercase" placeholder=" " required>
                                <label for="nomeCompleto" class="uppercase">nome completo </label>
                            </div>
                            <div class="col label-float large-6">
                                <input type="text" id="birthDate" class="uppercase" placeholder=" " onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                <label for="birthDate" class="uppercase">data de nascimento </label>   
                            </div>
                            <div class="col label-float large-4">
                                <input type="text" id="cpf" class="mask-cpf uppercase" placeholder=' ' inputmode="numeric">   
                                <label for="cpf" class="uppercase">cpf</label>
                            </div>
                            <div class="col label-float large-4">
                                <input type="text" id="phone" class="mask-phone uppercase" placeholder=' ' inputmode="numeric" required>
                                <label for="phone" class="uppercase">Telefone +55 </label>
                            </div>
                            <div class="col label-float large-4">
                                <input type="email" id="email" class="uppercase" placeholder=' ' required>
                                <label for="email" class="uppercase">e-mail </label>
                            </div>
                            <div class="col label-float large-6">
                                <input type="text" id="renda" class="uppercase mask-money" placeholder=' ' inputmode="numeric">
                                <label for="renda" class="uppercase">informe sua renda bruta </label>
                            </div>
                            <div class="col large-6">
                                <select name="RendaConjunta">
                                    <option value="" disabled selected>DESEJA COMPOR RENDA COM ALGUÉM?</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>                        
                            <div class="col label-float large-6">
                                <input type="text" id="segNome" class="uppercase" placeholder=' '>
                                <label for="segNome" class="uppercase">nome completo <span class="lowercase">(2º Proponente)</span></label>
                            </div>
                            <div class="col label-float large-6">
                                <input type="text" id="segBD"  class="uppercase" placeholder=' ' onfocus="(this.type='date')" onblur="(this.type='text')">
                                <label for="segBD" class="uppercase">data de nascimento <span class="lowercase">(2º Proponente)</span></label>

                            </div>
                            <div class="col label-float large-4">
                                <input type="text" id="segCpf" class="mask-cpf uppercase" placeholder=' ' inputmode="numeric">
                                <label for="segCpf" class="uppercase">cpf</label>
                            </div>
                            <div class="col label-float large-4">
                                <input type="text" id="segPhone" class="mask-phone uppercase" placeholder=' ' inputmode="numeric">
                                <label for="segPhone" class="uppercase">telefone +55</label>
                            </div>
                            <div class="col label-float large-4">
                                <input type="email" id="segEmail"  class="uppercase" placeholder=' '>
                                <label for="segEmail" class="uppercase">e-mail</label>
                            </div>
                            <div class="col label-float large-4">
                                <select name="TipoImovel">
                                    <option value="" disabled selected>TIPO DE IMÓVEL</option>
                                    <?php $imovelTipos = $env->getUsageProfile() ?>
                                    <?php foreach($imovelTipos as $imovelTipo) :?>
                                        <option value=""><?= $imovelTipo->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col label-float large-4">
                                <input type="text" id="valorImovel" class="mask-money" min="<?= $env->getMinimumSimulationAmount() ?>" max="<?= $env->getMaximumSimulationAmount() ?>" class="uppercase" placeholder=' ' required>
                                <label for="valorImovel" class="uppercase">valor do imóvel </label>
                            </div>
                            <div class="col label-float large-4">
                                <input type="text" id="entrada" class="mask-money" placeholder=' '  onfocus="(this.type='number')" onblur="(this.type='text')">
                                <label for="entrada" class="uppercase">valor de entrada + fgts <span class="lowercase">(Mínimo de 10% do valor do imóvel)</span></label>
                            </div>
                            <div class="col label-float large-6">
                                <select name="Financiar">
                                    <option value="" disabled selected>FINANCIAR VALOR DAS TAXAS ITBI E CARTÓRIO NO FINANCIAMENTO? (5% Do valor do imóvel)</option>
                                    <option value="">Teste</option>
                                </select>
                            </div>
                            <div class="col large-6">
                                <input type="checkbox" id="agree" value="1" required>
                                <label for="agree">Ao clicar no botão de envio, concordo com os termos do site. <span style="color:red;">*</span></label>
                            </div>
                            <div class="col large-6">
                                <select name="Localizacao">
                                    <option value="" disabled selected>LOCALIZAÇÃO DO IMÓVEL (Estado)</option>
                                    <?php $estados = $env->getBrazilianStates(); ?>
                                    <?php foreach($estados as $estado) :?>
                                        <option value=""><?= $estado->name ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col large-6">
                                <input type="checkbox" id="aceito-lgpd" value="1" required>
                                <label for="aceito-lgpd">Aceitar LGPD <span style="color:red;">*</span></label>
                            </div>
                            <div class="col label-float large-4">
                                <input type="number" id="prazo" placeholder=" " min="<?= $env->getMinimumSimulationDuration() ?>" max="<?= $env->getMaximumSimulationDuration() ?>" step="1">
                                <label for="prazo" class="uppercase">prazo</label>
                            </div>
                            <div class="col large-8" style="text-align: end;">
                                <button class="button mb-0 mr-0">
                                    <span>Próximo</span>
                                    <i class="icon-angle-right"></i>
                                </button>
                            </div>                        
                        </form>                
                    </div>
                </div>
        </div>
    </div>
</section>
