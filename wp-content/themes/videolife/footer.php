<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package videolife
 */

?>
	</div><!-- .clear -->

	<?php

		if ( is_single() ) :

		// Get the taxonomy terms of the current page for the specified taxonomy.
		$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

		// Bail if the term empty.
		if ( empty( $terms ) ) {
			return;
		}

		// Posts query arguments.
		$query = array(
			'post__not_in' => array( get_the_ID() ),
			'tax_query'    => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $terms,
					'operator' => 'IN'
				)
			),
			'posts_per_page' => 10,
			'post_type'      => 'post',
		);

		// Allow dev to filter the query.
		$args = apply_filters( 'videolife_related_posts_args', $query );

		// The post query
		$related = new WP_Query( $args );

		if ( $related->have_posts() ) : ?>

			<div class="post-bottom-related content-loop clear">

				<h3><?php esc_html_e( 'You might like', 'videolife' ); ?></h3>

				<div class="related-loop clear">

				<?php while ( $related->have_posts() ) : $related->the_post(); ?>

					<?php get_template_part('template-parts/content', 'loop'); ?>

				<?php endwhile; ?>

				</div><!-- .related-loop -->

			</div><!-- .post-bottom-related -->

		<?php 
			endif;
			// Restore original Post Data.
			wp_reset_postdata();

			endif; // end if single
		?>

	</div><!-- #content .site-content -->
	
	<footer id="colophon" class="site-footer">

		<?php if ( is_active_sidebar( 'footer' ) ) { ?>

			<div class="footer-columns clear">
	
				<div class="container clear">

					<div class="footer-columns-wrap">

						<?php dynamic_sidebar( 'footer' ); ?>															

					</div>

				</div><!-- .container -->

			</div><!-- .footer-columns -->

		<?php } ?>
				
	</footer><!-- #colophon -->

	<div id="site-bottom" class="clear">
		
		<div class="container">

			<div class="site-info">

				<?php
					$videolife_theme = wp_get_theme();
				?>

				&copy; <?php echo esc_html( date("o") ); ?> <?php echo esc_html( get_bloginfo('name') ); ?> - <a href="<?php echo esc_url( $videolife_theme->get( 'AuthorURI' ) ); ?>"><?php esc_html_e('WordPress Theme', 'videolife'); ?></a> <?php esc_html_e('by', 'videolife'); ?> <a href="<?php echo esc_url( $videolife_theme->get( 'AuthorURI' ) ); ?>"><?php esc_html_e('WPEnjoy', 'videolife'); ?></a>

			</div><!-- .site-info -->

			<?php 
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'footer-nav' ) );
				}
			?>	

		</div><!-- .container -->

	</div><!-- #site-bottom -->

</div><!-- #page -->

<div id="back-top">
	<a href="#top" title="<?php esc_attr_e('Back to top', 'videolife'); ?>"><span class="genericon genericon-collapse"></span></a>
</div>

<?php wp_footer(); ?>

</body>
</html>
