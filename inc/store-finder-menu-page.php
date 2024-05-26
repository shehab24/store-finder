<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
class Store_Finder_Menu_Page_Add
{
  public function __construct()
  {
    add_action("admin_menu", array($this, "strfn_admin_menu_page_add"));
    add_action('admin_enqueue_scripts', [$this, 'adminEnqueueScripts']);
    add_action('wp_ajax_save_store_data_ajax', array($this, 'save_store_data_ajax_callback'));
    add_action('wp_ajax_nopriv_save_store_data_ajax', array($this, 'save_store_data_ajax_callback'));
    add_action('wp_ajax_edit_store_data_ajax', array($this, 'edit_store_data_ajax_callback'));
    add_action('wp_ajax_nopriv_edit_store_data_ajax', array($this, 'edit_store_data_ajax_callback'));
    add_action('wp_ajax_delete_store_data_ajax', array($this, 'delete_store_data_ajax_callback'));
    add_action('wp_ajax_nopriv_delete_store_data_ajax', array($this, 'delete_store_data_ajax_callback'));
  }

  public function strfn_admin_menu_page_add()
  {
    $menuIcon = '<svg xmlns="http://www.w3.org/2000/svg" shapeRendering="geometricPrecision" textRendering="geometricPrecision" imageRendering="optimizeQuality" fillRule="evenodd" clipRule="evenodd" color="currentcolor" viewBox="0 0 497 511.74">
        <path fill="#FFFFFF" fillRule="nonzero" d="M466.63 211.73V439.5c0 8.19-3.36 15.66-8.77 21.06-5.39 5.39-12.86 8.77-21.06 8.77h-83.9c5.62-9.41 10.68-19.04 15.16-28.8h68.74c.24 0 .5-.13.7-.34.2-.2.33-.45.33-.69V214.3c10.24.91 19.92-.06 28.8-2.57zM251.7 511.74c94.65-57.38 131.17-190.37 66.02-249.8-39.72-36.25-91.75-33.77-132.71-1.12-71.81 57.21-39.6 183.38 66.69 250.92zm-3.13-223.6c29.83 0 54.02 24.18 54.02 54.02 0 29.83-24.19 54.02-54.02 54.02-29.84 0-54.03-24.19-54.03-54.02 0-29.84 24.19-54.02 54.03-54.02zm150.32-121.83c-15.79 30.05-70.14 33.19-91.7 11.63a48.126 48.126 0 0 1-8.57-11.63c-15.78 30.04-70.14 33.19-91.7 11.63-3.4-3.41-6.3-7.33-8.56-11.63-2.26 4.3-5.16 8.22-8.57 11.63-18.16 18.17-64.96 18.17-83.13 0a48.126 48.126 0 0 1-8.57-11.63c-2.26 4.3-5.16 8.22-8.56 11.63C64.65 202.81.28 193.08.28 144.27c0-2.98-.97-18.47.7-21.46L34.56 15.2C37.34 6.34 44.07.65 57.13.01L437.22 0c11.73 1.27 19.36 6.18 22.52 15.1l36.15 107.56c1.87 3.09.81 18.33.81 21.61 0 51.62-76.73 62.15-97.81 22.04zM149.78 469.33h-89.6c-8.15 0-15.61-3.36-21.02-8.76h-.06c-5.39-5.39-8.75-12.86-8.75-21.07V211.69c7.08 2.04 14.72 3.16 22.83 3.16 1.99 0 3.98-.07 5.97-.21V439.5c0 .25.12.51.32.7.17.21.44.33.71.33h72.83c4.95 9.71 10.53 19.34 16.77 28.8z"/>
      </svg>';
    add_menu_page(
      __("Store Finder", "store-finder"),
      __("Store Finder", "store-finder"),
      "manage_options",
      "store-finder",
      array($this, "strfn_admin_menu_page_add_callback"),
      'data:image/svg+xml;base64,' . base64_encode($menuIcon),
      30
    );

    add_submenu_page(
      "store-finder",
      __("Dashboard", "store-finder"),
      __("Dashboard", "store-finder"),
      "manage_options",
      "store-finder",
      array($this, "strfn_admin_menu_page_add_callback")
    );

    add_submenu_page(
      "store-finder",
      __("Add New Store", "store-finder"),
      __("Add New Store", "store-finder"),
      "manage_options",
      "add-new-store",
      array($this, "strfn_add_new_store_submenu_callback")
    );
    add_submenu_page(
      "store-finder",
      __("Manage Store", "store-finder"),
      __("Manage Store", "store-finder"),
      "manage_options",
      "manage-store",
      array($this, "strfn_manage_store_submenu_callback")
    );
    add_submenu_page(
      "null",
      __("Edit Store", "store-finder"),
      __("Edit Store", "store-finder"),
      "manage_options",
      "edit-store",
      array($this, "strfn_edit_store_submenu_callback")
    );
  }

