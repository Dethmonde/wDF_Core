<?php
/**
 * Block Styles
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 */
	function videolife_register_block_styles() {
		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'videolife-border',
				'label' => esc_html__( 'Borders', 'videolife' ),
			)
		);
	}
	add_action( 'init', 'videolife_register_block_styles' );
}
