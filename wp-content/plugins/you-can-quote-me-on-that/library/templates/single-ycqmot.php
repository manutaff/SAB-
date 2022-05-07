<?php
/**
 * The template for displaying all single You can quote me on that sliders.
 *
 * @package You can quote me on that
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
//  			$custom_fields = get_post_custom($queried_object->ID);
//  			$you_can_quote_me_on_that_speed = $custom_fields["you_can_quote_me_on_that_speed"][0];
//  			echo $you_can_quote_me_on_that_speed;
			
			if ( $queried_object ) {
				echo do_shortcode('[ycqmot id="' .$queried_object->ID. '"]');
			}
			?>		

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