  public function strfn_admin_menu_page_add_callback()
  {
    ?>
    <div class="wrap">
      <div class="page_header_div">
        <h2>How its Works?</h2>
      </div>
      <div class="working_div">
        <div class="work">
          <h3>01. Add This Shortcode</h3>
          <div class="shortcode_img_box">
            <img src="<?php echo esc_url(STOREFIND_DIR_URL . 'assets/image/store-finder.jpg'); ?>" alt="">
          </div>
          <h4>Add the shortcode [store-finder] on the new page or whichever page you’d like to display it.</h4>
        </div>
        <div class="work">
          <h3>02. Add your Stores</h3>
          <div class="shortcode_img_box">
            <img src="<?php echo esc_url(STOREFIND_DIR_URL . 'assets/image/create-store.jpg'); ?>" alt="">
          </div>
          <h4>Remove the dummy stores through Manage Stores and add your own store locations.</h4>
        </div>
      </div>
    </div>
    <?php
  }

  public function strfn_add_new_store_submenu_callback()
  {
    ?>
    <div class="main_div">
      <div class="page_header_title">
        <h3>Create Store</h3>
        <a class="text-white btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=manage-store')); ?>">Manage
          Store</a>
      </div>
      <div class="add_store_form">
        <form id="save_store_data_form">
          <div class="input_field_both">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeName" class="form-label">Email Store Name</label>
                <input type="text" class="form-control" id="storeName" name="storeName" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeAddress" class="form-label">Enter Store Address</label>
                <input type="text" class="form-control" id="storeAddress" name="storeAddress" required>
              </div>
            </div>
          </div>
          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeMobile" class="form-label">Email Store Mobile</label>
                <input type="number" class="form-control" id="storeMobile" name="storeMobile" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeEmail" class="form-label">Enter Store Email</label>
                <input type="email" class="form-control" id="storeEmail" name="storeEmail" required>
              </div>
            </div>
          </div>
          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeWebsite" class="form-label">Email Store Website</label>
                <input type="url" class="form-control" id="storeWebsite" placeholder="https://example.com"
                  name="storeWebsite" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeMap" class="form-label">Enter Store Map Url</label>
                <input type="url" class="form-control" id="storeMap" placeholder="https://map.example.com/V29Fe6Hj5YcE8bfj8"
                  name="storeMap" required>
              </div>
            </div>
          </div>

          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storePostcode" class="form-label">Email Postcode</label>
                <input type="number" class="form-control" id="storePostcode" name="storePostcode" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeOpeningClosing" class="form-label">Enter Store Opening & Closing Time</label>
                <input type="text" class="form-control" id="storeOpeningClosing" placeholder="11:00am to 8:00pm"
                  name="storeOpeningClosing" required>
              </div>
            </div>
          </div>

          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="continent-select" class="form-label">Select Continent</label>
                <select id="continent-select" class="form-control" name="continentSelect" required>
                  <option>Select one</option>
                  <option value="Africa">Africa</option>
                  <option value="Antarctica">Antarctica</option>
                  <option value="Asia">Asia</option>
                  <option value="Europe">Europe</option>
                  <option value="NorthAmerica">North America</option>
                  <option value="Oceania">Oceania</option>
                  <option value="SouthAmerica">South America</option>
                </select>

              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="country-select" class="form-label">Select Country</label>
                <select id="country-select" class="form-control" name="countrySelect" required>
                  <option>Select one</option>
                </select>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary submit_button">Save Changes</button>
        </form>

      </div>

      <div id="overlay">
        <div class="cv-spinner">
          <span class="cspinner"></span>
        </div>
      </div>
    </div>
    <?php
  }


