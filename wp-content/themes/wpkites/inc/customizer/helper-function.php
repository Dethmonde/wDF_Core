<?php
/**
 * Helper functions.
 *
 * @package wpkites
 */

if (!function_exists('wpkites_custom_navigation')) :

    function wpkites_custom_navigation() {
        echo '<div class="row justify-content-center center">';
        if (!is_rtl()) {
            the_posts_pagination(array(
                'prev_text' => __('<i class="fa fa-long-arrow-left"></i>', 'wpkites' ),
                'next_text' => __('<i class="fa fa-long-arrow-right"></i>', 'wpkites' ),
            ));
        } else {
            the_posts_pagination(array(
                'prev_text' => __('<i class="fa fa-long-arrow-right"></i>', 'wpkites' ),
                'next_text' => __('<i class="fa fa-long-arrow-left"></i>', 'wpkites' ),
            ));
        }
        echo '</div>';
    }

endif;
add_action('wpkites_post_navigation', 'wpkites_custom_navigation');

function wpkites_comment($comment, $args, $depth) {
    $tag = 'div';
    $add_below = 'comment';
    ?>
    <div class="media comment-box">
        <span class="pull-left-comment">
    <?php echo get_avatar($comment, 100, null, 'comments user', array('class' => array('img-fluid comment-img'))); ?>
        </span>
        <div class="media-body">
            <div class="comment-detail">
                <h5 class="comment-detail-title"><?php esc_html(comment_author()); ?><time class="comment-date"><?php 
                /* translators: %1$s: comment date and %2$s: comment time */
                printf(esc_html__('%1$s  %2$s', 'wpkites' ), esc_html(get_comment_date()), esc_html(get_comment_time())); ?></time></h5>
    <?php comment_text(); ?>

                <div class="reply">
    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>


        </div>      

    </div>
    <?php
}

if (!function_exists('wpkites_posted_content')) :

    /**
     * Content
     *
     */
    function wpkites_posted_content() {
        $blog_content = get_theme_mod('wpkites_blog_content', 'excerpt');
        $excerpt_length = get_theme_mod('wpkites_blog_content_length', 30);

        if ('excerpt' == $blog_content) {
            $excerpt = wpkites_the_excerpt(absint($excerpt_length));
            if (!empty($excerpt)) :
                ?>


                <?php
                echo wp_kses_post(wpautop($excerpt));
                ?>


            <?php endif;
        } else {
            ?>

            <?php the_content(); ?>

        <?php }
        ?>
    <?php
    }

endif;



if (!function_exists('wpkites_the_excerpt')) :

    /**
     * Generate excerpt.
     *
     */
    function wpkites_the_excerpt($length = 0, $post_obj = null) {

        global $post;

        if (is_null($post_obj)) {
            $post_obj = $post;
        }

        $length = absint($length);

        if (0 === $length) {
            return;
        }

        $source_content = $post_obj->post_content;

        if (!empty($post_obj->post_excerpt)) {
            $source_content = $post_obj->post_excerpt;
        }

        $source_content = preg_replace('`\[[^\]]*\]`', '', $source_content);
        $trimmed_content = wp_trim_words($source_content, $length, '&hellip;');
        return $trimmed_content;
    }

endif;

if (!function_exists('wpkites_button_title')) :

    /**
     * Display Button on Archive/Blog Page 
     */
    function wpkites_button_title() {
        if (get_theme_mod('wpkites_enable_blog_read_button', true) == true):
            $blog_button = get_theme_mod('wpkites_blog_button_title', 'Read More');

            if (empty($blog_button)) {
                return;
            }
            echo '<p><a href = "' . esc_url(get_the_permalink()) . '" class="more-link">' . esc_html($blog_button) . ' <i class="fa fa-plus"></i></a></p>';

        endif;
    }

endif;

/**
 * Displays the author name
 */
function wpkites_get_author_name($post) {

    $user_id = $post->post_author;
    if (empty($user_id)) {
        return;
    }

    $user_info = get_userdata($user_id);
    echo esc_html($user_info->display_name);
}

function wpkites_footer_section_hook() {
    ?>
    <footer class="site-footer">  
        <div class="container">
            <?php if (is_active_sidebar('footer-sidebar-1') || is_active_sidebar('footer-sidebar-2') || is_active_sidebar('footer-sidebar-3') || is_active_sidebar('footer-sidebar-4')): ?> 
                <?php get_template_part('sidebar', 'footer');
            endif;?>  
        </div>

        <!-- Animation lines-->
        <div _ngcontent-kga-c2="" class="lines">
            <div _ngcontent-kga-c2="" class="line"></div>
            <div _ngcontent-kga-c2="" class="line"></div>
            <div _ngcontent-kga-c2="" class="line"></div>
        </div>
        <!--/ Animation lines-->
        
        <?php if (get_theme_mod('ftr_bar_enable', true) == true): ?>
            <div class="site-info text-center">
            <?php echo wp_kses_post(get_theme_mod('footer_copyright', '<p class="copyright-section"><span>'.__( '?????????? ?????????? - <a href="https://steamcommunity.com/id/Dethmonde">Unit01</a>. ???????????????????? ?????? ?????????????? ???????????????? | ?????? ?????????? ???????????????? 2022', 'wpkites').'</span></p>')); ?>     
            </div>
        <?php endif; ?>
         <style type="text/css">
    <?php
    if (get_theme_mod('testimonial_image_overlay', true) != false) {
        $testimonial_overlay_section_color = get_theme_mod('testimonial_overlay_section_color', 'rgba(255,255,255,0.8)');
        ?>
        .section-space.testimonial:before {
            background-color:<?php echo esc_attr($testimonial_overlay_section_color); ?>;
        }
        
        <?php } ?>

    </style>
    </footer>
    <?php
    $scrolltotop_setting_enable = get_theme_mod('scrolltotop_setting_enable', true);
    if ($scrolltotop_setting_enable == true) {
        ?>
        <div class="scroll-up custom right"><a href="#totop"><i class="fa fa-arrow-up"></i></a></div>
    <?php }
}

add_action('wpkites_footer_section_hook', 'wpkites_footer_section_hook');

if ( ! function_exists( 'wpkites_plus_activate' ) ):

//Container Setting For Page
function wpkites_container()
{
 
$container_width= "";
return $container_width;
}

//Container Setting For Blog Post
function wpkites_blog_post_container()
{

$container_width= "";
return $container_width;
}

//Conainer Setting For Single Post

function wpkites_single_post_container()
{
$container_width= "";
return $container_width;
}
//Preloader feature section function
function wpkites_preloader_feature_section_fn(){
if(get_theme_mod('preloader_enable',false)==true):?>
  <div id="preloader1" class="wpkites-loader">
        <div class="wpkites-preloader-cube">
        <div class="wpkites-cube1 wpkites-cube"></div>
        <div class="wpkites-cube2 wpkites-cube"></div>
        <div class="wpkites-cube4 wpkites-cube"></div>
        <div class="wpkites-cube3 wpkites-cube"></div>
    </div> </div>
  <?php endif;
}
add_action('wpkites_preloader_feature_section_hook','wpkites_preloader_feature_section_fn');

//Admin customizer preview
if ( ! function_exists( 'wpkites_customizer_preview_scripts' ) ) {
    function wpkites_customizer_preview_scripts() {
        wp_enqueue_script( 'wpkites-customizer-preview', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-slider/js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
    }
}
add_action( 'customize_preview_init', 'wpkites_customizer_preview_scripts' );

endif;