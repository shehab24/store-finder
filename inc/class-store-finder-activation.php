<?php

class Store_Finder_Activation{
   public function __construct()
    {
        $this->activation_store_finder_callback();


    }


    public function activation_store_finder_callback(){
      global $wpdb;

        $table_name = $wpdb->prefix . 'strfn_all_store_data_save';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            store_name VARCHAR(55) NOT NULL,
            store_address VARCHAR(100) NOT NULL,
            store_mobile VARCHAR(55) NOT NULL,
            store_email VARCHAR(55) NOT NULL,
            store_website VARCHAR(55) NOT NULL,
            store_map VARCHAR(55) NOT NULL,
            store_postcode VARCHAR(20) NOT NULL,
            store_open_close VARCHAR(55) NOT NULL,
            store_continent VARCHAR(55) NOT NULL,
            store_country VARCHAR(55) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}