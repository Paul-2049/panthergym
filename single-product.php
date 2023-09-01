<?php
get_header();
global $post, $product, $variant;
$price = $product->get_price_html();
$description = $product->get_description();
$product_gallery = $product->get_gallery_image_ids();
$product_type = $product->get_type();
$attachment_ids = $product->get_gallery_image_ids();
$variations = [];
if ($product->is_type('variable')) {
    $variations = $product->get_available_variations();
}
?>

<section class="bg-black h-[130px] md:h-[177px]">
</section>
<div class="mx-auto pt-[30px] lg:px-[15px] px-[29px] w-full max-w-[1470px]">
    <?php
    /* breadcrumb Yoast */
    if (function_exists('yoast_breadcrumb')) :
        yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
    endif;
    ?>
</div>
<section class="lg:pb-[119px] pb-[60px] pt-[64px]">
    <div class="flex flex-col w-full max-w-[1470px] mx-auto gap-[61px] items-start justify-start lg:flex-row lg:px-[15px] px-[29px]">
        <div class="w-full max-w-[483px] product-slider">
            <div class="swiper lg:mb-[35px] main-slider-product mb-[15px]">
                <div class="swiper-wrapper">
                    <?php if ($product_gallery) : ?>
                        <?php foreach ($product_gallery as $image_id) : ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                            </div>
                        <?php endforeach; ?>
                        <?php foreach ($variations as $variation) : ?>
                            <div class="swiper-slide attribute-image" style="display: none;" <?php

                                                                                                foreach ($variation['attributes'] as $att_key => $att_value) {

                                                                                                    echo 'data-' . $att_key . '="' . $att_value . '"';
                                                                                                }

                                                                                                ?>>
                                <img src="<?php echo $variation['image']['src']; ?>" alt="<?php echo $variation['image']['alt']; ?>">
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="swiper-slide">
                            <?php echo get_the_post_thumbnail($product->get_id(), 'full'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div thumbsslider class="swiper bullet-slider-product">
                <div class="swiper-wrapper">
                    <?php if ($product_gallery) : ?>
                        <?php foreach ($product_gallery as $image_id) : ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                            </div>
                        <?php endforeach; ?>
                        <?php $used_attributes = array(); 
                        foreach ($variations as $variation) :
                            $attribute_string = ''; 

                            foreach ($variation['attributes'] as $att_key => $att_value) {
                                $attribute_string .= 'data-' . $att_key . '="' . $att_value . '"';
                            }

                            if (!in_array($attribute_string, $used_attributes)) {
                                array_push($used_attributes, $attribute_string); 
                        ?>
                                <div class="swiper-slide bullet-attribute-image" style="display: none;" <?php echo $attribute_string; ?>>
                                    <img src="<?php echo $variation['image']['src']; ?>" alt="<?php echo $variation['image']['alt']; ?>">
                                </div>
                        <?php
                            }
                        endforeach;  ?>
                    <?php else : ?>
                        <div class="swiper-slide">
                            <?php echo get_the_post_thumbnail($product->get_id(), 'full'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="mt-[30px]">
            <?php do_action('woocommerce_single_product_summary'); ?>
            <?php if ($description) : ?>
                <div class="content-single">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
$related_products = wc_get_related_products(get_the_id(), 4);
if ($related_products) :
?>
    <section class="lg:pb-[66px] pb-[33px]">
        <div class="flex flex-col w-full max-w-[1470px] mx-auto items-center px-[15px]">
            <h2 class="!font-bold h2 lg:mb-[51px] mb-[25px] text-center">
                related products
            </h2>
            <div class="auto-rows-auto bm:grid-cols-2 gap-4 grid grid-cols-1 lg:grid-cols-4">
                <?php foreach ($related_products as $product_id) :
                    $product = wc_get_product($product_id); ?>
                    <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="duration-[0.3s] ease-in transition-all border-b-[8px] border-transparent hover:border-panther-red-100 hover:shadow-card-shadow lg:px-[41px] pb-[49px] product-cart pt-[28px] px-[46px] rounded-[6px]">
                        <div class="mb-[16px] thumbail">
                            <?php echo $product->get_image();; ?>
                        </div>
                        <div class="font-privacy font-bold leading-[1.1] text-[15px] text-panther-red-100 category mb-[10px]">
                            <?php echo $product->get_category_ids(); ?>
                        </div>
                        <div class="font-base leading-[1.1] text-[24px] !font-bold mb-[18px] text-black title">
                            <?php echo $product->get_title();; ?>
                        </div>
                        <div class="font-privacy font-bold leading-[1.1] text-[15px] text-panther-red-100 price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $page_id = wc_get_page_id('shop'); ?>
<?php if (have_rows('ready_banner', $page_id)) : ?>
    <?php while (have_rows('ready_banner', $page_id)) : the_row();
        $bg_image_mob = get_sub_field('bg_image_mob', $page_id);
        $bg_image_desk = get_sub_field('bg_image_desk', $page_id);
        $title1 = get_sub_field('title1', $page_id);
        $title2 = get_sub_field('title2', $page_id);
        $cta1 = get_sub_field('cta1', $page_id);
        $cta2 = get_sub_field('cta2', $page_id);
    ?>
        <section class="relative h-max-[350px] lg:pb-[68px] pb-[46px]">
            <div class="w-full absolute bg-black-darkgray-gradient bottom-0 h-[50%]"></div>
            <div class="flex flex-col relative border-[1px] border-panther-grey-900 max-w-[1200px] mx-5 overflow-hidden rounded-[8px] shadow-[0_0_40px_0_#00000029] sm:mx-auto">
                <div class="absolute bottom-0 left-0 right-0 top-0">
                    <img class="w-full h-full object-cover object-left-top sm:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="img">
                    <img class="w-full h-full object-cover object-left-top hidden sm:block" src="<?php echo esc_url($bg_image_desk); ?>" alt="img">
                </div>
                <div class="flex flex-col justify-center md:w-[820px] pb-[60px] pt-[300px] px-[25px] relative sm:px-[60px] sm:py-[80px] sm:self-end z-[1]">
                    <p class="font-privacy font-bold italic leading-[42px] max-lg:hidden text-[40px] text-left text-white">
                        <?php echo wp_kses($title1, ''); ?></p>
                    <p class="font-privacy font-bold italic leading-[42px] lg:hidden text-[38px] mb-[20px] text-left text-white">
                        <?php echo $title1; ?>
                    </p>
                    <p class="font-privacy font-bold italic leading-[42px] max-lg:hidden text-[40px] text-[#E10A17] text-right">
                        <?php echo wp_kses($title2, ''); ?></p>
                    <p class="font-privacy font-bold italic leading-[42px] lg:hidden text-[38px] text-[#E10A17]">
                        <?php echo $title2; ?></p>
                    <div class="flex flex-col sm:flex-row gap-5 items-center justify-center mt-[30px] sm:gap-1">
                        <?php if ($cta1) : ?>
                            <a href="<?php echo esc_url($cta1['url']); ?>" class="btn-primary whitespace-nowrap">
                                <?php echo esc_html($cta1['title']); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($cta2) : ?>
                            <a href="<?php echo esc_url($cta2['url']); ?>" class="btn-primary">
                                <?php echo esc_html($cta2['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php
get_footer();
