<?php

// Consultar CEP
class CEP_API {
    public function get_address( $cep ) {
        $url = "https://brasilapi.com.br/api/cep/v2/{$cep}";
        $response = wp_remote_get( $url );
        $body = wp_remote_retrieve_body( $response );
        return json_decode( $body, true );
    }
}
?>
