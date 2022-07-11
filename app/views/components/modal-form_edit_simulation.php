s<?php $env = new Cred99\Env(); ?>
<div id="modal-form_edit_simulation" class="mobile-sidebar no-scrollbar mfp-hide">
	<div class="sidebar-menu no-scrollbar ">
		<div class="row edit-row align-center">
			<div class="col input-col large-12 text-center">            
                <img class="" src="<?= VVerner\Assets::getInstance()->getImageFileUrl('LOGO.png') ?>" alt="Obah-Crédito">
			</div>
			<div class="col input-col large-12">
				<h4 class="uppercase text-center">editar dados da simulação</h4>
			</div>
			<div class="col input-col large-12">
                <label for="valorImovel" class="uppercase">valor do imóvel </label>
                <input type="text" name="property_price" id="valorImovel" class="mask-money"
                min="<?= $env->getMinimumSimulationAmount() ?>"
                max="<?= $env->getMaximumSimulationAmount() ?>" class="uppercase" placeholder=' '
                required>
			</div>
			<div class="col input-col large-12">
                <label for="entrada" class="uppercase">valor da entrada</label>
                <input type="text" name="initial_payment" id="entrada" class="mask-money" placeholder=' '
                onfocus="(this.type='number')" onblur="(this.type='text')">
			</div>
			<div class="col input-col large-12">
                <label for="birthDate" class="uppercase">quando você nasceu</label>
                <input type="text" name="birthday" id="birthDate" class="uppercase" placeholder=" "
                onfocus="(this.type='date')" onblur="(this.type='text')" required>
			</div>
			<div class="col input-col large-12">
                <label for="prazo" class="uppercase">prazo <span class="lowercase">(em meses)</span></label>
                <input type="number" name="payment_length" id="prazo" placeholder=" "
                min="<?= $env->getMinimumSimulationDuration() ?>"
                max="<?= $env->getMaximumSimulationDuration() ?>" step="1">
			</div>
			<div class="col input-col large-12">
                <div class="toggle-container">
                    <input type="checkbox" name="include_itbi_fee" id="include_itbi_fee">
                    <label class="flex align-middle" for="include_itbi_fee">
                        <span class="toggle-state"></span>
                        <h2 class="uppercase mb-0 mt-0">incluir despesas(itbi) ? </h2>
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
		</div>   
	</div>	
</div>
