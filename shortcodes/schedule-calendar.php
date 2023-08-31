<div class="schedule_calendar">
	<div class="schedule_header">
		<div class="container">
			<div class="title">
				<h1><?= get_the_title(); ?></h1>
			</div>

			<?php if( !empty( trim(  $shortcode_content ) ) ) { ?>
				<div class="subtitle">
					<?= $shortcode_content; ?>
				</div>
			<?php } ?>

			<div class="schedule_days">
				<?php for( $i = 0; $i < 7; $i++ ) { $day = strtotime("+" . $i ." day"); ?>
					<div class="item <?= $i == 0 ? 'active' : ''; ?>" data-id="<?= $i + 1; ?>">
						<div class="desktop">
							<div class="data">
								<?= date( 'd', $day ); ?>
							</div>
							<div class="month">
								<?= date( 'M', $day ); ?>
							</div>
							<div class="day">
								<?= ($i == 0) ? 'Today' : date( 'l', $day ); ?>
							</div>
						</div>

						<div class="mobile">
							<?= ($i == 0) ? 'Today' : date( 'l', $day ); ?>,
							<?= date( 'M', $day ); ?>
							<?= date( 'd', $day ); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="schedule_list">
		<div class="container">
			<?php for( $i = 0; $i < 7; $i++ ) { ?>
			<div class="item_list <?= $i == 0 ? 'active' : ''; ?>" data-id="<?= $i + 1; ?>">
				<?php
				$day = strtotime("+" . $i ." day");
				$events = GYM_SCHEDULE::getEventsForDay( date('Y-m-d', $day) );

				if( !count($events) ) { ?>
						<div class="not_found">
							Schedule list is empty!
						</div>
				<?php } else {

					foreach ( $events as $event ) {
						$start = tribe_get_start_time( $event->ID );
						$end = tribe_get_end_time( $event->ID );
						?>
						<div class="item" data-id="<?= $event->ID; ?>">
							<div class="block_1">
								<div class="time">
									<?= $start ?>
								</div>
								<div class="duration">
									<?= (strtotime( $end ) - strtotime( $start )) / 60; ?>
									minutes
								</div>
								<div class="title">
									<div class="name">
										<?= $event->post_title ?>
									</div>
									<div class="categories">
										<?php
										$categories = tribe_get_event_taxonomy( $event->ID, [] );
										$categories = str_replace( '</a>', ', </a>', $categories );
										$categories = strip_tags( $categories );
										$categories = trim( $categories );

										if (!empty( $categories )) echo substr($categories,0,-1);
										?>
									</div>
								</div>
							</div>
							<div class="block_2">
								<div class="left">
									<?php
									$e = tribe_get_event( $event->ID );
									$available = tribe_events_count_available_tickets( $e );
									if( $available >= 0 ) {
										echo $available . ' spots left';
									} else {
										echo 'unlimited';
									}
									?>
								</div>
								<div class="actions">
									<button type="button" class="book">
										Book
									</button>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
