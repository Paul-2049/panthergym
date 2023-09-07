<?php

/**
 * Template Name: Front Page
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
<?php if (have_rows('main_home')) : ?>
  <?php while (have_rows('main_home')) : the_row();
    $title = get_sub_field('title');
    $cta = get_sub_field('cta');
    $bg_image = get_sub_field('bg_image');
    $image_content = get_sub_field('image_content');
    $overlay_image_content = get_sub_field('overlay_image_content');
  ?>
    <section class="flex flex-col justify-between bg-center bg-cover bg-no-repeat items-center lg:flex-row lg:pt-[143px] pt-[104px]" style="background-image: url(<?php echo esc_url($bg_image); ?>);">
      <div class="relative h-auto lg:h-[665px]">
        <img style="height: inherit" class="lg:object-contain	 lg:opacity-40 pb-[147px] lg:pb-[51px]" src="<?php echo esc_url($overlay_image_content); ?>" alt="overlay">
        <img class="h-full absolute bottom-0 left-0 lg:object-cover mx-auto right-0" src="<?php echo esc_url($image_content); ?>" alt="img">
      </div>
      <div class="flex flex-col w-full items-center justify-center 2xl:pl-[12%] bg-no-repeat bg-panther-red-100 bg-right-top lg:bg-red-bg lg:bg-transparent lg:clip-left lg:items-start lg:min-h-[461px] lg:pb-[65px] lg:pl-[8%] lg:pr-[20px] lg:pt[69px] lg:text-left lg:w-[55%] min-h-[334px] pb-[35px] pt-[27px] px-[31px] text-center">
        <h1 class="text-white w-full h1 lg:mb-[42px] max-w-[650px] mb-[34px]"><?php echo esc_html($title); ?></h1>
        <a href="<?php echo esc_url($cta['url']); ?>" class="btn-secondary">
          <span class="!font-bold">
            <?php echo esc_html($cta['title']); ?>
          </span>
        </a>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('about')) : ?>
  <?php while (have_rows('about')) : the_row();
    $animate_text = get_sub_field('animate_text');
    $video = get_sub_field('video');
    $content = get_sub_field('content');
    $link = get_sub_field('link');
    $allowed_html = array(
      'p'     => array(),
      'strong'      => array(),
      'a'      => array(
        'href' => array(),
        'title' => array(),
      ),
    );
    $search  = array('<p>');
    $replace = array('<p class="content-p">');
    $content = wp_kses($content, $allowed_html);
    $content = str_replace($search, $replace, $content);
  ?>
    <section class="bg-black lg:pt-[119px] pt-[94px]">
      <div class="flex flex-col w-full items-center mx-auto justify-center max-w-[1240px]">
        <div class="w-full !px-[60px] swiper !pb-[50px] !pt-[15px] aboutSwiper">
          <div class="swiper-wrapper">
            <?php if (have_rows('item')) : ?>
              <?php while (have_rows('item')) : the_row();
                $title = get_sub_field('title');
                $image = get_sub_field('image');
                $link_item = get_sub_field('link');
              ?>
                <div class="swiper-slide transition">
                  <a href="<?php echo esc_url($link_item);?>" class="relative clip-trainer-card sm:max-w-[400px] block">
                    <img src="<?php echo esc_url($image); ?>" alt="about-card">
                    <div class="flex flex-col w-full left-0 absolute bg-[#E10A17] bottom-0 px-[40px] right-0 card-text justify-end py-2 transition">
                      <span class="font-bold text-white text-[24px] uppercase"><?php echo esc_html($title); ?></span>
                    </div>
                  </a>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="font-bold font-privacy leading-[1.1] italic after:bg-grey-gradient lg:after:absolute lg:after:h-[217px] lg:after:left-0 lg:after:top-0 lg:after:w-full lg:mt-[-94px] lg:pt-[130px] lg:text-[200px] overflow-hidden relative text-[128px] text-animate text-panther-grey-300 uppercase whitespace-nowrap">
        <span><?php echo esc_html($animate_text); ?></span>
      </div>
      <div class="relative lg:bg-grey-black-gradient mt-[-45px] z-[1]">
        <div class="w-full mx-auto max-w-[1210px]">
          <?php
          preg_match('/src="(.+?)"/', $video, $matches);
          $src = $matches[1];
          $params = array(
            'controls'  => 0,
            'hd'        => 1,
            'autohide'  => 1
          );
          $new_src = add_query_arg($params, $src);
          $video = str_replace($src, $new_src, $video);
          $attributes = 'frameborder="0" class="w-full h-[190px] lg:h-[588px] lg:mb-[70px] mb-[32px]"';
          $video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video);
          echo $video;
          ?>
          <div class="text-white content lg:px-0 px-[31px]">
            <?php echo $content; ?>
            <a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a>
          </div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('panther_classes')) : ?>
  <?php while (have_rows('panther_classes')) : the_row();
    $title = get_sub_field('title');
    $content = get_sub_field('content');
    $image = get_sub_field('image');
    $cta = get_sub_field('cta');
  ?>
    <section class="relative bg-panther-white-100 lg:pt-[225px]">
      <div class="w-full absolute top-0 bg-black h-[38%] lg:bg-[#101010] md:h-[28%]">
        <img class="bottom-[-180px] absolute left-[40px]" src="<?php echo get_stylesheet_directory_uri(); ?>/images/white-sand2.svg">
        <img class="w-full absolute left-0 right-0 bottom-[-4px]" src="<?php echo get_stylesheet_directory_uri(); ?>/images/line.svg">
      </div>
      <div class="flex flex-col bg-panther-white-100 gap-5 md:flex-row md:gap-0">
        <img class="relative z-10 lg:absolute lg:bottom-0 lg:left-0 max-md:h-[360px] max-md:self-center max-md:w-fit max-w-[750px]" src="<?php echo esc_url($image); ?>" alt="img">
        <div class="flex flex-col w-full items-center justify-end pb-[100px] relative z-10">
          <h2 class="!font-bold h2 text-center mb-[25px] leading-[39.6px] lg:leading-[44px] lg:mb-[38px] lg:text-[40px] text-[36px] text-panther-red-100"><?php echo esc_html($title); ?></h2>
          <p class="font-privacy lg:text-[20px] text-[18px] mx-auto text-center w-full leading-[27px] lg:leading-[30px] lg:mb-[50px] max-w-[562px] mb-[63px] px-[15px]">
            <?php echo esc_html($content); ?>
          </p>
          <?php if ($cta) : ?>
            <div class="relative">
              <img class="w-full absolute top-[-50px]" src="<?php echo get_stylesheet_directory_uri(); ?>/images/black-sand.svg">
              <a href="<?php echo esc_url($cta['url']); ?>" class="font-bold btn-primary mx-auto relative z-10">
                <?php echo esc_html($cta['title']); ?>
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('shop_section')) : ?>
  <?php while (have_rows('shop_section')) : the_row();
    $title = get_sub_field('title');
    $content = get_sub_field('content');
    $products = get_sub_field('product');
  ?>
    <section class="lg:pb-[71px] lg:pt-[83px] pb-[112px] pt-[70px]">
      <div class="flex flex-col w-full items-center mx-auto px-[15px] max-w-[1470px]">
        <h2 class="!font-bold h2 text-center mb-[25px] lg:mb-[42px]">
          <?php echo esc_html($title); ?>
        </h2>
        <p class="font-privacy lg:text-[20px] text-[18px] mx-auto text-center w-full leading-[1.5] max-w-[794px]">
          <?php echo esc_html($content); ?>
        </p>
        <?php
        if ($products) : ?>
          <div class="auto-rows-auto bm:grid-cols-2 gap-4 grid grid-cols-1 lg:grid-cols-4 lg:mb-[66px] lg:mt-[64px] mb-[70px] mt-[48px]">
            <?php foreach ($products as $post) :
              setup_postdata($post);
              $product = wc_get_product($post->ID);
              $regular_price = $product->price;
              $sale_price = $product->sale_price;
            ?>
              <a href="<?php the_permalink(); ?>" class="rounded-[6px] border-transparent duration-[0.3s] ease-in transition-all border-b-[8px] hover:border-panther-red-100 hover:shadow-card-shadow lg:px-[41px] pb-[49px] product-cart pt-[28px] px-[46px]">
                <div class="mb-[16px] thumbail">
                  <img src="<?php the_post_thumbnail_url(); ?>" alt="img">
                </div>
                <div class="font-bold font-privacy leading-[1.1] text-[15px] text-panther-red-100 category mb-[10px] uppercase">
                  <?php $terms = get_the_terms($post->ID, 'product_cat');
                  foreach ($terms as $term) {
                    echo  $product_cat = $term->name;
                    break;
                  } ?>
                </div>
                <div class="!font-bold font-base leading-[1.1] mb-[18px] text-[24px] text-black title uppercase">
                  <?php the_title(); ?>
                </div>
                <div class="font-bold font-privacy leading-[1.1] text-[17px] text-panther-red-100 price">
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
<?php if (have_rows('different_us')) : ?>
  <?php while (have_rows('different_us')) : the_row();
    $title = get_sub_field('title');
  ?>
    <section class="bg-no-repeat bg-center bg-cover bg-[url('../images/rest-bg.jpg')] lg:pb-[160px] lg:pt-[130px] pb-[119px] pt-[30px]">
      <div class="flex flex-col w-full items-center mx-auto px-[15px] max-w-[1200px]">
        <h2 class="text-white !font-bold h2 text-center"><?php echo esc_html($title); ?></h2>
        <div class="auto-rows-auto bm:grid-cols-2 gap-4 grid grid-cols-1 lg:grid-cols-3 lg:mt-[90px] mt-[37px]">
          <?php if (have_rows('item')) : ?>
            <?php while (have_rows('item')) : the_row();
              $title = get_sub_field('title');
              $icon = get_sub_field('icon');
            ?>
              <div class="flex items-center border-[1px] border-solid border-transparent cursor-pointer duration-[0.2s] ease-in gap-[24px] hover:bg-panther-grey-100 hover:border-panther-grey-200 justify-start lg:gap-[34px] lg:p-[20px] p-[15px] rounded-[6px] transition-all">
                <div class="rounded-[6px] bg-panther-red-100 h-[66px] lg:h-[90px] lg:p-[9px] lg:w-[90px] p-[6px] w-[66px]">
                  <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>">
                </div>
                <p class="text-white font-base tracking-[1px] !font-bold leading-[1.1] text-[20px] uppercase"><?php echo esc_html($title); ?></p>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('trainers_section')) : ?>
  <?php while (have_rows('trainers_section')) : the_row();
    $title = get_sub_field('title');
    $content = get_sub_field('content');
    $trainers_post = get_sub_field('trainers_post');
  ?>
    <section class="relative">
      <div class="w-full absolute top-0 bg-white h-[80%]"></div>
      <div class="w-full absolute bottom-0 bg-black h-[20%]"></div>
      <div class="flex flex-row justify-between absolute bottom-0 h-[30%] w-full">
        <img class="h-fit" src="<?php echo get_stylesheet_directory_uri(); ?>/images/white-sand.png" alt="sand">
        <img class="h-fit" src="<?php echo get_stylesheet_directory_uri(); ?>/images/white-sand.png" alt="sand">
      </div>
      <div class="flex flex-col justify-center items-center relative">
        <p class="bg-no-repeat bg-center bg-cover bg-[url('../images/gray-bg.png')] h2 lg:mt-[105px] max-sm:text-center max-sm:w-full mb-[20px] mt-[62px] not-italic py-4 sm:px-[150px] sm:text-[40px] text-[36px]">
          <?php echo esc_html($title); ?>
        </p>
        <p class="max-w-[800px] leading-[27px] lg:leading-[30px] lg:text-[20px] mb-[40px] sm:mb-[90px] text-[18px] text-center font-privacy">
          <?php echo esc_html($content); ?></p>
        <?php
        if ($trainers_post) : ?>
          <div class="flex flex-col w-full items-center mx-auto justify-center max-w-[1320px] mb-[120px]">
            <div class="w-full !px-[60px] swiper !py-[15px] after:text-[#E10A17] after:text-[50px] before:text-[#E10A17] before:text-[50px] max-xl:after:hidden max-xl:before:hidden trainerSwiper">
              <div class="swiper-wrapper">
                <?php foreach ($trainers_post as $post) :
                  setup_postdata($post);
                ?>
                  <div class="swiper-slide transition">
                    <div class="relative clip-trainer-card sm:max-w-[400px]">
                      <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                      <div class="flex flex-col w-full left-0 absolute bg-[#E10A17] bottom-0 px-[40px] right-0 lg:pb-[15px] lg:pt-[37px] pb-[12px] pt-[30px]">
                        <span class="font-bold text-white font-base tracking-[1px] leading-[26.4px] text-[24px] uppercase"><?php the_title(); ?></span>
                        <span class="font-bold text-white font-base tracking-[1px] leading-[11px] text-[10px] uppercase"><?php the_field('position'); ?></span>
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
    </section>
  <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('results')) : ?>
  <?php while (have_rows('results')) : the_row();
    $title = get_sub_field('title');
    $image = get_sub_field('image');
    $cta = get_sub_field('cta');
  ?>
    <section>
      <div class="flex flex-col lg:flex-row lg:bg-black lg:pb-[100px]">
        <div class="lg:w-1/2">
          <img class="w-full h-full" src="<?php echo esc_url($image); ?>" alt="training">
        </div>
        <div class="flex flex-col justify-center bg-white lg:px-[60px] lg:py-14 lg:w-1/2 max-lg:items-center max-lg:pt-[60px] px-[15px]">
          <p class="font-bold font-privacy leading-[1.1] italic h1 lg:text-[40px] max-lg:text-center text-[#E10A17] text-[36px] tracking-[0]">
            <?php echo $title; ?>
          </p>
          <ul class="my-[30px]">
            <?php if (have_rows('item')) : ?>
              <?php while (have_rows('item')) : the_row();
                $name = get_sub_field('name');
              ?>
                <li class="flex items-center flex-row gap-5">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/checkmark.svg" alt="checkmark">
                  <p class="font-bold text-[20px] leading-[32px]"><?php echo esc_html($name); ?></p>
                </li>
              <?php endwhile; ?>
            <?php endif; ?>
          </ul>
          <a href="<?php echo esc_url($cta['url']); ?>" class="font-bold btn-primary w-fit">
            <?php echo esc_html($cta['title']); ?>
          </a>
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
    <section class="relative h-max-[350px] lg:py-[68px] py-[46px] flex justify-center items-center">
      <div class="w-full absolute top-0 bg-white h-[50%]"></div>
      <div class="w-full absolute bottom-0 bg-black-darkgray-gradient h-[50%]"></div>
      <div class="flex flex-col relative shadow-[0_0_40px_0_#00000029] rounded-[8px] overflow-hidden max-w-[1200px] w-full mx-5 sm:mx-auto">
        <div class="absolute top-0 left-0 right-0 bottom-0">
          <img class="w-full h-full object-cover object-left-top sm:hidden" src="<?php echo esc_url($bg_image_mob); ?>" alt="img">
          <img class="w-full h-full object-cover object-left-top hidden sm:block" src="<?php echo esc_url($bg_image_desk); ?>" alt="img">
        </div>
        <div class="flex flex-col justify-center relative md:w-[820px] pb-[60px] pt-[300px] px-[25px] sm:px-[60px] sm:py-[80px] sm:self-end z-[1]">
          <p class="font-bold text-white font-privacy italic leading-[42px] text-left max-lg:hidden text-[40px]"><?php echo wp_kses($title1, ''); ?></p>
          <p class="font-bold text-white font-privacy italic leading-[42px] text-left lg:hidden mb-[20px] text-[38px]"><?php echo $title1; ?>
          </p>
          <p class="font-bold font-privacy italic leading-[42px] max-lg:hidden text-[40px] text-[#E10A17] text-right"><?php echo wp_kses($title2, ''); ?></p>
          <p class="font-bold font-privacy italic leading-[42px] lg:hidden text-[38px] text-[#E10A17]"><?php echo $title2; ?></p>
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
