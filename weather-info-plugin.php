<?php
/*
Plugin Name: Weather Info Plugin
Description: Plugin para retornar informações climáticas utilizando a API da openweathermap.org e a API de CEP.
Version: 1.0
Author: Luiz Reimann
*/

// Prevenindo acesso direto
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

// Definindo constantes
define( 'WIP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WIP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Incluindo arquivos necessários
include_once WIP_PLUGIN_DIR . 'includes/class-weather-api.php';
include_once WIP_PLUGIN_DIR . 'includes/class-cep-api.php';
include_once WIP_PLUGIN_DIR . 'includes/class-registration-fields.php';

// Incluindo a página de configurações do plugin
include_once WIP_PLUGIN_DIR . 'settings.php';

// JavaScript consulta de CEP
function wip_enqueue_admin_scripts($hook_suffix) {
    if ( in_array( $hook_suffix, array( 'user-new.php', 'profile.php', 'user-edit.php' ) ) ) {
        wp_enqueue_script( 'weather-info-js-admin', WIP_PLUGIN_URL . 'assets/js/weather-info.js', array( 'jquery' ), null, true );
    }
}
add_action( 'admin_enqueue_scripts', 'wip_enqueue_admin_scripts' );
?>
