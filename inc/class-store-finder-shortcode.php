<?php
class Store_Finder_Shortcode{
  public function __construct(){
       add_shortcode( "store-finder", [$this , "shortcode_callback_function"] );
      add_action( 'wp_enqueue_scripts', [$this, 'wpEnqueueScripts'] );
  }

  public function wpEnqueueScripts(){
     wp_enqueue_script("jquery");
     wp_enqueue_style( 'strfn-frontend-css', STOREFIND_DIR_URL . 'assets/css/frontend.css', [], STOREFIND_VERSION );
  }

  public function shortcode_callback_function(){

    ob_start(); 
    ?>
        <div class="select_box">
          <div class="select_child_box">
            <select name="" id="">
              <option value="">Continent*</option>
              <option value="Asia">Asia</option>
            </select>
          </div>
          <div class="select_child_box">
            <select name="" id="">
              <option value="">Country/Region *</option>
              <option value="bd">Bangladesh</option>
            </select>
          </div>
        </div>
        <div class="show_store_search_result">
          <div class="search_box">
            <input type="text" name="" id="" placeholder="Search here....">
          </div>
          <div class="search_result_content">
          <table>
            <tbody>
              <tr>
                <div class="store_content">
                  <h2>Demo Store</h2>
                  <h3>Store Address</h3>
                  <h4>Store email</h4>
                </div>
              </tr>
            </tbody>
          </table>
      </div>
        </div>
    <?php
    $html = ob_get_clean() ; 
    return $html ;

  }
}

new Store_Finder_Shortcode();