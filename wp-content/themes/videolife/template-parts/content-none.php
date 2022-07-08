<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package videolife
 */

?>

<div class="no-results">

<div class="page-content">
	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'videolife' ); ?></p>

	<div class="widget">
	<?php
		get_search_form(); 
	?>
	</div><!-- .widget -->
	
	<p></p>
	
	<?php

		the_widget( 'WP_Widget_Recent_Posts' );

		// Only show the widget if site has multiple categories.
		if ( videolife_categorized_blog() ) :
	?>

	<div class="widget widget_categories">
		<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'videolife' ); ?></h2>
		<ul>
		<?php
			wp_list_categories( array(
				'orderby'    => 'count',
				'order'      => 'DESC',
				'show_count' => 1,
				'title_li'   => '',
				'number'     => 10,
			) );
		?>
		</ul>
	</div><!-- .widget -->

	<?php
		endif;

		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives.', 'videolife' ), convert_smilies( ':)' ) ) . '</p>';
		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
		echo '<p></p>';
		the_widget( 'WP_Widget_Tag_Cloud' );
	?>

</div><!-- .page-content -->

</div><!-- .no-results -->