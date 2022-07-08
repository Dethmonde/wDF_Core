<?php
/**
 * VideoLife Theme page
 *
 * @package videolife
 */

function videolife_about_admin_style( $hook ) {
	if ( 'appearance_page_videolife-about' === $hook ) {
		wp_enqueue_style( 'videolife-about-admin', get_theme_file_uri( 'assets/css/about-admin.css' ), null, '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'videolife_about_admin_style' );

/**
 * Add theme page
 */
function videolife_menu() {
	add_theme_page( esc_html__( 'About VideoLife', 'videolife' ), esc_html__( 'About VideoLife', 'videolife' ), 'edit_theme_options', 'videolife-about', 'videolife_about_display' );
}
add_action( 'admin_menu', 'videolife_menu' );

/**
 * Display About page
 */
function videolife_about_display() {
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$description = explode( '. ', $theme->get( 'Description' ) );

					array_pop( $description );

					$description = implode( '. ', $description );

					echo esc_html( $description . '.' );
				?></p>
				<p class="actions">
					<a href="<?php echo esc_url( $theme->get( 'ThemeURI' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Demo', 'videolife' ); ?></a>

					<a href="<?php echo esc_url( $theme->get( 'AuthorURI' ) . '/documentation/videolife' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Documentation', 'videolife' ); ?></a>

					<a href="<?php echo esc_url( $theme->get( 'AuthorURI' ) . '/themes' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'More Themes', 'videolife' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
			</div>

		</div>

	</div>
	<?php
}