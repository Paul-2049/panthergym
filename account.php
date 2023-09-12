<?php
/*
    Template Name: Account new
    Template Post Type: page
*/
get_header();
?>
<?php if (have_rows('main')) : ?>
    <?php while (have_rows('main')) : the_row();
        $bg_image_mob = get_sub_field('bg_image_mob');
        $bg_image = get_sub_field('bg_image');

		if(!empty( $bg_image_mob ) && !empty($bg_image)) {
    ?>
        <section class="flex items-end justify-end <?= !is_lost_password_page() ? 'h-[505px] lg:h-[500px]' : 'h-[130px] md:h-[177px]'; ?> relative pt-[1px]">
            <div class="absolute left-0 top-0 bg-black bottom-0 right-0 overflow-hidden">
                <img class="w-full h-full object-cover object-left-top sm:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="">
                <img class="w-full h-full object-cover object-left-top hidden sm:block" src="<?php echo esc_url($bg_image); ?>" alt="">
            </div>

            <?php if (!is_lost_password_page()) { ?>
                <div class="flex items-end 2xl:pl-[101px] bg-no-repeat bg-panther-red-100 bg-right-top clip-left h-[163px] justify-start lg:bg-red-bg lg:bg-transparent lg:h-[351px] lg:items-end lg:pb-[23px] lg:pl-[8%] lg:pr-[20px] lg:translate-y-[10%] lg:w-[50%] pb-[38px] pl-[12%] pt-[33px] text-left translate-y-[27%] w-[95%] xl:w-[48%] opacity-90">
                    <h1 class="text-white h1"><?php the_title(); ?></h1>
                </div>
            <?php } ?>
        </section>
    <?php } endwhile; ?>
<?php endif; ?>

<?php if (is_lost_password_page()) {
    echo do_shortcode('[gym_schedule id="head_bar" hide="auth"]Join now for $0 enrolment on the Ultimate and Performance Memberships! Ends August 31![/gym_schedule]');
} ?>

<section class="account-section pt-[1px]">
    <div class="container w-full mx-auto max-w-[1249px] px-[30px] text-center">
        <div class="account-head">
            <?php if (is_user_logged_in()) { ?>
                <div class="qr-code">
                    <?php echo do_shortcode('[mepr-show if="loggedin"][kaya_qrcode_dynamic title_align="aligncenter" ecclevel="L" align="aligncenter" css_shadow="1"]https://panthergym.com/staging/member-details/?id=[mepr-account-info field="ID"][/kaya_qrcode_dynamic][/mepr-show]'); ?>
                </div>
            <?php } ?>
            <div class="account-wrap">
                <div class="account-name">
                    <?php echo do_shortcode('[mepr-account-info field="first_name"]'); ?>
                </div>
                <p class="welcome-text text-center">
                    <?php
                    the_field('welcome_text');  ?>
                </p>
            </div>
        </div>
        <p class="account-content">
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
