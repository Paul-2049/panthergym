<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Panther_Gym_Child
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div class="wrapper">
    <div class="search-popup hidden">
      <div class="search--result-close-btn">
        <svg width="100%" height="100%" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1L14 13.5L1 26" stroke="currentColor"></path>
          <path d="M27 26L14 13.5L27 1" stroke="currentColor"></path>
        </svg>
      </div>
      <h2 class="heading-search"><?php echo __('Search in the website'); ?></h2>
      <form action="<?php echo home_url(''); ?>" class="search--form w-form" sym="true" method="get" role="search">
        <input type="search" class="text-field is--search-result w-input search-input" maxlength="256" name="s" placeholder="Search…" id="search" required="">
        <input type="submit" value="Search" class="btn--20 is--search w-button btn-search btn-secondary">
      </form>
    </div>
    <header class="w-full left-0 <?= GYM_HEADER::hasBgImage() ? 'bg-transparent absolute' : 'bg-black' ?> header lg:mt-0 lg:pb-[19px] lg:pt-[10px] mt-[27px] top-0 z-[5]">
      <div class="w-full mx-auto items-center max-w-[1470px] lg:px-[15px] gap-7 hidden justify-end lg:flex lg:mb-[10px]">
        <div class="search-btn-js">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.91006 12.5893C10.915 12.5893 13.3511 10.1533 13.3511 7.14834C13.3511 4.14335 10.915 1.70733 7.91006 1.70733C4.90507 1.70733 2.46905 4.14335 2.46905 7.14834C2.46905 10.1533 4.90507 12.5893 7.91006 12.5893ZM7.91006 14.2967C11.858 14.2967 15.0584 11.0963 15.0584 7.14834C15.0584 3.20042 11.858 0 7.91006 0C3.96214 0 0.761719 3.20042 0.761719 7.14834C0.761719 11.0963 3.96214 14.2967 7.91006 14.2967Z" fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.91006 12.5893C10.915 12.5893 13.3511 10.1533 13.3511 7.14834C13.3511 4.14335 10.915 1.70733 7.91006 1.70733C4.90507 1.70733 2.46905 4.14335 2.46905 7.14834C2.46905 10.1533 4.90507 12.5893 7.91006 12.5893ZM7.91006 14.2967C11.858 14.2967 15.0584 11.0963 15.0584 7.14834C15.0584 3.20042 11.858 0 7.91006 0C3.96214 0 0.761719 3.20042 0.761719 7.14834C0.761719 11.0963 3.96214 14.2967 7.91006 14.2967Z" fill="#E7E5E5" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6393 17.0848L11.5305 11.976L12.7378 10.7687L17.8466 15.8775L16.6393 17.0848Z" fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6393 17.0848L11.5305 11.976L12.7378 10.7687L17.8466 15.8775L16.6393 17.0848Z" fill="#E7E5E5" />
          </svg>
        </div>
        <div class="flex items-center gap-[9px] user-block">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.90904 3.86365C4.90904 1.72982 6.74061 0 8.99997 0C11.2593 0 13.0909 1.72982 13.0909 3.86365C13.0909 5.99749 11.2593 7.72731 8.99997 7.72731C6.74061 7.72731 4.90904 5.99749 4.90904 3.86365ZM8.99997 1.54546C7.64436 1.54546 6.54541 2.58335 6.54541 3.86365C6.54541 5.14396 7.64436 6.18185 8.99997 6.18185C10.3556 6.18185 11.4545 5.14396 11.4545 3.86365C11.4545 2.58335 10.3556 1.54546 8.99997 1.54546Z" fill="white" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M0.818115 16.2273C0.818115 11.9597 4.48126 8.50004 8.99997 8.50004C13.5187 8.50004 17.1818 11.9597 17.1818 16.2273V17.0001H0.818115V16.2273ZM2.50513 15.4546H15.4948C15.0922 12.4052 12.3379 10.0455 8.99997 10.0455C5.66209 10.0455 2.90775 12.4052 2.50513 15.4546Z" fill="white" />
            </svg>
          </span>
          <?php if (is_user_logged_in()) : ?>
            <a class="font-bold font-base leading-[1.6] text-[18px] text-panther-red-100 uppercase" href="<?php echo home_url('/my-account'); ?>">
              <?php echo do_shortcode('[mepr-account-info field="first_name"]'); ?>
            </a>
          <?php else : ?>
            <a class="font-bold font-base leading-[1.6] text-[18px] text-panther-red-100 uppercase" href="<?php echo home_url('/login'); ?>">
              <?php echo __('Login'); ?>
            </a>
          <?php endif; ?>
        </div>

        <div class="cart-block">
          <a href="<?php echo home_url('/cart'); ?>" class="cart--link w-inline-block" data-link="a2e7b20">
            <div class="cart--img w-embed">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                <g clip-path="url(#clip0_5_20)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M0.833374 0.791626H4.85831L5.48331 3.95829H19.5359L16.4109 11.875H7.04581L7.35831 13.4583H15.8334V15.0416H5.9751L3.4751 2.37496H0.833374V0.791626ZM6.73331 10.2916H15.2559L17.1309 5.54163H5.79581L6.73331 10.2916Z" fill="white" />
                  <path d="M6.66671 17.0208C6.66671 16.365 7.22635 15.8333 7.91671 15.8333C8.60706 15.8333 9.16671 16.365 9.16671 17.0208C9.16671 17.6766 8.60706 18.2083 7.91671 18.2083C7.22635 18.2083 6.66671 17.6766 6.66671 17.0208Z" fill="white" />
                  <path d="M12.5 17.0208C12.5 16.365 13.0597 15.8333 13.75 15.8333C14.4404 15.8333 15 16.365 15 17.0208C15 17.6766 14.4404 18.2083 13.75 18.2083C13.0597 18.2083 12.5 17.6766 12.5 17.0208Z" fill="white" />
                </g>
                <defs>
                  <clipPath id="clip0_5_20">
                    <rect width="20" height="19" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <div id="cart-count">
              <?php echo WC()->cart->get_cart_contents_count(); ?>
            </div>
          </a>
        </div>
      </div>
      <div class="flex items-center w-full mx-auto max-w-[1470px] gap-2 lg:justify-between lg:px-[15px] lg:py-[0] pb-[10px] pt-[17px] px-[29px]">
        <div class="burger-js cursor-pointer lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <g clip-path="url(#clip0_88_824)">
              <path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z" fill="white" />
            </g>
            <defs>
              <clipPath id="clip0_88_824">
                <rect width="24" height="24" fill="white" />
              </clipPath>
            </defs>
          </svg>
        </div>
        <?php $custom_logo__url = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full'); ?>
        <a href="<?php echo home_url('/'); ?>" class="lg:ml-0 logo ml-[30px]">
          <img src="<?php echo $custom_logo__url[0]; ?>" alt="PantherGym">
        </a>
        <nav class="flex flex-col h-screen fixed top-0 left-0 bg-panther-red-100 text-white w-full lg:static lg:h-auto lg:bg-transparent lg:justify-end pt-12 pb-16 px-7 lg:p-0 z-10 translate-x-[-100%] lg:translate-x-0 duration-[0.3s] ease-in transition-all nav-js overflow-y-auto lg:overflow-y-visible">
          <div class="flex items-center justify-between lg:hidden mb-9">
            <div class="close-js cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_146_1478)">
                  <path d="M12.2466 10.586L17.1966 5.63599L18.6106 7.04999L13.6606 12L18.6106 16.95L17.1966 18.364L12.2466 13.414L7.29657 18.364L5.88257 16.95L10.8326 12L5.88257 7.04999L7.29657 5.63599L12.2466 10.586Z" fill="white" />
                </g>
                <defs>
                  <clipPath id="clip0_146_1478">
                    <rect width="24" height="24" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <div class="user-icon cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                <g clip-path="url(#clip0_146_1485)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.40904 4.36365C5.40904 2.22982 7.24061 0.5 9.49997 0.5C11.7593 0.5 13.5909 2.22982 13.5909 4.36365C13.5909 6.49749 11.7593 8.22731 9.49997 8.22731C7.24061 8.22731 5.40904 6.49749 5.40904 4.36365ZM9.49997 2.04546C8.14436 2.04546 7.04541 3.08335 7.04541 4.36365C7.04541 5.64396 8.14436 6.68185 9.49997 6.68185C10.8556 6.68185 11.9545 5.64396 11.9545 4.36365C11.9545 3.08335 10.8556 2.04546 9.49997 2.04546Z" fill="white" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M1.31812 16.7273C1.31812 12.4597 4.98126 9.00004 9.49997 9.00004C14.0187 9.00004 17.6818 12.4597 17.6818 16.7273V17.5001H1.31812V16.7273ZM3.00513 15.9546H15.9948C15.5922 12.9052 12.8379 10.5455 9.49997 10.5455C6.16209 10.5455 3.40775 12.9052 3.00513 15.9546Z" fill="white" />
                </g>
                <defs>
                  <clipPath id="clip0_146_1485">
                    <rect width="18" height="17" fill="white" transform="translate(0.5 0.5)" />
                  </clipPath>
                </defs>
              </svg>
            </div>
          </div>
          <ul class="header-menu">
            <?php foreach (udesly_get_menu("navbar-menu", true) as $menu_item) : ?>
              <?php if (count($menu_item->items) == 0) : ?>
                <li class="item_menu">
                  <a href="<?php echo $menu_item->url; ?>" class="item-link"><?php echo $menu_item->title; ?></a>
                </li>
              <?php endif  ?>
              <?php if (count($menu_item->items) > 0) : ?>
                <div data-hover="false" data-delay="0" data-w-id="49aed735-83d3-c986-6ea1-0660c88faf36" class="relative h-fit has_submenu">
                  <li class="sub-menu-js item_menu">
                    <div class="item-link cursor-pointer"><?php echo $menu_item->title; ?></div>
                  </li>

                  <ul class="nav-sub-menu top-full w-max z-[2] lg:fixed lg:bg-white">
                    <?php foreach ($menu_item->items as $sub_item) : ?>
                      <li>
                        <a href="<?php echo $sub_item->url; ?>" class="item-link lg:text-black"><?php echo $sub_item->title; ?></a>
                      </li>
                    <?php endforeach ?>
                  </ul>
                </div>
              <?php endif  ?>
            <?php endforeach; ?>
          </ul>
          <ul class="header-menu lg:hidden mt-[20px]">
            <li><a class="item-link search-btn-js" href="#">Search</a></li>
            <?php if (is_user_logged_in()) : ?>
              <li>
                <a class="item-link" href="<?php echo home_url('/my-account'); ?>">
                  <?php echo do_shortcode('[mepr-account-info field="first_name"]'); ?>
                </a>
              </li>
            <?php else : ?>
              <li>
                <a class="item-link" href="<?php echo home_url('/login'); ?>">
                  <?php echo __('Login'); ?>
                </a>
              </li>
            <?php endif; ?>
          </ul>
          <div class="btn-rectangle lg:hidden mt-[44px] mx-auto">
            BECOME A MEMBER
          </div>
        </nav>
      </div>
    </header>

    <main class="page">
      <div data-observ></div>