  public function strfn_manage_store_submenu_callback()
  {
    global $wpdb;
    // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
    $results = wp_cache_get('store_data_' . "table_name");

    if (false === $results)
    {
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
      $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}strfn_all_store_data_save");
      wp_cache_set('store_data_' . "table_name", $results);
    }
    ?>
    <div class="main_div">
      <div class="page_header_title">
        <h3>Manage Store</h3>
        <a class="text-white btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=add-new-store')); ?>">Add
          New</a>
      </div>

      <div class="manage_store_main_div">
        <table id="manageStoreTable" class="cell-border table table-striped table-bordered">
          <thead>
            <tr>
              <th style="width:3%; text-align:center;">
                <?php echo esc_html_e("Serial No", "store-finder"); ?>
              </th>
              <th style="width:10%; text-align:center;">
                <?php echo esc_html_e("Store Name", "store-finder"); ?>
              </th>
              <th style="width:12%;text-align:center;">
                <?php echo esc_html_e("Address", "store-finder"); ?>
              </th>
              <th style="width:10%;text-align:center;">
                <?php echo esc_html_e("Mobile", "store-finder"); ?>
              </th>
              <th style="width:10%;text-align:center;">
                <?php echo esc_html_e("Email", "store-finder"); ?>
              </th>
              <th style="width:8%;text-align:center;">
                <?php echo esc_html_e("Website", "store-finder"); ?>
              </th>
              <th style="width:10%;text-align:center;">
                <?php echo esc_html_e("Map", "store-finder"); ?>
              </th>
              <th style="width:5%;text-align:center;">
                <?php echo esc_html_e("Postcode", "store-finder"); ?>
              </th>
              <th style="width:8%;text-align:center;">
                <?php echo esc_html_e("Opening Time", "store-finder"); ?>
              </th>
              <th style="width:8%;text-align:center;">
                <?php echo esc_html_e("Continent", "store-finder"); ?>
              </th>
              <th style="width:8%;text-align:center;">
                <?php echo esc_html_e("Country", "store-finder"); ?>
              </th>
              <th style="width:8%;text-align:center;">
                <?php echo esc_html_e("Action", "store-finder"); ?>
              </th>

