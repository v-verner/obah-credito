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
    hasAgeInRange: age => age >= OBAH_SIMULATOR._defs.minAge && age <= OBAH_SIMULATOR._defs.maxAge
}


jQuery(function($){
    const $createSimulationForm = $('#create-simulation-form');
    const $updateSimulationForm = $('#update-simulation-form');
    const $propertyPriceInput   = $('#property_price');
    const $initialPaymentInput  = $('#initial_payment');
    const $hasSecondBuyerInput  = $('#has_second_buyer');
    const $secondBuyerContainer = $('.second-buyer-fields-container');

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
        } else if (!$(this).find('input').hasClass('flashing-alert')) {
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

        if (!$(this).find('input').hasClass('flashing-alert')) {
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
        const $currentVal   = $(this).val();
        const pricePieces  = $currentVal.split(',');
        const currentPrice = pricePieces[0].replace(/[.,\s]/g, '');
        const minInitialPayment = OBAH_SIMULATOR.getMinimumInitialPayment(currentPrice);
        const minAcceptedValue  = $(this).data('min');
        const maxAcceptedValue  = $(this).data('max');

        if (!$currentVal) {
            $(this).removeClass('flashing-alert')
        } else if (currentPrice < minAcceptedValue) {
            $(this).addClass('flashing-alert')
            $('.initial-payment-rule-text').text('O valor do imóvel deve ser maior que ' + minAcceptedValue.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        } else if (currentPrice > maxAcceptedValue) {
            $(this).addClass('flashing-alert')
            $('.initial-payment-rule-text').text('O valor do imóvel deve ser menor que ' + maxAcceptedValue.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        } else {
            $(this).removeClass('flashing-alert')
            $('.initial-payment-rule-text').text('O valor mínimo de entrada deve ser ' + minInitialPayment.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        }

        $initialPaymentInput.attr('data-min', minInitialPayment);
        
    })

    // INITIAL PAYMENT GENERAL VALIDATION
    $initialPaymentInput.on('change', function(){
        const $currentVal   = $(this).val();
        const pricePieces   = $currentVal.split(',');
        const propertyPieces   = $propertyPriceInput.val().split(',');
        const currentPrice     = pricePieces[0].replace(/[.,\s]/g, '');
        const propertyPrice    = propertyPieces[0].replace(/[.,\s]/g, '');
        const minAcceptedValue = OBAH_SIMULATOR.getMinimumInitialPayment(propertyPrice);

        if (!$currentVal) {
            $(this).removeClass('flashing-alert')
        } else if (currentPrice < minAcceptedValue) {
            $(this).addClass('flashing-alert')
            $('.initial-payment-rule-text').text('O valor inserido deve ser maior que ' + minAcceptedValue.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        } else if ($currentVal > $propertyPriceInput.val()) {
            $(this).addClass('flashing-alert')
            $('.initial-payment-rule-text').text('O valor da entrada não pode ser maior que o valor do imóvel.');
        } else {
            $(this).removeClass('flashing-alert')
        }
        
    })

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
    
})
