<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
class STOREFINDStoreFinder{
	public function __construct(){
		add_action( 'enqueue_block_assets', [$this, 'enqueueBlockAssets'] );
		add_action( 'init', [$this, 'onInit'] );
	}

	function enqueueBlockAssets(){
		wp_register_style( 'fontAwesome', STOREFIND_DIR_URL . 'assets/css/font-awesome.min.css', [], '6.4.2' ); // Icon
	}

	function onInit() {
		wp_register_style( 'storefind-store-finder-style', STOREFIND_DIR_URL . 'dist/style.css', [ 'fontAwesome' ], STOREFIND_VERSION ); // Style
		wp_register_style( 'storefind-store-finder-editor-style', STOREFIND_DIR_URL . 'dist/editor.css', [ 'storefind-store-finder-style' ], STOREFIND_VERSION ); // Backend Style

		register_block_type( __DIR__, [
			'editor_style'		=> 'storefind-store-finder-editor-style',
			'render_callback'	=> [$this, 'render']
		] ); // Register Block

		wp_set_script_translations( 'storefind-store-finder-editor-script', 'store-finder', STOREFIND_DIR_PATH . 'languages' );
	}

	function render( $attributes ){
		return do_shortcode( '[store-finder]' );
	}
}
new STOREFINDStoreFinder();