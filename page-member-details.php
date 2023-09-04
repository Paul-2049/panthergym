<?php
get_header();
?>
<?php
// get the user id from the querystring
$user_id = (!empty($_GET['id'])) ? $_GET['id'] : null;
$event_date = date('d/m/Y');

// tabs
$tabs = ['userdetails', 'checkins', 'qrcodescans', 'classes', 'wellness'];
$tab = (!empty($_GET['tab'])) ? strtolower($_GET['tab']) : null;
$tab = (in_array($tab, $tabs)) ? $tab : 'userdetails';

// set default values
$valid_membership = false;
$membership_title = null;
$membership_status = null;
$membership_type = null;

if ($user_id) {

    /**
     * If post booking, then update booking id status to paid
     */
    if (array_key_exists('booking', $_POST) && array_key_exists('booking_id', $_POST)) {
        $booking_id = intval($_POST['booking_id']);

        // check to make sure integer
        if (is_int($booking_id)) {

            // get the booking
            $booking = get_wc_booking($booking_id);
            $booking->update_status('paid');

            // redirect with confirmation
            header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '&tab=wellness&confirm-booking');
            exit;
        }
    }

    /**
     * Get Drop Ins Without Gear
     */
    $without_args = array(
        'post_type' => 'dropin',
        'numberposts' => -1,
        'order' => 'DESC',
        'orderby' => 'ID',
        'meta_query'    => array(
            'relation'      => 'AND',
            array('key' => 'user_id', 'value' => $user_id, 'compare' => '='),
            array('key' => 'drop_in_type', 'value' => 'withoutgear', 'compare' => '='),
            array(
                'relation'      => 'OR',
                array('key' => 'date_used', 'compare' => 'NOT EXISTS'),
                array('key' => 'date_used', 'value' => '', 'compare' => '=')
            ),
        ),
    );
    $dropins_without_gear = get_posts($without_args);

    /**
     * Get Drop Ins With Gear
     */
    $with_args = array(
        'post_type' => 'dropin',
        'numberposts' => -1,
        'order' => 'DESC',
        'orderby' => 'ID',
        'meta_query'    => array(
            'relation'      => 'AND',
            array('key' => 'user_id', 'value' => $user_id, 'compare' => '='),
            array('key' => 'drop_in_type', 'value' => 'withgear', 'compare' => '='),
            array(
                'relation'      => 'OR',
                array('key' => 'date_used', 'compare' => 'NOT EXISTS'),
                array('key' => 'date_used', 'value' => '', 'compare' => '=')
            ),
        ),
    );
    $dropins_with_gear = get_posts($with_args);

    /**
     * Check to make sure MemberPress is enabled
     * and get membership details
     */
    if (class_exists('MeprUtils')) {

        $mepr_user = new MeprUser($user_id);
        $active_transactions = $mepr_user->active_product_subscriptions('transactions');

        // if subscriptions, then show
        if (!empty($active_transactions)) {

            //get the first transaction
            $txn = $active_transactions[0];
            $subscription = $txn->subscription();
            $product = $txn->product();

            // if there is a subscription, make sure it is active
            if ($subscription) {
                $valid_membership = true;
                $membership_title = $product->post_title;
                $membership_status = $subscription->status;
                $membership_type = $product->post_name;
            }
        }
    } else {

        echo 'Please enable MemberPress';
    }

    // update user meta for qr code scanned
    $scans = get_user_meta($user_id, 'qr_code_scans', true);
    if (!is_array($scans)) $scans = array();     // if not an array, it is empty, then initialize with a blank array
    array_unshift($scans, date("Y-m-d H:i:s"));   // add to the top of the array
    $updated = update_user_meta($user_id, 'qr_code_scans', $scans);

    // get check-ins
    $checkins = get_user_meta($user_id, 'check_ins', true);

    // determine if checked in
    if (is_array($checkins)) {
        $checkin_date = date_create($checkins[0])->format('Y-m-d');
        $today = date_create()->format('Y-m-d');
        $checked_in_today = ($checkin_date === $today) ? true : false;
    } else {
        $checked_in_today = false;
    }

    /**
     * determine if drop in has been used
     */
    $used_args = array(
        'post_type' => 'dropin',
        'numberposts' => -1,
        'order' => 'ASC',
        'orderby' => 'ID',
        'meta_query'    => array(
            'relation'      => 'AND',
            array('key' => 'user_id', 'value' => $user_id, 'compare' => '='),
            array('key' => 'date_used', 'compare' => '=', 'value' => $event_date),
        ),
    );
    $used_dropins = get_posts($used_args);
    $drop_in_used_this_date = (count($used_dropins)) ? true : false;
}
$current_logged_in_user = wp_get_current_user();
?>
<style>
    div.navbar,
    div.is--footer,
    div#wpadminbar {
        display: none;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-timezone@0.5.40/moment-timezone.min.js"></script>
