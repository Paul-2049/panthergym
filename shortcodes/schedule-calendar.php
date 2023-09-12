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
						<div class="not_found font-privacy">
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
									$available = tribe_events_count_available_tickets( $event );
									if( $available >= 0 ) {
										echo $available . ' spots left';
									} else {
										echo 'unlimited';
									}
									?>
								</div>
								<div class="actions">
									<button type="button"
											class="book booking_shedule"
											data-id="<?= $event->ID ?>"
											data-date="<?= date('Y-m-d', $day) ?>"
											data-time="<?= $start ?> - <?= $end ?>"
											data-duration="<?= (strtotime( $end ) - strtotime( $start )) / 60; ?> minutes"
											data-title="<?= $event->post_title ?>"
											data-description="<?= $event->post_content ?>"
											data-location="<?= tribe_get_venue( $event->ID ) ?? "&mdash;"; ?>"
											data-intensity="<?= get_field( 'event_intensity', $event->ID ) ?? "&mdash;" ?>"
											data-instructors="<?php
												$organizer_ids = tribe_get_organizer_ids( $event->ID );
												$organizers = [];
												if( !empty( $organizer_ids ) ) foreach( $organizer_ids as $id ) {
													$organizers[] = tribe_get_organizer_object( $id )->post_title;
													echo implode(', ', $organizers);
												} else {
													echo "&mdash;";
												}

											?>"
											data-categories="<?php if (!empty( $categories )) echo substr($categories,0,-1); else echo "&mdash;"; ?>"
									>
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
