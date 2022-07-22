const OBAH_SIMULATOR = {
    _defs: app_data.simulator,
    calculateAge: birthday => {
        const birthDate = new Date(birthday);
        const diff      = Date.now() - birthDate.getTime();
        const ageDate   = new Date(diff);
        return Math.abs(ageDate.getUTCFullYear() - 1970); 
    },
    getMaximumDuration: age => {
        const ageMax = age > OBAH_SIMULATOR._defs.maxAge ? 0 : (OBAH_SIMULATOR._defs.maxAge - age) * 12;
        return Math.min( ageMax, OBAH_SIMULATOR._defs.maxDuration )
    },
    getMinimumInitialPayment: totalAmount => totalAmount * OBAH_SIMULATOR._defs.minInitialPaymentRatio,
    hasAgeInRange: age => age >= OBAH_SIMULATOR._defs.minAge && age <= OBAH_SIMULATOR._defs.maxAge,
    getPriceFromInput: $input => {
        const pricePieces  = $input.val().split(',');
        const price = pricePieces[0].replace(/[.,\s]/g, '');
        return parseInt( price );
    },
    getItbiAmount: propertyPrice => propertyPrice * OBAH_SIMULATOR._defs.itbiFee
}


jQuery(function($){
    const $createSimulationForm = $('#create-simulation-form');
    const $updateSimulationForm = $('#update-simulation-form');
    const $propertyPriceInput   = $('#property_price');
    const $initialPaymentInput  = $('#initial_payment');
    const $hasSecondBuyerInput  = $('#has_second_buyer');
    const $secondBuyerContainer = $('.second-buyer-fields-container');
    const $includeItbiInput     = $('#include_itbi_fee');
    const $initialPaymentAlert  = $('.initial-payment-rule-text');

    const ERROR_CLASS           = 'flashing-alert';

    $('.mask-cpf').mask('000.000.000-00', {reverse: false});
    $('.mask-phone').mask('(00) 0 0000-0000');
    $('.mask-money').mask("#.##0,00", {reverse: true});

    $secondBuyerContainer.hide();

    // CREATE OBAH SIMULATION
    $createSimulationForm.on('submit', function(e){
        const userBirth = $(this).find('#birthday').val();
        const userAge = OBAH_SIMULATOR.calculateAge(userBirth);

        e.preventDefault();

        if (OBAH_SIMULATOR.hasAgeInRange(userAge)) {
            $.post(app_data.url, $createSimulationForm.serialize(), function(res){
                if(res.success) {
                    Swal.fire(
                        'Dados enviados com sucesso!',
                        'Você será redirecionado para o simulador.',
                        'success'
                    ).then(() => {
                        window.location.href=res.data;
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: res.data
                    });
                }
            })
        } else if (!$(this).find('input').hasClass(ERROR_CLASS)) {
            Swal.fire({
                icon: 'error',
                title: 'Algo deu errado!',
                text: $(this).find('.initial-payment-rule-text').text().trim(),
                footer: 'Confira suas informações e tente novamente, por favor.'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Parece que sua idade não está dentro da idade aceita para realizar uma simulação em nossa plataforma.'
            });
        }

        $('button.send-obah-simulation').addClass('is-loading');

    });

    // EDIT OBAH SIMULATION
    $updateSimulationForm.on('submit', function(e){
        e.preventDefault();

        if (!$(this).find('input').hasClass(ERROR_CLASS)) {
            $.post(app_data.url, $updateSimulationForm.serialize(), function(res){
                if(res.success) {
                    Swal.fire(
                        'Dados atualizados com sucesso!',
                        'Os dados da sua simulação foram atualizados.',
                        'success'
                    ).then(() => {
                        $('#container-form_simulation_table').html( res.data )
                    })
    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: res.data
                    });
                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Algo deu errado!',
                text: $(this).find('.initial-payment-rule-text').text().trim(),
                footer: 'Confira suas informações e tente novamente, por favor.'
            });
        }
    })

    // PROPERTY PRICE GENERAL VALIDATION
    $propertyPriceInput.on('change', function(){
        updateItbiAmount()

        const currentPrice      = OBAH_SIMULATOR.getPriceFromInput( $propertyPriceInput );
        const minInitialPayment = OBAH_SIMULATOR.getMinimumInitialPayment( currentPrice ) + parseInt($propertyPriceInput.data('itbi'));
        const minAcceptedValue  = $propertyPriceInput.data('min');
        const maxAcceptedValue  = $propertyPriceInput.data('max');

        if (!$propertyPriceInput.val()) {
            $propertyPriceInput.removeClass(ERROR_CLASS)
            $initialPaymentAlert.text('');
        } else if (currentPrice < minAcceptedValue) {
            $propertyPriceInput.addClass(ERROR_CLASS)
            $initialPaymentAlert.text('O valor do imóvel deve ser maior que ' + minAcceptedValue.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        } else if (currentPrice > maxAcceptedValue) {
            $propertyPriceInput.addClass(ERROR_CLASS)
            $initialPaymentAlert.text('O valor do imóvel deve ser menor que ' + maxAcceptedValue.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        } else {
            $propertyPriceInput.removeClass(ERROR_CLASS)
            $initialPaymentAlert.text('O valor mínimo de entrada deve ser ' + minInitialPayment.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        }

        $initialPaymentInput.attr('min', minInitialPayment);
        $initialPaymentInput.data('min', minInitialPayment);
        $initialPaymentInput.trigger('change')
    })

    // INITIAL PAYMENT GENERAL VALIDATION
    $initialPaymentInput.on('change', function(){
        const currentPrice     = OBAH_SIMULATOR.getPriceFromInput( $initialPaymentInput );
        const propertyPrice    = OBAH_SIMULATOR.getPriceFromInput( $propertyPriceInput );
        const minAcceptedValue = $initialPaymentInput.data('min');

        if (!$(this).val()) {
            $(this).removeClass(ERROR_CLASS)
        } else if (currentPrice < minAcceptedValue) {
            $(this).addClass(ERROR_CLASS)
            $initialPaymentAlert.text('O valor inserido deve ser maior que ' + minAcceptedValue.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        } else if (currentPrice > propertyPrice) {
            $(this).addClass(ERROR_CLASS)
            $initialPaymentAlert.text('O valor da entrada não pode ser maior que o valor do imóvel.');
        } else if (currentPrice === propertyPrice) {
            $(this).addClass(ERROR_CLASS)
            $initialPaymentAlert.text('O valor da entrada não pode ser igual ao valor do imóvel.');
        } else {
            $(this).removeClass(ERROR_CLASS)
        }
        
    })

    // UPDATE INITAL PAYMENT ON ITBI CHANGE
    $includeItbiInput.on('change', function() {
        updateItbiAmount();
        $propertyPriceInput.trigger('change')
    });

    // HIDE SECOND BUYER FIELDS BY INPUT VALUE
    $hasSecondBuyerInput.on('change', function(){
        const $currentVal   = $(this).val();

        if ($currentVal === 'Não') {
            $secondBuyerContainer.hide();
        } else if ($currentVal === 'Sim') {
            $secondBuyerContainer.show();
        } else {
            $secondBuyerContainer.hide();
        }
        
    })
    
    function updateItbiAmount() {
        const include = $includeItbiInput.is(':checked');
        const propertyPrice = OBAH_SIMULATOR.getPriceFromInput( $propertyPriceInput );
        const itbiAmount = include ? OBAH_SIMULATOR.getItbiAmount( propertyPrice ) : 0;

        $propertyPriceInput.data('itbi', itbiAmount);
    }
})
