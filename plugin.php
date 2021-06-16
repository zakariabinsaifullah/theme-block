<?php
/**
 * Plugin Name: Theme Block
 * Description: <strong><a href="https://webackstop.com">Theme Block</a></strong> is a custom Gutenberg Block that is specially developed for designing the Theme Section for full widht page.
 * Author: Zakaria Binsaifullah
 * Author URI: https://webackstop.com/
 * Text Domain: custom-guten-blocks
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
* Root Function for Blocks Registration
* */
function gmtb_register_block( $block, $options=array() ){
    return register_block_type(
        'gmtb-blocks/' . $block,
        array_merge(
            array(
                'editor_script' => 'gmtb-editor-script',
                'editor_style'  => 'gmtb-editor-style',
                'style'         => 'gmtb-front-style',
                'script'        => 'gmtb-front-script',
            ),
            $options
        )
    );
}
/*
 * Gutenberg Blocks Registration
 * */
function gmtb_blocks_init(){

    // editor script 
    wp_register_script(
        'gmtb-editor-script',
        plugins_url('dist/editor.js', __FILE__),
        array('wp-blocks','wp-i18n', 'wp-element', 'wp-components', 'wp-blob', 'wp-data', 'wp-html-entities', 'lodash', 'wp-block-editor','wp-date' )
    );

    // front script 
    wp_register_script(
        'gmtb-front-script',
        plugins_url('dist/front.js', __FILE__)
    );

    // editor style 
    wp_register_style(
        'gmtb-editor-style',
        plugins_url('dist/editor.css', __FILE__),
        array('wp-edit-blocks')   
    );

    // front style 
    wp_register_style(
        'gmtb-front-style',
        plugins_url('dist/front.css', __FILE__)
    );

    // single block registration
    gmtb_register_block('section-block');

}
add_action( 'init', 'gmtb_blocks_init' );

/**
 * External Assets
*/
function gmtb_enqueue_blocks_assets(){
    wp_enqueue_style( 'block-style', plugins_url( 'dist/assets/css/blocks.style.css', __FILE__ ) );
}
add_action( 'enqueue_block_assets', 'gmtb_enqueue_blocks_assets' );

/*
 * New Category
 * */

function gmtb_blocks_new_cat( $categories ){
	return array_merge(
		$categories,
		array(
			array(
				'title' => 'Theme Blocks',
				'slug'  => 'theme-blocks'
			)
		)
	);
}
add_filter( 'block_categories', 'gmtb_blocks_new_cat' );

