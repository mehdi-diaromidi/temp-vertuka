<?php

$order_id = esc_attr($_GET['order']);

$order = wc_get_order($order_id);

$user = wp_get_current_user();

$user_info = get_userdata($user->ID);

$mobile = $user_info->user_login;

//address

$shipping_address = $order->get_formatted_shipping_address();

// echo "<pre>";var_dump($order->get_address('shipping')['address_1']);die;

$shipping_address = str_replace(array('<br/>', '<br>', '< br>', '</ br>'), ', ', $shipping_address);

// echo "<pre>"; var_dump( $order );



if ($user->ID != $order->get_user_id()) {

    die('Smille');

}

?>

<main class="rounded-3">

    <div class="my-3">

        <a class="d-flex justify-content-between page-title-dashboard-box d-lg-none" id="sidebar-mobile-menu">

            <div class="d-flex">

                <div class="me-2"><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/cart.svg')); ?>" alt="icon"></div>

                <div>

                    <h1 class="page-title-dashboard mb-0">سفارش</h1>

                </div>

            </div>

            <div><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>" alt="icon"></div>

        </a>

    </div>



    <div class="order-box-detail-box">

        <div class="d-block d-lg-flex flex-row-reverse mb-32 justify-content-between">

            <div class="go-back-btn-box">

                <a href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/orders/" class="d-block return-to-orders standard-hover">

                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/right arrow.svg')); ?>" alt>

                    <span>بازگشت به سفارش&zwnj;ها</span>

                </a>

            </div>



            <div class="d-block d-lg-flex">

                <div class="me-3 my-3 my-lg-0">

                    <h5 class="order-code m-0">سفارش <?php echo $order_id; ?></h5>

                </div>

                <!-- <div class="me-3 d-flex">

                    <div>

                        <h6 class="text-gray m-0">کد تحویل کالا:</h6>

                    </div>

                    <div class="ms-2"><span class="fw-bold">#<?php echo '1' . $order_id; ?></span></div>

                </div> -->

                <div class="me-3 d-flex">

                    <div><img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Time_duotone.svg')); ?>" alt></div>

                    <div>

                        <h6 class="mt-1">

                            تاریخ ثبت سفارش:

                            <?php

                            $order_info = $order->get_data();

                            $date_paid = $order->get_date_created();

                            $date_paid = $date_paid->date_i18n('d F Y');

                            echo $date_paid;

                            ?>

                        </h6>

                    </div>

                </div>

            </div>

        </div>

        <?php

        $order_status = $order->get_status();

        $persian_status = '';



        if ($order_status == 'processing' || $order_status == 'accepted' || $order_status == 'receive-warehouse' || $order_status == 'preparation' || $order_status == 'delivery-carrier' || $order_status == 'case1' || $order_status == 'case2' || $order_status == 'case3' || $order_status == 'case31' || $order_status == 'case32' || $order_status == 'case33' || $order_status == 'case34' ) {

            $order_status = 'processing';

            $persian_status = 'در حال انجام';

        }



        // if ($order_status == 'case1') {

        //     $order_status = 'on-hold';

        // }



        if ($order_status == 'completed') {

            $order_status = 'completed';

            $persian_status = 'تحویل داده شده';

        }



        if ($order_status == 'cancelled') {

            $persian_status = 'لغو شده';

            $order_status = 'cancelled';

        }



        if ($order_status == 'case35' || $order_status == 'returned-sale') {

            $order_status = 'returned';

            $persian_status = 'مرجوع شده';

        }



        



        ?>



        <div class="order-situation-box mb-32">

            <div class="d-flex justify-content-between mb-4 filter-item <?php echo esc_attr($order_status); ?>">

                <div>

                    <h5>وضعیت سفارش</h5>

                </div>

                <div>

                    <p class="m-0 label-order bg-txt-green">

                        <?php

                        if ($order_status == 'on-hold' || $order_status == 'cancelled') {

                            $persian_status = 'لغو شده';

                        } elseif ($order_status == 'completed') {

                            $persian_status = 'تحویل داده شده';

                        } elseif ($order_status == 'processing') {

                            $persian_status = 'در حال انجام';

                        }

                        echo  $persian_status;

                        ?>

                    </p>

                </div>

            </div>



            <div class="bar-box">

                <div class="progress my-3">

                    <div class="progress-bar w-100 bg-transparent" role="progressbar" aria-valuenow="<?php echo $percent . '%'; ?>" aria-valuemin="0" aria-valuemax="100">

                        <div style="background: #48AE42;height: 100%; border-radius: 36px; width: <?php echo $percent . '%'; ?>;"></div>

                    </div>

                </div>

            </div>



        </div>



        <div class="order-items mb-32">

            <?php

            $order_items = wc_get_order($order_id);



            foreach ($order_items->get_items() as $item_id => $item) {

                $product_name = $item->get_name();

                $quantity = $item->get_quantity();

                $data_Stored = $item->get_data_store();

                $subtotal = $item->get_subtotal();

                $product_id = $item->get_product_id();

                // $product = wc_get_product($product_id);

                $product = $item->get_product();

                $thumbnail = $product->get_image(array(186, 186));

                $esc_post_url = esc_url(get_the_permalink($product_id));



            ?>

                <div class="order-detail-item">

                    <div class="d-flex justify-content-between">

                        <div class="item-info-box">

                            <div class="d-flex">

                                <div class="me-3 pt-4 pt-md-0">

                                    <div class="thumbnail-box">

                                        <a href="<?php echo $esc_post_url; ?>" target="_blank"><?php echo $thumbnail; ?></a>

                                    </div>

                                </div>



                                <div class="position-relative">

                                    <div class="inner-box-float py-4">

                                        <div class="category mb-2"><?php vertuka_get_category_html($product_id); ?></div>

                                        <div class="quantity mb-0 mb-md-2">تعداد: <strong><?php echo $quantity; ?></strong></div>

                                        <div class="product-name mb-2">

                                            <a href="<?php echo $esc_post_url; ?>" target="_blank">

                                                <h2 class="title"><?php echo $product_name; ?></h2>

                                            </a>

                                        </div>

                                        <!-- <div class="gauranty">

                                            <div class="d-flex">

                                                <div><img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Headphones_fill1.svg')); ?>" alt="icon"></div>

                                                <div><p class="m-0">پشتیبانی پیش فرض 6 ماهه (رایگان)</p></div>

                                            </div>

                                        </div> -->

                                        <div class="d-block d-md-none mt-2">

                                            <div class="m-0 price position-relative top-0 d-flex left-0">

                                                <p class="mb-0 orginal-price-discounted-product-2 me-2">

                                                    <del>

                                                        <?php

                                                        if ($product_id == $product_id) {

                                                            // Get regular price

                                                            $regular_price = $item->get_product()->get_regular_price();



                                                            // Get discounted price

                                                            $discounted_price = $item->get_product()->get_price();



                                                            // Output the prices

                                                            if ($regular_price != $discounted_price) {

                                                                echo vertuka_the_persian_number(number_format($regular_price)) . '<span> تومان</span>';

                                                            }

                                                        }



                                                        ?>

                                                    </del>

                                                </p>

                                                <p class="m-0 mobile-price">

                                                    <?php echo vertuka_the_persian_number(number_format($subtotal)); ?><span> تومان</span>

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="price-box d-none d-md-block position-relative">





                            <div class="m-0 price">

                                <p class="mb-2 orginal-price-discounted-product-2">

                                    <del>

                                        <?php

                                        if ($product_id == $product_id) {

                                            // Get regular price

                                            $regular_price = $item->get_product()->get_regular_price();



                                            // Get discounted price

                                            $discounted_price = $item->get_product()->get_price();



                                            // Output the prices

                                            // var_dump($regular_price, $discounted_price);

                                            if ($regular_price != $discounted_price) {

                                                echo vertuka_the_persian_number(number_format($regular_price)) . '<span> تومان</span>';

                                            }

                                        }



                                        ?>

                                    </del>

                                </p>

                                <?php echo vertuka_the_persian_number(number_format($subtotal)); ?><span> تومان</span>

                            </div>

                        </div>

                    </div>

                </div>

            <?php

            }

            ?>

        </div>





        <div class="invoice-box-wrapper">

            <div class="invoice-box">

                <div class="d-block  d-lg-flex justify-content-between">

                    <div>

                        <div class="d-flex justify-content-between">

                            <p class="mb-2 me-lg-2 me-0">

                                <span>موبایل گیرنده :</span>

                                <br class="d-md-none d-lg-none d-xl-none">

                                <strong><?php echo esc_html($order->get_address('shipping')['phone']); ?></strong>

                            </p>



                            <p class="mb-2">

                                <span>نام گیرنده :</span>

                                <br class="d-md-none d-lg-none d-xl-none">

                                <strong>

                                    <?php

                                    echo $order->get_address('shipping')['first_name'] . ' ' . $order->get_address('shipping')['last_name'];

                                    ?>

                                </strong>

                            </p>

                        </div>

                        <div>

                            <p class="m-0">

                                <span>آدرس:</span>

                                <strong>

                                    <?php echo $order->get_address('shipping')['address_1']; ?>

                                </strong>

                            </p>

                        </div>

                        <p class="shipping-method mt-2">

                            <?php



                            $shipping_type = explode(" ", $order->get_meta('_vertuka_custom_text_field', true));
                            if ($order->get_meta('_vertuka_custom_text_field', true) == 'پست') {
                                echo 'روش ارسال: پست';
                            }



                            if ($order->get_meta('_vertuka_custom_text_field', true) == 'پست-رایگان') {

                                echo 'روش ارسال: پست';

                            }



                            if ($order->get_meta('_vertuka_custom_text_field', true) == 'پیک-توربو') {

                                echo 'ارسال توربو ' . jdate('d-m-Y', strtotime($order->get_date_created()));

                            }



                            if ($shipping_type[0] == 'ساعت') {
                                echo 'ارسال عادی: ' . explode("-", $shipping_type[1])[2] . ' بازه (' . explode("-", $shipping_type[1])[0] . '-' . explode("-", $shipping_type[1])[1] . ')';
                            }



                            ?>

                        </p>

                    </div>



                    <div class="mt-3 mt-lg-0 text-center text-md-end">

                        <!-- <a href="/my-account/print-order/<?php echo $order->get_id(); ?>" class="print-url btn bg-white py-2 px-3 rounded-4 text-center download-invoice d-inline-block d-lg-flex"> -->

                        <a href="/my-account/print-order/<?php echo $order->get_id(); ?>" class="btn bg-white py-2 px-3 rounded-4 text-center download-invoice d-inline-block d-lg-flex mt-3" download>

                            <div><i class="icon download-icon"></i></div>

                            <div><span>دانلود فاکتور</span></div>

                            <?php

                            //$fac = new WCDN_Theme;

                            //$fac->create_print_button_order_page($order->get_id());

                            ?>

                        </a>

                    </div>

                </div>

            </div>



            <div class="order-specifications">



                <?php

                if (WC()->payment_gateways()) {

                    $payment_gateways = WC()->payment_gateways->payment_gateways();

                } else {

                    $payment_gateways = array();

                }

                $payment_method = $order->get_payment_method();

                ?>

                <div class="mt-3">

                    <span class="order-specifications-title">روش پرداخت:

                    </span>

                    <span class="d-none">پرداخت اینترنتی - </span>

                    <span class="fw-bold">

                        <?php

                        if ($payment_method && 'other' !== $payment_method) {

                            echo sprintf(

                                /* translators: %s: payment method */

                                // __('Payment via %s', 'woocommerce'),

                                esc_html(isset($payment_gateways[$payment_method]) ? $payment_gateways[$payment_method]->get_title() : $payment_method)

                            );

                        }

                        ?>

                    </span>

                </div>

                <!-- <div class="mt-3">

                            <span class="order-specifications-title">تاریخ تحویل

                                سفارش:</span>

                    <span class="">۲۱ دی ۱۴۰۱</span>

                </div> -->

            </div>



            <div class="return mt-2">

                <?php

                if ($order_status == 'processing' || $order_status == 'accepted' || $order_status == 'receive-warehouse' || $order_status == 'preparation') {

                ?>

                    <button class="btn w-100 return-cancel">

                        <p class="m-0 label-order bg-txt-green">

                            لغو سفارش

                        </p>

                    </button>

                    <form class="return-form-cancel" style="display: none" id="return-form-cancel">

                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

                        <div class="form-group">

                            <label for="exampleFormControlTextarea1">آیا از لغو سفارش خود مطمئن هستید؟</label><button type="submit" class="btn btn-success mx-2">بله</button>

                        </div>

                    </form>

                <?php

                }

                ?>



                <div class="result" style="display: none"></div>



                <?php

                $order_status = $order->get_status();

                // one week return time 604800

                if ($order_status == 'completed' && $order->get_meta('order_completed_time', true) && $order->get_meta('order_completed_time', true)+604800 > time() ) {

                ?>

                    <button class="btn w-100 return-btn">

                        <p class="m-0 label-order bg-txt-green">

                            درخواست مرجوعی

                        </p>

                    </button>

                    <form class="return-form" style="display: none" id="return-form">

                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

                        <div class="form-group">

                            <label for="exampleFormControlTextarea1">لطفا دلیل درخواست خود را بنویسید:</label>

                            <textarea name="request_text" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>

                        </div>

                        <div>

                            <button type="submit" class="btn btn-success mt-2 ">ارسال</button>

                        </div>

                    </form>

                <?php

                }

                ?>



                <?php

                if ($order->get_meta('_return_request_cancel', true) != '') {

                ?>

                    <div>درخواست لغو سفارش ثبت شده است.</div>

                <?php

                }

                ?>



                <?php

                if ($order->get_meta('_return_request', true) != '') {

                ?>

                    <div>درخواست مرجوع کالا ثبت شده است.</div>

                <?php

                }

                ?>



                <script>

                    jQuery(document).ready(function() {

                        jQuery(".download-invoice").click(function() {

                            jQuery("#mjModal").css("display", "block");

                            setTimeout(

                                function() {

                                    jQuery("#mjModal").css("display", "none");

                                }, 5000);

                        });



                        jQuery(".return-cancel").click(function() {

                            jQuery(".return-form-cancel").slideToggle();

                        });

                        jQuery("#return-form-cancel").submit(function(e) {

                            e.preventDefault();



                            jQuery.ajax({

                                type: "post",

                                url: `${window.location.origin}/wp-admin/admin-ajax.php`,

                                data: {

                                    action: "save_return_request_cancel", // the action to fire in the server

                                    data: jQuery(this).serialize(), // any JS object

                                },

                                success: function(response) {

                                    jQuery(".return-cancel").slideToggle();

                                    jQuery(".return-form-cancel").slideToggle();

                                    jQuery(".result").text(response.message);

                                    jQuery(".result").show();

                                },

                            });







                        });

                        jQuery(".return-btn").click(function() {

                            jQuery(".return-form").slideToggle();

                        });

                        jQuery("#return-form").submit(function(e) {

                            e.preventDefault();

                            jQuery.ajax({

                                type: "post",

                                url: `${window.location.origin}/wp-admin/admin-ajax.php`,

                                data: {

                                    action: "save_return_request", // the action to fire in the server

                                    data: jQuery(this).serialize(), // any JS object

                                },

                                success: function(response) {

                                    jQuery(".return-btn").slideToggle();

                                    jQuery(".return-form").slideToggle();

                                    jQuery(".result").text(response.message);

                                    jQuery(".result").show();

                                },

                            });



                        });

                    });

                </script>



            </div>

        </div>

    </div>



