<?php
get_header();
?>
<section class="bg-black h-[130px] md:h-[177px]">
</section>
<div class="w-full mx-auto pt-[30px] lg:px-[15px] px-[29px] max-w-[1470px] flex flex-col md:flex-row items-start md:items-center justify-start md:justify-between gap-[20px] mb-[30px] md:mb-[60px]">
    <?php
    /* breadcrumb Yoast */
    if (function_exists('yoast_breadcrumb')) :
        yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
    endif;
    ?>
    <div class="flex items-center justify-start gap-[5px] md:gap-[10px] text-[12px] sm:text-[16px] font-privacy font-bold leading-[1.1] uppercase">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                <path d="M7.6875 22.5886C9 21.672 10.3021 20.9688 11.5938 20.4792C12.8854 19.9897 14.2708 19.7449 15.75 19.7449C17.2292 19.7449 18.6198 19.9897 19.9219 20.4792C21.224 20.9688 22.5312 21.672 23.8438 22.5886C24.7604 21.4636 25.4115 20.3282 25.7969 19.1824C26.1823 18.0365 26.375 16.8282 26.375 15.5574C26.375 12.5365 25.3594 10.0105 23.3281 7.97925C21.2969 5.948 18.7708 4.93237 15.75 4.93237C12.7292 4.93237 10.2031 5.948 8.17188 7.97925C6.14062 10.0105 5.125 12.5365 5.125 15.5574C5.125 16.8282 5.32292 18.0365 5.71875 19.1824C6.11458 20.3282 6.77083 21.4636 7.6875 22.5886ZM15.7442 16.4949C14.5397 16.4949 13.526 16.0815 12.7031 15.2547C11.8802 14.4279 11.4688 13.4123 11.4688 12.2078C11.4688 11.0034 11.8821 9.98966 12.7089 9.16675C13.5357 8.34383 14.5514 7.93237 15.7558 7.93237C16.9603 7.93237 17.974 8.34577 18.7969 9.17256C19.6198 9.99935 20.0312 11.015 20.0312 12.2194C20.0312 13.4239 19.6179 14.4376 18.7911 15.2605C17.9643 16.0834 16.9486 16.4949 15.7442 16.4949ZM15.7646 28.0574C14.0465 28.0574 12.4271 27.7292 10.9062 27.073C9.38542 26.4167 8.05729 25.5209 6.92188 24.3855C5.78646 23.2501 4.89062 21.9244 4.23438 20.4084C3.57812 18.8925 3.25 17.2727 3.25 15.5491C3.25 13.8254 3.57812 12.2084 4.23438 10.698C4.89062 9.18758 5.78646 7.86466 6.92188 6.72925C8.05729 5.59383 9.38298 4.698 10.8989 4.04175C12.4149 3.3855 14.0347 3.05737 15.7583 3.05737C17.4819 3.05737 19.099 3.3855 20.6094 4.04175C22.1198 4.698 23.4427 5.59383 24.5781 6.72925C25.7135 7.86466 26.6094 9.18791 27.2656 10.699C27.9219 12.2101 28.25 13.8247 28.25 15.5427C28.25 17.2608 27.9219 18.8803 27.2656 20.4011C26.6094 21.922 25.7135 23.2501 24.5781 24.3855C23.4427 25.5209 22.1195 26.4167 20.6084 27.073C19.0973 27.7292 17.4827 28.0574 15.7646 28.0574ZM15.75 26.1824C16.8958 26.1824 18.0156 26.0157 19.1094 25.6824C20.2031 25.349 21.2812 24.7657 22.3438 23.9324C21.2812 23.1824 20.1979 22.6095 19.0938 22.2136C17.9896 21.8178 16.875 21.6199 15.75 21.6199C14.625 21.6199 13.5104 21.8178 12.4062 22.2136C11.3021 22.6095 10.2188 23.1824 9.15625 23.9324C10.2188 24.7657 11.2969 25.349 12.3906 25.6824C13.4844 26.0157 14.6042 26.1824 15.75 26.1824ZM15.75 14.6199C16.4583 14.6199 17.0365 14.3959 17.4844 13.948C17.9323 13.5001 18.1562 12.922 18.1562 12.2136C18.1562 11.5053 17.9323 10.9272 17.4844 10.4792C17.0365 10.0313 16.4583 9.80737 15.75 9.80737C15.0417 9.80737 14.4635 10.0313 14.0156 10.4792C13.5677 10.9272 13.3438 11.5053 13.3438 12.2136C13.3438 12.922 13.5677 13.5001 14.0156 13.948C14.4635 14.3959 15.0417 14.6199 15.75 14.6199Z" fill="black" />
            </svg>
        </span>
        Logged In As: <span class="text-panther-red-100">
            <?php $current_logged_in_user = wp_get_current_user();
            echo $current_logged_in_user->display_name; ?>
        </span>
    </div>
