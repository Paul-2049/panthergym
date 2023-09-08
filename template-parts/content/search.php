<section class="search-section px-[30px] bg-white lg:pb-[90px] lg:pt-[137px] pb-[52px] pt-[110px]">
	<h1>
		<?php echo __( 'Search results', 'text' ); ?>
	</h1>
	<div class="w-full [&amp;>*]:mb-[15px] font-privacy leading-[1.5] md:text-[18px] text-[15px] text-left">
		<form action="<?php echo home_url( '' ); ?>"
			  class="search--form is--search-page w-form"
			  method="get"
			  role="search">
			<span class="dashicons dashicons-search"></span>
			<input type="search"
				   class="text-field w-input"
				   maxlength="256"
				   name="s"
				   placeholder="Search…"
				   id="search"
				   value="<?= $_GET['s'] ?? '' ?>"
				   required="">
			<input type="submit"
				   value="Search"
				   class="w-button">
		</form>

		<?php
		global $wp_query;
		$total_results = $wp_query->found_posts;

		if( is_search() ) : ?>
			<div data-node-type="search-result-wrapper"><?php
				if( $total_results > 0 ) : ?>
					<div data-node-type="search-result-list" class="search--grid"><?php
						while( have_posts() ) : the_post(); ?>
							<div data-node-type="search-result-item">
								<a data-node-type="link"
								   class="heading--24 is--link"
								   href="<?php the_permalink(); ?>">
									<?php the_title() ?>
								</a>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif ?>

				<?php
				if( $total_results == 0 ) : ?>
					<div data-node-type="search-result-empty">
						<div data-node-type="block">No matching results.</div>
					</div>
				<?php endif ?>
			</div>
		<?php endif ?>
	</div>
</section>