</main>



<script>

    //LISTEN FOR PRINT URL ITEMS TO BE CLICKED

    jQuery(document).off('click.PrintUrl').on('click.PrintUrl', '.print-url', function(e) {



        //PREVENT OTHER CLICK EVENTS FROM PROPAGATING

        e.preventDefault();



        //TRY TO ASK THE URL TO TRIGGER A PRINT DIALOGUE BOX

        printUrl(jQuery(this).attr('href'));

    });



    //TRIGGER A PRINT DIALOGE BOX FROM A URL

    function printUrl(url) {



        //CREATE A HIDDEN IFRAME AND APPEND IT TO THE BODY THEN WAIT FOR IT TO LOAD

        jQuery('<iframe src="' + url + '"></iframe>').hide().appendTo('body').on('load', function() {



            var oldTitle = jQuery(document).attr('title'); //GET THE ORIGINAL DOCUMENT TITLE

            var that = jQuery(this); //STORE THIS IFRAME AS A VARIABLE           

            var title = jQuery(that).contents().find('title').text(); //GET THE IFRAME TITLE

            jQuery(that).focus(); //CALL THE IFRAME INTO FOCUS (FOR OLDER BROWSERS)   



            //SET THE DOCUMENT TITLE FROM THE IFRAME (THIS NAMES THE DOWNLOADED FILE)

            if (title && title.length) jQuery(document).attr('title', title);



            //TRIGGER THE IFRAME TO CALL THE PRINT

            jQuery(that)[0].contentWindow.print();



            //LISTEN FOR THE PRINT DIALOGUE BOX TO CLOSE

            jQuery(window).off('focus.PrintUrl').on('focus.PrintUrl', function(e) {

                e.stopPropagation(); //PREVENT OTHER WINDOW FOCUS EVENTS FROM RUNNING            

                jQuery(that).remove(); //GET RID OF THE IFRAME

                if (title && title.length) jQuery(document).attr('title', oldTitle); //RESET THE PAGE TITLE

                jQuery(window).off('focus.PrintUrl'); //STOP LISTENING FOR WINDOW FOCUS

            });

        });

    };

