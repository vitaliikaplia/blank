<?php

if(!defined('ABSPATH')){exit;}

class custom_widget_options{

	static $widget_title;
	static $all_options;

	public function __construct() {

		static::$widget_title = __('Additional system options', TEXTDOMAIN);
		static::$all_options = array (
			array (
				'type'          => 'checkbox',
				'label'         => 'enable_maintenance_mode',
				'description'   => __("Enable maintenance mode for anonymous users", TEXTDOMAIN)
			),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_all_updates',
                'description'   => __("Disable all updates", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_customizer',
                'description'   => __("Disable customizer", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_src_set',
                'description'   => __("Disable src set", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'remove_default_image_sizes',
                'description'   => __("Remove default image sizes", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_core_privacy_tools',
                'description'   => __("Disable core privacy tools", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'enable_cyr3lat',
                'description'   => __("Enable CYR3LAT", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_dns_prefetch',
                'description'   => __("Disable DNS prefetch", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_rest_api',
                'description'   => __("Disable Rest API", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_emojis',
                'description'   => __("Disable Emojis", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_embeds',
                'description'   => __("Disable Embeds", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'hide_dashboard_widgets',
                'description'   => __("Disable dashboard widgets", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'hide_admin_top_bar',
                'description'   => __("Hide admin top bar", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_admin_email_verification',
                'description'   => __("Disable admin email verification", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'          => 'disable_comments',
                'description'   => __("Disable comments", TEXTDOMAIN),
                'admin'         => true
            ),
			array (
				'type'          => 'checkbox',
				'label'          => 'delete_child_media',
				'description'   => __("Delete child media", TEXTDOMAIN),
				'admin'         => true
			),
			array (
				'type'          => 'checkbox',
				'label'          => 'enable_html_cache',
				'description'   => __("Enable HTML cache", TEXTDOMAIN),
				'admin'         => true
			),
            array (
                'type'          => 'checkbox',
                'label'          => 'enable_minify',
                'description'   => __("Enable minify", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'checkbox',
                'label'         => 'inline_scripts_and_styles',
                'description'   => __("Inline scripts and styles", TEXTDOMAIN)
            ),
            array (
                'type'          => 'number',
                'label'          => 'resize_upload_width',
                'description'   => __("Resize upload width", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'number',
                'label'          => 'resize_upload_height',
                'description'   => __("Resize upload height", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'number',
                'label'          => 'resize_upload_quality',
                'description'   => __("Resize upload quality", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'password',
                'label'          => 'google_maps_api_key',
                'description'   => __("Google maps API key", TEXTDOMAIN),
                'admin'         => true
            ),
            array (
                'type'          => 'text',
                'label'          => 'smtp_host',
                'description'   => __("SMTP host", TEXTDOMAIN)
            ),
            array (
                'type'          => 'text',
                'label'          => 'smtp_port',
                'description'   => __("SMTP port", TEXTDOMAIN)
            ),
            array (
                'type'          => 'text',
                'label'          => 'smtp_username',
                'description'   => __("SMTP username", TEXTDOMAIN)
            ),
            array (
                'type'          => 'password',
                'label'          => 'smtp_password',
                'description'   => __("SMTP password", TEXTDOMAIN)
            ),
            array (
                'type'          => 'text',
                'label'          => 'smtp_from_name',
                'description'   => __("SMTP from name", TEXTDOMAIN)
            ),
			array (
				'type'          => 'textarea',
				'label'          => 'custom_header',
				'description'   => __("Header custom code", TEXTDOMAIN)
			),
			array (
				'type'          => 'textarea',
				'label'          => 'custom_footer',
				'description'   => __("Footer custom code", TEXTDOMAIN)
			)
		);

		add_action('wp_dashboard_setup', array( $this, 'dashboard_widget_opa' ) );
		add_action('admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_style' ) );
		add_action('admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_script' ) );
		add_action( 'wp_ajax_change_widget_option', array( $this, 'change_widget_option_function' ) );
	}

	public function options_widget(){
		$this->build_html('start');
		$this->build_html('options', self::$all_options);
		$this->build_html('end');
	}

	public function dashboard_widget_opa(){
		wp_add_dashboard_widget('dashboard_widget', self::$widget_title, array( $this, 'options_widget' ));
	}

	public function load_custom_wp_admin_style(){
		wp_register_style( 'custom-dashboard', TEMPLATE_DIRECTORY_URL . 'assets/css/dashboard.min.css', false, ASSETS_VERSION);
		wp_enqueue_style( 'custom-dashboard' );
	}

	public function load_custom_wp_admin_script(){
		wp_register_script( 'custom_wp_admin_js', TEMPLATE_DIRECTORY_URL . 'assets/js/dashboard.min.js', '', ASSETS_VERSION, true);
		wp_enqueue_script( 'custom_wp_admin_js' );
	}

	public function build_html($part, $options = false){

		if($part == 'start'){
			echo '<div class="widget-options-inner">';
		}
		if($part == 'end'){
			echo '</div>';
		}
		if($part == 'options' && $options && is_array($options)){
			foreach($options as $option){
                if($option['type'] == 'checkbox'){
                    $option_html  = '<label for="'.$option['label'].'">';
                    $option_html .= '<input type="checkbox" value="1" class="widget-options-checkbox" name="'.$option['label'].'" id="'.$option['label'].'" ';
                    $option_html .= checked( 1, get_option( $option['label'] ), false );
                    $option_html .= '/>';
                    $option_html .= '<span class="indicator"></span>';
                    $option_html .= $option['description'];
                    $option_html .= '</label>';
                    echo $option_html;
                }
                if($option['type'] == 'number'){
                    $option_html  = '<label for="'.$option['label'].'">';
                    $option_html .= '<span class="label">'.$option['description'].'</span>';
                    $option_html .= '<input type="number" class="widget-options-number" name="'.$option['label'].'" id="'.$option['label'].'" value="'.get_option( $option['label'] ).'" step="1" />';
                    $option_html .= '</label>';
                    echo $option_html;
                }
                if($option['type'] == 'text'){
                    $option_html  = '<label for="'.$option['label'].'">';
                    $option_html .= '<span class="label">'.$option['description'].'</span>';
                    $option_html .= '<input type="text" class="widget-options-text" name="'.$option['label'].'" id="'.$option['label'].'" value="'.get_option( $option['label'] ).'" autocomplete="off" />';
                    $option_html .= '</label>';
                    echo $option_html;
                }
                if($option['type'] == 'password'){
                    $option_html  = '<label for="'.$option['label'].'">';
                    $option_html .= '<span class="label">'.$option['description'].'</span>';
                    $option_html .= '<input type="password" class="widget-options-text" name="'.$option['label'].'" id="'.$option['label'].'" value="'.get_option( $option['label'] ).'" autocomplete="new-password" />';
                    $option_html .= '</label>';
                    echo $option_html;
                }
                if($option['type'] == 'textarea'){
                    $option_html  = '<label for="'.$option['label'].'">';
                    $option_html .= '<span class="label">'.$option['description'].'</span>';
                    $option_html .= '<textarea name="'.$option['label'].'" id="'.$option['label'].'" rows="4" class="large-text widget-options-textarea">'.get_option( $option['label'] ).'</textarea>';
                    $option_html .= '</label>';
                    echo $option_html;
                }
			}
		}

	}

	public function change_widget_option_function(){
		if($_POST['label'] && $_POST['type']){

			$label = stripslashes($_POST['label']);
			$type = stripslashes($_POST['type']);
			$val = stripslashes($_POST['val']);

			$toJson['label'] = $label;
			$toJson['val'] = $val;

			if($type == 'checkbox'){

				$val = filter_var($val, FILTER_VALIDATE_BOOLEAN) ? true : false;

				if($val){
					$toJson['result'] = update_option( $label, $val );
				} else {
					$toJson['result'] = delete_option( $label );
				}

				echo json_encode($toJson);
				exit;

			}

            if($type == 'number' || $type == 'text' || $type == 'textarea' || $type == 'password'){
				$val_status = boolval($val) ? true : false;

				if($val_status){
					$toJson['result'] = update_option( $label, $val );
				} else {
					$toJson['result'] = delete_option( $label );
				}

				echo json_encode($toJson);
				exit;
			}
		}
	}

}

new custom_widget_options();