            </tr>
          </thead>
          <tbody>
            <?php
            if ($results)
            {
              $serialNumber = 1;
              foreach ($results as $result)
              {
                ?>
                <tr class="table_row_id_<?php echo esc_attr($result->id); ?>">
                  <td>
                    <?php echo esc_html($serialNumber++); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_name); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_address); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_mobile); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_email); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_website); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_map); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_postcode); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_open_close); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_continent); ?>
                  </td>
                  <td>
                    <?php echo esc_html($result->store_country); ?>
                  </td>
                  <td>
                    <ul class="action_ul">
                      <li><a
                          href="<?php echo esc_url(admin_url('admin.php?page=edit-store&edit-id=' . $result->id . '')); ?>"><i
                            class="fa-solid fa-pen-to-square"></i></a> </li>
                      <li><a href="#" class="store_delete_button" data-id="<?php echo esc_attr($result->id); ?>"><i
                            class="fa-solid fa-trash"></i></a></li>
                    </ul>
                  </td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

      <div id="overlay">
        <div class="cv-spinner">
          <span class="cspinner"></span>
        </div>
      </div>
    </div>
    <?php
  }

  public function strfn_edit_store_submenu_callback()
  {
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    if (isset ($_GET['edit-id']))
    {
      // phpcs:ignore WordPress.Security.NonceVerification.Recommended
      $editID = isset ($_GET['edit-id']) ? absint($_GET['edit-id']) : 0;

      global $wpdb;
      $results = wp_cache_get('store_data_' . $editID);
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
      if (false === $results)
      {
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $results = $wpdb->get_results(
          $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}strfn_all_store_data_save WHERE id =%d ",
            $editID
          )
        );
        wp_cache_set('store_data_' . $editID, $results);
      }
    }
    ?>
    <div class="main_div">
      <div class="page_header_title">
        <h3>Edit Store</h3>
        <a class="text-white btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=manage-store')); ?>">Go
          Back</a>
      </div>
      <div class="add_store_form">
        <form id="edit_store_data_form" method="post">
          <div class="input_field_both">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeName" class="form-label">Enter Store Name</label>
                <input type="text" class="form-control" id="storeName" name="storeName"
                  value="<?php echo esc_attr($results[0]->store_name); ?>" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeAddress" class="form-label">Enter Store Address</label>
                <input type="text" class="form-control" id="storeAddress" name="storeAddress"
                  value="<?php echo esc_attr($results[0]->store_address); ?>" required>
              </div>
            </div>
          </div>
          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeMobile" class="form-label">Enter Store Mobile</label>
                <input type="number" class="form-control" id="storeMobile" name="storeMobile"
                  value="<?php echo esc_attr($results[0]->store_mobile); ?>" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeEmail" class="form-label">Enter Store Email</label>
                <input type="email" class="form-control" id="storeEmail" name="storeEmail"
                  value="<?php echo esc_attr($results[0]->store_email); ?>" required>
              </div>
            </div>
          </div>
          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeWebsite" class="form-label">Enter Store Website</label>
                <input type="url" class="form-control" id="storeWebsite" placeholder="https://example.com"
                  name="storeWebsite" value="<?php echo esc_attr($results[0]->store_website); ?>" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeMap" class="form-label">Enter Store Map Url</label>
                <input type="url" class="form-control" id="storeMap" placeholder="https://map.example.com/V29Fe6Hj5YcE8bfj8"
                  name="storeMap" value="<?php echo esc_attr($results[0]->store_map); ?>" required>
              </div>
            </div>
          </div>

          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storePostcode" class="form-label">Enter Postcode</label>
                <input type="number" class="form-control" id="storePostcode" name="storePostcode"
                  value="<?php echo esc_attr($results[0]->store_postcode); ?>" required>
              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="storeOpeningClosing" class="form-label">Enter Store Opening & Closing Time</label>
                <input type="text" class="form-control" id="storeOpeningClosing" placeholder="11:00am to 8:00pm"
                  name="storeOpeningClosing" value="<?php echo esc_attr($results[0]->store_open_close); ?>" required>
              </div>
            </div>
          </div>

          <div class="input_field_both mt-4">
            <div class="input_field_div">
              <div class="mb-3">
                <label for="continent-select" class="form-label">Select Continent</label>
                <?php
                $continents = array(
                  "Africa",
                  "Antarctica",
                  "Asia",
                  "Europe",
                  "North America",
                  "Oceania",
                  "South America"
                );
                ?>
                <select id="continent-select" class="form-control" name="continentSelect" required>
                  <option>Select one</option>
                  <?php foreach ($continents as $continent): ?>
                    <option value="<?php echo esc_attr($continent); ?>" <?php echo (esc_attr($results[0]->store_continent) === $continent) ? 'selected' : ''; ?>>
                      <?php echo esc_html($continent); ?>
                    </option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>
            <div class="input_field_div">
              <div class="mb-3">
                <label for="country-select" class="form-label">Select Country</label>
                <?php
                $countries = array(
                  "AF" => "Afghanistan",
                  "AL" => "Albania",
                  "DZ" => "Algeria",
                  "AS" => "American Samoa",
                  "AD" => "Andorra",
                  "AO" => "Angola",
                  "AI" => "Anguilla",
                  "AQ" => "Antarctica",
                  "AG" => "Antigua and Barbuda",
                  "AR" => "Argentina",
                  "AM" => "Armenia",
                  "AW" => "Aruba",
                  "AU" => "Australia",
                  "AT" => "Austria",
                  "AZ" => "Azerbaijan",
                  "BS" => "Bahamas",
                  "BH" => "Bahrain",
                  "BD" => "Bangladesh",
                  "BB" => "Barbados",
                  "BY" => "Belarus",
                  "BE" => "Belgium",
                  "BZ" => "Belize",
                  "BJ" => "Benin",
                  "BM" => "Bermuda",
                  "BT" => "Bhutan",
                  "BO" => "Bolivia",
                  "BA" => "Bosnia and Herzegovina",
                  "BW" => "Botswana",
                  "BV" => "Bouvet Island",
                  "BR" => "Brazil",
                  "IO" => "British Indian Ocean Territory",
                  "BN" => "Brunei Darussalam",
                  "BG" => "Bulgaria",
                  "BF" => "Burkina Faso",
                  "BI" => "Burundi",
                  "KH" => "Cambodia",
                  "CM" => "Cameroon",
                  "CA" => "Canada",
                  "CV" => "Cape Verde",
                  "KY" => "Cayman Islands",
                  "CF" => "Central African Republic",
                  "TD" => "Chad",
                  "CL" => "Chile",
                  "CN" => "China",
                  "CX" => "Christmas Island",
                  "CC" => "Cocos (Keeling) Islands",
                  "CO" => "Colombia",
                  "KM" => "Comoros",
                  "CG" => "Congo",
                  "CD" => "Congo, the Democratic Republic of the",
                  "CK" => "Cook Islands",
                  "CR" => "Costa Rica",
                  "CI" => "Cote D'Ivoire",
                  "HR" => "Croatia",
                  "CU" => "Cuba",
                  "CY" => "Cyprus",
                  "CZ" => "Czech Republic",
                  "DK" => "Denmark",
                  "DJ" => "Djibouti",
                  "DM" => "Dominica",
                  "DO" => "Dominican Republic",
                  "EC" => "Ecuador",
                  "EG" => "Egypt",
                  "SV" => "El Salvador",
                  "GQ" => "Equatorial Guinea",
                  "ER" => "Eritrea",
                  "EE" => "Estonia",
                  "ET" => "Ethiopia",
                  "FK" => "Falkland Islands (Malvinas)",
                  "FO" => "Faroe Islands",
                  "FJ" => "Fiji",
                  "FI" => "Finland",
                  "FR" => "France",
                  "GF" => "French Guiana",
                  "PF" => "French Polynesia",
                  "TF" => "French Southern Territories",
                  "GA" => "Gabon",
                  "GM" => "Gambia",
                  "GE" => "Georgia",
                  "DE" => "Germany",
                  "GH" => "Ghana",
                  "GI" => "Gibraltar",
                  "GR" => "Greece",
                  "GL" => "Greenland",
                  "GD" => "Grenada",
                  "GP" => "Guadeloupe",
                  "GU" => "Guam",
                  "GT" => "Guatemala",
                  "GN" => "Guinea",
                  "GW" => "Guinea-Bissau",
                  "GY" => "Guyana",
                  "HT" => "Haiti",
                  "HM" => "Heard Island and Mcdonald Islands",
                  "VA" => "Holy See (Vatican City State)",
                  "HN" => "Honduras",
                  "HK" => "Hong Kong",
                  "HU" => "Hungary",
                  "IS" => "Iceland",
                  "IN" => "India",
                  "ID" => "Indonesia",
                  "IR" => "Iran, Islamic Republic of",
                  "IQ" => "Iraq",
                  "IE" => "Ireland",
                  "IL" => "Israel",
                  "IT" => "Italy",
                  "JM" => "Jamaica",
                  "JP" => "Japan",
                  "JO" => "Jordan",
                  "KZ" => "Kazakhstan",
                  "KE" => "Kenya",
                  "KI" => "Kiribati",
                  "KP" => "Korea, Democratic People's Republic of",
                  "KR" => "Korea, Republic of",
                  "KW" => "Kuwait",
                  "KG" => "Kyrgyzstan",
                  "LA" => "Lao People's Democratic Republic",
                  "LV" => "Latvia",
                  "LB" => "Lebanon",
                  "LS" => "Lesotho",
                  "LR" => "Liberia",
                  "LY" => "Libyan Arab Jamahiriya",
                  "LI" => "Liechtenstein",
                  "LT" => "Lithuania",
                  "LU" => "Luxembourg",
                  "MO" => "Macao",
                  "MK" => "Macedonia, the Former Yugoslav Republic of",
                  "MG" => "Madagascar",
                  "MW" => "Malawi",
                  "MY" => "Malaysia",
                  "MV" => "Maldives",
                  "ML" => "Mali",
                  "MT" => "Malta",
                  "MH" => "Marshall Islands",
                  "MQ" => "Martinique",
                  "MR" => "Mauritania",
                  "MU" => "Mauritius",
                  "YT" => "Mayotte",
                  "MX" => "Mexico",
                  "FM" => "Micronesia, Federated States of",
                  "MD" => "Moldova, Republic of",
                  "MC" => "Monaco",
                  "MN" => "Mongolia",
                  "MS" => "Montserrat",
                  "MA" => "Morocco",
                  "MZ" => "Mozambique",
                  "MM" => "Myanmar",
                  "NA" => "Namibia",
                  "NR" => "Nauru",
                  "NP" => "Nepal",
                  "NL" => "Netherlands",
                  "AN" => "Netherlands Antilles",
                  "NC" => "New Caledonia",
                );
                ?>
                <select id="country-select" class="form-control" name="countrySelect" required>
                  <option>Select one</option>
                  <?php foreach ($countries as $code => $country): ?>
                    <option value="<?php echo esc_attr($code); ?>" <?php echo (esc_attr($results[0]->store_country) === $code) ? 'selected' : ''; ?>>
                      <?php echo esc_html($country); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <input type="hidden" name="storeId" value="<?php echo esc_attr($editID); ?>">
          <button type="submit" class="btn btn-primary submit_button">Save Changes</button>
        </form>

        <div id="overlay">
          <div class="cv-spinner">
            <span class="cspinner"></span>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

  public function adminEnqueueScripts($hook)
  {
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $current_page = isset ($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $edit_id = isset ($_GET['edit-id']) ? absint($_GET['edit-id']) : '';
    wp_enqueue_script("jquery");
    if (in_array($current_page, array('store-finder', 'add-new-store', 'manage-store')) || ($current_page === 'edit-store' && !empty ($edit_id)))
    {
      wp_enqueue_style('jquery-data-tablecss', STOREFIND_DIR_URL . 'assets/css/jquery.dataTables.css', [], STOREFIND_VERSION);
      wp_enqueue_style('strfn-bootstrap-css', STOREFIND_DIR_URL . 'assets/css/bootstrap.min.css', [], STOREFIND_VERSION);
      wp_enqueue_style('strfn-fontawesome-css', STOREFIND_DIR_URL . 'assets/css/font-awesome.min.css', [], STOREFIND_VERSION);
      wp_enqueue_style('strfn-sweetalert-css', STOREFIND_DIR_URL . 'assets/css/sweet-alert.css', [], STOREFIND_VERSION);
      wp_enqueue_style('strfn-admin-main-css', STOREFIND_DIR_URL . 'assets/css/admin-main.css', [], STOREFIND_VERSION);
      wp_enqueue_script('jquery-data-tablejs', STOREFIND_DIR_URL . 'assets/js/jquery.dataTables.js', [], STOREFIND_VERSION, true);
      wp_enqueue_script('strfn-sweetalert-js', STOREFIND_DIR_URL . 'assets/js/sweet-alert.min.js', [], STOREFIND_VERSION, true);
      wp_enqueue_script('strfn-bootstrap-js', STOREFIND_DIR_URL . 'assets/js/bootstrap.min.js', [], STOREFIND_VERSION, true);
    }



    wp_enqueue_script('strfn-admin-main-js', STOREFIND_DIR_URL . 'assets/js/admin-main.js', [], STOREFIND_VERSION, true);

    $nonces = array(
      'action_1' => wp_create_nonce('save_store_data_ajax_nonce'),
      'action_2' => wp_create_nonce('strfn_store_update_ajax_nonce'),
      'action_3' => wp_create_nonce('strfn_store_delete_ajax_nonce'),
      'action_4' => wp_create_nonce('continent_based_country_nonce'),
      // Add more nonces as needed
    );
    wp_localize_script('strfn-admin-main-js', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php'), "nonces" => $nonces));

    wp_set_script_translations('strfn-admin-post', 'store-finder', STOREFIND_DIR_PATH . 'languages');

  }

  public function save_store_data_ajax_callback()
  {

    if (!isset ($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'save_store_data_ajax_nonce'))
    {
      // Nonce verification failed, handle error
      echo 'Nonce verification failed!';
      return;
    }
    $form_data = isset($_POST['formData']) ? sanitize_text_field(wp_unslash($_POST['formData'])) : '';
    parse_str($form_data, $form_array);

    // Sanitize each input value
    $storeName = isset ($form_array['storeName']) ? sanitize_text_field($form_array['storeName']) : '';
    $storeAddress = isset ($form_array['storeAddress']) ? sanitize_text_field($form_array['storeAddress']) : '';
    $storeMobile = isset ($form_array['storeMobile']) ? sanitize_text_field($form_array['storeMobile']) : '';
    $storeEmail = isset ($form_array['storeEmail']) ? sanitize_email($form_array['storeEmail']) : '';
    $storeWebsite = isset ($form_array['storeWebsite']) ? esc_url_raw($form_array['storeWebsite']) : '';
    $storeMap = isset ($form_array['storeMap']) ? esc_url_raw($form_array['storeMap']) : '';
    $storePostcode = isset ($form_array['storePostcode']) ? absint($form_array['storePostcode']) : '';
    $storeOpeningClosing = isset ($form_array['storeOpeningClosing']) ? sanitize_text_field($form_array['storeOpeningClosing']) : '';
    $continentSelect = isset ($form_array['continentSelect']) ? sanitize_text_field($form_array['continentSelect']) : '';
    $countrySelect = isset ($form_array['countrySelect']) ? sanitize_text_field($form_array['countrySelect']) : '';

    global $wpdb;

    $table_name = $wpdb->prefix . 'strfn_all_store_data_save';


    $data = array(
      'store_name' => $storeName,
      'store_address' => $storeAddress,
      'store_mobile' => $storeMobile,
      'store_email' => $storeEmail,
      'store_website' => $storeWebsite,
      'store_map' => $storeMap,
      'store_postcode' => $storePostcode,
      'store_open_close' => $storeOpeningClosing,
      'store_continent' => $continentSelect,
      'store_country' => $countrySelect
    );
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->insert($table_name, $data);
    if ($wpdb->last_error)
    {
      $status = false;
    } else
    {
      $status = true;
    }

    wp_send_json_success(array("status" => $status));
    wp_die();
  }

  public function edit_store_data_ajax_callback()
  {
    if (!isset ($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'strfn_store_update_ajax_nonce'))
    {
      // Nonce verification failed, handle error
      echo 'Nonce verification failed!';
      return;
    }
    $form_data = isset($_POST['formData']) ? sanitize_text_field(wp_unslash($_POST['formData'])) : '';
    parse_str($form_data, $form_array);

    // Sanitize each input value
    $storeName = isset ($form_array['storeName']) ? sanitize_text_field($form_array['storeName']) : '';
    $storeAddress = isset ($form_array['storeAddress']) ? sanitize_text_field($form_array['storeAddress']) : '';
    $storeMobile = isset ($form_array['storeMobile']) ? sanitize_text_field($form_array['storeMobile']) : '';
    $storeEmail = isset ($form_array['storeEmail']) ? sanitize_email($form_array['storeEmail']) : '';
    $storeWebsite = isset ($form_array['storeWebsite']) ? esc_url_raw($form_array['storeWebsite']) : '';
    $storeMap = isset ($form_array['storeMap']) ? esc_url_raw($form_array['storeMap']) : '';
    $storePostcode = isset ($form_array['storePostcode']) ? absint($form_array['storePostcode']) : '';
    $storeOpeningClosing = isset ($form_array['storeOpeningClosing']) ? sanitize_text_field($form_array['storeOpeningClosing']) : '';
    $continentSelect = isset ($form_array['continentSelect']) ? sanitize_text_field($form_array['continentSelect']) : '';
    $countrySelect = isset ($form_array['countrySelect']) ? sanitize_text_field($form_array['countrySelect']) : '';

    global $wpdb;

    $table_name = $wpdb->prefix . 'strfn_all_store_data_save';


    $data = array(
      'store_name' => $storeName,
      'store_address' => $storeAddress,
      'store_mobile' => $storeMobile,
      'store_email' => $storeEmail,
      'store_website' => $storeWebsite,
      'store_map' => $storeMap,
      'store_postcode' => $storePostcode,
      'store_open_close' => $storeOpeningClosing,
      'store_continent' => $continentSelect,
      'store_country' => $countrySelect
    );

    $where = array(
      'id' => $form_array['storeId']
    );



    $results = wp_cache_get('store_data_' . $storeName);
    if (false === $results)
    {
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
      $results = $wpdb->update($table_name, $data, $where);
      $results = wp_cache_set('store_data_' . $storeName, $results);
    }

    if ($wpdb->last_error)
    {
      $status = false;
    } else
    {
      $status = true;
    }

    $url = admin_url('admin.php?page=manage-store');

    wp_send_json_success(array("status" => $status, "url" => $url));
    wp_die();
  }

  public function delete_store_data_ajax_callback()
  {
    if (!isset ($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'strfn_store_delete_ajax_nonce'))
    {
      // Nonce verification failed, handle error
      echo 'Nonce verification failed!';
      return;
    }
    $dataId = isset ($_POST['dataId']) ? absint($_POST['dataId']) : 0;
    // Retrieve form data

    global $wpdb;
    $table_name = $wpdb->prefix . 'strfn_all_store_data_save';

    $where = array(
      'id' => $dataId
    );
    $results = wp_cache_get('store_data_' . $dataId);
    // Delete the row based on the provided id
    if (false === $results)
    {
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
      $result = $wpdb->delete($table_name, $where);
      wp_cache_set('store_data_' . $dataId, $results);
    }
    // Check if the deletion was successful
    if ($result === false)
    {
      $status = false;
    } else
    {
      $status = true;
    }

    // Send the response
    wp_send_json_success(array("status" => $status));
    wp_die();

  }

}

new Store_Finder_Menu_Page_Add();