<?php

/*
Plugin Name: Mod Uploads
Description: Modifies /uploads/ dir by removing the path "uploads"
Author: OPCODE (Erasmus Software Engineering)
Version: 0.0.1-alpha
Author URI: https://caxton.co.za
*/


class Mod_Uploads {

    private static $instance;

    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new Mod_Uploads();
        }

        return self::$instance;
    }

    public function __construct() {
        // For future expansion
        return true;
    }

    public function setup() {
        
        add_filter( 'upload_dir', array( $this, 'modify_upload_dir' ) );

    }

    public function modify_upload_dir( array $dirs ) : array {
        
        $dirs['path'] = str_replace('/uploads', '', $dirs['path']);
        $dirs['basedir'] = str_replace('/uploads', '', $dirs['basedir']);
        $dirs['url'] = str_replace('/uploads', '', $dirs['url']);
        $dirs['baseurl'] = str_replace('/uploads', '', $dirs['baseurl']);
        return $dirs;

    }
}

add_action( 'plugins_loaded', 'opcode_mod_uploads_init' , 20);

function opcode_mod_uploads_init() {

    $instance = Mod_Uploads::get_instance();
    $instance->setup();

}

?>
