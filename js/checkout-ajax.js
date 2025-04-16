
jQuery(document).ready(function($) {

    $('#addresspress-check-receiver').on('change', function() {
        var firstName = $('#addresspress-title').data('user-first_name');
        var lastName = $('#addresspress-title').data('user-last_name');
        var phone = $('#addresspress-title').data('user-phone_number');

        var fields = [
            {selector: '#addresspress-first-name', value: firstName},
            {selector: '#addresspress-last-name', value: lastName},
            {selector: '#addresspress-phone', value: phone}
        ];

        if ($(this).is(':checked')) {
            fields.forEach(function(field) {
                $(field.selector).closest('.mb-4').hide().fadeIn(300);
            });

            function fillField(index) {
                if (index >= fields.length) return;

                var field = $(fields[index].selector);
                var value = fields[index].value;

                field.prop('disabled', false).prop('readonly', false).removeClass('save-addr-lower-color');

                field.focus();
                field.val(value);

                var domInput = field[0];
                domInput.selectionStart = domInput.selectionEnd = domInput.value.length;

                setTimeout(function() {
                    field.blur();

                    field.addClass('save-addr-lower-color').prop('readonly', true);

                    setTimeout(function() {
                        fillField(index + 1);
                    }, 200);
                }, 400);
            }

            fillField(0);
        } else {
            fields.forEach(function(field) {
                var fieldElement = $(field.selector);
                fieldElement
                    .val('')
                    .removeClass('save-addr-lower-color')
                    .prop('readonly', false);

                fieldElement.closest('.mb-4').fadeOut(100).fadeIn(100);
            });
        }
    });

});

