<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('GSPB_GreenShift_Settings')) {

	class GSPB_GreenShift_Settings
	{

		public function __construct()
		{
			add_action('admin_menu', array($this, 'greenshift_admin_page'));
			if(!defined('REHUB_ADMIN_DIR')){
				//Show Reusable blocks column
				add_action( 'registered_post_type', array( $this, 'gspb_template_menu_display'), 10, 2 );
				add_filter( 'manage_wp_block_posts_columns', array( $this, 'gspb_template_screen_add_column') );
				add_action( 'manage_wp_block_posts_custom_column' , array( $this, 'gspb_template_screen_fill_column'), 1000, 2);
				// Force Block editor for Reusable Blocks even when Classic editor plugin is activated
				add_filter( 'use_block_editor_for_post', array( $this, 'gspb_template_gutenberg_post'), 1000, 2 );
				add_filter( 'use_block_editor_for_post_type', array( $this, 'gspb_template_gutenberg_post_type'), 1000, 2 );
				//Shortcode output for reusable blocks
				add_shortcode( 'wp_reusable_render', array($this, 'gspb_template_shortcode_function'));
				//Ajax render action
				add_action( 'wp_ajax_gspb_el_reusable_load', array($this, 'gspb_el_reusable_load'));
				add_action( 'wp_ajax_nopriv_gspb_el_reusable_load', array($this, 'gspb_el_reusable_load'));
			}
		}

		public function greenshift_admin_page()
		{

			$parent_slug = 'greenshift_dashboard';

			add_menu_page(
				'GreenShift',
				'GreenShift',
				'manage_options',
				$parent_slug,
				array($this, 'welcome_page'),
				plugin_dir_url(__FILE__) . 'libs/gspbLogo.svg',
				20
			);

			add_submenu_page(
				$parent_slug,
				esc_html__('Settings', 'greenshift'),
				esc_html__('Settings', 'greenshift'),
				'manage_options',
				'greenshift',
				array($this, 'settings_page')
			);
		}

		public function welcome_page()
		{
		?>
			<div class="wrap gspb_welcome_div_container">
				<style>
					.wrap {
						background: white;
						max-width: 900px;
						margin: 2.5em auto;
						border: 1px solid #dbdde2;
						box-shadow: 0 10px 20px #ececec;
						text-align: center
					}

					.wrap .notice,
					.wrap .error {
						display: none
					}

					.wrap h2 {
						font-size: 1.5em;
						margin-bottom: 1em;
						font-weight: bold
					}

					.gs-introtext {
						font-size: 14px;
						max-width: 500px;
						margin: 0 auto 50px auto
					}

					.gs-intro-video iframe {
						box-shadow: 10px 10px 20px rgb(0 0 0 / 15%);
					}

					.gs-intro-video {
						margin-bottom: 40px
					}

					.wrap h1 {
						text-align: left;
						padding: 15px 20px;
						margin: -1px -1px 0 -1px;
						font-size: 13px;
						font-weight: bold;
						text-transform: uppercase;
						box-shadow: 0 3px 8px rgb(0 0 0 / 5%);
					}

					.wrap .fs-notice {
						margin: 0 25px 25px 25px !important
					}

					.wrap .fs-plugin-title {
						display: none !important
					}
					.gridrows{display:grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap:20px}
					.gridrows div{padding: 20px;
    					border: 1px solid #e4eff9;
    					background: #f3f8ff; font-size:16px}
						.gridrows div a{text-decoration: none}
					.gs-padd {
						padding: 25px
					}
				</style>
				<h1><?php esc_html_e("Getting Started", 'greenshift'); ?></h1>
				<div class="gs-padd">
					<p><img src="<?php echo GREENSHIFT_DIR_URL.'libs/logo_300.png';?>" height="100" width="100" /></p>
					<p class="gs-introtext"><?php esc_html_e("Thank you for using Greenshift. For any bug report, please, contact us ", 'greenshift'); ?> <a href="<?php echo admin_url('admin.php?page=greenshift_dashboard-contact'); ?>"><?php esc_html_e("through the contact form", 'greenshift'); ?></a></p>
					<div class="gs-intro-video"><iframe width="560" height="315" src="https://www.youtube.com/embed/3xbQcQ5LDEc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
						<div style="text-align:left; padding-top:30px; border-top:1px solid #eee;">
							<h2><?php esc_html_e("More tutorials", 'greenshift'); ?></h2>
							<div class="gridrows">
							<div><a href="https://www.youtube.com/watch?v=hwzSWXvvJXU4" target="_blank"><?php esc_html_e("Row and section Options", 'greenshift'); ?></a></div>
								<div><a href="https://www.youtube.com/watch?v=00ebtAX-a34" target="_blank"><?php esc_html_e("Overview of design options", 'greenshift'); ?></a></div>
								<div><a href="https://www.youtube.com/watch?v=ijo7sBKGPIQ" target="_blank"><?php esc_html_e("In depth overview of unique options", 'greenshift'); ?></a></div>
								<div><a href="https://www.youtube.com/watch?v=5g51fLFtpmc" target="_blank"><?php esc_html_e("How to Add carousels to any block", 'greenshift'); ?></a></div>
								<div><a href="https://www.youtube.com/watch?v=pIz5U5eq2bQ" target="_blank"><?php esc_html_e("How to Use Presets", 'greenshift'); ?></a></div>
								<div><a href="https://youtu.be/Qj5uk7e4vpM" target="_blank"><?php esc_html_e("How to make floating toolbars", 'greenshift'); ?></a></div>
								<div><a href="https://youtu.be/gksGsf1VEBs" target="_blank"><?php esc_html_e("How to improve Query Loop with Query Addon", 'greenshift'); ?></a></div>
							</div>
					</div>
				</div>
			</div>
		<?php
		}

		public function settings_page()
		{

			if (!current_user_can('manage_options')) {
				wp_die('Unauthorized user');
			}

			// Get the active tab from the $_GET param
			$default_tab = null;
			$tab         = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : $default_tab;

		?>
			<div class="wrap">
				<style>
					.wrap {
						background: white;
						max-width: 900px;
						margin: 2.5em auto;
						border: 1px solid #dbdde2;
						box-shadow: 0 10px 20px #ececec;
						text-align: center
					}

					.wrap .notice,
					.wrap .error {
						display: none
					}

					.wrap h2 {
						font-size: 1.5em;
						margin-bottom: 1em;
						font-weight: bold;
						padding: 15px;
						background: #f4f4f4;
					}

					.gs-introtext {
						font-size: 14px;
						max-width: 500px;
						margin: 0 auto 50px auto
					}

					.gs-intro-video iframe {
						box-shadow: 10px 10px 20px rgb(0 0 0 / 15%);
					}

					.gs-intro-video {
						margin-bottom: 40px
					}

					.wrap h1 {
						text-align: left;
						padding: 15px 20px;
						margin: -1px -1px 60px -1px;
						font-size: 13px;
						font-weight: bold;
						text-transform: uppercase;
						box-shadow: 0 3px 8px rgb(0 0 0 / 5%);
					}

					.gs-padd {
						padding: 25px;
						text-align: left;
						background-color: #fbfbfb
					}

					.rtl .gs-padd {
						text-align: right
					}

					.wp-core-ui .button-primary {
						background-color: #2184f9
					}

					.nav-tab-active,
					.nav-tab-active:focus,
					.nav-tab-active:focus:active,
					.nav-tab-active:hover {
						border-bottom: 1px solid #fbfbfb;
						background: #fbfbfb;
					}

					.nav-tab-wrapper {
						padding-left: 20px
					}

					.wrap .fs-notice {
						margin: 0 25px 35px 25px !important
					}

					.wrap .fs-plugin-title {
						display: none !important
					}
				</style>
				<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
				<!-- Here are our tabs -->
				<nav class="nav-tab-wrapper">
					<a href="?page=greenshift" class="nav-tab 
				<?php
				if ($tab === null) :
				?>
					nav-tab-active<?php endif; ?>"> <?php esc_html_e("General", 'greenshift'); ?> </a>
					<a href="?page=greenshift&tab=save_css" class="nav-tab 
				<?php
				if ($tab === 'save_css') :
				?>
					nav-tab-active<?php endif; ?>"><?php esc_html_e("Save CSS", 'greenshift'); ?></a>
					<a href="?page=greenshift&tab=breakpoints" class="nav-tab 
				<?php
				if ($tab === 'breakpoints') :
				?>
					nav-tab-active<?php endif; ?>"><?php esc_html_e("Breakpoints", 'greenshift'); ?></a>
				</nav>

				<div class="tab-content gs-padd">
					<?php
					switch ($tab):
						case 'save_css':
							if (isset($_POST['gspb_save_settings'])) {
								if (!wp_verify_nonce($_POST['gspb_settings_field'], 'gspb_settings_page_action')) {
									esc_html_e("Sorry, your nonce did not verify.", 'greenshift');
									return;
								}
								update_option('gspb_css_save', sanitize_text_field($_POST['gspb_settings_option']));
							}

							$css_tsyle_option = get_option('gspb_css_save');
					?>
							<div class="gspb_settings_form">
								<form method="POST">
									<?php wp_nonce_field('gspb_settings_page_action', 'gspb_settings_field'); ?>
									<table class="form-table">
										<tr>
											<th> <label for="css_system"><?php esc_html_e("Css location", 'greenshift'); ?></label> </th>
											<td>
												<select name="gspb_settings_option">
													<option value="inline" <?php selected($css_tsyle_option, 'inline'); ?>><?php esc_html_e("Inline in Head", 'greenshift'); ?> </option>
													<option value="file" <?php selected($css_tsyle_option, 'file'); ?>> <?php esc_html_e("File system", 'greenshift'); ?> </option>
													<option value="inlineblock" <?php selected($css_tsyle_option, 'inlineblock'); ?>> <?php esc_html_e("Inline in block", 'greenshift'); ?> </option>
												</select>
											</td>
										</tr>
									</table>
									<div style="margin-bottom:15px"><?php esc_html_e("Use Inline in block only if you have some issues with not updating styles of blocks or cache. Once saved as inline in block, styles can be overwritten only when you update post with blocks", 'greenshift'); ?></div>

									<input type="submit" name="gspb_save_settings" value="<?php esc_html_e("Save settings"); ?>" class="button button-primary button-large">
								</form>
							</div>
						<?php
							break;
						case 'breakpoints':
							$global_settings = get_option('gspb_global_settings');

							if (isset($_POST['gspb_save_settings']) && isset($_POST['gspb_settings_field']) && wp_verify_nonce($_POST['gspb_settings_field'], 'gspb_settings_page_action')) {
								$breakpoints = array(
									"mobile" =>  sanitize_text_field($_POST['mobile']),
									"tablet" =>  sanitize_text_field($_POST['tablet']),
									"desktop" =>  sanitize_text_field($_POST['desktop']),
									"row" =>  sanitize_text_field($_POST['row']),
								);
								$global_settings['breakpoints'] = $breakpoints;
								update_option('gspb_global_settings', $global_settings);
							}
						?>
							<form method="POST" class="greenshift_form">
								<?php wp_nonce_field('gspb_settings_page_action', 'gspb_settings_field'); ?>
								<table class="form-table">

									<tr>
										<td> <?php esc_html_e("Mobile", 'greenshift'); ?> </td>
										<td> 
											<input name="mobile" type="text" value="<?php if (isset($global_settings['breakpoints']['mobile'])) {
											echo esc_attr($global_settings['breakpoints']['mobile']);
										}  ?>" placeholder="576" /> 
										</td>
									</tr>
									<tr>
										<td> <?php esc_html_e("Tablet", 'greenshift'); ?> </td>
										<td> 
											<input name="tablet" type="text" value="<?php if (isset($global_settings['breakpoints']['tablet'])) {
											echo esc_attr($global_settings['breakpoints']['tablet']);
										} ?>" placeholder="768" /> 
										</td>
									</tr>
									<tr>
										<td> <?php esc_html_e("Desktop", 'greenshift'); ?> </td>
										<td> 
											<input name="desktop" type="text" value="<?php if (isset($global_settings['breakpoints']['desktop'])) {
											echo esc_attr($global_settings['breakpoints']['desktop']);
										} ?>" placeholder="992" /> 
										</td>
									</tr>
									<tr>
										<td> <?php esc_html_e("Default Row Content Width", 'greenshift'); ?> </td>
										<td> 
											<input name="row" type="text" value="<?php if (isset($global_settings['breakpoints']['row'])) {
											echo esc_attr($global_settings['breakpoints']['row']);
										} ?>" placeholder="1200" /> 
										</td>
									</tr>
								</table>
								<input type="submit" name="gspb_save_settings" value="Save" class="button button-primary button-large">
							</form>
						<?php
							break;
						default:
						?>
							<h2><?php esc_html_e("General Settings", 'greenshift'); ?></h2>
							<?php esc_html_e("You can assign global presets and other settings in Post edit area when you click on G button in header toolbar", 'greenshift'); ?>
					<?php
							break;
					endswitch;
					?>
				</div>
			</div>
		<?php
		}

		//Function to display Reusable section in menu
		function gspb_template_menu_display( $type, $args ) {
			if ( 'wp_block' !== $type ) { return; }
			$args->show_in_menu = true;
			$args->_builtin = false;
			$args->labels->name = esc_html__( 'Block template', 'greenshift' );
			$args->labels->menu_name = esc_html__( 'Reusable templates', 'greenshift' );
			$args->menu_icon = 'dashicons-screenoptions';
			$args->menu_position = 58;
		}
	
		//Columns in Reusable section
		function gspb_template_screen_add_column( $columns ) {
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => esc_html__( 'Block title', 'greenshift' ),
				'gs-reusable-preview' => esc_html__( 'Usage', 'greenshift' ),
			);
			return $columns;
		}
	
		//Render function for Columns in Reusable Sections
		function gspb_template_screen_fill_column( $column, $ID ) {
			global $post;
			switch( $column ) {
		
				case 'gs-reusable-preview' :
		
					echo '<p><input type="text" style="width:350px" value="[wp_reusable_render id=\'' . $ID . '\']" readonly=""></p>';
					echo '<p>' . esc_html__( 'Shortcode for Ajax render:', 'greenshift' ) . '<br><input type="text" style="width:350px" value="[wp_reusable_render ajax=1 height=100px id=\'' . $ID . '\']" readonly="">';
					echo '<p>' . esc_html__( 'Hover trigger:', 'greenshift' ) . ' <code>gs-el-onhover load-block-' . $ID . '</code>';
					echo '<p>' . esc_html__( 'Click trigger:', 'greenshift' ) . ' <code>gs-el-onclick load-block-' . $ID . '</code>';
					echo '<p>' . esc_html__( 'On view trigger:', 'greenshift' ) . ' <code>gs-el-onview load-block-' . $ID . '</code>';
					break;
		
				default :
					break;
			}
		}
	
		//Render shortcode function

		function gspb_template_shortcode_function( $atts ){
			extract(shortcode_atts(
				array(
					'id' => '',
					'ajax'=>'',
					'height'=>'',
					'renderonview'=>''
			), $atts));
			if(!isset($id) || empty($id)){
				return '';
			}
			if(!is_numeric($id)){
				$postget = get_page_by_path($id, OBJECT, array('wp_block') );
				$id = $postget->ID;
			}
			if(!empty($ajax)){
				wp_enqueue_style('wp-block-library');
				wp_enqueue_style('gspreloadercss');
				wp_enqueue_script('gselajaxloader');
				$scriptvars = array( 
					'reusablenonce' => wp_create_nonce('gsreusable'),
					'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ),	
				);
				wp_localize_script( 'gselajaxloader', 'gsreusablevars', $scriptvars );
				$content = '<div class="gs-ajax-load-block gs-ajax-load-block-'.$id.'"></div>'; 

				$content_post = get_post( $id );
				$contentpost = $content_post->post_content;
				$style = '';
				if ( has_blocks( $contentpost ) ) {
					$blocks = parse_blocks( $contentpost );
					$style .= '<style scoped>';
					$style .= gspb_get_inline_styles_blocks($blocks);
					$style .= '</style>';
				}
				if(!empty($height)){
					$content = '<div style="min-height:'.$height.'">'.$content.$style.'</div>';
				} else{
					$content = '<div>'.$content.$style.'</div>';
				}      
			} else{
				$content_post = get_post( $id );
				$content = $content_post->post_content;
				$content = do_blocks($content);
				$content = do_shortcode($content);
				$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
				$content = preg_replace('/^(?:<br\s*\/?>\s*)+/', '', $content);
			}
			return $content;
		}
	
		//Load reusable Ajax function
		function gspb_el_reusable_load() {
			check_ajax_referer( 'gsreusable', 'security' );  
			$post_id = intval($_POST['post_id']);
			$content_post = get_post(  $post_id );
			$content = $content_post->post_content;
			$content = apply_filters( 'the_content', $content);
			$content = str_replace('strokewidth', 'stroke-width', $content);
			$content = str_replace('strokedasharray', 'stroke-dasharray', $content);
			$content = str_replace('stopcolor', 'stop-color', $content);
			$content = str_replace('loading="lazy"', '', $content);
			if( $content){
				wp_send_json_success($content);
			}else{
				wp_send_json_success('fail');
			}
			wp_die();
		}
	
		//Show gutenberg editor on reusable section even if Classic editor plugins enabled
		function gspb_template_gutenberg_post( $use_block_editor, $post ) {
			if ( empty( $post->ID ) ) return $use_block_editor;
			if ( 'wp_block' === get_post_type( $post->ID ) ) return true;
			return $use_block_editor;
		}
		function gspb_template_gutenberg_post_type( $use_block_editor, $post_type ) {
			if ( 'wp_block' === $post_type ) return true;
			return $use_block_editor;
		}

	}
}

add_filter('block_editor_settings_all','gspb_generate_anchor_headings', 10, 2);

function gspb_generate_anchor_headings($settings, $block_editor_context){
	$settings['generateAnchors'] = true;
	return $settings;
}

function gspb_get_inline_styles_blocks($blocks){
	$inlinestyle = '';
	foreach ($blocks as $block) {
		if(!empty( $block['attrs']['inlineCssStyles'])){
			$dynamic_style = $block['attrs']['inlineCssStyles'];
			$dynamic_style = gspb_get_final_css($dynamic_style);
			$dynamic_style = gspb_quick_minify_css($dynamic_style);
			$dynamic_style = htmlspecialchars_decode($dynamic_style);
			$inlinestyle .= $dynamic_style;
		}
		gspb_greenShift_block_script_assets('', $block);
		if(function_exists('greenShiftGsap_block_script_assets')){
			greenShiftGsap_block_script_assets('', $block);
		}
		if ( !empty($block['innerBlocks'])) {
			$blocks = $block['innerBlocks'];
			$inlinestyle .= gspb_get_inline_styles_blocks($blocks);
		}
	}
	return $inlinestyle;
}

?>