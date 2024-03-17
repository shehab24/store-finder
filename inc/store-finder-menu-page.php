<?php
class Store_Finder_Menu_Page_Add{
  public function __construct(){
    add_action("admin_menu" , array($this , "strfn_admin_menu_page_add"));
    add_action( 'admin_enqueue_scripts', [$this, 'adminEnqueueScripts'] );
    add_action('wp_ajax_save_store_data_ajax', array($this,'save_store_data_ajax_callback'));
    add_action('wp_ajax_nopriv_save_store_data_ajax', array($this,'save_store_data_ajax_callback'));
    add_action('wp_ajax_edit_store_data_ajax', array($this,'edit_store_data_ajax_callback'));
    add_action('wp_ajax_nopriv_edit_store_data_ajax', array($this,'edit_store_data_ajax_callback'));
    add_action('wp_ajax_delete_store_data_ajax', array($this,'delete_store_data_ajax_callback'));
    add_action('wp_ajax_nopriv_delete_store_data_ajax', array($this,'delete_store_data_ajax_callback'));
  }

  public function strfn_admin_menu_page_add(){
    $menuIcon = '<svg xmlns="http://www.w3.org/2000/svg" shapeRendering="geometricPrecision" textRendering="geometricPrecision" imageRendering="optimizeQuality" fillRule="evenodd" clipRule="evenodd" color="currentcolor" viewBox="0 0 497 511.74">
        <path fill="#FFFFFF" fillRule="nonzero" d="M466.63 211.73V439.5c0 8.19-3.36 15.66-8.77 21.06-5.39 5.39-12.86 8.77-21.06 8.77h-83.9c5.62-9.41 10.68-19.04 15.16-28.8h68.74c.24 0 .5-.13.7-.34.2-.2.33-.45.33-.69V214.3c10.24.91 19.92-.06 28.8-2.57zM251.7 511.74c94.65-57.38 131.17-190.37 66.02-249.8-39.72-36.25-91.75-33.77-132.71-1.12-71.81 57.21-39.6 183.38 66.69 250.92zm-3.13-223.6c29.83 0 54.02 24.18 54.02 54.02 0 29.83-24.19 54.02-54.02 54.02-29.84 0-54.03-24.19-54.03-54.02 0-29.84 24.19-54.02 54.03-54.02zm150.32-121.83c-15.79 30.05-70.14 33.19-91.7 11.63a48.126 48.126 0 0 1-8.57-11.63c-15.78 30.04-70.14 33.19-91.7 11.63-3.4-3.41-6.3-7.33-8.56-11.63-2.26 4.3-5.16 8.22-8.57 11.63-18.16 18.17-64.96 18.17-83.13 0a48.126 48.126 0 0 1-8.57-11.63c-2.26 4.3-5.16 8.22-8.56 11.63C64.65 202.81.28 193.08.28 144.27c0-2.98-.97-18.47.7-21.46L34.56 15.2C37.34 6.34 44.07.65 57.13.01L437.22 0c11.73 1.27 19.36 6.18 22.52 15.1l36.15 107.56c1.87 3.09.81 18.33.81 21.61 0 51.62-76.73 62.15-97.81 22.04zM149.78 469.33h-89.6c-8.15 0-15.61-3.36-21.02-8.76h-.06c-5.39-5.39-8.75-12.86-8.75-21.07V211.69c7.08 2.04 14.72 3.16 22.83 3.16 1.99 0 3.98-.07 5.97-.21V439.5c0 .25.12.51.32.7.17.21.44.33.71.33h72.83c4.95 9.71 10.53 19.34 16.77 28.8z"/>
      </svg>';
    add_menu_page(
       __("Store Finder" , "store-finder"),
      __("Store Finder" , "store-finder"),
       "manage_options",
       "store-finder",
       array($this , "strfn_admin_menu_page_add_callback"),
      'data:image/svg+xml;base64,' . base64_encode($menuIcon),
      30
    );

    add_submenu_page( 
      "store-finder",
      __("Dashboard" , "store-finder"),
      __("Dashboard" , "store-finder"), 
      "manage_options", 
      "store-finder", 
      array($this , "strfn_admin_menu_page_add_callback") 
      );

    add_submenu_page( 
      "store-finder",
      __("Add New Store" , "store-finder"),
      __("Add New Store" , "store-finder"), 
      "manage_options", 
      "add-new-store", 
      array($this , "strfn_add_new_store_submenu_callback") 
      );
    add_submenu_page( 
      "store-finder",
      __("Manage Store" , "store-finder"),
      __("Manage Store" , "store-finder"), 
      "manage_options", 
      "manage-store", 
      array($this , "strfn_manage_store_submenu_callback") 
      );
    add_submenu_page( 
      "null",
      __("Edit Store" , "store-finder"),
      __("Edit Store" , "store-finder"), 
      "manage_options", 
      "edit-store", 
      array($this , "strfn_edit_store_submenu_callback") 
      );
  }

