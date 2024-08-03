<?php
class Weather_API {
    private $api_key;

    public function __construct( $api_key ) {
        $this->api_key = $api_key;
    }

    // Consultar clima atual
    public function get_weather( $latitude, $longitude ) {
        $url = "http://api.openweathermap.org/data/2.5/weather?lat=$latitude&lon=$longitude&appid={$this->api_key}&units=metric&lang=pt_br";
        $response = wp_remote_get( $url );

        if ( is_wp_error( $response ) ) {
            $this->log( 'Error fetching weather data: ' . $response->get_error_message() );
            return $response;
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        $this->log( 'Weather data retrieved: ' . print_r( $data, true ) );
        return $data;
    }

    // Consultar previsão 
    public function get_forecast( $latitude, $longitude ) {
        $url = "http://api.openweathermap.org/data/2.5/forecast?lat=$latitude&lon=$longitude&appid={$this->api_key}&units=metric&lang=pt_br";
        $response = wp_remote_get( $url );

        if ( is_wp_error( $response ) ) {
            $this->log( 'Error fetching forecast data: ' . $response->get_error_message() );
            return $response;
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        $this->log( 'Forecast data retrieved: ' . print_r( $data, true ) );
        return $data;
    }

    //Gerar log
    private function log( $message ) {
        $log_file = plugin_dir_path( dirname( __FILE__ ) ) . 'weather-api.log';

        if ( ! file_exists( $log_file ) ) {
            file_put_contents( $log_file, '' );
        }

        $timestamp = date( 'Y-m-d H:i:s' );
        $formatted_message = "[$timestamp] $message\n";
        file_put_contents( $log_file, $formatted_message, FILE_APPEND );
    }
}
