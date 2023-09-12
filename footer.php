<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Panther_Gym_Child
 */

?>

</main>
<footer class="bg-black footer">
  <div class="footer__container">
    <div class="flex flex-col sm:flex-row justify-between sm:gap-5 gap-[75px] py-8">
      <div class="flex flex-col justify-center sm:w-[40%]">
        <img class="mb-[50px] mx-auto sm:ml-0 w-fit" src="<?php echo esc_url(get_theme_mod('footer_logo')); ?>">
        <p class="font-privacy text-white text-[16px] leading-[24px] mb-[40px]">
          <?php echo get_theme_mod('slogan'); ?>
        </p>
        <?php if (is_active_sidebar('footer-contact')) {
          dynamic_sidebar('footer-contact');
        } ?>
      </div>
      <div class="flex flex-col sm:w-[50%]">
        <div class="flex flex-col mb-[60px]">
          <p class="font-bold text-white font-base text-[20px] max-lg:text-center mb-[18px]">SIGN UP FOR OUR NEWSLETTER</p>
          <div class="flex flex-row justify-between border-b border-solid border-white gap-[15px] max-w-[400px] pb-[10px] px-[15px]">
            <input class="font-privacy text-white text-[16px] bg-transparent sm:min-w-[300px]" placeholder="E-mail">
            <button class="font-bold font-base py-[8px] text-[#E10A17] text-[16px]">Submit</button>
          </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:justify-between gap-[50px]">
          <div class="flex flex-col gap-[15px]">
            <span class="font-bold text-white font-base text-[20px]">LINKS</span>
            <ul class="flex flex-col">
              <?php foreach (udesly_get_menu("footer-links") as $menu_item) : ?>
                <li><a class="font-privacy capitalize footer-item-link" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
          <div class="flex flex-col gap-[15px]">
            <span class="font-bold text-white font-base text-[20px]">CLASSES & SERVICES</span>
            <ul class="flex flex-col">
              <?php foreach (udesly_get_menu("classes-services") as $menu_item) : ?>
                <li><a class="font-privacy capitalize footer-item-link" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
          <?php if (is_active_sidebar('work-time')) { ?>
            <div class="flex flex-col gap-[15px]">
              <span class="font-bold text-white font-base text-[20px]">HOURS</span>
              <?php dynamic_sidebar('work-time'); ?>
            </div>
          <?php  } ?>
        </div>
      </div>
    </div>
    <div class="flex flex-col sm:flex-row justify-between sm:items-center border-[#2B2B2B] border-solid border-t max-sm:gap-[20px] mb-[100px] pt-[34px] sm:mb-[60px]">
      <p class="font-privacy text-[#646464] sm:w-[40%]"><?php echo get_theme_mod('copyright'); ?></p>
      <div class="flex flex-col sm:flex-row justify-between sm:gap-5 gap-[40px] sm:items-center sm:w-[60%]">
        <div class="flex flex-col sm:flex-row justify-between sm:gap-8 sm:w-[1/2]">
          <?php foreach (udesly_get_menu("footer-privacy") as $menu_item) : ?>
            <a href="<?php echo $menu_item->url; ?>" class="font-privacy text-[#646464] hover:text-white transition-colors duration-200 ease-in"><?php echo $menu_item->title; ?></a>
          <?php endforeach ?>

          <!-- <span class="font-privacy text-[#646464]">Terms & Conditions</span> -->
        </div>
        <?php
        wp_nav_menu([
          'theme_location'  => 'soc-menu',
          'menu'            => 'soc-menu',
          'container'       => false,
          'menu_class'      => '',
          'echo'            => true,
          'fallback_cb'     => 'wp_page_menu',
          'items_wrap'      => '<ul class="flex items-center justify-center lg:justify-end flex-row gap-[22px] sm:w-1/2">%3$s</ul>',
          'depth'           => 0
        ]);
        ?>
      </div>
    </div>
  </div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>
