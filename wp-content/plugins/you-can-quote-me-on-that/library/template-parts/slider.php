<?php
if ( get_post_status( $id ) != 'publish' || get_post_type( $id ) != 'ycqmot' ) {
	return;
}

$slides = get_post_meta( $id, 'you-can-quote-me-on-that-slide-settings-group', true );

$settings = $this->settings['fields'];
$slider_settings = array();

foreach ( $settings as $name => $config ) {
	$slider_settings[$name] = $this->sanitize_field( get_post_meta( $id, $name, true ), $config['type'] );
}

	if ( $slides ) :
		$slideshow 		 = $slider_settings['you_can_quote_me_on_that_slideshow'];
		$slideshow_speed = $slider_settings['you_can_quote_me_on_that_slideshow_speed'];

		$container_classes = array();
		
		$quote_font_color 	   = $slider_settings['you_can_quote_me_on_that_quote_font_color'];
		$button_color 	  	   = $slider_settings['you_can_quote_me_on_that_navigation_button_color'];
		$button_rollover_color = $slider_settings['you_can_quote_me_on_that_navigation_button_rollover_color'];

		$slider_id = uniqid();
?>

		<div id="you-can-quote-me-on-that-<?php echo $slider_id ?>" class="you-can-quote-me-on-that-container you-can-quote-me-on-that-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( implode( ' ', $container_classes ) ); ?> loading">
		
			<ul class="you-can-quote-me-on-that">

				<?php
				foreach ( $slides as $slide ) :
					$opacity_classes = array();
				?>

					<li class="slide">
			            <?php
			            $text  	 = trim( $slide['you_can_quote_me_on_that_slide_quote'] );
			            $name  	 = trim( $slide['you_can_quote_me_on_that_slide_name'] );
			            $title 	 = trim( $slide['you_can_quote_me_on_that_slide_title'] );
			            $company = trim( $slide['you_can_quote_me_on_that_slide_company'] );
			            
			            if ( !empty( $text ) || !empty( $name ) ) {
			            ?>
							<?php
							if ( !empty( $text ) ) {
							?>
							<div class="quote <?php echo empty( $title ) ? 'no-title' : ''; ?>" style="color: <?php echo $quote_font_color; ?>;">
								<?php echo esc_html_e( $text ); ?>
							</div>
							<?php
							}
							?>

							<?php
							if ( !empty( $name ) ) {
							?>
								<div class="name"><?php esc_html_e( $name ); ?></div>
								
								<?php
								if ( !empty( $title ) || !empty( $company ) ) {
								?>
								<div class="credentials">
									<?php if ( !empty( $title ) ) { ?><span clas="title"><?php esc_html_e( $title ); ?></span><?php } ?><?php if ( !empty( $title ) && !empty( $company ) ) { ?>, <?php } ?><?php if ( !empty( $company ) ) { ?><span class="company"><?php esc_html_e( $company ); ?></span><?php } ?>
								</div>
								<?php
								}
								?>
							<?php
							}
							?>
						<?php 
						}
						?>
					</li>

				<?php endforeach; ?>
				
			</ul>
			
			<div class="controls-container">
				<div class="controls">
					<div class="prev" style="background-color: <?php echo $button_color; ?>;">
						<i class="ycqmot-fa ycqmot-fa-angle-left"></i>
						<div class="rollover" style="background-color: <?php echo $button_rollover_color; ?>;"></div>
					</div>
					<div class="next" style="background-color: <?php echo $button_color; ?>;">
						<i class="ycqmot-fa ycqmot-fa-angle-right"></i>
						<div class="rollover" style="background-color: <?php echo $button_rollover_color; ?>;"></div>
					</div>
				</div>
			</div>
			
		</div>
		
		<script type="text/javascript">
			jQuery(window).on('load', function() {
				new YouCanQuoteMeOnThat( '#you-can-quote-me-on-that-<?php echo $slider_id; ?>', {
					speed: <?php echo $slider_settings['you_can_quote_me_on_that_speed']; ?>,
					slideshow: <?php echo $slideshow; ?>,
					slideshowSpeed: <?php echo $slideshow_speed; ?>
				})
			});
		</script>

	<?php else : ?>

		<div class="placeholder">
			<?php esc_html_e( 'Invalid Shortcode ID,', 'you-can-quote-me-on-that' ); ?> <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=ycqmot' ) ); ?>" target="_blank"><?php esc_html_e( 'Create a new Slider', 'you-can-quote-me-on-that' ); ?></a>
		</div>
	
	<?php endif; ?>
