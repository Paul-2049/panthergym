<?php

/**
 * Template Name: Boxing Classes
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
        <section class="flex bg-no-repeat bg-cover bg-black h-[683px] items-end justify-end lg:h-[594px] xl:bg-left-bottom" style="background-image: url(<?php echo esc_url($bg_image); ?>);">
            <div class="flex items-end bg-no-repeat 2xl:pl-[101px] bg-panther-red-100 bg-right-top clip-left h-[163px] justify-start pb-[38px] pl-[12%] pt-[33px] text-left translate-y-[27%] w-[95%] xl:bg-red-bg xl:bg-transparent xl:h-[461px] xl:items-end xl:pb-[34px] xl:pl-[8%] xl:pr-[20px] xl:translate-y-[10%] xl:w-[48%] opacity-90">
                <h1 class="text-white h1"><?php echo $title; ?></h1>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('content_section')) : ?>
    <?php while (have_rows('content_section')) : the_row();
        $title = get_sub_field('title');
        $text = get_sub_field('text');
        $cta = get_sub_field('cta');
    ?>
        <section class="bg-white lg:pb-[85px] lg:pt-[160px] pb-[52px] pt-[110px] px-[30px]">
            <h2 class="h2 lg:mb-[31px] mb-[25px] text-center">
                <?php echo $title; ?>
            </h2>
            <div class="font-privacy [&>*]:mb-[15px] leading-[1.5] max-w-[1000px] md:text-[18px] mx-auto text-[15px] text-left w-full">
                <?php echo $text; ?>
                <?php if ($cta) : ?>
                    <a href="<?php echo esc_url($cta['url']); ?>" class="btn-primary lg:mt-[102px] mt-[50px] mx-auto">
                        <?php echo esc_html($cta['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('gallery')) : ?>
    <section>
        <div class="swiper JS-boxing-main-swiper relative">
            <div class="swiper-wrapper !h-[235px] md:!h-full md:max-h-[600px]">
                <?php while (have_rows('gallery')) : the_row();
                    $image = get_sub_field('image');
                ?>
                    <div class="swiper-slide flex items-start gap-4 lg:gap-7">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>" class="w-full h-full md:h-auto object-cover">
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="flex items-center pl-[30px] gap-[60px] lg:gap-[76px] lg:pl-[50px] absolute top-1/2 translate-y-[-50%] w-full z-[1] ">
                <div class="swiper-button-prev !hidden md:!flex w-[30px] lg:!w-[38px] lg:!h-[75px] absolute z-1 !left-[25px] md:!left-[75px] xl:!left-[95px] 2xl:!left-[145px] cursor-pointer after:!content-[''] after:w-full after:h-full after:bg-[url('../images/prev.svg')] after:bg-cover after:bg-center"></div>
                <div class="swiper-button-next !hidden md:!flex w-[30px] lg:!w-[38px] lg:!h-[75px] absolute z-1 !right-[25px] md:!right-[75px] xl:!right-[95px] 2xl:!right-[145px] cursor-pointer after:!content-[''] after:w-full after:h-full after:bg-[url('../images/next.svg')] after:bg-cover after:bg-center"></div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if (have_rows('advantages')) : ?>
    <section class="bg-white lg:pt-[50px] md:bg-panther-grey-800 pt-[17px] px-[15px]">
        <div class="w-full mx-auto auto-rows-auto gap-0 grid grid-cols-1 max-w-[1440px] md:grid-cols-3 md:pb-[90px] md:pt-0 pb-[80px] pt-[50px]">
            <?php while (have_rows('advantages')) : the_row();
                $image = get_sub_field('image');
                $name = get_sub_field('name');
            ?>
                <div class="flex items-center justify-center bg-center bg-cover bg-no-repeat flex-auto font-bold leading-[1.1] lg:py-[90px] py-[55px] text-[30px] text-center text-white uppercase" style="background-image: url('<?php echo esc_url($image); ?>');">
                    <?php echo $name; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('trainers_section')) : ?>
    <?php while (have_rows('trainers_section')) : the_row();
        $animate_text = get_sub_field('animate_text');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $trainers_post = get_sub_field('trainers_post');
    ?>
        <section class="px-[15px] lg:pt-[50px] pt-[17px] bg-panther-grey-800">
            <div class="font-privacy font-bold italic uppercase absolute leading-[1.1] lg:after:absolute lg:after:h-[217px] lg:after:left-0 lg:after:top-0 lg:after:w-full lg:mt-[-94px] lg:text-[200px] overflow-hidden text-[128px] text-animate whitespace-nowrap">
                <span class="text-white"><?php echo esc_html($animate_text); ?></span>
            </div>
            <div class="relative">
                <div class="w-full absolute top-0 h-[80%]"></div>
                <div class="flex flex-col justify-center items-center relative">
                    <p class="bg-no-repeat bg-cover bg-center h2 lg:mt-[40px] max-sm:text-center max-sm:w-full mb-[20px] md:mt-[62px] mt-[145px] not-italic py-4 sm:px-[150px] sm:text-[40px] text-[36px]">
                        <?php echo esc_html($title); ?>
                    </p>
                    <p class="text-[18px] lg:text-[20px] leading-[27px] lg:leading-[30px] max-w-[800px] mb-[40px] sm:mb-[90px] text-center font-privacy">
                        <?php echo esc_html($content); ?></p>
                    <?php if ($trainers_post) : ?>
                        <div class="flex flex-col w-full items-center justify-center max-w-[1320px] mx-auto">
                            <div class="w-full !px-[60px] swiper !py-[15px] after:text-[#E10A17] after:text-[50px] before:text-[#E10A17] before:text-[50px] max-xl:after:hidden max-xl:before:hidden trainerSwiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($trainers_post as $post) :
                                        setup_postdata($post);
                                    ?>
                                        <div class="swiper-slide transition">
                                            <div class="relative clip-trainer-card sm:max-w-[400px]">
                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                                <div class="flex flex-col w-full left-0 absolute bg-[#E10A17] bottom-0 lg:pb-[15px] lg:pt-[37px] pb-[12px] pt-[30px] px-[40px] right-0">
                                                    <span class="text-white font-bold font-base tracking-[1px] leading-[26.4px] text-[24px] uppercase"><?php the_title(); ?></span>
                                                    <span class="text-white font-bold font-base tracking-[1px] leading-[11px] text-[10px] uppercase"><?php the_field('position'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="bg-no-repeat bg-center !h-full !top-0 !w-[55px] after:hidden bg-contain opacity-100 !left-0 bg-swiper-prev swiper-button-prev">
                                </div>
                                <div class="bg-no-repeat bg-center !h-full !top-0 !w-[55px] after:hidden bg-contain opacity-100 !right-0 bg-swiper-next swiper-button-next">
                                </div>
                            </div>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
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
        $title_line_5 = get_sub_field('title_line_5');
        $title_left = get_sub_field('title_left');
        $cta = get_sub_field('cta');
    ?>
        <section class="relative lg:pb-[77px] lg:pt-[70px] pb-[66px] pt-[306px] sm:pt-[400px]">
            <div class="z-[-1] absolute bottom-0 left-0 right-0 top-0">
                <img class="w-full h-full object-cover object-left-top md:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="img">
                <img class="w-full h-full object-cover object-left-top hidden md:block" src="<?php echo esc_url($bg_image_desk); ?>" alt="img">
            </div>
            <div class="flex flex-col justify-center items-center lg:flex-row lg:items-stretch px-[30px]">
                <div class="flex flex-col w-full items-end justify-end lg:max-w-[50%] max-w-[312px]">
                    <h3 class="font-privacy text-white font-bold italic leading-[1] uppercase w-full lg:text-[38px] lg:text-right text-[29px] xl:pr-[30px] xl:text-[40px] xs:text-[30px]">
                        <?php echo $title_line_1; ?> <span class="text-white block lg:inline lg:ml-0 ml-[10%]"><?php echo $title_line_2; ?></span>
                    </h3>
                    <h3 class="font-privacy text-white font-bold italic leading-[1] uppercase w-full 2xl:pr-[270px] lg:pr-[150px] lg:text-[32px] text-[22px] xs:pr-[25%] xs:w-auto">
                        <?php echo $title_line_3; ?>
                    </h3>
                    <h3 class="font-privacy font-bold italic uppercase leading-[1] lg:pr-[40px] text-[50px] text-panther-red-100 text-right xl:pr-[98px] xs:text-[64px]">
                        <?php echo $title_line_4; ?> <span class="mr-[-7%] text-panther-red-100"><?php echo $title_line_5; ?></span>
                    </h3>
                </div>
                <div class="flex flex-col w-full items-center lg:items-start lg:mt-0 lg:pl-[50px] lg:w-2/4 mt-[50px]">
                    <h3 class="text-white font-bold uppercase leading-[1.1] text-[30px] text-center lg:mb-[11px] lg:text-left mb-[20px]">
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
<section>
    <div class="flex flex-col justify-center items-center max-w-[1200px] lg:mt-[100px] mt-[95px] mx-[32px] sm:mx-auto">
        <script defer async src='https://cdn.trustindex.io/loader.js?2d5df9913f1f2678f136ecb0af7'></script>
    </div>
</section>
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
            <div class="w-full absolute top-0 bg-white h-[50%]"></div>
            <div class="w-full absolute bottom-0 bg-black-darkgray-gradient h-[50%]"></div>
            <div class="flex flex-col relative shadow-[0_0_40px_0_#00000029] rounded-[8px] overflow-hidden max-w-[1200px] mx-5 sm:mx-auto">
                <div class="absolute top-0 left-0 right-0 bottom-0">
                    <img class="w-full h-full object-cover object-left-top sm:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="img">
                    <img class="w-full h-full object-cover object-left-top hidden sm:block" src="<?php echo esc_url($bg_image_desk); ?>" alt="img">
                </div>
                <div class="flex flex-col justify-center relative md:w-[820px] pb-[60px] pt-[300px] px-[25px] sm:px-[60px] sm:py-[80px] sm:self-end z-[1]">
                    <p class="font-privacy text-white font-bold italic leading-[42px] text-left max-lg:hidden text-[40px]">
                        <?php echo wp_kses($title1, ''); ?>
                    </p>
                    <p class="font-privacy text-white font-bold italic leading-[42px] text-left lg:hidden mb-[20px] text-[38px]"><?php echo $title1; ?>
                    </p>
                    <p class="font-privacy font-bold italic leading-[42px] max-lg:hidden text-[40px] text-[#E10A17] text-right">
                        <?php echo wp_kses($title2, ''); ?>
                    </p>
                    <p class="font-privacy font-bold italic leading-[42px] lg:hidden text-[38px] text-[#E10A17]"><?php echo $title2; ?></p>
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