  public function strfn_admin_menu_page_add_callback(){
    ?>
        <div class="main_div">
              <div class="page_header_title">
                <h3>Create Store</h3>
           
              </div>
              <div class="add_store_form">
                    <form id="save_store_data_form">
                      <div class="input_field_both">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeName" class="form-label">Email Store Name</label>
                                <input type="text" class="form-control" id="storeName" name="storeName" required >
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
                                <input type="url" class="form-control" id="storeWebsite" placeholder="https://example.com" name="storeWebsite" required>
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeMap" class="form-label">Enter Store Map Url</label>
                                <input type="url" class="form-control" id="storeMap" placeholder="https://maps.app.goo.gl/V29Fe6Hj5YcE8bfj8" name="storeMap" required>
                              </div>
                        </div>
                      </div>
                      
                      <div class="input_field_both mt-4">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storePostcode" class="form-label">Email Postcode</label>
                                <input type="number" class="form-control" id="storePostcode"   name="storePostcode" required>
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeOpeningClosing" class="form-label">Enter Store Opening & Closing Time</label>
                                <input type="text" class="form-control" id="storeOpeningClosing" placeholder="11:00am to 8:00pm" name="storeOpeningClosing" required>
                              </div>
                        </div>
                      </div>
                      
                      <div class="input_field_both mt-4">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="continent-select" class="form-label">Select Continent</label>
                                <select id="continent-select" class="form-control" name="continentSelect" required>
                                  <option >Select one</option>
                                  <option value="AF">Africa</option>
                                  <option value="AN">Antarctica</option>
                                  <option value="AS">Asia</option>
                                  <option value="EU">Europe</option>
                                  <option value="NA">North America</option>
                                  <option value="OC">Oceania</option>
                                  <option value="SA">South America</option>
                                </select>

                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="country-select" class="form-label">Select Country</label>
                                <select id="country-select" class="form-control" name="countrySelect" required>
                                                  <option >Select one</option>
                                                  <option value="AF">Afghanistan</option>
                                                  <option value="AL">Albania</option>
                                                  <option value="DZ">Algeria</option>
                                                  <option value="AS">American Samoa</option>
                                                  <option value="AD">Andorra</option>
                                                  <option value="AO">Angola</option>
                                                  <option value="AI">Anguilla</option>
                                                  <option value="AQ">Antarctica</option>
                                                  <option value="AG">Antigua and Barbuda</option>
                                                  <option value="AR">Argentina</option>
                                                  <option value="AM">Armenia</option>
                                                  <option value="AW">Aruba</option>
                                                  <option value="AU">Australia</option>
                                                  <option value="AT">Austria</option>
                                                  <option value="AZ">Azerbaijan</option>
                                                  <option value="BS">Bahamas</option>
                                                  <option value="BH">Bahrain</option>
                                                  <option value="BD">Bangladesh</option>
                                                  <option value="BB">Barbados</option>
                                                  <option value="BY">Belarus</option>
                                                  <option value="BE">Belgium</option>
                                                  <option value="BZ">Belize</option>
                                                  <option value="BJ">Benin</option>
                                                  <option value="BM">Bermuda</option>
                                                  <option value="BT">Bhutan</option>
                                                  <option value="BO">Bolivia</option>
                                                  <option value="BA">Bosnia and Herzegovina</option>
                                                  <option value="BW">Botswana</option>
                                                  <option value="BV">Bouvet Island</option>
                                                  <option value="BR">Brazil</option>
                                                  <option value="IO">British Indian Ocean Territory</option>
                                                  <option value="BN">Brunei Darussalam</option>
                                                  <option value="BG">Bulgaria</option>
                                                  <option value="BF">Burkina Faso</option>
                                                  <option value="BI">Burundi</option>
                                                  <option value="KH">Cambodia</option>
                                                  <option value="CM">Cameroon</option>
                                                  <option value="CA">Canada</option>
                                                  <option value="CV">Cape Verde</option>
                                                  <option value="KY">Cayman Islands</option>
                                                  <option value="CF">Central African Republic</option>
                                                  <option value="TD">Chad</option>
                                                  <option value="CL">Chile</option>
                                                  <option value="CN">China</option>
                                                  <option value="CX">Christmas Island</option>
                                                  <option value="CC">Cocos (Keeling) Islands</option>
                                                  <option value="CO">Colombia</option>
                                                  <option value="KM">Comoros</option>
                                                  <option value="CG">Congo</option>
                                                  <option value="CD">Congo, the Democratic Republic of the</option>
                                                  <option value="CK">Cook Islands</option>
                                                  <option value="CR">Costa Rica</option>
                                                  <option value="CI">Cote D'Ivoire</option>
                                                  <option value="HR">Croatia</option>
                                                  <option value="CU">Cuba</option>
                                                  <option value="CY">Cyprus</option>
                                                  <option value="CZ">Czech Republic</option>
                                                  <option value="DK">Denmark</option>
                                                  <option value="DJ">Djibouti</option>
                                                  <option value="DM">Dominica</option>
                                                  <option value="DO">Dominican Republic</option>
                                                  <option value="EC">Ecuador</option>
                                                  <option value="EG">Egypt</option>
                                                  <option value="SV">El Salvador</option>
                                                  <option value="GQ">Equatorial Guinea</option>
                                                  <option value="ER">Eritrea</option>
                                                  <option value="EE">Estonia</option>
                                                  <option value="ET">Ethiopia</option>
                                                  <option value="FK">Falkland Islands (Malvinas)</option>
                                                  <option value="FO">Faroe Islands</option>
                                                  <option value="FJ">Fiji</option>
                                                  <option value="FI">Finland</option>
                                                  <option value="FR">France</option>
                                                  <option value="GF">French Guiana</option>
                                                  <option value="PF">French Polynesia</option>
                                                  <option value="TF">French Southern Territories</option>
                                                  <option value="GA">Gabon</option>
                                                  <option value="GM">Gambia</option>
                                                  <option value="GE">Georgia</option>
                                                  <option value="DE">Germany</option>
                                                  <option value="GH">Ghana</option>
                                                  <option value="GI">Gibraltar</option>
                                                  <option value="GR">Greece</option>
                                                  <option value="GL">Greenland</option>
                                                  <option value="GD">Grenada</option>
                                                  <option value="GP">Guadeloupe</option>
                                                  <option value="GU">Guam</option>
                                                  <option value="GT">Guatemala</option>
                                                  <option value="GN">Guinea</option>
                                                  <option value="GW">Guinea-Bissau</option>
                                                  <option value="GY">Guyana</option>
                                                  <option value="HT">Haiti</option>
                                                  <option value="HM">Heard Island and Mcdonald Islands</option>
                                                  <option value="VA">Holy See (Vatican City State)</option>
                                                  <option value="HN">Honduras</option>
                                                  <option value="HK">Hong Kong</option>
                                                  <option value="HU">Hungary</option>
                                                  <option value="IS">Iceland</option>
                                                  <option value="IN">India</option>
                                                  <option value="ID">Indonesia</option>
                                                  <option value="IR">Iran, Islamic Republic of</option>
                                                  <option value="IQ">Iraq</option>
                                                  <option value="IE">Ireland</option>
                                                  <option value="IL">Israel</option>
                                                  <option value="IT">Italy</option>
                                                  <option value="JM">Jamaica</option>
                                                  <option value="JP">Japan</option>
                                                  <option value="JO">Jordan</option>
                                                  <option value="KZ">Kazakhstan</option>
                                                  <option value="KE">Kenya</option>
                                                  <option value="KI">Kiribati</option>
                                                  <option value="KP">Korea, Democratic People's Republic of</option>
                                                  <option value="KR">Korea, Republic of</option>
                                                  <option value="KW">Kuwait</option>
                                                  <option value="KG">Kyrgyzstan</option>
                                                  <option value="LA">Lao People's Democratic Republic</option>
                                </select>
                              </div>
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary submit_button">Add Store</button>
                   </form>

              </div>
        </div>
    <?php
  }

