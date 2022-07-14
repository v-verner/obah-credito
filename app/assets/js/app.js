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

    $('.mask-cpf').mask('000.000.000-00', {reverse: false});
    $('.mask-phone').mask('(00) 0 0000-0000');
    $('.mask-money').mask("#.##0,00", {reverse: true});

    // CREATE OBAH SIMULATION
    $createSimulationForm.on('submit', function(e){
        const userBirth = $(this).find('#birthday').val();
        const userAge = OBAH_SIMULATOR.calculateAge(userBirth);

        $('.send-obah-simulation').addClass('loading');

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
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Parece que sua idade não está dentro da idade aceita para realizar uma simulação em nossa plataforma.'
            });
        }
    });

    // EDIT OBAH SIMULATION
    $updateSimulationForm.on('submit', function(e){
        e.preventDefault();

        $.post(app_data.url, $updateSimulationForm.serialize(), function(res){
            if(res.success) {
                Swal.fire(
                    'Dados atualizados com sucesso!',
                    'Os dados da sua simulação foram atualizados.',
                    'success'
                ).then(() => {
                    $('#container-form_simulation_table').html( res.data )
                    console.log(res)
                })

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Algo deu errado!',
                    text: res.data
                });
            }
        })
    })

    // INITIAL PAYMENT MINIMUM ACCEPTED VALUE MESSAGE
    $propertyPriceInput.on('change', function(){
        const pricePieces  = $(this).val().split(',');
        const currentPrice = pricePieces[0].replace(/[.,\s]/g, '');
        const minInitialPayment = OBAH_SIMULATOR.getMinimumInitialPayment(currentPrice);

        $('#initial_payment').attr('min', minInitialPayment);
        $('.initial-payment-rule-text').text('O valor mínimo de entrada deve ser ' + minInitialPayment.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        
    })
    
})
