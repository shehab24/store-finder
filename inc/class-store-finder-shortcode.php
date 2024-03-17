<?php
class Store_Finder_Shortcode{
  public function __construct(){
       add_shortcode( "store-finder", [$this , "shortcode_callback_function"] );
      add_action( 'wp_enqueue_scripts', [$this, 'wpEnqueueScripts'] );
  }

  public function wpEnqueueScripts(){
     wp_enqueue_script("jquery");
     wp_enqueue_style( 'strfn-frontend-css', STOREFIND_DIR_URL . 'assets/css/frontend.css', [], STOREFIND_VERSION );
     wp_enqueue_style( 'strfn-fontawesome-css', STOREFIND_DIR_URL . 'assets/css/font-awesome.min.css', [], STOREFIND_VERSION );
     wp_enqueue_script( 'strfn-frontend-js', STOREFIND_DIR_URL . 'assets/js/frontend.js', [], STOREFIND_VERSION );
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
            <input type="text" name="" id="searchInput" placeholder="Search here....">
          </div>
          <div class="search_result_content">
          <table>
            <tbody id="searchTableContent">
              <tr>
                <td class="store_content">
                  <span>Demo Store1</span>
                    <ul>
                      <li><span><i class="fa-solid fa-location-dot"></i> Store Address</span></li>
                      <li><span><i class="fa-regular fa-clock"></i> 10:00am to 8:00pm</span></li>
                      <li><span><i class="fa-solid fa-phone"></i> +8809678666777</span></li>
                      <li><span><i class="fa-solid fa-envelope"></i> sabbir2434@outlook.com</span></li>
                      <li>
                        <div class="website_link_div">
                          <a href="#">Direction</a><a href="#">Website</a>
                        </div>
                    </li>
                    </ul>
                </td>
              </tr>
              <tr>
                <td class="store_content">
                  <span>Demo Store2</span>
                    <ul>
                      <li><span><i class="fa-solid fa-location-dot"></i> Store Address</span></li>
                      <li><span><i class="fa-regular fa-clock"></i> 10:00am to 8:00pm</span></li>
                      <li><span><i class="fa-solid fa-phone"></i> +8809678666777</span></li>
                      <li><span><i class="fa-solid fa-envelope"></i> sabbir2434@outlook.com</span></li>
                      <li>
                        <div class="website_link_div">
                          <a href="#">Direction</a><a href="#">Website</a>
                        </div>
                    </li>
                    </ul>
                </td>
              </tr>
              <tr>
                <td class="store_content">
                  <span>Demo Store3</span>
                    <ul>
                      <li><span><i class="fa-solid fa-location-dot"></i> Store Address</span></li>
                      <li><span><i class="fa-regular fa-clock"></i> 10:00am to 8:00pm</span></li>
                      <li><span><i class="fa-solid fa-phone"></i> +8809678666777</span></li>
                      <li><span><i class="fa-solid fa-envelope"></i> sabbir2434@outlook.com</span></li>
                      <li>
                        <div class="website_link_div">
                          <a href="#">Direction</a><a href="#">Website</a>
                        </div>
                    </li>
                    </ul>
                </td>
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