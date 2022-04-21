<?php

if(!defined('ABSPATH')){exit;}

if(!DISABLE_GUTENBERG){

    /**
     * Custom Gutenberg blocks
     */
    $blocks = array(
        array(
            "name" => "first-screen",
            "label" => __( "First screen", TEXTDOMAIN ),
            "category" => "main",
            'icon' => 'screenoptions'
        )
    );

    /**
     * Create arrays of custom blocks
     */
    $allowed_blocks = array();
    $custom_gutenberg_blocks = array();

    foreach($blocks as $block){

        $allowed_blocks[] = 'acf/' . $block['category'] . '-' . $block['name'];

        $style_url = TEMPLATE_DIRECTORY_URL.'assets/css/blocks/'.$block['category'].'/'.$block['name'].'.min.css';
        $style_name = $block['category'] . '-' . $block['name'];

        array_push($custom_gutenberg_blocks, array(
            'name'            => $block['category'] . '-' . $block['name'],
            'title'           => $block['label'],
            'render_callback' => 'block_render_callback',
            //'enqueue_style'   => $style_url,
            'enqueue_assets' => function() use ($style_url, $style_name){
                if(is_admin()) {
                    // wp_enqueue_style($style_name, $style_url, array('gutenberg-custom-styles'), ASSETS_VERSION);
                } else {
                    wp_enqueue_style($style_name, $style_url, '', ASSETS_VERSION);
                }
            },
            'icon'            => $block['icon'],
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
        ));
    }

    /**
     *  This is the callback that renders the blocks
     */
    function block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {

        $context = Timber::get_context();

        // Store block values
        $context['block'] = $block;

        $context['block_name'] = str_replace('acf/','',$block['name']);
        $context['block_class'] = $context['block_name'];
        $no_category_block_name = str_replace('acf/'.$block['category'] . '-','',$block['name']);

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
        $context['block_style_url'] = TEMPLATE_DIRECTORY_URL.'assets/css/blocks/'.$block['category'].'/'.$no_category_block_name.'.min.css';
        $context['gutenberg_style_url'] = TEMPLATE_DIRECTORY_URL . 'assets/css/gutenberg.min.css';
        $context['is_example'] = get_field('is_example');
        if($context['is_example']){
            $context['block_example'] = TEMPLATE_DIRECTORY_URL . 'assets/gutenberg/' . $block['category'] . '/' . $no_category_block_name . '.png';
        }

        // Render the block
        Timber::render('blocks/'.$context['block']['category'].'/'.$no_category_block_name.'.twig', $context );
    }

    /**
     * Init custom blocks
     */
    function init_custom_gutenberg_blocks() {
        global $custom_gutenberg_blocks;
        foreach ($custom_gutenberg_blocks as $block) {
            acf_register_block_type( $block );
        }
    }
    add_action( 'acf/init', 'init_custom_gutenberg_blocks' );

    /**
     * Allow only custom blocks
     */
    add_filter( 'allowed_block_types', 'custom_allowed_block_types' );
    function custom_allowed_block_types( $allowed_blocks ) {
        global $allowed_blocks;
        return $allowed_blocks;
    }

    /**
     * Custom blocks category
     */
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
    add_filter( 'block_categories', 'custom_block_categories', 10, 2);

    /**
     * Remove default block patterns from Gutenberg editor
     */
    remove_theme_support( 'core-block-patterns' );

    /**
     * Remove custom gutenberg css
     */
    add_filter( 'block_editor_settings' , 'remove_guten_wrapper_styles' );
    function remove_guten_wrapper_styles( $settings ) {
        unset($settings['styles'][0]);
        unset($settings['styles'][1]);
        return $settings;
    }

}
