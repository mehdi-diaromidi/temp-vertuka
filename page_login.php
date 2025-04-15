<?php /* Template Name: صفحه ورود/ثبت نام */ ?>
<?php
get_header();
?>
<div class="w-100 d-flex">
    <div class="w-50 main-wrapper">
        <div class="login-wrapper">
            <div class="login-heading">
                <div class="d-lg-flex d-block justify-content-between">
                    <div class="mb-3 mb-lg-0">
                        <a href="<?php echo get_bloginfo('url'); ?>">
                            <img src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="login" width="160">
                        </a>
                    </div>
                    <div>
                        <a class="button secondary d-block d-lg-inline-block" href="<?php echo get_bloginfo('url'); ?>">
                            برگشت به صفحه اصلی
                            <i class="icon left-arrow-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="content">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <div class="d-block d-md-flex">
                    <?php
                    if (single_post_title(null, false) == "ورود") {
                    ?>
                        <div class="pe-1">
                            <a class="button secondary d-block w-100" href="<?php echo esc_url(get_bloginfo('url')); ?>/register/">
                                <i class="icon left-arrow-2"></i>
                                <span class="">ثبت نام</span>
                            </a>
                        </div>
                    <?php }
                    if (single_post_title(null, false) == "ثبت نام") {
                    ?>
                        <div class="mx-0 me-md-3 mb-3 mb-md-0">
                            <a class="button secondary d-block w-100" href="<?php echo esc_url(get_bloginfo('url')); ?>/login/">
                                <i class="icon left-arrow-2"></i>
                                <span class="">ورود به پنل کاربری</span>
                            </a>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>

            <p class="agreement-privacy">
                ثبت‌نام شما به‌معنای پذیرش <span class="brand"><a href="/terms-and-conditions" class="text-dark">قوانین و مقررات</a></span> ورتوکا است.
            </p>
        </div>
    </div>

    <div class="w-50 bg-wrapper d-none d-md-block">

    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const inputFields = document.querySelectorAll('.med-input');

        inputFields.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                const currentInput = event.target;

                if (currentInput.value.length === 1) {
                    if (index < inputFields.length - 1) {
                        inputFields[index + 1].focus();

                    } else {
                        // All inputs are filled, you can perform any action you want here
                    }
                }
            });
        });
    });

    (function($) {
        "use strict";
        jQuery(document).ready(function($) {
            var password = generatePassword();
            $('#signupform #password').val(password);
            console.log(password);

            function generatePassword() {
                var length = 12; // Change this to set the desired password length
                var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-+=<>?/"; // You can customize this character set

                var password = "";
                for (var i = 0; i < length; i++) {
                    var randomIndex = Math.floor(Math.random() * charset.length);
                    password += charset.charAt(randomIndex);
                }

                return password;
            }
            $('#signupform #password').attr('readonly', 'readonly');
            $('#signupform #password').closest('.registerpress-input-box').addClass('d-none');

            $('#signupform #username').on('keyup', function() {
                var username = $(this).val();
                var generated_email = username + '@' + window.location.hostname;
                $('#signupform #email').attr('readonly', 'readonly');
                $('#signupform #email').val(generated_email);
            });
            $('#signupform #email').closest('.registerpress-input-box').addClass('d-none');


        });
    })(jQuery);
</script>
<style>
    #signupform #password {
        display: none;
    }

    #signupform #email {
        display: none;
    }
</style>
<?php
get_footer();
