<?php
get_header();
?>
<section class="bg-black h-[130px] md:h-[177px]">
</section>
<div class="w-full mx-auto pt-[30px] px-[15px] max-w-[1280px]">
    <?php

    /* breadcrumb Yoast */
    if (function_exists('yoast_breadcrumb')) :
        yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
    endif;

    ?>
</div>
<section class="bg-white pt-[40px] px-[30px] pb-[55px] lg:pb-[107px]">
    <div class="w-full mx-auto px-[15px] max-w-[1280px]">
        <h1 class="uppercase lg:text-[68px] text-center font-bold italic leading-[1.1] text-[36px] mb-[36px] lg:mb-[78px] font-privacy">
            <?php echo __('Checkout', 'text'); ?>
        </h1>
        <?php udesly_wc_checkout() ?>
    </div>
</section>
<?php
get_footer();
?>