</script>

<!-- The Modal -->

<div id="mjModal" class="mjModal">

    <!-- Modal content -->

    <div class="modal-content d-flex">

        <p>درحال آماده سازی فاکتور</p>

    </div>

</div>

<!-- MJ end popup -->

<style>

    /* The Modal (background) */

    .mjModal {

        display: none;

        /* Hidden by default */

        position: fixed;

        /* Stay in place */

        z-index: 1;

        /* Sit on top */

        padding-top: 100px;

        /* Location of the box */

        left: 0;

        top: 0;

        width: 100%;

        /* Full width */

        height: 100%;

        /* Full height */

        overflow: auto;

        /* Enable scroll if needed */

        background-color: rgb(0, 0, 0);

        /* Fallback color */

        background-color: rgba(0, 0, 0, 0.4);

        /* Black w/ opacity */

    }



    #mjModal {

        padding-top: 300px;

        background-color: rgba(100, 100, 100, 0.7);

    }



    /* Modal Content */

    .mjModal .modal-content {

        background-color: #fefefe;

        margin: auto;

        padding: 40px;

        border: 1px solid #888;

        width: 50%;

        text-align: center;

        font-size: 13px;

        overflow-y: scroll;

        scrollbar-width: none;

        /* Firefox */

        -ms-overflow-style: none;

        /* Internet Explorer 10+ */

        border-radius: 20px;

    }



    .mjModal {

        padding-top: 100px;

        background-color: rgba(100, 100, 100, 0.7);

    }



    .mjModal p {

        margin-top: 10px;

    }



    #mjModalOnlyOne .modal-content {

        height: 150px;

        font-size: 16px;

        text-align: center;

        top: 30%;

    }



    #mjModalOnlyOne .div-close {

        width: 35px !important;

        height: 35px !important;

        border-radius: 100% !important;

        padding: 6px !important;

        background-color: #d6d6d6;

    }

</style>