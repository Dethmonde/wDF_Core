<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package videolife
 */

get_header(); 
?>

	<?php
		while ( have_posts() ) : the_post();
	?>
	<div class="entry-top">

		<h1 class="entry-title">
			<?php the_title(); ?>
			<?php 
				if ( function_exists( 'pvc_get_post_views' ) ) :
				$post_id = (int) ( empty( $post_id ) ? get_the_ID() : $post_id );
				$views = pvc_get_post_views( $post_id );
			?>
				<span class="entry-views">
					<i class="fa fa-eye"></i> <?php echo number_format($views); ?>
				</span>
			<?php
				endif;
			?>			
		</h1>

	</div><!-- .entry-top -->

	<div class="entry-below-top">

		<span class="entry-author">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></a>
			<a class="author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author_meta('display_name'); ?></a>
		</span>		

		<div class="entry-tags">

			<?php if (has_tag()) { ?><span class="tag-links"><?php the_tags(' ', ' '); ?></span><?php } ?>
				
		</div><!-- .entry-tags -->

	</div><!-- .entry-below-top -->

	<div class="single-wrap clear">

	<div id="primary" class="content-area">

		<main id="main" class="site-main">
		
		<?php

			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( ( comments_open() || get_comments_number() ) && is_singular('post') ) :
				comments_template();
			endif;

		?>
		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php
		endwhile; // End of the loop.
	?>

	<?php get_sidebar(); ?>

	</div><!-- .single-wrap -->

<?php get_footer(); ?>
