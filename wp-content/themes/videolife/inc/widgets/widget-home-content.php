<?php
/**
 * Home content widget.
 *
 * @package    videolife
 * @author     WPEnjoy
 * @copyright  Copyright (c) 2021, WPEnjoy
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class VideoLife_Home_Content_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-videolife-home-block-one',
			'description' => __( 'Display post content blocks. Only use for the "Home Content" widget area.', 'videolife' )
		);

		// Create the widget.
		parent::__construct(
			'videolife-home-block-one',          // $this->id_base
			__( '&raquo; Home Content', 'videolife' ), // $this->name
			$widget_options                    // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {

		// Default value.
		$defaults = array(
			'title' => '',
			'limit' => 4,
			'cat'   => '',
			'col'   => '4col'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo wp_kses_post( $before_widget );

			// Theme prefix
			$prefix = 'videolife-';

			// Pull the selected category.
			$cat_id = isset( $instance['cat'] ) ? absint( $instance['cat'] ) : 0;

			// Get the category.
			$category = get_category( $cat_id );

			// Get the category archive link.
			$cat_link = get_category_link( $cat_id );

			// Posts query arguments.
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 6
			);

			// Limit to category based on user selected tag.
			if ( ! $cat_id == 0 ) {
				$args['cat'] = $cat_id;
			}

			// Allow dev to filter the post arguments.
			$query = apply_filters( 'videolife_home_one_column_args', $args );

			// The post query.
			$posts = new WP_Query( $query );

			$i = 1;

			$col = isset( $instance['col'] ) ? strip_tags( $instance['col'] ) : '4col';

			$grid_col = 'ht_grid_1_4';

			if ($col == '4col') {
				$grid_col = 'ht_grid_1_4';
			} else {
				$grid_col = 'ht_grid_1_3';
			}

			if ( $posts->have_posts() ) : ?>

				<div class="content-block content-block-1 clear">

					<div class="section-heading">

					<?php

						if ( $cat_id == 0 ) {
							if ( empty( $instance['title'] ) ) {
								echo '<h3 class="section-title"><span>' . wp_kses_post( apply_filters( 'widget_title',  esc_html( 'Latest Posts', 'videolife' ), $instance, $this->id_base ) ) . '</span></h3>';
							} else {
								echo '<h3 class="section-title"><span>' . wp_kses_post(  apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) ) . '</span></h3>';
							}
						} else {
							if ( empty( $instance['title'] ) ) {
								echo '<h3 class="section-title"><a href="' . esc_url( $cat_link ) . '">' . wp_kses_post( apply_filters( 'widget_title', esc_attr( $category->name ), $instance, $this->id_base ) ) . '</a></h3>';
							} else {
								echo '<h3 class="section-title"><a href="' . esc_url( $cat_link ) . '">' . wp_kses_post( apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) ) . '</a></h3>';
							}	

							$term_description = term_description( $cat_id );
							if ( ! empty( $term_description ) ) {
								printf( '<span class="taxonomy-description">%s</span>', wp_kses_post($term_description) );
							}

							echo '<span class="section-more-link"><a href="' . esc_url( $cat_link ) . '">'. esc_html( 'More', 'videolife' ) . '</a></span>';			
						}

					?>

					</div><!-- .section-heading -->			

					<div class="posts-loop clear">

					<?php 
						while ( $posts->have_posts() ) : $posts->the_post(); 
					?>

					<div <?php post_class( $grid_col ); ?>>

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
							<?php if ( $cat_id == 0 ) { ?>
								<div class="entry-category"><?php videolife_first_category(); ?></div>
							<?php } ?>
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

					</div><!-- .hentry -->

					<?php 
						$i++;
						endwhile; 
					?>
					</div><!-- .posts-loop -->
				</div><!-- .content-block-1 -->

			<?php endif;

			// Restore original Post Data.
			wp_reset_postdata();

		// Close the theme's widget wrapper.
		echo wp_kses_post( $after_widget );

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = (int) $new_instance['limit'];
		$instance['cat']   = (int) $new_instance['cat'];
		$instance['col'] = strip_tags($new_instance['col']);

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title' => '',
			'limit' => 4,
			'cat'   => '',
			'col'   => '4col'
		);
		if (empty( $instance['col'] ) ) {
			$instance['col'] = '4col';
		}

		$col = esc_attr($instance['col']);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'videolife' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'cat' ) ); ?>"><?php esc_html_e( 'Choose category', 'videolife' ); ?></label>
			<select class="widefat" id="<?php echo esc_html( $this->get_field_id( 'cat' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'cat' ) ); ?>" style="width:100%;">
				<?php $categories = get_terms( 'category' ); ?>
				<option value="0"><?php esc_html_e( 'All categories &hellip;', 'videolife' ); ?></option>
				<?php foreach( $categories as $category ) { ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['cat'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id('col') ); ?>">
		    	<input class="" id="<?php echo esc_html( $this->get_field_id('3col') ); ?>" name="<?php echo esc_html( $this->get_field_name('col') ); ?>" type="radio" value="3col" <?php if($col === '3col') { echo 'checked="checked"'; } ?> />
				<?php esc_html_e( '3 Columns Layout', 'videolife' ); ?>		    	
			</label>		    
		<br/>
			<label for="<?php echo esc_html( $this->get_field_id('col') ); ?>">
		    	<input class="" id="<?php echo esc_html( $this->get_field_id('4col') ); ?>" name="<?php echo esc_html( $this->get_field_name('col') ); ?>" type="radio" value="4col" <?php if($col === '4col') { echo 'checked="checked"'; } ?> />
		    	<?php esc_html_e( '4 Columns Layout', 'videolife' ); ?>
			</label>		    
	    </p>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'limit' ) ); ?>">
				<?php esc_html_e( 'Number of posts to show', 'videolife' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'limit' ) ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['limit'] ); ?>" />
		</p>		

	<?php

	}

}