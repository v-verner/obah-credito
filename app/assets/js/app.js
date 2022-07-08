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

    $('.mask-cpf').mask('000.000.000-00', {reverse: false});

    $('.mask-phone').mask('(00) 0 0000-0000');

    $('.mask-money').mask('000.000.000.000.000,00', {reverse: false});
})



   
 
