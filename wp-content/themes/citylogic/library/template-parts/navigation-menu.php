<?php
global $is_navigation_menu_transparent;

if ( get_theme_mod( 'citylogic-navigation-menu-uppercase', customizer_library_get_default( 'citylogic-navigation-menu-uppercase' ) ) ) {
	$navigation_menu_classes[] = 'uppercase';
}

$navigation_menu_classes[] = get_theme_mod( 'citylogic-navigation-menu-alignment', customizer_library_get_default( 'citylogic-navigation-menu-alignment' ) );
$navigation_menu_classes[] = get_theme_mod( 'citylogic-navigation-menu-rollover-style', customizer_library_get_default( 'citylogic-navigation-menu-rollover-style' ) );

$alignment = get_theme_mod( 'citylogic-navigation-menu-alignment', customizer_library_get_default( 'citylogic-navigation-menu-alignment' ) );

if ( function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'primary' ) ) {
?>
<nav id="site-navigation" class="main-navigation-mega-menu" style="background: linear-gradient(to bottom, <?php echo( mmm_get_theme_for_location('primary')['container_background_from'] ); ?>, <?php echo( mmm_get_theme_for_location('primary')['container_background_to'] ); ?>);" role="navigation">
	<div id="main-menu" class="main-menu-container">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</div>
</nav><!-- #site-navigation -->
<?php 
} else {
?>
<nav id="site-navigation" class="main-navigation centered-submenu <?php echo esc_attr( implode( ' ', $navigation_menu_classes ) ); ?> <?php echo( $alignment == 'left-aligned' ? 'border-bottom' : '' ); ?> <?php echo ( $is_navigation_menu_transparent && $alignment == 'left-aligned' ) ? 'transparent' : ''; ?>" role="navigation">
	<span class="header-menu-button" aria-expanded="false"><i class="otb-fa otb-fa-bars"></i></span>
	<div id="main-menu" class="main-menu-container">
		<div class="main-menu-close"><i class="otb-fa otb-fa-angle-right"></i><i class="otb-fa otb-fa-angle-left"></i></div>
		<div class="main-navigation-inner">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</div>
        
		<div class="search-slidedown">
			<div class="container">
				<div class="padder">
					<div class="search-block">
					<?php
					if( get_theme_mod( 'citylogic-navigation-menu-search-button', customizer_library_get_default( 'citylogic-navigation-menu-search-button' ) ) && get_theme_mod( 'citylogic-navigation-menu-search-type', customizer_library_get_default( 'citylogic-navigation-menu-search-type' ) ) == 'default' ) :
						get_search_form();
					endif;
					?>
					</div>
				</div>
			</div>
		</div>
        
	</div>
</nav><!-- #site-navigation -->
<?php 
}
