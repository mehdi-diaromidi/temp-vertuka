<?php
get_header();

if (isset($_GET['item'])) {
    $items = explode(',', esc_html($_GET['item']));
    for ($d = 0; $d < 4; $d++) {
        if (is_numeric($items[$d]) && intval($items[$d]) != 0) {
            $products[] = intval($items[$d]);
        }
    }
}

$first_product = wc_get_product($products[0]);
$categories = get_the_terms($products[0], 'product_cat');
$last_category = '';
if ($categories && !is_wp_error($categories)) {
    foreach ($categories as $category) {
        if ($category->slug != 'offers' && $category->parent == 0) {
            $last_category = $category;
            $category_name = $last_category->name;
            $category_url = get_term_link($last_category);
            break;
        }
        if ($category->slug != 'offers' && $category->parent) {
            $parentcats = get_ancestors($category->term_id, 'product_cat');
            $last_category = get_term($parentcats[0]);
            $category_name = $last_category->name;
            $category_url = get_term_link($last_category);
            break;
        }
    }
    // if ($categories[0]->slug == 'offers') {
    //     if ($categories[1]->parent) {
    //         $last_category = get_term($categories[1]->term_id);
    //         $category_name = $last_category->name;
    //         $category_url = get_term_link($last_category);
    //     } else {
    //         $parentcats = get_ancestors($categories[1]->term_id, 'product_cat');
    //         $last_category = get_term($parentcats[1]);
    //         $category_name = $last_category->name;
    //         $category_url = get_term_link($last_category);
    //     }
    // } else {
    //     if ($categories[0]->parent) {
    //         $last_category = get_term($categories[0]->term_id);
    //         $category_name = $last_category->name;
    //         $category_url = get_term_link($last_category);
    //     } else {
    //         $parentcats = get_ancestors($categories[0]->term_id, 'product_cat');
    //         $last_category = get_term($parentcats[0]);
    //         $category_name = $last_category->name;
    //         $category_url = get_term_link($last_category);
    //     }
    // }
}

?>

