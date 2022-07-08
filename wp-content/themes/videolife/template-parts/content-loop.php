<?php
	$grid_class;
	if ( is_single() ) {
		$grid_class = 'ht_grid_1_5';
	} else {
		$grid_class = 'ht_grid_1_4';
	}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $grid_class ); ?>>	

	<?php if ( has_post_thumbnail() ) { ?>
		<a class="thumbnail-link" href="<?php the_permalink(); ?>">
			<div class="thumbnail-wrap">
				<?php 
					the_post_thumbnail('videolife_post_thumb'); 
				?>
			</div><!-- .thumbnail-wrap -->
			<?php if( (videolife_has_embed_code() || videolife_has_embed()) ) { ?>
				<div class="icon-play"><i class="genericon genericon-play"></i></div>
			<?php } ?>
		</a>
	<?php } ?>	

	<div class="entry-header">

		<?php if (!is_category() && !is_single()) : ?>
			<div class="entry-category"><?php videolife_first_category(); ?></div>
		<?php endif; ?>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="entry-meta">
			<?php 
				if ( function_exists( 'pvc_get_post_views' ) ) :
				$post_id = (int) ( empty( $post_id ) ? get_the_ID() : $post_id );
				$views = pvc_get_post_views( $post_id );
			?>
				<span class="entry-views">
					<?php echo videolife_custom_number_format($views) . ' ' . esc_html('views', 'videolife'); ?>
				</span>

				<span class="sep">&middot;</span>		

			<?php
				endif;
			?>	

			<span class="entry-date"><?php echo esc_html( human_time_diff(get_the_time('U'), current_time('timestamp')) ) . ' '.  esc_html( 'ago', 'videolife' ); ?></span>
		</div><!-- .entry-meta -->		
									
	</div><!-- .entry-header -->

</div><!-- #post-<?php the_ID(); ?> -->