<script>
    moment.tz.add("America/Edmonton|LMT MST MDT MWT MPT|7x.Q 70 60 60 60|0121212121212134121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121212121|-2yd4q.8 shdq.8 1in0 17d0 hz0 2dB0 1fz0 1a10 11z0 1qN0 WL0 1qN0 11z0 IGN0 8x20 ix0 3NB0 11z0 XQp0 1cL0 1cN0 1cL0 1cN0 1cL0 1cN0 1cL0 1cN0 1fz0 1a10 1fz0 1cN0 1cL0 1cN0 1cL0 1cN0 1cL0 1cN0 1cL0 1cN0 1fz0 1a10 1fz0 1cN0 1cL0 1cN0 1cL0 1cN0 1cL0 14p0 1lb0 14p0 1nX0 11B0 1nX0 11B0 1nX0 14p0 1lb0 14p0 1lb0 14p0 1nX0 11B0 1nX0 11B0 1nX0 14p0 1lb0 14p0 1lb0 14p0 1lb0 14p0 1nX0 11B0 1nX0 11B0 1nX0 14p0 1lb0 14p0 1lb0 14p0 1nX0 11B0 1nX0 11B0 1nX0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Rd0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0 Op0 1zb0|10e5")
</script>
<div class="working hidden">Updating ...</div>
<script>
    /**
     * Use Drop-In
     */
    function doDropInCheckInAjax(evt, user_id, dropin_type, date_used) {
        // enable working overlay
        $('.working').removeClass('hidden');
        // set ajax values
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        const $container = $(evt.currentTarget);
        /**
         * Use Drop In
         */
        const dropintype_settings = {};
        dropintype_settings['action'] = 'panther_gym_use_dropin';
        dropintype_settings['user_id'] = user_id;
        dropintype_settings['dropin_type'] = dropin_type;
        dropintype_settings['date_used'] = date_used;
        let jqxhrDropInUse = jQuery.ajax({
            url: ajaxurl,
            data: dropintype_settings,
            type: 'POST'
        });
        // on success do checkin
        jqxhrDropInUse.success(function(dropInReturnData) {
            if (dropInReturnData.success) {
                doCheckIn(user_id);
            }
        });
    }

    /**
     * Check-In
     */
    function doCheckIn(user_id) {
        // enable working overlay
        $('.working').removeClass('hidden');
        // set ajax values
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        /**
         * Do Check-In
         */
        const checkin_settings = {};
        checkin_settings['action'] = 'panther_gym_checkin_user';
        checkin_settings['user_id'] = user_id;
        let jqxhrCheckIn = jQuery.ajax({
            url: ajaxurl,
            data: checkin_settings,
            type: 'POST'
        });
        // on success remove working div and show message
        jqxhrCheckIn.success(function(checkInReturnData) {
            if (checkInReturnData.success) {
                window.location.replace("<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '&confirmation=checkin_complete'; ?>");
            }
        });
    }
    /**
     * Do Booking
     */
    function doBookingOnlyAjax(evt, ticket_id, form_id, type) {
        // enable working overlay
        $('.working').removeClass('hidden');
        // set button values
        let button_values = new Array();
        button_values['book'] = 'Booked';
        button_values['cancel'] = 'Cancelled';
        // set ajax values
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        const $container = $(evt.currentTarget);
        const $book_button = $('#ticket-book-now-' + ticket_id);
        const $form = $(form_id);
        const params = $form.serializeArray();
        const settings = {};
        $(params).each(function(index, object) {
            settings[object.name] = object.value;
        });
        console.log('$form', $form);
        console.log('settings', settings);
        /**
         * Do ajax request
         */
        let jqxhr = jQuery.ajax({
            url: ajaxurl,
            data: settings,
            type: 'POST'
        });
        /**
         * what to do on success
         */
        jqxhr.success(function(data) {
            if (data.success) {
                // set button on page
                $book_button.html(button_values[type]);
                $book_button.attr('disabled', 'disabled');
                $book_button.addClass('disabled');
                $book_button.addClass('booked');
                // hide open lightbox and change button text
                $book_button.parent().find('.already-registered').remove();
                $('.working').addClass('hidden');
            }
        });
    }
