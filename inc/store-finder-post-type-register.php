<?php
class Store_Finder_CPT_Register{

   public function __construct()
   {
    add_action( 'admin_enqueue_scripts', [$this, 'adminEnqueueScripts'] );
    add_action("init" , array($this , "strfn_custom_post_register_callback"));
    add_action( 'use_block_editor_for_post', [$this, 'useBlockEditorForPost'], 999, 2 );
    add_action('post_row_actions', array($this, 'strfn_add_duplicate_link'), 10, 2);
		add_action('admin_action_duplicate_post', array($this, 'strfn_duplicate_post'));
    add_filter( 'manage_store-finder_posts_columns', [$this, 'manageSTRFNPostsColumns'], 10 );
		add_action( 'manage_store-finder_posts_custom_column', [$this, 'manageSTRFNPostsCustomColumns'], 10, 2 );
    add_shortcode( 'stf', [$this, 'onAddShortcode'] );
   }


   public function adminEnqueueScripts($hook){
      if( 'edit.php' === $hook || 'post.php' === $hook ){
          wp_enqueue_style( 'strfn-admin-post', STOREFIND_DIR_URL . 'assets/css/admin-post.css', [], STOREFIND_VERSION );
          wp_enqueue_script( 'strfn-admin-post', STOREFIND_DIR_URL . 'assets/js/admin-post.js', [], STOREFIND_VERSION );
          wp_set_script_translations( 'strfn-admin-post', 'store-finder', STOREFIND_DIR_PATH . 'languages' );
        }
   }


   public function strfn_custom_post_register_callback(){

          $menuIcon = '<svg xmlns="http://www.w3.org/2000/svg" shapeRendering="geometricPrecision" textRendering="geometricPrecision" imageRendering="optimizeQuality" fillRule="evenodd" clipRule="evenodd" color="currentcolor" viewBox="0 0 497 511.74">
        <path fill="#FFFFFF" fillRule="nonzero" d="M466.63 211.73V439.5c0 8.19-3.36 15.66-8.77 21.06-5.39 5.39-12.86 8.77-21.06 8.77h-83.9c5.62-9.41 10.68-19.04 15.16-28.8h68.74c.24 0 .5-.13.7-.34.2-.2.33-.45.33-.69V214.3c10.24.91 19.92-.06 28.8-2.57zM251.7 511.74c94.65-57.38 131.17-190.37 66.02-249.8-39.72-36.25-91.75-33.77-132.71-1.12-71.81 57.21-39.6 183.38 66.69 250.92zm-3.13-223.6c29.83 0 54.02 24.18 54.02 54.02 0 29.83-24.19 54.02-54.02 54.02-29.84 0-54.03-24.19-54.03-54.02 0-29.84 24.19-54.02 54.03-54.02zm150.32-121.83c-15.79 30.05-70.14 33.19-91.7 11.63a48.126 48.126 0 0 1-8.57-11.63c-15.78 30.04-70.14 33.19-91.7 11.63-3.4-3.41-6.3-7.33-8.56-11.63-2.26 4.3-5.16 8.22-8.57 11.63-18.16 18.17-64.96 18.17-83.13 0a48.126 48.126 0 0 1-8.57-11.63c-2.26 4.3-5.16 8.22-8.56 11.63C64.65 202.81.28 193.08.28 144.27c0-2.98-.97-18.47.7-21.46L34.56 15.2C37.34 6.34 44.07.65 57.13.01L437.22 0c11.73 1.27 19.36 6.18 22.52 15.1l36.15 107.56c1.87 3.09.81 18.33.81 21.61 0 51.62-76.73 62.15-97.81 22.04zM149.78 469.33h-89.6c-8.15 0-15.61-3.36-21.02-8.76h-.06c-5.39-5.39-8.75-12.86-8.75-21.07V211.69c7.08 2.04 14.72 3.16 22.83 3.16 1.99 0 3.98-.07 5.97-.21V439.5c0 .25.12.51.32.7.17.21.44.33.71.33h72.83c4.95 9.71 10.53 19.34 16.77 28.8z"/>
      </svg>';
     $args = array(
            'public' => false,
            'labels' => array(
                'name' => 'Store Finder',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New item',
                'edit_item' => 'Edit item ',
                'new_item' => 'New item',
                'view_item' => 'View item',
                'search_items' => 'Search item',
            ),
            'show_ui' => true,
            'show_in_menu' => true,
            'supports' => array('title','editor'),
            'rewrite' => false,
            'show_in_rest' => true,
            'template' => array(
                array('storefind/store-finder'),
            ),
            'template_lock' => 'all',
            'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode($menuIcon),
        );

        register_post_type('store-finder', $args);
   }

   function manageSTRFNPostsColumns( $defaults ) {
		unset( $defaults['date'] );
		$defaults['shortcode'] = 'ShortCode';
		$defaults['date'] = 'Date';
		return $defaults;
	}

  function manageSTRFNPostsCustomColumns( $column_name, $post_ID ) {
		if ( $column_name == 'shortcode' ) {
			echo "<div class='bPlAdminShortcode' id='bPlAdminShortcode-$post_ID'>
				<input value='[stf id=$post_ID]' onclick='copyBPlAdminShortcode($post_ID)'>
				<span class='tooltip'>Copy To Clipboard</span>
			</div>";
		}
	}

  function onAddShortcode( $atts ) {
		$post_id = $atts['id'];

		$post = get_post( $post_id );
		$blocks = parse_blocks( $post->post_content );

     if ($post && $post->post_status === 'publish') {

        ob_start();
        echo render_block($blocks[0]);
        return ob_get_clean();

      } else {

         return '<h2>The post is not published or does not exist.</h2>';

      }

		
	}

   function useBlockEditorForPost($use, $post){
		if ( 'store-finder' === $post->post_type ) {
			return true;
		}
		return $use;
	}

   function strfn_add_duplicate_link($actions, $post)
	{
	   if ($post->post_type == 'store-finder') {
		  $actions['duplicate'] = '<a href="' . admin_url("admin.php?action=duplicate_post&post={$post->ID}") . '">Duplicate</a>';
		  
	   }
	   return $actions;
	}

	public function strfn_duplicate_post()
    {
        if (!isset($_GET['post']) || !current_user_can('edit_posts')) {
            wp_die('Permission denied');
        }

        $post_id = $_GET['post'];
        $post = get_post($post_id);

        if (!$post) {
            wp_die('Invalid post ID');
        }

        $new_post = array(
            'post_title' => $post->post_title . '(copy)',
            'post_content' => $post->post_content,
            'post_status' => $post->post_status,
            'post_type' => $post->post_type,
        );

        $new_post_id = wp_insert_post($new_post);
        wp_redirect(admin_url("post.php?action=edit&post={$new_post_id}"));
        exit;
    }

}

new Store_Finder_CPT_Register();