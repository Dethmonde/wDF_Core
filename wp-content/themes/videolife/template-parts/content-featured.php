<div id="featured-content" class="clear">

<?php		
	$args = array( 
	    'posts_per_page' => 3,
		'ignore_sticky_posts' => 1,
		'post__not_in' => get_option( 'sticky_posts' ),	
		'meta_query' => array(
                array(
                'key' => 'videolife-featured',
                'value' => 'yes'
        	)
    	)
	); 

	// The Query
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() && (!get_query_var('paged')) ) {	
?>
	<ul class="owl-carousel owl-theme">

	<?php
		while ( $the_query->have_posts() ) : $the_query->the_post();
	?>	

	<li class="featured-large hentry clear">

		<div class="thumbnail-wrap">
			<a class="thumbnail-link" href="<?php the_permalink(); ?>">					
				<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('videolife_post_thumb');  
				} else {
					echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/img/no-featured.png" alt="" />';
				}
				?>
				<div class="entry-header">	
					<h2 class="entry-title"><?php the_title(); ?></h2>		
				</div><!-- .entry-header -->

				<div class="gradient"></div>		
			</a>					
		</div><!-- .thumbnail-wrap -->

	</li><!-- .featured-large -->			

	<?php
		endwhile;
		}
		wp_reset_postdata();			
	?>
	</ul>

<?php		
	$args = array( 
	    'posts_per_page' => 4,
		'ignore_sticky_posts' => 1,
		'post__not_in' => get_option( 'sticky_posts' ),	
	    'offset' => 3,
		'meta_query' => array(
                array(
                'key' => 'videolife-featured',
                'value' => 'yes'
        	)
    	)
	); 

	// The Query
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() && (!get_query_var('paged')) ) {	
?>

	<div class="featured-right">

		<?php
			while ( $the_query->have_posts() ) : $the_query->the_post();
		?>	

		<div class="featured-small hentry">

			<div class="thumbnail-wrap">
				<a class="thumbnail-link" href="<?php the_permalink(); ?>">					
					<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('videolife_post_thumb');  
					} else {
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/img/no-featured.png" alt="" />';
					}
					?>
					<div class="entry-header">	
						<h2 class="entry-title"><?php the_title(); ?></h2>	
					</div><!-- .entry-header -->	

					<div class="gradient"></div>					
				</a>					
			</div><!-- .thumbnail-wrap -->
			
		</div><!-- .featured-small -->

		<?php
			endwhile;
		?>

	</div><!-- .featured-right -->

<?php
	}
	wp_reset_postdata();	
?>

</div><!-- #featured-content -->