</script>

<section class="bg-black h-[130px] md:h-[177px]">
</section>
<div class="w-full mx-auto pt-[30px] lg:px-[15px] px-[29px] max-w-[1470px] flex flex-col md:flex-row items-start md:items-center justify-start md:justify-between gap-[20px] mb-[30px] md:mb-[50px]">
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
<section class="w-full mx-auto lg:px-[15px] px-[29px] max-w-[1110px] mb-[40px] md:mb-[83px]">
    <form action="<?php echo get_permalink(9694); ?>" method="get" class="search-form w-full flex items-center justify-start flex-col md:flex-row mb-[25px] md:mb-[53px]">
        <span class="w-full h-[57px] border-t-[1px] border-l-[1px] border-b-[1px] border-r-[1px] md:border-r-0 border-black rounded-[2px] pl-[35px] md:pl-[60px] flex items-center before:bg-search-icon before:bg-no-repeat before:bg-center before:w-[19px] before:h-[19px] relative before:absolute before:left-[10px] md:before:left-[22px]">
            <input class="inputfield w-full h-full text-[16px] leading-[1.5] font-privacy placeholder:text-panther-white-300 " type="text" name="search_details" value="" placeholder="Search for a member" autocomplete="off">
        </span>
        <input type="submit" value="View member" class="btn-clip-none w-full md:max-w-[217px]">
    </form>
</section>

