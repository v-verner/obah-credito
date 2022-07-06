<?php $env = new Cred99\Env(); ?>
<section class="section dark hero">
    <div class="col large-12">  
        <div class="row align-bottom align-left">
            <div class="col only-text large-3">
                <h2>Inclua seus dados e obtenha</h2>
                <h2>a simulação dos bancos</h2>
            </div>
            <div class="col form-col large-9">
                <div class="row row-small align-middle form-row">
                    <h2 class="uppercase mb">precisamos de alguns dados para fazer sua simulação personalizada</h2>
                    
                    <form>   
                        <div class="row"> 
                            <?php $redStar = '* ' ?>
                            <div class="col large-6">
                                <input type="text" class="uppercase red-star" placeholder='nome completo <?= $redStar ?>' required>
                            </div>
                            <div class="col large-6">
                                <input type="text" class="uppercase" placeholder='data de nascimento <?= $redStar ?>' onfocus="(this.type='date')" onblur="(this.type='text')">   
                            </div>
                            <div class="col large-4">
                                <input type="text" class="uppercase mask-cpf" placeholder='cpf <?= $redStar ?>' inputmode="numeric">   
                            </div>
                            <div class="col large-4">
                                <input type="text" class="uppercase mask-phone" placeholder='telefone <?= $redStar ?> +55' inputmode="numeric">
                            </div>
                            <div class="col large-4">
                                <input type="email" class="uppercase" placeholder='e-mail <?= $redStar ?>'>
                            </div>
                            <div class="col large-6">
                                <input type="number" class="uppercase" placeholder='informe sua renda bruta'>
                            </div>
                            <div class="col large-6">
                                <select name="RendaConjunta" class="uppercase">
                                    <option value="" disabled selected>Deseja compor renda com alguém?</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                            <?php $second = '(2º Proponente)'?>
                            <div class="col large-6">
                                <label for="xxx" class="sr-only hidden" aria-label="xxxx">Nome </label>
                                <input type="text" class="uppercase" id="xxxx" placeholder='nome completo <?= $second ?>'>
                            </div>
                            <div class="col large-6">
                                <input type="text" class="uppercase" placeholder='data de nascimento <?= $second ?>' onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>
                            <div class="col large-4">
                                <input type="number" class="uppercase" placeholder='cpf' pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{2}">
                            </div>
                            <div class="col large-4">
                                <input type="tel" class="uppercase" placeholder='telefone +55' pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}">
                            </div>
                            <div class="col large-4">
                                <input type="email" class="uppercase" placeholder='e-mail'>
                            </div>
                            <div class="col large-4">
                                <select name="TipoImovel" class="uppercase">
                                    <option value="" disabled selected>tipo de imóvel</option>
                                    <option value="Apartamento">Apartamento</option>
                                    <option value="Casa">Casa</option>
                                    <option value="Casa em condominio">Casa em condomínio</option>
                                    <option value="Terreno">Terreno</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>
                            <div class="col large-4">
                                <!-- getMinimumSimulationAmount -->
                                <!-- getMaximumSimulationAmount -->
                                <input type="number" class="uppercase" placeholder='valor do imóvel <?= $redStar ?>'>
                            </div>
                            <div class="col large-4">
                                <input type="number" class="captilize" placeholder='valor de entrada + fgts (Mínimo de 10% do valor do imóvel)'  onfocus="(this.type='number')" onblur="(this.type='text')">
                            </div>
                            <div class="col large-6">
                                <select name="Financiar" class="captalize">
                                    <option value="" disabled selected>financiar valor das taxas itbi e cartório no financiamento? (5% Do valor do imóvel)</option>
                                    <option value="">Teste</option>
                                </select>
                            </div>
                            <div class="col large-6">
                                <input type="checkbox" aria-invalid="false">
                                <label>Ao clicar no botão de envio, concordo com os termos do site. <?= $redStar ?></label>
                            </div>
                            <div class="col large-6">
                                <select name="Localizacao" class="captalize">
                                    <option value="" disabled selected>localização do imóvel (Estado)</option>
                                    <option value="">Acre - AC;</option>
                                    <option value="">Alagoas - AL;</option>
                                    <option value="">Amapá - AP;</option>
                                    <option value="">Amazonas - AM;</option>
                                    <option value="">Bahia - BA;</option>
                                    <option value="">Ceará - CE;</option>
                                    <option value="">Distrito Federal - DF;</option>
                                    <option value="">Espírito Santo - ES;</option>
                                    <option value="">Goiás - GO;</option>
                                    <option value="">Maranhão - MA;</option>
                                    <option value="">Mato Grosso - MT;</option>
                                    <option value="">Mato Grosso do Sul - MS;</option>
                                    <option value="">Minas Gerais - MG;</option>
                                    <option value="">Pará - PA;</option>
                                    <option value="">Paraíba - PB;</option>
                                    <option value="">Paraná - PR;</option>
                                    <option value="">Pernambuco - PE;</option>
                                    <option value="">Piauí - PI;</option>
                                    <option value="">Rio de Janeiro - RJ;</option>
                                    <option value="">Rio Grande do Norte - RN;</option>
                                    <option value="">Rio Grande do Sul - RS;</option>
                                    <option value="">Rondônia - RO;</option>
                                    <option value="">Roraima - RR;</option>
                                    <option value="">Santa Catarina - SC;</option>
                                    <option value="">São Paulo - SP;</option>
                                    <option value="">Sergipe - SE;</option>
                                    <option value="">Tocantins - TO.</option>
                                </select>
                            </div>
                            <div class="col large-6">
                                <input type="checkbox" id="aceito-lgpd" value="1" required>
                                <label for="aceito-lgpd">Aceitar LGPD <?= $redStar ?></label>
                            </div>
                            <div class="col large-4">
                                <input type="number" placeholder="Prazo" min="<?= $env->getMinimumSimulationDuration() ?>" max="<?= $env->getMaximumSimulationDuration() ?>" step="1">
                            </div>
                            <div class="col large-8" style="text-align: end;">
                                <button class="button mb-0 mr-0">
                                    <span>Próximo</span>
                                    <i class="icon-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>

.form-row input[type="checkbox"] {
    min-height: unset;
}
