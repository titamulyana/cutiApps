function limitInputValue(inputElement, maxAllowedValue) {
    inputElement.on('input', function() {
        var inputValue = parseFloat(inputElement.val());

        if (inputValue > maxAllowedValue) {
            inputElement.val(maxAllowedValue);
        }
    });
}
$(document).ready(function() {
    limitInputValue($('.validation-cuti-tahunan'), 12);
    limitInputValue($('.validation-cuti-hamil'), 90);
});

//hide cuti hamil
$(document).ready(function() {
    function disabledCutiHamil() {
        $('.cuti-hamil').attr('disabled', true);
        $('.cuti-hamil').val(0);
    }
    
    function enableCutiHamil() {
        $('.cuti-hamil').val('');
        $('.cuti-hamil').attr('disabled', false);
    }

    var genderSelect = $('.jenis-kelamin');

    genderSelect.on('change', function() {
        var selectedValue = genderSelect.val();

        if (selectedValue === 'laki-laki') {
            disabledCutiHamil();
        } else {
            enableCutiHamil();
        }
    });

    if (genderSelect.val() === 'laki-laki') {
        disabledCutiHamil();
    }
});