<section class="member-details-section max-w-[919px] w-full mx-auto pb-[80px] lg:pb-[193px]">
    <h1 class="leading-[1.1] font-bold text-center text-[32px] md:text-[40px] uppercase mb-[20px] md:mb-[40px] text-black"><?php echo get_the_title(); ?></h1>
    <?php
    // continue as long as there is an id
    if ($user_id) {

        // ensure valid user
        $user = get_userdata($user_id);
        if ($user) {
    ?>
            <div class="w3-container">

                <div class="w3-bar w3-black">
                    <button class="w3-bar-item w3-button tablink <?php if ('userdetails' === $tab) echo 'w3-active'; ?>" onclick="openTab(event,'UserDetails')">Member Details</button>
                    <button class="w3-bar-item w3-button tablink <?php if ('checkins' === $tab) echo 'w3-active'; ?>" onclick="openTab(event,'CheckIns')">Check-Ins</button>
                    <button class="w3-bar-item w3-button tablink <?php if ('qrcodescans' === $tab) echo 'w3-active'; ?>" onclick="openTab(event,'QRCodeScans')">QR Code Scans</button>
                    <button class="w3-bar-item w3-button tablink <?php if ('classes' === $tab) echo 'w3-active'; ?>" onclick="openTab(event,'Classes')">Classes</button>
                    <button class="w3-bar-item w3-button tablink <?php if ('wellness' === $tab) echo 'w3-active'; ?>" onclick="openTab(event,'Wellness')">Wellness Services</button>
                </div>

                <!-- User Details -->
                <div id="UserDetails" class="w3-container w3-border tab" <?php if ('userdetails' !== $tab) echo 'style="display:none"'; ?>>
                    <div class="font-privacy text-[16px] leading-[1.1] flex flex-col md:flex-row items-center justify-center gap-[45px] md:gap-[97px] pt-[25px] md:pt-[58px] pb-[40px] md:pb-[88px] px-[15px]">
                        <div class="avatar">
                            <?php echo do_shortcode('[avatar user="' . $user_id . '"]'); ?>
                        </div>
                        <div>
                            <div class="flex items-center gap-[31px] flex-wrap mb-[15px] md:mb-[32px]">
                                <div class="w-[88px] h-[88px]">
                                    <?php echo do_shortcode('[mepr-show if="loggedin"][kaya_qrcode_dynamic title_align="aligncenter" ecclevel="L" align="aligncenter" css_shadow="1"]https://panthergym.com/staging/member-details/?id=[mepr-account-info field="' . $user_id . '"][/kaya_qrcode_dynamic][/mepr-show]'); ?>
                                </div>
                                <div class="">
                                    <p class="name text-[20px] font-bold mb-[10px]"><?php echo $user->data->display_name; ?></p>
                                    <p><?php echo $user->data->user_email; ?></p>
                                </div>
                            </div>

                            <ul class="max-w-[500px] w-full">
                                <li class="flex items-center justify-start">
                                    <?php if ($valid_membership) : ?>
                                        <span class="font-bold py-[10px] min-w-[210px]">Membership:</span>
                                        <span class="text-panther-red-100 py-[10px] type"><?php echo $membership_title; ?></span>
                                    <?php else : ?>
                                        <span class="font-bold py-[10px] min-w-[210px]">No active subscriptions found.</span>
                                    <?php endif ?>
                                </li>

                                <li class="flex items-center justify-start">
                                    <?php if ($valid_membership) : ?>
                                        <span class="font-bold py-[10px] min-w-[210px]">Membership status:</span>
                                        <span class="text-panther-red-100 py-[10px]"><?php echo $membership_status; ?></span>
                                    <?php else : ?>
                                        <span class="font-bold py-[10px] min-w-[210px]">No active subscriptions found.</span>
                                    <?php endif ?>
                                </li>
                                <?php if ($valid_membership && 'free-membership' === $membership_type) : ?>
                                    <li class="flex items-center justify-start">
                                        <span class="font-bold py-[10px] min-w-[210px]">Without gear:</span>
                                        <span class="text-panther-red-100 py-[10px]"><?php echo count($dropins_without_gear); ?></span>
                                        With gear: <?php echo count($dropins_with_gear); ?>
                                    </li>
                                    <li class="flex items-center justify-start">
                                        <span class="font-bold py-[10px] min-w-[210px]">With gear:</span>
                                        <span class="text-panther-red-100 py-[10px]"><?php echo count($dropins_with_gear); ?></span>
                                    </li>
                                <?php endif; ?>
                                <li class="flex items-center justify-start">
                                    <span class="font-bold py-[10px] min-w-[210px]">Last check-ins:</span>
                                    <?php if (is_array($checkins)) : ?>
                                        <span class="py-[10px]">
                                            <script>
                                                var checkin = moment.utc("<?php echo $checkins[0]; ?>", "YYYY-MM-DD HH:mm:ss").tz("America/Edmonton");
                                                document.write(checkin.format("MMMM Do YYYY, h:mm:ss a")); // without day
                                            </script>
                                        </span>
                                    <?php else : ?>
                                        <span class="py-[10px]">No Check-Ins Found</span>
                                    <?php endif; ?>
                                </li>
                                <li class="flex items-center justify-start">
                                    <span class="font-bold  py-[10px] min-w-[210px]">Last QR Code Scan:</span>
                                    <span class="py-[10px]">
                                        <script>
                                            var scan = moment.utc("<?php echo $scans[0]; ?>", "YYYY-MM-DD HH:mm:ss").tz("America/Edmonton");
                                            document.write(scan.format("MMMM Do YYYY, h:mm:ss a")); // without day
                                        </script>
                                    </span>
                                </li>
                            </ul>


                        </div>
                    </div>
                </div>
                <!-- /User Details -->

                <!-- Check-Ins -->
                <div id="CheckIns" class="w3-container w3-border tab" <?php if ('checkins' !== $tab) echo 'style="display:none"'; ?>>
                    <h2>Check-Ins</h2>
                    <?php if (is_array($checkins)) : ?>
                        <ul style="margin-bottom: 50px; height: 300px; overflow-y: scroll;">
                            <?php
                            foreach ($checkins as $key => $checkin) {
                            ?>
                                <li>
                                    <script>
                                        var checkin = moment.utc("<?php echo $checkin; ?>", "YYYY-MM-DD HH:mm:ss").tz("America/Edmonton");
                                        //document.write( checkin.format("dddd, MMMM Do YYYY, h:mm:ss a") );  // includes day
                                        document.write(checkin.format("MMMM Do YYYY, h:mm:ss a")); // without day
                                    </script>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php else : ?>
                        No Check-Ins Found
                    <?php endif; ?>
                </div>
                <!-- /Check-Ins -->

                <!-- QR Code Scans -->
                <div id="QRCodeScans" class="w3-container w3-border tab" <?php if ('qrcodescans' !== $tab) echo 'style="display:none"'; ?>>
                    <div class="pt-[30px] px-[15px] md:px-[26px] min-h-[520px]">
                        <ul class="tabs-nav flex justify-between gap-[23px] overflow-x-auto overflow-y-hidden">
                            <li class="active tab-item" data-tab-target="#tab-January">January</li>
                            <li class="tab-item" data-tab-target="#tab-February">February</li>
                            <li class="tab-item" data-tab-target="#tab-March">March</li>
                            <li class="tab-item" data-tab-target="#tab-April">April</li>
                            <li class="tab-item" data-tab-target="#tab-May">May</li>
                            <li class="tab-item" data-tab-target="#tab-June">June</li>
                            <li class="tab-item" data-tab-target="#tab-Jule">Jule</li>
                            <li class="tab-item" data-tab-target="#tab-August">August</li>
                            <li class="tab-item" data-tab-target="#tab-September">September</li>
                            <li class="tab-item" data-tab-target="#tab-October">October</li>
                            <li class="tab-item" data-tab-target="#tab-November">November</li>
                            <li class="tab-item" data-tab-target="#tab-December">December</li>
                        </ul>
                        <?php
                        sort($scans);

                        $currentMonth = null;
                        $i = 0;
                        foreach ($scans as $key => $scan) {
                            $i++;
                            if($i==1){
                                $class = 'active';
                            }else{
                                $class = '';
                            }
                            $scanDate = new DateTime($scan);
                            $month = $scanDate->format("F");
                            if ($month !== $currentMonth) {
                                if ($currentMonth !== null) {
                                    echo "</div></div>";
                                }
                                echo "<div class='$class tabs-content max-w-[625px] w-full mx-auto mt-[25px] md:mt-[47px]' data-tab-content id='tab-$month'> <p class='text-[24px] font-bold leading-[1.1] text-right mb-[25px] md:mb-[47px]'>$month</p><div class='grid grid-cols-4 gap-[25px] md:grid-cols-7 lg:gap-[50px]'>";
                                $currentMonth = $month;
                            }
                            echo "<div class='text-center'>";
                            echo "<p class='text-panther-red-100 font-bold text-[32px] leading-[1.1]'>  <script>
                            var scan = moment.utc('$scan', 'YYYY-MM-DD HH:mm:ss').tz('America/Edmonton');
                            document.write(scan.format('DD'));
                        </script></p>";
                            echo "<p class='text-black font-privacy font-bold uppercase leading-[1]'>  <script>
                            var scan = moment.utc('$scan', 'YYYY-MM-DD HH:mm:ss').tz('America/Edmonton');
                            document.write(scan.format(`hh:mm <br/> a`));
                        </script></p>";
                            echo "</div>";
                        }
                        if ($currentMonth !== null) {
                            echo "</div></div>";
                        }
                        ?>

                    </div>
                </div>
                <!-- /QR Code Scans -->

                <!-- Classes -->
                <div id="Classes" class="w3-container w3-border tab" <?php if ('classes' !== $tab) echo 'style="display:none"'; ?>>
                    <h2>Classes</h2>
                    <!-- Schedule -->
                    <div class="schedule-list-wrapper">
                        <?php include('partials/member-details/classes/schedule.php'); ?>
                    </div>
                </div>
                <!-- /Classes -->

                <!-- Wellness Services -->
                <div id="Wellness" class="w3-container w3-border tab" <?php if ('wellness' !== $tab) echo 'style="display:none"'; ?>>

                    <h2>Wellness Services</h2>

                    <!-- Show COnfirmation box booking -->
                    <?php if (array_key_exists('confirm-booking', $_GET)) : ?>
                        <div class="section" style="padding: 0;">
                            <div class="container--1248 confirmation" style="width: 100%;">
                                <div>Wellness Service marked as Paid</div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    $orders = wc_get_orders(array(
                        'customer' => $user->data->user_email,
                        'status' => array('wc-completed'),
                    ));
                    // var_export($orders);

                    $booking_data = new WC_Booking_Data_Store();
                    $bookings  = $booking_data::get_bookings_for_user($user_id, ['date_after' => time(), 'order_by' => 'start_date', 'order' => 'ASC']);

                    foreach ($bookings as $customer_booking) :

                        // get booking and product and resource
                        $booking = get_wc_booking($customer_booking->id);
                        $product = wc_get_product($booking->product_id);
                        $resource = get_post($booking->resource_id);

                        // get product details
                    ?>
                        <div class="individual-wellness-service" style="margin-top: 30px;">
                            <h3><?php echo $product->get_name(); ?></h3>

                            <div>
                                Date: <?php echo date("Y-m-d \a\\t h:i a", $booking->start) . ' - ' . date("h:i a", $booking->end); ?>
                            </div>

                            <div class="status status-<?php echo $booking->status; ?>">
                                Status: <?php echo ucfirst($booking->status); ?>
                            </div>

                            <div>
                                Resource: <?php echo $resource->post_title; ?>
                            </div>

                            <?php
                            if ('confirmed' === $booking->status) {
                                // button to mark as paid
                            ?>
                                <form action="" method="post">
                                    <input type="hidden" name="booking" value="true">
                                    <input type="hidden" name="booking_id" value="<?php echo $customer_booking->id; ?>">
                                    <input type="submit" value="Mark as Paid" style="background: darkgreen; padding: 5px 15px; color: white; margin-top: 10px; display: inline-block; width: 200px;">
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    endforeach;

                    if (empty($bookings)) :
                        echo 'No Wellness Services Booked.';
                    endif;
                    ?>
                </div>
                <!-- /Wellness Services -->
            </div>

            <script>
                function openTab(evt, cityName) {
                    var i, x, tablinks;
                    x = document.getElementsByClassName("tab");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < x.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" w3-active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " w3-active";
                }
            </script>


    <?php

        } else {

            // not a user so set user_id to null
            $user_id = null;
        }
    }

    if (!$valid_membership && $user_id) {
        echo '<div class="not-valid-user">No Membership(s) found</div>';
    }

    ?>
    <!-- </div>
</div> -->
</section>


<?php
get_footer();
?>