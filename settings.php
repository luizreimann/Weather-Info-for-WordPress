<?php

// Adiciona a página de opções do plugin
function wip_add_admin_menu() {
    add_menu_page(
        'Weather Info Plugin',
        'Weather Info',
        'manage_options',
        'weather-info-plugin',
        'wip_options_page'
    );
}
add_action( 'admin_menu', 'wip_add_admin_menu' );

// Registra as configurações
function wip_settings_init() {
    register_setting( 'pluginPage', 'wip_settings' );

    add_settings_section(
        'wip_pluginPage_section',
        __( 'Configurações da API', 'wip' ),
        'wip_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'wip_text_field_0',
        __( 'API Key', 'wip' ),
        'wip_text_field_0_render',
        'pluginPage',
        'wip_pluginPage_section'
    );
}
add_action( 'admin_init', 'wip_settings_init' );

function wip_text_field_0_render() {
    $options = get_option( 'wip_settings' );
    ?>
    <input type='text' name='wip_settings[wip_text_field_0]' value='<?php echo $options['wip_text_field_0']; ?>'>
    <?php
}

function wip_settings_section_callback() {
    echo __( 'Insira sua chave de API da openweathermap.org', 'wip' );
}

function wip_options_page() {
    if ( isset( $_POST['clear_log'] ) ) {
        $log_file = WIP_PLUGIN_DIR . 'weather-api.log';
        if ( file_exists( $log_file ) ) {
            unlink( $log_file );
            echo '<div class="updated"><p>Arquivo de log limpo.</p></div>';
        }
    }

    ?>
    <form action='options.php' method='post'>
        <h1>Weather Info Plugin</h1>
        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>
    </form>
    <h2 style="display: inline-block; margin-right: 10px;">Log</h2>
    <form action="" method="post" style="display: inline-block;">
        <input type="hidden" name="clear_log" value="1">
        <button type="submit" class="button">Limpar</button>
    </form>
    <?php
    // Exibindo o arquivo de log
    $log_file = WIP_PLUGIN_DIR . 'weather-api.log';
    if ( file_exists( $log_file ) ) {
        echo '<textarea style="width: 100%; height: 500px;" readonly>';
        echo file_get_contents( $log_file );
        echo '</textarea>';
    } else {
        echo '<p>O arquivo de log está vazio.</p>';
    }
}
?>