  public function strfn_add_new_store_submenu_callback(){
    ?>
        <div class="main_div">
              <div class="page_header_title">
                <h3>Create Store</h3>
                <a class="text-white btn btn-primary" href="<?php echo  esc_url(admin_url('admin.php?page=manage-store')) ;?>">Manage Store</a>
              </div>
              <div class="add_store_form">
                    <form id="save_store_data_form">
                      <div class="input_field_both">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeName" class="form-label">Email Store Name</label>
                                <input type="text" class="form-control" id="storeName" name="storeName" required >
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
                                <input type="url" class="form-control" id="storeWebsite" placeholder="https://example.com" name="storeWebsite" required>
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeMap" class="form-label">Enter Store Map Url</label>
                                <input type="url" class="form-control" id="storeMap" placeholder="https://maps.app.goo.gl/V29Fe6Hj5YcE8bfj8" name="storeMap" required>
                              </div>
                        </div>
                      </div>
                      
                      <div class="input_field_both mt-4">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storePostcode" class="form-label">Email Postcode</label>
                                <input type="number" class="form-control" id="storePostcode"   name="storePostcode" required>
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeOpeningClosing" class="form-label">Enter Store Opening & Closing Time</label>
                                <input type="text" class="form-control" id="storeOpeningClosing" placeholder="11:00am to 8:00pm" name="storeOpeningClosing" required>
                              </div>
                        </div>
                      </div>
                      
                      <div class="input_field_both mt-4">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="continent-select" class="form-label">Select Continent</label>
                                <select id="continent-select" class="form-control" name="continentSelect" required>
                                  <option >Select one</option>
                                  <option value="Africa">Africa</option>
                                  <option value="Antarctica">Antarctica</option>
                                  <option value="Asia">Asia</option>
                                  <option value="Europe">Europe</option>
                                  <option value="North America">North America</option>
                                  <option value="Oceania">Oceania</option>
                                  <option value="South America">South America</option>
                                </select>

                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="country-select" class="form-label">Select Country</label>
                                <select id="country-select" class="form-control" name="countrySelect" required>
                                                  <option >Select one</option>
                                                  <option value="AF">Afghanistan</option>
                                                  <option value="AL">Albania</option>
                                                  <option value="DZ">Algeria</option>
                                                  <option value="AS">American Samoa</option>
                                                  <option value="AD">Andorra</option>
                                                  <option value="AO">Angola</option>
                                                  <option value="AI">Anguilla</option>
                                                  <option value="AQ">Antarctica</option>
                                                  <option value="AG">Antigua and Barbuda</option>
                                                  <option value="AR">Argentina</option>
                                                  <option value="AM">Armenia</option>
                                                  <option value="AW">Aruba</option>
                                                  <option value="AU">Australia</option>
                                                  <option value="AT">Austria</option>
                                                  <option value="AZ">Azerbaijan</option>
                                                  <option value="BS">Bahamas</option>
                                                  <option value="BH">Bahrain</option>
                                                  <option value="BD">Bangladesh</option>
                                                  <option value="BB">Barbados</option>
                                                  <option value="BY">Belarus</option>
                                                  <option value="BE">Belgium</option>
                                                  <option value="BZ">Belize</option>
                                                  <option value="BJ">Benin</option>
                                                  <option value="BM">Bermuda</option>
                                                  <option value="BT">Bhutan</option>
                                                  <option value="BO">Bolivia</option>
                                                  <option value="BA">Bosnia and Herzegovina</option>
                                                  <option value="BW">Botswana</option>
                                                  <option value="BV">Bouvet Island</option>
                                                  <option value="BR">Brazil</option>
                                                  <option value="IO">British Indian Ocean Territory</option>
                                                  <option value="BN">Brunei Darussalam</option>
                                                  <option value="BG">Bulgaria</option>
                                                  <option value="BF">Burkina Faso</option>
                                                  <option value="BI">Burundi</option>
                                                  <option value="KH">Cambodia</option>
                                                  <option value="CM">Cameroon</option>
                                                  <option value="CA">Canada</option>
                                                  <option value="CV">Cape Verde</option>
                                                  <option value="KY">Cayman Islands</option>
                                                  <option value="CF">Central African Republic</option>
                                                  <option value="TD">Chad</option>
                                                  <option value="CL">Chile</option>
                                                  <option value="CN">China</option>
                                                  <option value="CX">Christmas Island</option>
                                                  <option value="CC">Cocos (Keeling) Islands</option>
                                                  <option value="CO">Colombia</option>
                                                  <option value="KM">Comoros</option>
                                                  <option value="CG">Congo</option>
                                                  <option value="CD">Congo, the Democratic Republic of the</option>
                                                  <option value="CK">Cook Islands</option>
                                                  <option value="CR">Costa Rica</option>
                                                  <option value="CI">Cote D'Ivoire</option>
                                                  <option value="HR">Croatia</option>
                                                  <option value="CU">Cuba</option>
                                                  <option value="CY">Cyprus</option>
                                                  <option value="CZ">Czech Republic</option>
                                                  <option value="DK">Denmark</option>
                                                  <option value="DJ">Djibouti</option>
                                                  <option value="DM">Dominica</option>
                                                  <option value="DO">Dominican Republic</option>
                                                  <option value="EC">Ecuador</option>
                                                  <option value="EG">Egypt</option>
                                                  <option value="SV">El Salvador</option>
                                                  <option value="GQ">Equatorial Guinea</option>
                                                  <option value="ER">Eritrea</option>
                                                  <option value="EE">Estonia</option>
                                                  <option value="ET">Ethiopia</option>
                                                  <option value="FK">Falkland Islands (Malvinas)</option>
                                                  <option value="FO">Faroe Islands</option>
                                                  <option value="FJ">Fiji</option>
                                                  <option value="FI">Finland</option>
                                                  <option value="FR">France</option>
                                                  <option value="GF">French Guiana</option>
                                                  <option value="PF">French Polynesia</option>
                                                  <option value="TF">French Southern Territories</option>
                                                  <option value="GA">Gabon</option>
                                                  <option value="GM">Gambia</option>
                                                  <option value="GE">Georgia</option>
                                                  <option value="DE">Germany</option>
                                                  <option value="GH">Ghana</option>
                                                  <option value="GI">Gibraltar</option>
                                                  <option value="GR">Greece</option>
                                                  <option value="GL">Greenland</option>
                                                  <option value="GD">Grenada</option>
                                                  <option value="GP">Guadeloupe</option>
                                                  <option value="GU">Guam</option>
                                                  <option value="GT">Guatemala</option>
                                                  <option value="GN">Guinea</option>
                                                  <option value="GW">Guinea-Bissau</option>
                                                  <option value="GY">Guyana</option>
                                                  <option value="HT">Haiti</option>
                                                  <option value="HM">Heard Island and Mcdonald Islands</option>
                                                  <option value="VA">Holy See (Vatican City State)</option>
                                                  <option value="HN">Honduras</option>
                                                  <option value="HK">Hong Kong</option>
                                                  <option value="HU">Hungary</option>
                                                  <option value="IS">Iceland</option>
                                                  <option value="IN">India</option>
                                                  <option value="ID">Indonesia</option>
                                                  <option value="IR">Iran, Islamic Republic of</option>
                                                  <option value="IQ">Iraq</option>
                                                  <option value="IE">Ireland</option>
                                                  <option value="IL">Israel</option>
                                                  <option value="IT">Italy</option>
                                                  <option value="JM">Jamaica</option>
                                                  <option value="JP">Japan</option>
                                                  <option value="JO">Jordan</option>
                                                  <option value="KZ">Kazakhstan</option>
                                                  <option value="KE">Kenya</option>
                                                  <option value="KI">Kiribati</option>
                                                  <option value="KP">Korea, Democratic People's Republic of</option>
                                                  <option value="KR">Korea, Republic of</option>
                                                  <option value="KW">Kuwait</option>
                                                  <option value="KG">Kyrgyzstan</option>
                                                  <option value="LA">Lao People's Democratic Republic</option>
                                </select>
                              </div>
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary submit_button">Add Store</button>
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

 
  public function strfn_manage_store_submenu_callback(){
        global $wpdb;
        $table_name = $wpdb->prefix . 'strfn_all_store_data_save'; 

         $results = $wpdb->get_results(
            $wpdb->prepare(
               "SELECT * FROM $table_name "
            )
         );
    ?>
        <div class="main_div">
              <div class="page_header_title">
                <h3>Manage Store</h3>
                <a class="text-white btn btn-primary" href="<?php echo  esc_url(admin_url('admin.php?page=add-new-store')) ;?>">Add New</a>
              </div>

                  <div class="manage_store_main_div">
                          <table id="manageStoreTable" class="cell-border table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th style="width:3%; text-align:center;"><?php _e("Serial No", "store-finder"); ?></th>
                                      <th style="width:10%; text-align:center;"><?php _e("Store Name", "store-finder"); ?></th>
                                      <th style="width:12%;text-align:center;"><?php _e("Address", "store-finder"); ?></th>
                                      <th style="width:10%;text-align:center;"><?php _e("Mobile", "store-finder"); ?></th>
                                      <th style="width:10%;text-align:center;"><?php _e("Email", "store-finder"); ?></th>
                                      <th style="width:8%;text-align:center;"><?php _e("Website", "store-finder"); ?></th>
                                      <th style="width:10%;text-align:center;"><?php _e("Map", "store-finder"); ?></th>
                                      <th style="width:5%;text-align:center;"><?php _e("Postcode", "store-finder"); ?></th>
                                      <th style="width:8%;text-align:center;"><?php _e("Opening Time", "store-finder"); ?></th>
                                      <th style="width:8%;text-align:center;"><?php _e("Continent", "store-finder"); ?></th>
                                      <th style="width:8%;text-align:center;"><?php _e("Country", "store-finder"); ?></th>
                                      <th style="width:8%;text-align:center;"><?php _e("Action", "store-finder"); ?></th>

                                  </tr>
                              </thead>
                              <tbody>
                                   <?php
                                      if ($results) {
                                          $serialNumber = 1;
                                          foreach ($results as $result) {
                                              ?>
                                      <tr class="table_row_id_<?php echo $result->id ; ?>">
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
                                                <li><a href="<?php echo esc_url(admin_url('admin.php?page=edit-store&edit-id='.$result->id.'')) ;?>"><i class="fa-solid fa-pen-to-square"></i></a> </li>
                                                <li><a href="#" class="store_delete_button" data-id="<?php echo $result->id ; ?>"><i class="fa-solid fa-trash"></i></a></li>
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

   public function strfn_edit_store_submenu_callback(){
    if(isset($_GET['edit-id'])){
      $editID = $_GET['edit-id'];

      global $wpdb;
        $table_name = $wpdb->prefix . 'strfn_all_store_data_save'; 

         $results = $wpdb->get_results(
            $wpdb->prepare(
               "SELECT * FROM $table_name WHERE id =%d ",
               $editID 
            )
         );
    }
    ?>
        <div class="main_div">
              <div class="page_header_title">
                <h3>Edit Store</h3>
                <a class="text-white btn btn-primary" href="<?php echo  esc_url(admin_url('admin.php?page=manage-store')) ;?>">Go Back</a>
              </div>
              <div class="add_store_form">
                    <form id="edit_store_data_form">
                      <div class="input_field_both">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeName" class="form-label">Enter Store Name</label>
                                <input type="text" class="form-control" id="storeName" name="storeName" value="<?php echo esc_attr( $results[0]->store_name ) ; ?>" required >
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeAddress" class="form-label">Enter Store Address</label>
                                <input type="text" class="form-control" id="storeAddress" name="storeAddress" value="<?php echo esc_attr( $results[0]->store_address ) ; ?>" required>
                              </div>
                        </div>
                      </div>
                      <div class="input_field_both mt-4">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeMobile" class="form-label">Enter Store Mobile</label>
                                <input type="number" class="form-control" id="storeMobile" name="storeMobile" value="<?php echo esc_attr( $results[0]->store_mobile ) ; ?>" required>
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeEmail" class="form-label">Enter Store Email</label>
                                <input type="email" class="form-control" id="storeEmail" name="storeEmail" value="<?php echo esc_attr( $results[0]->store_email ) ; ?>" required>
                              </div>
                        </div>
                      </div>
                      <div class="input_field_both mt-4">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeWebsite" class="form-label">Enter Store Website</label>
                                <input type="url" class="form-control" id="storeWebsite" placeholder="https://example.com" name="storeWebsite" value="<?php echo esc_attr( $results[0]->store_website ) ; ?>" required>
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeMap" class="form-label">Enter Store Map Url</label>
                                <input type="url" class="form-control" id="storeMap" placeholder="https://maps.app.goo.gl/V29Fe6Hj5YcE8bfj8" name="storeMap" value="<?php echo esc_attr( $results[0]->store_map ) ; ?>" required>
                              </div>
                        </div>
                      </div>
                      
                      <div class="input_field_both mt-4">
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storePostcode" class="form-label">Enter Postcode</label>
                                <input type="number" class="form-control" id="storePostcode"   name="storePostcode" value="<?php echo esc_attr( $results[0]->store_postcode ) ; ?>" required>
                            </div>
                        </div>
                        <div class="input_field_div">
                              <div class="mb-3">
                                <label for="storeOpeningClosing" class="form-label">Enter Store Opening & Closing Time</label>
                                <input type="text" class="form-control" id="storeOpeningClosing" placeholder="11:00am to 8:00pm" name="storeOpeningClosing" value="<?php echo esc_attr( $results[0]->store_open_close ) ; ?>" required>
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
                                <?php foreach ($continents as $continent) : ?>
                                    <option value="<?php echo $continent; ?>" <?php echo (esc_attr($results[0]->store_continent) === $continent) ? 'selected' : ''; ?>><?php echo $continent; ?></option>
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
                                    <?php foreach ($countries as $code => $country) : ?>
                                        <option value="<?php echo $code; ?>" <?php echo (esc_attr($results[0]->store_country) === $code) ? 'selected' : ''; ?>><?php echo $country; ?></option>
                                    <?php endforeach; ?>
                                </select>
                              </div>
                        </div>
                      </div>
                      <input type="hidden" name="storeId" value="<?php echo esc_attr( $editID ); ?>">
                      <button type="submit" class="btn btn-primary submit_button">Edit Store</button>
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

     public function adminEnqueueScripts($hook){

          wp_enqueue_script("jquery");
         wp_enqueue_style('jquery-data-tablecss', STOREFIND_DIR_URL . 'assets/css/jquery.dataTables.css');
          wp_enqueue_style( 'strfn-bootstrap-css', STOREFIND_DIR_URL . 'assets/css/bootstrap.min.css', [], STOREFIND_VERSION );
          wp_enqueue_style( 'strfn-fontawesome-css', STOREFIND_DIR_URL . 'assets/css/font-awesome.min.css', [], STOREFIND_VERSION );
          wp_enqueue_style( 'strfn-sweetalert-css', STOREFIND_DIR_URL . 'assets/css/sweet-alert.css', [], STOREFIND_VERSION );
          wp_enqueue_style( 'strfn-admin-main-css', STOREFIND_DIR_URL . 'assets/css/admin-main.css', [], STOREFIND_VERSION );
           wp_enqueue_script('jquery-data-tablejs', STOREFIND_DIR_URL . 'assets/js/jquery.dataTables.js' );
           wp_enqueue_script( 'strfn-sweetalert-js', STOREFIND_DIR_URL . 'assets/js/sweet-alert.min.js', [], STOREFIND_VERSION );
          wp_enqueue_script( 'strfn-bootstrap-js', STOREFIND_DIR_URL . 'assets/js/bootstrap.min.js', [], STOREFIND_VERSION );
       
          wp_enqueue_script( 'strfn-admin-main-js', STOREFIND_DIR_URL . 'assets/js/admin-main.js', [], STOREFIND_VERSION );
          wp_localize_script('strfn-admin-main-js', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
    
          wp_set_script_translations( 'strfn-admin-post', 'store-finder', STOREFIND_DIR_PATH . 'languages' );
        
   }

   public function save_store_data_ajax_callback(){
    $form_data = $_POST['formData']; // Retrieve form data
    parse_str($form_data, $form_array);
    $storeName = $form_array['storeName'];
    $storeAddress = $form_array['storeAddress'];
    $storeMobile = $form_array['storeMobile'];
    $storeEmail = $form_array['storeEmail'];
    $storeWebsite = $form_array['storeWebsite'];
    $storeMap = $form_array['storeMap'];
    $storePostcode = $form_array['storePostcode'];
    $storeOpeningClosing = $form_array['storeOpeningClosing'];
    $continentSelect = $form_array['continentSelect'];
    $countrySelect = $form_array['countrySelect'];
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

    $wpdb->insert($table_name, $data);
    if ($wpdb->last_error) {
        $status = false ;
    } else {
        $status = true ;
    }

    wp_send_json_success(array("status" => $status));
    wp_die();
   }

   public function edit_store_data_ajax_callback(){
    $form_data = $_POST['formData']; // Retrieve form data
    parse_str($form_data, $form_array);
    $storeName = $form_array['storeName'];
    $storeAddress = $form_array['storeAddress'];
    $storeMobile = $form_array['storeMobile'];
    $storeEmail = $form_array['storeEmail'];
    $storeWebsite = $form_array['storeWebsite'];
    $storeMap = $form_array['storeMap'];
    $storePostcode = $form_array['storePostcode'];
    $storeOpeningClosing = $form_array['storeOpeningClosing'];
    $continentSelect = $form_array['continentSelect'];
    $countrySelect = $form_array['countrySelect'];
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

    $wpdb->update($table_name, $data, $where);
    if ($wpdb->last_error) {
        $status = false ;
    } else {
        $status = true ;
    }

    $url = admin_url('admin.php?page=manage-store');

    wp_send_json_success(array("status" => $status, "url"=> $url));
    wp_die();
   }

   public function delete_store_data_ajax_callback(){
    $dataId = $_POST['dataId']; // Retrieve form data

    global $wpdb;
    $table_name = $wpdb->prefix . 'strfn_all_store_data_save';

    $where = array(
        'id' => $dataId
    );

    // Delete the row based on the provided id
    $result = $wpdb->delete($table_name, $where);

    // Check if the deletion was successful
    if ($result === false) {
        $status = false;
    } else {
        $status = true;
    }

    // Send the response
    wp_send_json_success(array("status" => $status));
    wp_die();

   }
}

new Store_Finder_Menu_Page_Add();