<?php 
global $currentSimulationId;
$env = new Cred99\Env();
$minAgeDate = new DateTime(current_time('Y-m-d'));
$maxAgeDate = new DateTime(current_time('Y-m-d'));
$minAgeDate->modify('- '. $env->getMinimumAgeForSimulation() .' years');
$maxAgeDate->modify('- '. $env->getMaximumAgeForSimulation() .' years');
$lastResult = getLastSimulationResult($currentSimulationId);
$lastSimulationRes = isset($lastResult) ? array_shift($lastResult) : null;
$propertyPrice = $lastSimulationRes->_Valor_Entrada + $lastSimulationRes->_Valor_Financiado;
$includeITBI = get_post_meta($currentSimulationId, 'include_itbi_fee');
?>

<div id="modal-form_edit_simulation" class="mobile-sidebar no-scrollbar mfp-hide">
	<div class="sidebar-menu no-scrollbar ">
		<div class="row edit-row align-center">
			<div class="col input-col large-12 text-center">            
                <img class="" src="<?= VVerner\Assets::getInstance()->getImageFileUrl('logo-novo.png') ?>" alt="Obah-Crédito">
			</div>
            <form id="update-simulation-form">
			<div class="col input-col large-12">
				<h4 class="uppercase text-center">editar dados da simulação</h4>
			</div>
			<div class="col input-col large-12">
                <label for="property_price" class="uppercase">valor do imóvel </label>
                <input type="text" name="property_price" value="<?= number_format($propertyPrice, 2, ',', '.') ?>" id="property_price" class="mb-0 mask-money"
                data-min="<?= $env->getMinimumSimulationAmount() ?>"
                data-max="<?= $env->getMaximumSimulationAmount() ?>" class="uppercase" placeholder=' '>
			</div>
			<div class="col input-col large-12">
                <label for="initial_payment" class="uppercase">valor da entrada</label>
                <input type="text" name="initial_payment"  data-itbi="0" value="<?= number_format($lastSimulationRes->_Valor_Entrada, 2, ',', '.') ?>" data-min="" id="initial_payment" class="mb-0 mask-money" placeholder=' '>
                <small class="initial-payment-rule-text"></small>
			</div>
			<div class="col input-col large-12">
                <label for="birthday" class="uppercase">quando você nasceu</label>
            <input type="date" name="birthday" value="<?= get_post_meta($currentSimulationId, 'birthday', true) ?>" id="birthday" class="uppercase" placeholder=" "
                                onfocus="(this.type='date')" min="<?= $maxAgeDate->format('Y-m-d') ?>" max="<?= $minAgeDate->format('Y-m-d') ?>" required>
			</div>
			<div class="col input-col large-12">
                <label for="payment_length" class="uppercase">prazo <span class="lowercase">(em meses)</span></label>
                <input type="number" name="payment_length" value="<?= $lastSimulationRes->_Prazo ?>" id="payment_length" placeholder=" "
                min="<?= $env->getMinimumSimulationDuration() ?>"
                max="<?= $env->getMaximumSimulationDuration() ?>" step="1">
			</div>
			<div class="col input-col large-12">
                <div class="toggle-container">
                    <input type="checkbox" name="include_itbi_fee"  data-itbi="0" id="include_itbi_fee" <?= array_shift($includeITBI) === 'Sim' ? 'checked' : '' ?>>
                    <label class="flex align-middle" for="include_itbi_fee">
                        <span class="toggle-state"></span>
                        <h2 class="uppercase mt-0">incluir despesas(itbi) ? </h2>
                    </label>
                </div>                
                <h6 class="lowercase">Impostos ITBI e registro do contrato custam cerca de 5% do valor do imóvel.</h6>

                
			</div>
			<div class="col text-right large-12">
                <button class="button mb-0 mr-0">
                    <span class="uppercase">salvar</span>
                    <i class="icon-angle-right"></i>
                </button>
			</div>
            <input type="hidden" name="action" value="obah/update_simulation">
            <?php wp_nonce_field('obah/update_simulation') ?>
            </form>
		</div>   
	</div>	
</div>
