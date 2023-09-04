<?php

/**
 * Template Name: FAQ
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

<section class="bg-black h-[130px] md:h-[177px]">
</section>
<?php
$title = get_field('title');
$cta = get_field('cta');
$allowed_html = array(
    'span'     => array()
);
$title = wp_kses($title, $allowed_html);
$search  = array('<span>');
$replace = array('<span class="text-panther-red-100">');
$title = str_replace($search, $replace, $title);
?>
<section class="bg-white pt-[40px] lg:pt-[80px] px-[30px] pb-[55px] lg:pb-[107px]">
    <h1 class="uppercase lg:text-[68px] text-center font-bold italic leading-[1.1] text-[36px] mb-[36px] lg:mb-[78px] font-privacy">
        <?php echo $title; ?>
    </h1>
    <?php if (have_rows('tabs_item')) : ?>

        <div class="flex flex-col lg:flex-row max-w-[1260px] w-full mx-auto">
            <div class="flex flex-col">
                <span class="lg:px-[22px] font-privacy leading-[1.5] text-[20px] font-bold lg:mb-[42px] block cursor-pointer relative mb-[15px]">Choose
                    the topic:</span>
                <ul class="tabs-nav lg:mr-[-15px] h-[51px] lg:h-auto overflow-hidden mb-[20px] lg:mb-0 gap-1 flex flex-col">
                    <div class="active-tab text-[18px] w-full font-privacy leading-[1] lg:hidden h-[51px] flex items-center justify-start relative rounded-[2px] min border-[1px] border-panther-grey-200 py-[10px] px-[15px] mb-[15px] after:absolute after:right-[15px] after:w-2 after:h-2 min-h-[46px] after:border-r-[1px] after:border-b-[1px] after:border-panther-grey-200 after:rotate-45 after:transition-transform after:duration-200 after:ease-in">
                        Policies, Rules and Etiquette
                    </div>
                    <?php while (have_rows('tabs_item')) : the_row();
                        $tab_title = get_sub_field('tab_title');
                    ?>
                        <li class="<?php echo get_row_index() == 1 ? 'active' : ''; ?> tab-item" data-tab-target="#tab-<?php echo get_row_index(); ?>"><?php echo $tab_title; ?></li>
                    <?php endwhile; ?>

                </ul>
            </div>
            <div class="flex flex-col max-w-[985px] w-full lg:pl-[93px] lg:border-l-[1px] lg:border-black">
				<form action="" class="form-search rounded-[2px] border-[1px] border-black flex items-center justify-start pl-[15px] lg:pl-[20px] gap-[20px] mb-[40px] max-w-[892px] w-full">
					<button type="button" class="js-search-btn bg-transparent w-[20px] h-[20px] cursor-pointer m-0 p-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M7.53506 12.5893C10.54 12.5893 12.9761 10.1533 12.9761 7.14834C12.9761 4.14335 10.54 1.70733 7.53506 1.70733C4.53007 1.70733 2.09405 4.14335 2.09405 7.14834C2.09405 10.1533 4.53007 12.5893 7.53506 12.5893ZM7.53506 14.2967C11.483 14.2967 14.6834 11.0963 14.6834 7.14834C14.6834 3.20042 11.483 0 7.53506 0C3.58714 0 0.386719 3.20042 0.386719 7.14834C0.386719 11.0963 3.58714 14.2967 7.53506 14.2967Z" fill="white" />
							<path fill-rule="evenodd" clip-rule="evenodd" d="M7.53506 12.5893C10.54 12.5893 12.9761 10.1533 12.9761 7.14834C12.9761 4.14335 10.54 1.70733 7.53506 1.70733C4.53007 1.70733 2.09405 4.14335 2.09405 7.14834C2.09405 10.1533 4.53007 12.5893 7.53506 12.5893ZM7.53506 14.2967C11.483 14.2967 14.6834 11.0963 14.6834 7.14834C14.6834 3.20042 11.483 0 7.53506 0C3.58714 0 0.386719 3.20042 0.386719 7.14834C0.386719 11.0963 3.58714 14.2967 7.53506 14.2967Z" fill="#E7E5E5" />
							<path fill-rule="evenodd" clip-rule="evenodd" d="M16.2643 17.0848L11.1555 11.976L12.3628 10.7687L17.4716 15.8775L16.2643 17.0848Z" fill="white" />
							<path fill-rule="evenodd" clip-rule="evenodd" d="M16.2643 17.0848L11.1555 11.976L12.3628 10.7687L17.4716 15.8775L16.2643 17.0848Z" fill="#E7E5E5" />
						</svg>
					</button>
					<input class="js-search-input w-full py-[10px] pr-[15px] lg:py-[18px] lg:pr-[20px]" type="text" placeholder="Search by keyword">
				</form>
                <?php while (have_rows('tabs_item')) : the_row();
                ?>
                    <div class="tabs-content <?php echo get_row_index() == 1 ? 'active' : ''; ?>" data-tab-content id="tab-<?php echo get_row_index(); ?>">
                        <?php if (have_rows('faq_item')) : ?>
                            <?php while (have_rows('faq_item')) : the_row();
                                $question = get_sub_field('question');
                                $answer = get_sub_field('answer');
                                $allowed_html = array(
                                    'p'     => array(),
                                    'span'     => array(
                                        'style' => array(),
                                    ),
                                    'ul'     => array(),
                                    'li'     => array(),
                                    'a'     => array(
                                        'href' => array(),
                                        'title' => array(),
                                    ),
                                );
                                $answer = wp_kses($answer, $allowed_html);
                            ?>
                                <div class="flex flex-col">
                                    <div class="according-title">
                                        <?php echo esc_html($question); ?>
                                    </div>
                                    <div class="according-content">
                                        <?php echo $answer; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($cta) : ?>
        <h4 class="text-[24px] text-center font-base font-bold mt-[70px] lg:mt-[155px]">
            Don't see an answer to your question?
        </h4>
        <a href="<?php echo esc_url($cta['url']); ?>" class="btn-border mt-[25px] mx-auto block"><?php echo esc_html($cta['title']); ?></a>
    <?php endif; ?>
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
        <section class="relative lg:py-[68px] py-[46px] pt-0 bg-white lg:pt-0">
            <div class="absolute h-[50%] w-full bg-black-darkgray-gradient bottom-0"></div>
            <div class="relative flex flex-col hadow-[0_0_40px_0_#00000029] rounded-[8px] overflow-hidden max-w-[1200px] sm:mx-auto mx-5">
                <div class="absolute top-0 left-0 right-0 bottom-0">
                    <img class="sm:hidden object-left-top object-cover w-full h-full" src="<?php echo esc_url($bg_image_mob); ?>" alt="">
                    <img class="hidden sm:block object-left-top object-cover w-full h-full" src="<?php echo esc_url($bg_image_desk); ?>" alt="">
                </div>
                <div class="flex flex-col justify-center sm:self-end md:w-[820px] sm:py-[80px] sm:px-[60px] px-[25px] pb-[60px] pt-[300px] relative z-[1]">
                    <p class="text-[40px] font-privacy font-bold italic leading-[42px] text-white text-left max-lg:hidden">
                    <?php echo wp_kses($title1, ''); ?>
                    </p>
                    <p class="text-[38px] font-privacy font-bold italic leading-[42px] text-white text-left lg:hidden mb-[20px]">
                        <?php echo $title1; ?>
                    </p>
                    <p class="text-[40px] font-privacy font-bold italic leading-[42px] text-[#E10A17] text-right max-lg:hidden">
                    <?php echo wp_kses($title2, ''); ?>
                    </p>
                    <p class="text-[38px] font-privacy font-bold italic leading-[42px] text-[#E10A17] lg:hidden">
                        <?php echo $title2; ?></p>
                    <div class="flex sm:flex-row flex-col sm:gap-1 gap-5 justify-center items-center mt-[30px]">
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
