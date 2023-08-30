<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>

<form name="checkout" method="post" data-node-type="commerce-checkout-form-container" class="checkout woocommerce-checkout checkout-page" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

	<div class="flex flex-col lg:flex-row justify-between items-start">
		<div class="max-w-[777px] w-full">
			<?php if ($checkout->get_checkout_fields()) : ?>

				<?php do_action('woocommerce_checkout_before_customer_details'); ?>

				<div id="customer_details" class="mb-[25px]">

					<?php do_action('woocommerce_checkout_billing'); ?>

					<?php do_action('woocommerce_checkout_shipping'); ?>

				</div>

				<?php do_action('woocommerce_checkout_after_customer_details'); ?>

			<?php endif; ?>

			<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

			<h3 class="checkout-item-title mb-[25px]" id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

			<?php do_action('woocommerce_checkout_before_order_review'); ?>

			<div class="woocommerce-checkout-review-order">
				<div class="border-[1px] border-black">
					<?php
					do_action('woocommerce_review_order_before_cart_contents');

					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
					?>
							<div class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> flex items-center justify-between">
								<div class="product-name flex items-center justify-between left-col">
									<span>
										<?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
									</span>
									<span>
										<?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?>
										<?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?>
									</span>
								</div>
								<div class="product-total right-col">
									<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?>
								</div>
							</div>
					<?php
						}
					}

					do_action('woocommerce_review_order_after_cart_contents');
					?>
					<div>
						<div class="cart-subtotal flex items-center justify-end">
							<div class="flex items-center justify-between left-col text-right"><?php esc_html_e('Subtotal:', 'woocommerce'); ?></div>
							<div class="right-col"><?php wc_cart_totals_subtotal_html(); ?></div>
						</div>
						<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
							<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> flex items-center justify-end">
								<div class="flex items-center justify-between left-col text-right"><?php wc_cart_totals_coupon_label($coupon); ?>:</div>
								<div class="right-col"><?php wc_cart_totals_coupon_html($coupon); ?></div>
							</div>
						<?php endforeach; ?>
						<!-- <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
							<?php do_action('woocommerce_review_order_before_shipping'); ?>

							<?php wc_cart_totals_shipping_html(); ?>

							<?php do_action('woocommerce_review_order_after_shipping'); ?>

						<?php endif; ?> -->
						<?php foreach (WC()->cart->get_fees() as $fee) : ?>
							<div class="fee flex items-center justify-end">
								<div class="flex items-center justify-between left-col text-right"><?php echo esc_html($fee->name); ?></div>
								<div class="right-col"><?php wc_cart_totals_fee_html($fee); ?></div>
							</div>
						<?php endforeach; ?>
						<?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
							<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
								<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
								?>
									<div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> flex items-center justify-end">
										<div class="flex items-center justify-between left-col text-right"><?php echo esc_html($tax->label); ?>:</div>
										<div class="right-col"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<div class="tax-total flex items-center justify-end">
									<div class="flex items-center justify-between left-col text-right"><?php echo esc_html(WC()->countries->tax_or_vat()); ?>:</div>
									<div class="right-col"><?php wc_cart_totals_taxes_total_html(); ?></div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<?php do_action('woocommerce_review_order_before_order_total'); ?>
						<div class="order-total flex items-center justify-end">
							<div class="flex items-center justify-between left-col text-right text-panther-red-100 font-bold"><?php esc_html_e('Total:', 'woocommerce'); ?></div>
							<div class="right-col [&>bdi]:text-panther-red-100 font-bold"><?php wc_cart_totals_order_total_html(); ?></div>
						</div>
						<?php do_action('woocommerce_review_order_after_order_total'); ?>
					</div>
				</div>
			</div>
			<?php do_action('woocommerce_checkout_after_order_review'); ?>
		</div>
		<div class="lg:max-w-[380px] w-full border-[1px] border-black pt-[43px] pb-[22px] px-[35px] mt-[25px] lg:mt-0">
			<h3 class="checkout-item-title mb-[30px] text-center uppercase"><?php esc_html_e('YOUR CART', 'text'); ?></h3>
			<ul class="flex flex-col gap-[4px] py-[23px] border-t-[1px] border-b-[1px] border-black">
				<li class="flex items-center justify-between font-privacy text-[16px] leading-[2]">
					<span><?php esc_html_e('Subtotal', 'woocommerce'); ?>:</span><span><?php wc_cart_totals_subtotal_html(); ?></span>
				</li>
				<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>

					<li class="flex items-center justify-between font-privacy text-[16px] leading-[2] coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
						<span><?php wc_cart_totals_coupon_label($coupon); ?>:</span><span><?php wc_cart_totals_coupon_html($coupon); ?></span>
					</li>
				<?php endforeach; ?>

				<?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
					<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
						<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
							<li class="flex items-center justify-between font-privacy text-[16px] leading-[2] tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
								<span><?php echo esc_html($tax->label); ?>:</span><span><?php echo wp_kses_post($tax->formatted_amount); ?></span>
							</li>
						<?php endforeach; ?>
					<?php else : ?>
						<li class="flex items-center justify-between font-privacy text-[16px] leading-[2]">
							<span><?php echo esc_html(WC()->countries->tax_or_vat()); ?>:</span><span><?php wc_cart_totals_taxes_total_html(); ?></span>
						</li>
					<?php endif; ?>
				<?php endif; ?>

			</ul>
			<div class="flex items-center justify-between font-privacy font-bold text-[16px] py-[9px] border-b-[1px] border-black leading-[2] order-total">
				<span><?php esc_html_e('Total:', 'woocommerce'); ?></span><span class="text-panther-red-100"><?php wc_cart_totals_order_total_html(); ?></span>
			</div>
			<?php woocommerce_checkout_payment(); ?>
			<a class="btn-transparent" href="<?php echo home_url('/shop');?>">Back to Shop</a>
			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
		</div>
	</div>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>