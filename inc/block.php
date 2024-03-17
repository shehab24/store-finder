<?php
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
		extract( $attributes );

		wp_enqueue_style( 'storefind-store-finder-style' );
		wp_enqueue_script( 'storefind-store-finder-script', STOREFIND_DIR_URL . 'dist/script.js', [ 'react', 'react-dom' ], STOREFIND_VERSION, true );
		wp_set_script_translations( 'storefind-store-finder-script', 'store-finder', STOREFIND_DIR_PATH . 'languages' );

		$className = $className ?? '';
		$blockClassName = "wp-block-storefind-store-finder $className align$align";

		ob_start(); ?>
		<div class='<?php echo esc_attr( $blockClassName ); ?>' id='storefindStoreFinder-<?php echo esc_attr( $cId ) ?>' data-attributes='<?php echo esc_attr( wp_json_encode( $attributes ) ); ?>'></div>

		<?php return ob_get_clean();
	}
}
new STOREFINDStoreFinder();