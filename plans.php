<?php

/**
 * Template Name: Membership pricing
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Panther_Gym_Child
 */

get_header();
?>
<?php if (have_rows('main')) : ?>
    <?php while (have_rows('main')) : the_row();
        $title = get_sub_field('title');
        $bg_image = get_sub_field('bg_image');
    ?>
        <section class="flex bg-black bg-cover bg-left-top bg-no-repeat h-[683px] items-end justify-end lg:h-[617px]" style="background-image: url(<?php echo esc_url($bg_image); ?>);">
            <div class="flex items-end justify-start 2xl:pl-[101px] bg-no-repeat bg-panther-red-100 bg-right-top clip-left h-[163px] pb-[38px] pl-[12%] pt-[33px] text-left translate-y-[27%] w-[95%] xl:bg-red-bg xl:bg-transparent xl:h-[461px] xl:items-end xl:pb-[34px] xl:pl-[8%] xl:pr-[20px] xl:translate-y-[10%] xl:w-[48%] opacity-90">
                <h1 class="h1 text-white"><?php echo $title; ?></h1>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('plan_membership')) : ?>
    <?php while (have_rows('plan_membership')) : the_row();
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $allowed_html = array(
            'span'     => array(),
        );
        $search  = array('<span>');
        $replace = array('<span class="text-panther-red-100">');
        $content = wp_kses($content, $allowed_html);
        $content = str_replace($search, $replace, $content);
    ?>
        <section class="lg:pb-[108px] lg:pt-[148px] pb-[72px] pt-[104px] px-[30px] full-membership">
            <h2 class="h2 text-center mb-[25px]">
                <?php echo esc_html($title); ?>
            </h2>
            <p class="font-privacy leading-[1.5] mx-auto text-center w-full max-w-[902px] lg:mb-[43px] mb-[57px] text-[20px]">
                <?php echo $content; ?>
            </p>
            <div class="grid grid-cols-1 gap-[35px] lg:gap-0 md:grid-cols-2 lg:grid-cols-4 auto-rows-auto px-[30px] max-w-[1300px] w-full mx-auto">
                <?php if (have_rows('item')) : ?>
                    <?php while (have_rows('item')) : the_row();
                        $name = get_sub_field('name');
                        $size_price = get_sub_field('size_price');
                        $price = get_sub_field('price');
                        $period = get_sub_field('period');
                        $cta = get_sub_field('cta');
                        $option = get_sub_field('option');
                        $allowed_html = array(
                            'ul'     => array(),
                            'li'     => array(),
                            'strong'     => array(),
                        );
                        $search  = array('<ul>');
                        $replace = array('<ul class="option">');
                        $option = wp_kses($option, $allowed_html);
                        $option = str_replace($search, $replace, $option);
                    ?>
                        <div class="tarif-js">
                            <div class="tarif-head">
                                <div class="flex flex-col items-center">
                                    <div class="name">
                                        – <?php echo esc_html($name); ?> –
                                    </div>
                                    <div class="price <?php echo $size_price == 'small' ? 'small' : 'big'; ?>">
                                        <?php echo esc_html($price); ?>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="period">
                                        <?php echo esc_html($period); ?>
                                    </div>
                                    <a href="<?php echo esc_url($cta['url']); ?>" class="btn-get"><?php echo esc_html($cta['title']); ?></a>
                                </div>

                            </div>
                            <div class="hidden border-b-[1px] border-black border-l-[1px] border-r-[1px] h-[0] md:block md:border-none md:h-auto rounded-b-[4px] tarif-options">

                                <?php echo $option; ?>

                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('free_membership')) : ?>
    <?php while (have_rows('free_membership')) : the_row();
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $cta = get_sub_field('cta');
        $allowed_html = array(
            'span'     => array(),
        );
        $search  = array('<span>');
        $replace = array('<span class="text-panther-red-100">');
        $title = wp_kses($title, $allowed_html);
        $title = str_replace($search, $replace, $title);
        $content = wp_kses($content, $allowed_html);
        $content = str_replace($search, $replace, $content);
    ?>
        <section class="flex flex-col items-center bg-[url('../images/free-bg-mob.jpg')] bg-black bg-cover bg-left-top bg-no-repeat lg:pb-[52px] lg:pt-[70px] md:bg-[url('../images/free-bg.jpg')] pb-[165px] pt-[202px] px-[30px] sm:pt-[325px]">
            <h2 class="h2 text-center lg:mb-[9px] mb-[15px] text-white">
                <?php echo $title; ?>
            </h2>
            <p class="font-privacy text-white leading-[1.5] lg:mb-[38px] max-w-[902px] mb-[15px] mx-auto text-[18px] text-center w-full">
                <?php echo $content; ?>
            </p>
            <?php if (have_rows('item')) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 auto-rows-auto	lg:gap-x-[70px] mb-[27px] lg:mb-[50px]">
                    <?php while (have_rows('item')) : the_row();
                        $name = get_sub_field('name'); ?>
                        <span class="font-privacy font-bold text-white before:bg-[length:55%_auto] before:bg-center before:bg-checkmark-white before:bg-no-repeat before:bg-panther-red-100 before:h-[22px] before:mr-[21px] before:rounded-[100%] before:w-[22px] flex items-center justify-start leading-[2.2] lg:before:h-[24px] lg:before:mr-[20px] lg:before:w-[24px] lg:leading-[2.4]">
                            <?php echo esc_html($name); ?>
                        </span>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php if ($cta) : ?>
                <a href="<?php echo esc_url($cta['url']); ?>" class="btn-primary">
                    <?php echo esc_html($cta['title']); ?>
                </a>
            <?php endif; ?>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('shop_section')) : ?>
    <?php while (have_rows('shop_section')) : the_row();
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $products = get_sub_field('product');
    ?>
        <section class="lg:pb-[20px] lg:pt-[83px] pb-[25px] pt-[70px]">
            <div class="flex flex-col items-center max-w-[1470px] mx-auto px-[15px] w-full">
                <h2 class="font-bold h2 mb-[25px] text-center">
                    <?php echo esc_html($title); ?>
                </h2>
                <p class="font-privacy leading-[1.5] mx-auto text-center w-full text-[18px] lg:text-[20px] max-w-[794px]">
                    <?php echo esc_html($content); ?>
                </p>
                <?php if ($products) : ?>
                    <div class="auto-rows-auto grid grid-cols-1 bm:grid-cols-2 gap-4 lg:grid-cols-4 lg:mb-[46px] lg:mt-[64px] mb-[70px] mt-[48px]">
                        <?php foreach ($products as $post) :
                            setup_postdata($post);
                            $product = wc_get_product($post->ID);
                            $regular_price = $product->price;
                            $sale_price = $product->sale_price;
                        ?>
                            <a href="<?php the_permalink(); ?>" class="duration-[0.3s] ease-in transition-all border-b-[8px] border-transparent hover:border-panther-red-100 hover:shadow-card-shadow lg:px-[41px] pb-[49px] product-cart pt-[28px] px-[46px] rounded-[6px]">
                                <div class="mb-[16px] thumbail">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                </div>
                                <div class="font-privacy font-bold leading-[1.1] text-[15px] text-panther-red-100 category mb-[10px]">
                                    <?php $terms = get_the_terms($post->ID, 'product_cat');
                                    foreach ($terms as $term) {
                                        echo  $product_cat = $term->name;
                                        break;
                                    } ?>
                                </div>
                                <div class="font-base mb-[18px] !font-bold leading-[1.1] text-[24px] text-black title">
                                    <?php the_title(); ?>
                                </div>
                                <div class="font-privacy font-bold leading-[1.1] text-[15px] text-panther-red-100 price">
                                    <?php echo ($sale_price ? '$ ' . $sale_price : '$ ' . $regular_price); ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <a href="/shop" class="!font-bold btn-primary">
                        SHOP NOW
                    </a>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('ready_banner')) : ?>
    <?php while (have_rows('ready_banner')) : the_row();
        $bg_image_mob = get_sub_field('bg_image_mob');
        $bg_image_desk = get_sub_field('bg_image_desk');
        $title1 = get_sub_field('title1');
        $title2 = get_sub_field('title2');
        $cta1 = get_sub_field('cta1');
        $cta2 = get_sub_field('cta2');
    ?>
        <section class="relative h-max-[350px] lg:py-[68px] py-[46px]">
            <div class="w-full absolute h-[50%] bg-white top-0"></div>
            <div class="w-full absolute h-[50%] bg-black-darkgray-gradient bottom-0"></div>
            <div class="flex flex-col relative shadow-[0_0_40px_0_#00000029] rounded-[8px] overflow-hidden max-w-[1200px] mx-5 sm:mx-auto">
                <div class="absolute top-0 left-0 bottom-0 right-0">
                    <img class="w-full h-full object-cover object-left-top sm:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="">
                    <img class="w-full h-full object-cover object-left-top hidden sm:block" src="<?php echo esc_url($bg_image_desk); ?>" alt="">
                </div>
                <div class="flex flex-col justify-center md:w-[820px] pb-[60px] pt-[300px] px-[25px] relative sm:px-[60px] sm:py-[80px] sm:self-end z-[1]">
                    <p class="font-privacy font-bold text-white italic leading-[42px] text-left max-lg:hidden text-[40px]"><?php echo wp_kses($title1, ''); ?></p>
                    <p class="font-privacy font-bold text-white italic leading-[42px] lg:hidden text-left mb-[20px] text-[38px]"><?php echo $title1; ?>
                    </p>
                    <p class="font-privacy font-bold italic leading-[42px] max-lg:hidden text-[40px] text-[#E10A17] text-right"><?php echo wp_kses($title2, ''); ?></p>
                    <p class="font-privacy font-bold italic leading-[42px] text-[38px]   text-[#E10A17]"><?php echo $title2; ?></p>
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
