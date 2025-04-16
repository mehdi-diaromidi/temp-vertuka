jQuery(document).ready(function ($) {
  if ($('body').hasClass('woocommerce-checkout')) {
    const fields = ['#addresspress-first-name', '#addresspress-last-name', '#addresspress-phone'];

    $('#addresspress-check-receiver').on('change', function () {
      const isChecked = $(this).is(':checked');
      const userFirstName = $('#addresspress-title').data('user-first_name');
      const userLastName = $('#addresspress-title').data('user-last_name');
      const userPhoneNumber = $('#addresspress-title').data('user-phone_number');

      // Loop through fields to apply changes
      fields.forEach((field) => {
        const $field = $(field);

        if (isChecked) {
          // Set values and disable fields
          if ($field.is('#addresspress-first-name')) {
            $field.val(userFirstName);
          } else if ($field.is('#addresspress-last-name')) {
            $field.val(userLastName);
          } else if ($field.is('#addresspress-phone')) {
            $field.val(userPhoneNumber);
          }

          $field.addClass('save-addr-lower-color').prop('readonly', true).prop('disabled', true);
        } else {
          $field.val('').removeClass('save-addr-lower-color').prop('readonly', false).prop('disabled', false);
        }
      });
    });
  }
});