</div>
<section class="w-full mx-auto lg:px-[15px] px-[29px] max-w-[1110px] min-h-[658px]">
    <h1 class="leading-[1.1] font-bold text-center text-[32px] md:text-[40px] uppercase mb-[20px] md:mb-[40px] text-black"><?php the_title(); ?></h1>
    <?php
    $search_string = '';
    if (array_key_exists('search_details', $_GET)) {
        $search_string = esc_sql($_GET['search_details']);
    }
    ?>
    <form action="" method="get" class="search-form w-full flex items-center justify-start flex-col md:flex-row mb-[25px] md:mb-[53px]">
        <span class="w-full h-[57px] border-t-[1px] border-l-[1px] border-b-[1px] border-r-[1px] md:border-r-0 border-black rounded-[2px] pl-[35px] md:pl-[60px] flex items-center before:bg-search-icon before:bg-no-repeat before:bg-center before:w-[19px] before:h-[19px] relative before:absolute before:left-[10px] md:before:left-[22px]">
            <input class="inputfield w-full h-full text-[16px] leading-[1.5] font-privacy placeholder:text-panther-white-300 " type="text" name="search_details" value="" placeholder="Search for a member" autocomplete="off">
        </span>
        <input type="submit" value="View member" class="btn-clip-none w-full md:max-w-[217px]">
    </form>
    <?php if ($search_string) :
        $email_login_users_query = new WP_User_Query(
            array(
                'fields' => 'all',
                'search' => "*{$search_string}*",
                'search_columns' => array('user_login', 'user_email'),
            )
        );
        $email_login_users = $email_login_users_query->get_results();
        $meta_key_users_query = new WP_User_Query([
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key'     => 'first_name',
                    'value'   => $search_string,
                    'compare' => 'LIKE',
                ],
                [
                    'key'     => 'last_name',
                    'value'   => $search_string,
                    'compare' => 'LIKE',
                ],
                [
                    'key'     => 'billing_first_name',
                    'value'   => $search_string,
                    'compare' => 'LIKE',
                ],
                [
                    'key'     => 'billing_last_name',
                    'value'   => $search_string,
                    'compare' => 'LIKE',
                ],
                [
                    'key'     => 'billing_phone',
                    'value'   => $search_string,
                    'compare' => 'LIKE',
                ],
            ],
        ]);
        $meta_key_users = $meta_key_users_query->get_results();
        $users_found = array_unique(array_merge($email_login_users_query->get_results(), $meta_key_users_query->get_results()), SORT_REGULAR);
    ?>
        <div class="max-w-[919px] w-full mx-auto pb-[80px] lg:pb-[193px]">
            <?php if (!$users_found) : ?>
                <p class="text-[16px] font-privacy leading-[1.5] mb-[25px] md:mb-[52px]">
                    <span class="text-panther-red-100 font-bold">No members found.</span>
                </p>
            <?php else : ?>
                <p class="text-[16px] font-privacy leading-[1.5] mb-[25px] md:mb-[52px]">
                    We found <span class="text-panther-red-100 font-bold"><?php echo count($users_found); ?></span> users:
                </p>
            <?php endif; ?>
            <div class="grid grid-cols-2 auto-rows-auto gap-[15px] md:gap-[65px]">


                <?php foreach ($users_found as $key => $user) : ?>
                    <div class="flex flex-col items-center justify-center border-t-[3px] border-panther-red-100 shadow-card-membership-shadow py-[20px] md:py-[67px] text-center">
                        <div class="rounded-full w-[138px] h-[138px] shadow-avatar-shadow mb-[20px] md:mb-[30px] flex item-center justify-center overflow-hidden">
                            <img src="<?php echo get_avatar_url($user->ID); ?>" alt="">
                        </div>
                        <p class="uppercase text-[20px] md:text-[24px] font-bold leading-[1.1] text-black mb-[9px]">
                            <?php echo $user->display_name; ?>
                        </p>
                        <p class="text-[16px] leading-[1.1] font-privacy mb-[25px] md:mb-[52px]">
                            <?php echo $user->user_email; ?>
                        </p>
                        <a href="<?php echo get_permalink(5095); ?>?id=<?php echo $user->ID; ?>" class="font-privacy font-bold uppercase text-panther-red-100 hover:text-panther-red-200 transition-colors duration-200 ease-in">
                            View member
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php
get_footer();
?>