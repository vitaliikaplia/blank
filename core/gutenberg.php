<?php

if(!defined('ABSPATH')){exit;}

if(!get_option('disable_gutenberg_everywhere')){

    /** custom blocks categories */
    function custom_block_categories( $categories, $post ) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'main',
                    'title' => __( 'Main', TEXTDOMAIN ),
                ),
            )
        );
    }
    add_filter( 'block_categories_all', 'custom_block_categories', 10, 2);

    /** custom gutenberg blocks */
    function get_custom_gutenberg_blocks_array(){
        return array(
            array(
                "name" => "first-screen",
                "label" => __( "First screen", TEXTDOMAIN ),
                "category" => "main",
                'defaults' => array(
                    'field_5es3eaf348ca151aff27' => array('desktop_tablet','mobile')
                )
            ),
            array(
                "name" => "second-screen",
                "label" => __( "Second screen", TEXTDOMAIN ),
                "category" => "main",
                'defaults' => array(
                    'field_5es3eaf348ca151aff27' => array('desktop_tablet','mobile')
                )
            ),
        );
    }

    /** parse arrays of custom blocks */
    function parse_custom_gutenberg_blocks(){

        $to_return = array();

        foreach(get_custom_gutenberg_blocks_array() as $block){

            $to_return['global_allowed_blocks'][] = 'acf/' . $block['category'] . '-' . $block['name'];

            $to_return['custom_gutenberg_blocks'][] = array(
                'name'            => $block['category'] . '-' . $block['name'],
                'title'           => $block['label'],
                'render_callback' => 'block_render_callback',
                'style'           => $block['category'] . '-' . $block['name'],
                'mode' 			  => 'preview',
                'category'        => $block['category'],
                'keywords'        => array( $block['label'] ),
                'data'            => $block['defaults'],
                'supports'        => array(
                    'align' => false,
                    'mode' => false,
                    'customClassName' => false,
                    'jsx' => true
                ),
                'example'  => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => array(
                            'is_example'   => true
                        )
                    ]
                ]
            );

        }

        return $to_return;

    }

    /** the callback that renders the blocks */
    function block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {

        $context = Timber::context();

        // Store block values
        $context['block'] = $block;

        $context['block_name'] = str_replace('acf/','', $block['name']);
        $context['block_class'] = $context['block_name'];
        $no_category_block_name = str_replace('acf/' . $block['category'] . '-','', $block['name']);

        //Store $is_preview value.
        global $is_preview_global;
        if($is_preview_global){
            $context['is_preview'] = true;
        } else {
            $context['is_preview'] = $is_preview;
        }

        // Store field values
        $context['fields'] = get_fields();

        $context['site_theme_uri'] = TEMPLATE_DIRECTORY_URL;
        $context['is_admin'] = is_admin();
        $context['is_example'] = get_field('is_example');
        if($context['is_example']){
            $context['block_example'] = TEMPLATE_DIRECTORY_URL . 'assets/block-preview/' . $block['category'] . '/' . $no_category_block_name . '.png?ver=' . ASSETS_VERSION;
        }

        // Render the block
        Timber::render('blocks' . DS . $context['block']['category'] . DS . $no_category_block_name . '.twig', $context );
    }

    /** init custom blocks */
    function init_custom_gutenberg_blocks() {
        $parsed = parse_custom_gutenberg_blocks();
        foreach ($parsed['custom_gutenberg_blocks'] as $block) {
            acf_register_block_type( $block );
        }
    }
    add_action( 'acf/init', 'init_custom_gutenberg_blocks' );

    /** allow only custom blocks */
    add_filter( 'allowed_block_types_all', 'custom_allowed_block_types' );
    function custom_allowed_block_types() {
        $parsed = parse_custom_gutenberg_blocks();
        return $parsed['global_allowed_blocks'];
    }

    /** remove default block patterns from gutenberg editor */
    remove_theme_support( 'core-block-patterns' );

    /**
     * Enqueue WordPress theme styles within Gutenberg.
     */
    function organic_origin_gutenberg_styles() {
        wp_enqueue_style( 'organic-origin-gutenberg', TEMPLATE_DIRECTORY_URL . 'assets/css/gutenberg.min.css', false, ASSETS_VERSION, 'all' );
    }
    add_action( 'enqueue_block_editor_assets', 'organic_origin_gutenberg_styles' );

    /** adding block styles as css files */
    function add_locks_styles_css_action() {
        foreach(get_custom_gutenberg_blocks_array() as $block){
            $style_name = $block['category'] . '-' . $block['name'];
            $style_url = TEMPLATE_DIRECTORY_URL . 'assets/css/blocks/' . $block['category'] . '/' . $block['name'] . '.min.css';
            wp_register_style($style_name, $style_url, '', ASSETS_VERSION);
        }
    }
    add_action('init', 'add_locks_styles_css_action');

}
