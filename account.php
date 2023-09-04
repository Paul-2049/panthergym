<?php
/*
    Template Name: Account new
    Template Post Type: page
*/
get_header();
?>
<section class="flex h-[505px] items-end justify-end lg:h-[500px] relative">
    <div class="absolute left-0 top-0 bg-black bottom-0 right-0 overflow-hidden">
        <img class="w-full h-full object-cover object-left-top sm:hidden" src="<?php the_field('bg_image_mob'); ?>" alt="">
        <img class="w-full h-full object-cover object-left-top hidden sm:block" src="<?php the_field('bg_image'); ?>" alt="">
    </div>
    <div class="flex items-center 2xl:pl-[101px] bg-no-repeat bg-panther-red-100 bg-right-top clip-left h-[163px] justify-start lg:bg-red-bg lg:bg-transparent lg:h-[351px] lg:items-end lg:pb-[40px] lg:pl-[8%] lg:pr-[20px] lg:translate-y-[10%] lg:w-[50%] pb-[43px] pl-[12%] pt-[33px] text-left translate-y-[27%] w-[95%] xl:w-[48%] opacity-90">
        <h1 class="text-white h1"><?php the_title(); ?></h1>
    </div>
</section>
<section class="account-section">
    <div class="w-full mx-auto max-w-[1470px] px-[30px] text-center">
        <div class="account-head">
            <div class="qr-code">
                <?php echo do_shortcode('[mepr-show if="loggedin"][kaya_qrcode_dynamic title_align="aligncenter" ecclevel="L" align="aligncenter" css_shadow="1"]https://panthergym.com/staging/member-details/?id=[mepr-account-info field="ID"][/kaya_qrcode_dynamic][/mepr-show]'); ?>
            </div>
            <div class="account-wrap">
                <div class="account-name">
                    <?php echo do_shortcode('[mepr-account-info field="first_name"]'); ?>
                </div>
                <p class="welcome-text">
                    <?php
                    the_field('welcome_text');  ?>
                </p>
            </div>
        </div>
        <p class="account-content mx-auto">
            <?php
            $text = get_field('sub_text');
            $allowed_html = array(
                'span'     => array(),
            );
            $text = wp_kses($text, $allowed_html);
            echo $text;
            ?>
        </p>
        <div class="account-block">
            <?php echo do_shortcode('[mepr-account-form]'); ?>
        </div>
    </div>

</section>

<?php
get_footer();
