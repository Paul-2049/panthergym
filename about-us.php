<?php

/**
 * Template Name: About Us
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
        <section class="flex bg-no-repeat bg-cover bg-black bg-left-bottom h-[683px] items-end justify-end lg:h-[638px]" style="background-image: url(<?php echo esc_url($bg_image); ?>);">
            <div class="flex items-center bg-no-repeat 2xl:pl-[101px] bg-panther-red-100 bg-right-top clip-left h-[163px] justify-start pb-[43px] pl-[12%] pt-[33px] text-left translate-y-[27%] w-[95%] xl:bg-red-bg xl:bg-transparent xl:h-[461px] xl:items-end xl:pb-[40px] xl:pl-[8%] xl:pr-[20px] xl:translate-y-[10%] xl:w-[48%] opacity-90">
                <h1 class="h1 text-white"><?php echo $title; ?></h1>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('content_section')) : ?>
    <?php while (have_rows('content_section')) : the_row();
        $title = get_sub_field('title');
        $text = get_sub_field('text');
    ?>
        <section class="px-[30px] bg-white lg:pb-[90px] lg:pt-[137px] pb-[52px] pt-[110px]">
            <h2 class="h2 lg:mb-[31px] mb-[25px] text-center">
                <?php echo $title; ?>
            </h2>
            <div class="w-full mx-auto [&>*]:mb-[15px] font-privacy [&>p]:leading-[1.5] leading-[1.5] max-w-[1000px] md:text-[18px] text-[15px] text-left">
                <?php echo $text; ?>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('we_offer')) : ?>
    <?php while (have_rows('we_offer')) : the_row();
        $bg_image_mob = get_sub_field('bg_image_mob');
        $bg_image_desk = get_sub_field('bg_image_desk');
        $title_line_1 = get_sub_field('title_line_1');
        $title_line_2 = get_sub_field('title_line_2');
        $title_line_3 = get_sub_field('title_line_3');
        $title_line_4 = get_sub_field('title_line_4');
        $title_left = get_sub_field('title_left');
        $cta = get_sub_field('cta');
    ?>
        <section class="relative lg:pb-[77px] lg:pt-[70px] pb-[66px] pt-[306px] sm:pt-[400px]">
            <div class="top-0 left-0 absolute bottom-0 right-0 z-[-1]">
                <img class="w-full h-full object-cover object-left-top md:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="">
                <img class="w-full h-full object-cover object-left-top hidden md:block" src="<?php echo esc_url($bg_image_desk); ?>" alt="">
            </div>
            <div class="flex flex-col lg:flex-row items-center justify-center lg:items-stretch px-[30px]">
                <div class="flex flex-col w-full items-end justify-end lg:max-w-[50%] max-w-[312px]">
                    <h3 class="font-bold uppercase text-[30px] lg:text-[40px] font-privacy italic leading-[1] lg:pr-[21%] text-white">
                        <?php echo $title_line_1; ?>
                    </h3>
                    <h3 class="font-bold uppercase font-privacy italic leading-[1] text-white lg:pr-[38%] lg:text-[32px] pr-[31%] text-[22px]">
                        <?php echo $title_line_2; ?>
                    </h3>
                    <h3 class="font-bold uppercase font-privacy italic leading-[1] lg:text-[40px] lg:pr-[26%] text-[34px] text-panther-red-100">
                        <?php echo $title_line_3; ?>
                    </h3>
                    <h3 class="font-bold uppercase font-privacy italic lg:pr-[21%] leading-[0.8] pr-[20%] text-[64px] text-panther-red-100">
                        <?php echo $title_line_4; ?>
                    </h3>
                </div>
                <div class="flex flex-col w-full items-center lg:items-start lg:mt-0 lg:pl-[50px] lg:w-2/4 mt-[50px]">
                    <h3 class="font-bold uppercase leading-[1.1] text-[30px] text-center text-white lg:mb-[11px] lg:text-left mb-[20px]">
                        <?php echo esc_html($title_left); ?>
                    </h3>
                    <ul class="[&>*]:font-privacy [&>*]:leading-[1.8] [&>*]:lg:text-[18px] [&>*]:list-disc [&>*]:list-inside [&>*]:text-[15px] [&>*]:text-white lg:mb-[37px] lg:pl-[20px] mb-[56px]">
                        <?php if (have_rows('item')) : ?>
                            <?php while (have_rows('item')) : the_row();
                                $name = get_sub_field('name');
                            ?>
                                <li>
                                    <?php echo esc_html($name); ?>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                    <?php if ($cta) : ?>
                        <a href="<?php echo esc_url($cta['url']); ?>" class="btn-primary">
                            <?php echo esc_html($cta['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<section class="lg:pt-[70px] lg:pb-[146px] pb-[65px] pt-[17px] px-[15px]">
    <?php if (have_rows('advantages')) : ?>
        <div class="w-full mx-auto auto-rows-auto gap-0 grid grid-cols-1 max-w-[1440px] md:grid-cols-3">
            <?php while (have_rows('advantages')) : the_row();
                $image = get_sub_field('image');
                $name = get_sub_field('name');
            ?>
                <div class="flex items-center justify-center bg-center bg-cover bg-no-repeat flex-auto font-bold leading-[1.1] lg:py-[90px] py-[55px] text-[30px] text-center text-white uppercase" style="background-image: url('<?php echo esc_url($image); ?>');">
                    <?php echo $name; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if (have_rows('item_content')) : ?>
        <div class="flex flex-col lg:gap-[110px] gap-[66px] lg:mt-[95px] max-w-[1256px] mt-[45px] mx-auto w-full">
            <?php while (have_rows('item_content')) : the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $sub_title = get_sub_field('sub_title');
                $text = get_sub_field('text');
            ?>
                <div class="flex flex-col lg:flex-row card-room gap-[27px] items-start lg:even:flex-row-reverse lg:gap-[110px]">
                    <div class="w-full h-full lg:flex-[1_0_573px] lg:mb-0 max-h-[390px] order-1 overflow-hidden">
                        <img class="w-full object-cover" src="<?php echo esc_url($image); ?>" alt="img">
                    </div>
                    <div class="order-2 text-room">
                        <div class="relative before:absolute before:bg-panther-red-100 before:bottom-0 before:h-[4px] before:left-0 before:w-[120px] lg:mb-[35px] lg:pb-[21px] mb-[23px] pb-[13px]">
                            <h3 class="font-bold uppercase leading-[1.1] text-[30px] lg:text-[40px]"><?php echo esc_html($title); ?></h3>
                            <?php if ($sub_title) : ?>
                                <h4 class="font-bold uppercase leading-[1.1] text-[20px]"><?php echo esc_html($sub_title); ?></h4>
                            <?php endif; ?>
                        </div>
                        <?php echo $text; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>

<?php if (have_rows('trainers_section')) : ?>
    <?php while (have_rows('trainers_section')) : the_row();
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $trainers_post = get_sub_field('trainers_post');
    ?>
        <section class="relative bg-panther-grey-800 lg:pt-[98px] pt-[88px]">
            <div class="w-full absolute bottom-0 bg-black h-[33.8%] hidden md:block"></div>
            <div class="flex flex-col justify-center items-center relative">
                <p class="h2 max-sm:text-center max-sm:w-full mb-[20px] not-italic sm:px-[150px] sm:text-[40px] text-[36px]">
                    <?php echo esc_html($title); ?>
                </p>
                <p class="mb-[40px] leading-[27px] lg:leading-[30px] lg:text-[20px] max-w-[800px] md:mb-[90px] text-[18px] text-center font-privacy">
                    <?php echo esc_html($content); ?></p>
                <?php
                if ($trainers_post) : ?>
                    <div class="flex flex-col w-full items-center justify-center max-w-[1320px] mb-[142px] md:mb-[133px] mx-auto">
                        <div class="w-full !px-[60px] !py-[15px] after:text-[#E10A17] after:text-[50px] before:text-[#E10A17] before:text-[50px] max-xl:after:hidden max-xl:before:hidden swiper trainerSwiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($trainers_post as $post) :
                                    setup_postdata($post);
                                ?>
                                    <div class="swiper-slide transition">
                                        <div class="relative clip-trainer-card sm:max-w-[400px]">
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                            <div class="flex flex-col w-full left-0 absolute bg-[#E10A17] bottom-0 lg:pb-[15px] lg:pt-[37px] pb-[12px] pt-[30px] px-[40px] right-0">
                                                <span class="font-bold text-white font-base tracking-[1px] leading-[26.4px] text-[24px] uppercase"><?php the_title(); ?></span>
                                                <span class="font-bold text-white font-base tracking-[1px] leading-[11px] text-[10px] uppercase"><?php the_field('position'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="!h-full !top-0 !w-[55px] after:hidden bg-center bg-contain bg-no-repeat opacity-100 !left-0 bg-swiper-prev swiper-button-prev">
                            </div>
                            <div class="!h-full !top-0 !w-[55px] after:hidden bg-center bg-contain bg-no-repeat opacity-100 !right-0 bg-swiper-next swiper-button-next">
                            </div>
                        </div>
                    </div>
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
        <section class="relative bg-panther-grey-800 lg:pt-0 lg:py-[68px] md:bg-black pt-0 py-[46px]">
            <div class="w-full absolute bottom-0 bg-black-darkgray-gradient h-[50%]"></div>
            <div class="flex flex-col relative shadow-[0_0_40px_0_#00000029] rounded-[8px] overflow-hidden max-w-[1200px] mx-5 sm:mx-auto">
                <div class="top-0 left-0 absolute bottom-0 right-0">
                    <img class="w-full h-full object-cover object-left-top sm:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="img">
                    <img class="w-full h-full object-cover object-left-top hidden sm:block" src="<?php echo esc_url($bg_image_desk); ?>" alt="img">
                </div>
                <div class="flex flex-col justify-center relative md:w-[820px] pb-[60px] pt-[300px] px-[25px] sm:px-[60px] sm:py-[80px] sm:self-end z-[1]">
                    <p class="font-bold text-white font-privacy italic leading-[42px] text-left max-lg:hidden text-[40px]"><?php echo wp_kses($title1, ''); ?></p>
                    <p class="font-bold text-white font-privacy italic leading-[42px] text-left lg:hidden mb-[20px] text-[38px]"><?php echo $title1; ?>
                    </p>
                    <p class="font-bold leading-[42px] font-privacy italic max-lg:hidden text-[40px] text-[#E10A17] text-right">
                        <?php echo wp_kses($title2, ''); ?>
                    </p>
                    <p class="font-bold leading-[42px] font-privacy italic lg:hidden text-[38px] text-[#E10A17]">
                        <?php echo $title2; ?>
                    </p>
                    <div class="flex flex-col justify-center items-center gap-5 mt-[30px] sm:flex-row sm:gap-1">
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