<div class="select-product-compare py-3">
    <div class="container-fluid">
        <div class="subject-box d-flex">
            <div class="icon-box"><i class="icon exposure primary-4"></i></div>
            <div class="title-box">
                <h1 class="title">مقایسه کالا ها</h1>
            </div>
        </div>

        <div class="row items">
            <?php
            for ($pot = 0; $pot < 4; $pot++) {
            ?>
                <!-- Item-1 -->
                <div class="col-lg-3 col-md-4 col-6">
                    <?php
                    if (isset($products) && $products[$pot] && get_post_type($products[$pot]) == 'product') {
                        $MJ_price_new = mj_same_price_everywhere($products[$pot]);

                        if ($products[$pot]) {
                            $esc_thumbnail_url_1 = esc_url(get_the_post_thumbnail_url($products[$pot], 'post-thumbnail'));
                            $esc_title_1 = esc_html(get_the_title($products[$pot]));

                    ?>
                            <div id="product<?php echo $products[$pot]; ?>" class="item bg-white br-16 p-3">


                                <div><img class="img-fluid" src="<?php echo $esc_thumbnail_url_1; ?>" alt="<?php echo $esc_title_1; ?>"></div>

                                <div class="category">
                                    <a href="<?php echo $category_url; ?>" rel="tag"><?php echo $category_name; ?></a>
                                </div>
                                <div class="mb-32 pb-1">
                                    <h3 class="title"><?php echo $esc_title_1; ?></h3>
                                </div>
                                <div class="price-box">
                                    <div class="d-flex justify-content-between">
                                        <?php echo $MJ_price_new['text']; ?>

                                        <div>
                                            <?php
                                            if ($pot == 0) {
                                            ?>
                                                <a href="<?php echo get_the_permalink() . '?item=' . $products[1] . ',' . $products[2] . ',' . $products[3] ?>,;" class="remove">
                                                    <i class="icon trash red"></i>
                                                    <span>حذف</span>
                                                </a>

                                            <?php
                                            }
                                            if ($pot == 1) {
                                            ?>
                                                <a href="<?php echo get_the_permalink() . '?item=' . $products[0] . ',' . $products[2] . ',' . $products[3] ?>,;" class="remove">
                                                    <i class="icon trash red"></i>
                                                    <span>حذف</span>
                                                </a>
                                            <?php
                                            }
                                            if ($pot == 2) {
                                            ?>
                                                <a href="<?php echo get_the_permalink() . '?item=' . $products[0] . ',' . $products[1] . ',' . $products[3] ?>,;" class="remove">
                                                    <i class="icon trash red"></i>
                                                    <span>حذف</span>
                                                </a>
                                            <?php
                                            }
                                            if ($pot == 3) {
                                            ?>
                                                <a href="<?php echo get_the_permalink() . '?item=' . $products[0] . ',' . $products[1] . ',' . $products[2] ?>,;" class="remove">
                                                    <i class="icon trash red"></i>
                                                    <span>حذف</span>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <a href="#" class="d-block position-relative item bg-white br-16 p-3 empty" data-bs-toggle="modal" data-bs-target="#ChooseProductModal">
                            <div class="py-3 text-an-btn">
                                <div class="text-center mb-4"><i class="icon add-new"></i></div>
                                <div class="text-center">
                                    <h3 class="add-product-to-compare m-0">افزودن محصول</h3>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>

            <!-- Modal [Start] -->
            <div class="modal fade" id="ChooseProductModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog reseller-modal">
                    <div class="modal-content">
                        <input type="text" class="form-control mb-2" name="compare_product_search" id="compare_product_search" placeholder="محصول مورد نظر خود را جستجو کنید...">
                        <img class="compare_product_search_process icon-repeat" id="compare_product_search_process" src="<?php vertuka_show_image('assets/images/Process.svg'); ?>" alt="Process" style="width: 50px;margin: 20px auto auto auto;display: none;">
                        <div class="compare_product_search_results" id="compare_product_search_results"></div>
                    </div>
                </div>
            </div>
            <!-- Modal [End] -->
        </div>
    </div>
</div>


<!-- MJ -->
<?php
if (isset($products)) {
    $index = 0;
    $mj_products = array();
    foreach ($products as $key => $value) {
        if (get_post_type($value) == 'product') {
            $product_2 = wc_get_product($value);

            if ($product_2) {
                $label_group = '';
                $attributes_fixed_obj = array();
                $attributes_fixed_array = array();
                foreach (get_taxonomies() as $taxonomy) {
                    $label = get_taxonomy($taxonomy)->labels->singular_name;
                    if (strstr($label, '--')) {
                        $value = $product_2->get_attribute($taxonomy);
                        if ($value) {
                            if (!$label) {
                                $label = vertuka_get_feature_lable($taxonomy);
                            }
                            $label_array = explode('--', $label);
                            if ($label_array[0] !== $label_group) {
                                $label_group = $label_array[0];
                            }
                            $attributes_fixed_obj[$label_array[0]][$label_array[1]] = vertuka_the_persian_number($value);
                            $attributes_fixed_array[$label] = vertuka_the_persian_number($value);
                        }
                    }
                }
                if (!function_exists('customSort')) {
                    function customSort($array, $priority)
                    {
                        $sortedArray = array();

                        foreach ($priority as $index => $feature) {
                            if (isset($array[$feature])) {
                                $sortedArray[$feature] = $array[$feature];
                                unset($array[$feature]);
                            } else {
                                $sortedArray[$feature] = '-';
                            }
                        }
                        // Append any remaining elements to the end of the sorted array
                        $sortedArray += $array;

                        return $sortedArray;
                    }
                }


                $priorityArray = [
                    'شبکه--تکنولوژی شبکه',
                    'معرفی--تاریخ معرفی',
                    'بدنه--ابعاد',
                    'بدنه--وزن',
                    'بدنه--جنس بدنه',
                    'بدنه--تعداد سیم‌کارت',
                    'بدنه--استاندارد ضدآب بودن',
                    'نمایشگر--نوع نمایشگر',
                    'نمایشگر--اندازه نمایشگر',
                    'نمایشگر--رزولوشن نمایشگر',
                    'نمایشگر--فرکانس نمایشگر',
                    'نمایشگر--تراکم پیکسلی',
                    'نمایشگر--محافظ نمایشگر',
                    'نمایشگر--ویژگی‌های نمایشگر',
                    'سخت‌افزار و سیستم عامل--سیستم عامل',
                    'سخت‌افزار و سیستم عامل--نسخه سیستم عامل در زمان عرضه',
                    'سخت‌افزار و سیستم عامل--رابط کاربری',
                    'سخت‌افزار و سیستم عامل--چیپست',
                    'سخت‌افزار و سیستم عامل--CPU',
                    'سخت‌افزار و سیستم عامل--پردازنده گرافیکی',
                    'حافظه و رم--درگاه کارت حافظه',
                    'حافظه و رم--حافظه داخلی',
                    'حافظه و رم--رم',
                    'دوربین اصلی--نوع دوربین اصلی',
                    'دوربین اصلی--پیکربندی دوربین‌ها',
                    'دوربین اصلی--رزولوشن دوربین اصلی',
                    'دوربین اصلی--ویژگی‌های دوربین اصلی',
                    'دوربین اصلی--دوربین اولترا واید',
                    'دوربین اصلی--مشخصات دوربین اولترا واید',
                    'دوربین اصلی--دوربین تله',
                    'دوربین اصلی--مشخصات دوربین تله',
                    'دوربین اصلی--دوربین ماکرو',
                    'دوربین اصلی--مشخصات دوربین ماکرو',
                    'دوربین اصلی--دوربین تشخیص عمق',
                    'دوربین اصلی--مشخصات دوربین تشخیص عمق',
                    'دوربین اصلی--رزولوشن فیلم‌برداری',
                    'دوربین اصلی--قابلیت‌های فیلم‌برداری دوربین اصلی',
                    'دوربین سلفی--نوع دوربین سلفی',
                    'دوربین سلفی--رزولوشن دوربین سلفی',
                    'دوربین سلفی--ویژگی‌های دوربین سلفی',
                    'دوربین سلفی--قابلیت‌های فیلم‌برداری دوربین سلفی',
                    'صدا--جک ۳.۵ میلی‌متری',
                    'صدا--مشخصات اسپیکر',
                    'ارتباطات--WLAN',
                    'ارتباطات--بلوتوث',
                    'ارتباطات--موقعیت‌یابی',
                    'ارتباطات--NFC',
                    'ارتباطات--اینفرارد',
                    'ارتباطات--رادیو',
                    'ارتباطات--درگاه ارتباطی',
                    'ارتباطات--قابلیت OTG',
                    'حسگر و ویژگی‌ها--قابلیت تشخیص چهره',
                    'حسگر و ویژگی‌ها--حسگر اثر انگشت',
                    'حسگر و ویژگی‌ها--سایر حسگرها',
                    'حسگر و ویژگی‌ها--سایر ویژگی‌ها',
                    'باتری--نوع باتری',
                    'باتری--ظرفیت باتری',
                    'باتری--قابلیت شارژ سریع',
                    'باتری--شارژ بی‌سیم',
                    'باتری--توضیحات شارژ',
                ];

                // $first_product = wc_get_product($products[0]);
                // $categories = get_the_terms($products[0], 'product_cat');
                if ($categories && !is_wp_error($categories)) {

                    if ($category_name == "هدفون و هندزفری") {
                        $priorityArray = [
                            'مشخصات ظاهری و فیزیکی--ابعاد',
                            'مشخصات ظاهری و فیزیکی--وزن',
                            'مشخصات ظاهری و فیزیکی--جنس بدنه',
                            'مشخصات ظاهری و فیزیکی--نوع',
                            'مشخصات ظاهری و فیزیکی--مقاومت در برابر آب و گرد و غبار',
                            'مشخصات ظاهری و فیزیکی--نشانگر LED',
                            'مشخصات فنی--سازگاری',
                            'مشخصات فنی--چیپست',
                            'مشخصات فنی--نوع اتصال',
                            'مشخصات فنی--نوع رابط',
                            'مشخصات فنی--بلوتوث',
                            'مشخصات فنی--برد بلوتوث',
                            'مشخصات فنی--NFC',
                            'مشخصات فنی--میکروفون',
                            'مشخصات فنی--نویز کنسلینگ فعال (ANC)',
                            'مشخصات فنی--کنترل‌های دستگاه',
                            'مشخصات فنی--قابلیت کنترل موزیک/تماس‌ها',
                            'مشخصات فنی--قابلیت کنترل صدا',
                            'مشخصات فنی--دستیار صوتی',
                            'مشخصات فنی--طول سیم',
                            'مشخصات فنی--قطر درایور اسپیکر',
                            'مشخصات فنی--محدوده فرکانس پاسخگویی',
                            'مشخصات فنی--امپدانس',
                            'مشخصات فنی--حذف نویز میکروفون',
                            'مشخصات فنی--حساسیت',
                            'مشخصات فنی--حسگرها',
                            'باتری و شارژ--باتری',
                            'باتری و شارژ--عمر باتری',
                            'باتری و شارژ--مدت‌زمان شارژ شدن',
                            'باتری و شارژ--شارژ',
                            'سایر ویژگی‌ها--سایر ویژگی‌ها',
                            'سایر ویژگی‌ها--محتویات جعبه',
                        ];
                    }
                    if ($category_name == "گوشی موبایل") {
                        $priorityArray = [
                            'شبکه--تکنولوژی شبکه',
                            'معرفی--تاریخ معرفی',
                            'بدنه--ابعاد',
                            'بدنه--وزن',
                            'بدنه--جنس بدنه',
                            'بدنه--تعداد سیم‌کارت',
                            'بدنه--استاندارد ضدآب بودن',
                            'نمایشگر--نوع نمایشگر',
                            'نمایشگر--اندازه نمایشگر',
                            'نمایشگر--رزولوشن نمایشگر',
                            'نمایشگر--فرکانس نمایشگر',
                            'نمایشگر--تراکم پیکسلی',
                            'نمایشگر--محافظ نمایشگر',
                            'نمایشگر--ویژگی‌های نمایشگر',
                            'سخت‌افزار و سیستم عامل--سیستم عامل',
                            'سخت‌افزار و سیستم عامل--نسخه سیستم عامل در زمان عرضه',
                            'سخت‌افزار و سیستم عامل--رابط کاربری',
                            'سخت‌افزار و سیستم عامل--چیپست',
                            'سخت‌افزار و سیستم عامل--CPU',
                            'سخت‌افزار و سیستم عامل--پردازنده گرافیکی',
                            'حافظه و رم--درگاه کارت حافظه',
                            'حافظه و رم--حافظه داخلی',
                            'حافظه و رم--رم',
                            'دوربین اصلی--نوع دوربین اصلی',
                            'دوربین اصلی--پیکربندی دوربین‌ها',
                            'دوربین اصلی--رزولوشن دوربین اصلی',
                            'دوربین اصلی--ویژگی‌های دوربین اصلی',
                            'دوربین اصلی--دوربین اولترا واید',
                            'دوربین اصلی--مشخصات دوربین اولترا واید',
                            'دوربین اصلی--دوربین تله',
                            'دوربین اصلی--مشخصات دوربین تله',
                            'دوربین اصلی--دوربین ماکرو',
                            'دوربین اصلی--مشخصات دوربین ماکرو',
                            'دوربین اصلی--دوربین تشخیص عمق',
                            'دوربین اصلی--مشخصات دوربین تشخیص عمق',
                            'دوربین اصلی--رزولوشن فیلم‌برداری',
                            'دوربین اصلی--قابلیت‌های فیلم‌برداری دوربین اصلی',
                            'دوربین سلفی--نوع دوربین سلفی',
                            'دوربین سلفی--رزولوشن دوربین سلفی',
                            'دوربین سلفی--ویژگی‌های دوربین سلفی',
                            'دوربین سلفی--قابلیت‌های فیلم‌برداری دوربین سلفی',
                            'صدا--جک ۳.۵ میلی‌متری',
                            'صدا--مشخصات اسپیکر',
                            'ارتباطات--WLAN',
                            'ارتباطات--بلوتوث',
                            'ارتباطات--موقعیت‌یابی',
                            'ارتباطات--NFC',
                            'ارتباطات--اینفرارد',
                            'ارتباطات--رادیو',
                            'ارتباطات--درگاه ارتباطی',
                            'ارتباطات--قابلیت OTG',
                            'حسگر و ویژگی‌ها--قابلیت تشخیص چهره',
                            'حسگر و ویژگی‌ها--حسگر اثر انگشت',
                            'حسگر و ویژگی‌ها--سایر حسگرها',
                            'حسگر و ویژگی‌ها--سایر ویژگی‌ها',
                            'باتری--نوع باتری',
                            'باتری--ظرفیت باتری',
                            'باتری--قابلیت شارژ سریع',
                            'باتری--شارژ بی‌سیم',
                            'باتری--توضیحات شارژ',
                        ];
                    }
                    if ($category_name == "ساعت و بند هوشمند") {
                        $priorityArray = [
                            'معرفی--تاریخ معرفی',
                            'مشخصات ظاهری و فیزیکی--نوع کاربری',
                            'مشخصات ظاهری و فیزیکی--مناسب برای',
                            'مشخصات ظاهری و فیزیکی--سایز',
                            'مشخصات ظاهری و فیزیکی--جنس بدنه',
                            'مشخصات ظاهری و فیزیکی--رنگ بدنه',
                            'مشخصات ظاهری و فیزیکی--نوع/جنس بند',
                            'مشخصات ظاهری و فیزیکی--رنگ بند',
                            'مشخصات ظاهری و فیزیکی--ابعاد',
                            'مشخصات ظاهری و فیزیکی--وزن',
                            'مشخصات ظاهری و فیزیکی--مقاومت در برابر آب و گرد و غبار',
                            'صفحه نمایش--صفحه نمایش رنگی',
                            'صفحه نمایش--صفحه نمایش لمسی',
                            'صفحه نمایش--فناوری ساخت',
                            'صفحه نمایش--حداکثر روشنایی',
                            'صفحه نمایش--اندازه (اینچ)',
                            'صفحه نمایش--رزولوشن',
                            'صفحه نمایش--تراکم پیکسلی',
                            'صفحه نمایش--فرم صفحه نمایش',
                            'صفحه نمایش--محافظ نمایشگر',
                            'صفحه نمایش--سایر ویژگی‌های نمایشگر',
                            'سیستم‌عامل--سیستم‌عامل',
                            'سیستم‌عامل--سازگاری',
                            'سیستم‌عامل--اپلیکیشن انحصاری',
                            'سیستم‌عامل--پشتیبانی از زبان فارسی در اعلان و پیام',
                            'مشخصات سخت‌افزاری--چیپ‌ست',
                            'مشخصات سخت‌افزاری--پردازنده مرکزی',
                            'مشخصات سخت‌افزاری--پردازنده گرافیکی',
                            'مشخصات سخت‌افزاری--حافظه داخلی',
                            'مشخصات سخت‌افزاری--حافظه رم',
                            'صدا--اسپیکر',
                            'صدا--میکروفون',
                            'امکانات ارتباطی--قابلیت اتصال به شبکه موبایل',
                            'امکانات ارتباطی--قابلیت مکالمه',
                            'امکانات ارتباطی--وای‌فای',
                            'امکانات ارتباطی--بلوتوث',
                            'امکانات ارتباطی--موقعیت‌یابی',
                            'امکانات ارتباطی--NFC',
                            'حسگر و ویژگی‌ها--حسگرها',
                            'حسگر و ویژگی‌ها--سایر ویژگی‌ها',
                            'باتری--نوع باتری',
                            'باتری--ظرفیت باتری',
                            'باتری--عمر باتری',
                            'باتری--نحوه شارژ',
                            'باتری--توضیحات باتری',
                            'محتویات جعبه--محتویات جعبه',
                        ];
                    }
                }
                $priorityArray[] = 'سایر ویژگی‌ها--اصالت کالا';

                $sortedArray = customSort($attributes_fixed_array, $priorityArray);
                // $sortedArray = $attributes_fixed_array;
                // echo "<pre>";var_dump( $sortedArray );die();
                $attributes_fixed_obj = array();
                foreach ($sortedArray as $item => $value) {
                    $label_array = explode('--', $item);
                    $attributes_fixed_obj[$label_array[0]][$label_array[1]] = vertuka_the_persian_number($value);
                }
                $index_index = 0;
                $index_mini = 0;

                foreach ($attributes_fixed_obj as $g_name => $g_array) {
                    $mj_products[$index][$index_index] = '<div class="items">';
                    $mj_products[$index][$index_index] .= '<div><h4 class="product-group-title">' . $g_name . '<h4></div>';
                    foreach ($g_array as $item_name => $item_info) {
                        $mj_products[$index][$index_index] .= '<div>';
                        $mj_products[$index][$index_index] .= '<div class="text-caption-2 index-' . $index_mini . '-' . $index . ' "><span class="d-block c-title">' . $item_name . ' :</span>';
                        $mj_products[$index][$index_index] .= '<strong class="d-block mr-2 c-value compare-product-group-item-overflow">' . $item_info . '</strong></div>';
                        $mj_products[$index][$index_index] .= '</div>';
                        $index_mini++;
                    }
                    $mj_products[$index][$index_index] .= '</div>';
                    $index_index++;
                }
            }
        }
        $index++;
    }
}
?>
</div>
</div>

<!-- end MJ -->
<div class="container-fluid mb-5 compare-table">
    <?php
    // echo "<pre>";var_dump( $mj_products );die();
    if (is_array($mj_products[1])) {
        for ($i = 0; $i < count($mj_products[1]); $i++) { ?>
            <div class="row">
                <?php for ($j = 0; $j < count($mj_products); $j++) { ?>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div id="about-tech-product-section-text">
                            <div class="p-0 mt-4 mx-0 mb-0 compare-product-group-title">
                                <?php echo $mj_products[$j][$i] ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    <?php }
    }
    ?>
</div>





<script>
    jQuery(document).ready(function() {
        let temp_counter = 0;
        for (let row = 0; row < <?php echo ($index_mini) ? $index_mini : 0 ?>; row++) {
            temp_counter = 0;
            for (let col = 0; col < <?php echo count($mj_products) ?>; col++) {
                // console.log('.index-'+row+'-'+col);
                // console.log(jQuery('.index-'+row+'-'+col+' .c-value').text());
                if (jQuery('.index-' + row + '-' + col + ' .c-value').text() == "-") {
                    temp_counter++;
                }
            }
            // console.log(temp_counter);
            if (temp_counter == <?php echo count($mj_products) ?>) {
                // console.log("must be removed row: " + row);
                for (let col = 0; col < <?php echo count($mj_products) ?>; col++) {
                    jQuery('.index-' + row + '-' + col).remove();

                    // closest row remove if empty
                }

            }
        }

        //setup before functions
        var typingTimer; //timer identifier
        var doneTypingInterval = 1000; //time in ms, 5 seconds for example
        var $input = jQuery('#compare_product_search');

        //on keyup, start the countdown
        $input.on('keyup', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown 
        $input.on('keydown', function() {
            clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function doneTyping() {
            var value = jQuery("#compare_product_search").val();
            var noWhitespaceValue = value.replace(/\s+/g, '');
            var noWhitespaceCount = noWhitespaceValue.length;
            if (noWhitespaceCount > 2) {
                jQuery('#compare_product_search_process').show();
                jQuery('#compare_product_search_results').html("");
                // EMPTY result div

                //making url 
                var url = `https://vertuka.com/index.php/wp-json/wp/v2/product?search=${noWhitespaceValue}<?php echo ($last_category->term_id) ? '&product_cat=' . $last_category->term_id : '' ?>&per_page=85&page=1&_embed`;
                var jqxhr = jQuery.get({
                        url: url,
                    }, function(result_data) {
                        // console.log(result_data);
                        
                        jQuery('#compare_product_search_process').hide();
                        let html_results = `<div class="row">`;
                        for (let i = 0; i < result_data.length; i++) {
                            // console.log(result_data[i]._embedded['wp:featuredmedia'][0].source_url);

                            html_results += `
                                    <div class="item col-6 col-md-3" id="produc-${result_data[i].id}">
                                                <div class="img-box">
                                                    <a href="<?php echo esc_url($current_page); ?>?item=${result_data[i].id},<?php echo $products[0] . ',' . $products[1] . ',' . $products[2] . ',' . $products[3]; ?>">
                                                        <img class="pic" src="${result_data[i]._embedded['wp:featuredmedia'][0].source_url}" alt="${result_data[i].title.rendered}">
                                                    </a>
                                                </div>
                                                <div class="category"><p class="m-0"><a href="<?php echo $category_url ?>"><?php echo $category_name ?></a></p></div>
                                                <div class="title">
                                                    <h3><a href="<?php echo esc_url($current_page); ?>?item=${result_data[i].title.rendered},<?php echo $products[0] . ',' . $products[1] . ',' . $products[2] . ',' . $products[3]; ?>,;">${result_data[i].title.rendered}</a></h3>
                                                </div>
                                            </div>
                                `;
                        }
                        html_results += `</div>`;
                        jQuery('#compare_product_search_results').append(html_results);

                        //alert( "success" );
                    })
                    .done(function() {
                        //alert( "second success" );
                    })
                    .fail(function() {
                        //alert( "error" );
                    })
                    .always(function() {
                        //alert( "finished" );
                    });
            }
        }
    });

    function AnimateRotate(angle, repeat) {
        var duration = 1500;
        setTimeout(function() {
            if (repeat && repeat == "infinite") {
                AnimateRotate(angle, repeat);
            } else if (repeat && repeat > 1) {
                AnimateRotate(angle, repeat - 1);
            }
        }, duration)
        var $elem = jQuery('.icon-repeat');

        jQuery({
            deg: 0
        }).animate({
            deg: angle
        }, {
            duration: duration,
            step: function(now) {
                $elem.css({
                    'transform': 'rotate(' + now + 'deg)'
                });
            }
        });
    }
    AnimateRotate(-90, "infinite");
</script>

<?php
get_footer();
