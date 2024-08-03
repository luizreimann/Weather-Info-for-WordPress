<?php

class Registration_Fields {
    private $fields = array(
        'cep' => 'CEP',
        'address' => 'Endereço',
        'number' => 'Número',
        'neighborhood' => 'Bairro',
        'city' => 'Cidade',
        'state' => 'Estado'
    );

    public function __construct() {
        // Campos na página de registro
        add_action( 'register_form', array( $this, 'render_fields' ) );
        add_action( 'user_register', array( $this, 'save_custom_registration_fields' ) );

        // Campos na página de perfil e edição de usuário
        add_action( 'show_user_profile', array( $this, 'render_fields' ) );
        add_action( 'edit_user_profile', array( $this, 'render_fields' ) );
        add_action( 'personal_options_update', array( $this, 'save_custom_profile_fields' ) );
        add_action( 'edit_user_profile_update', array( $this, 'save_custom_profile_fields' ) );

        // Campos na página de criação de usuário no admin
        add_action( 'user_new_form', array( $this, 'render_fields' ) );
        add_action( 'create_user', array( $this, 'save_custom_profile_fields' ) );
    }

    public function render_fields( $user = null ) {
        ?>
        <h3><?php _e( 'Endereço', 'wip' ); ?></h3>
        <table class="form-table">
        <?php
        foreach ( $this->fields as $field => $label ) {
            $value = $user ? get_user_meta( $user->ID, $field, true ) : '';
            ?>
            <tr>
                <th><label for="<?php echo $field; ?>"><?php echo $label; ?></label></th>
                <td>
                    <input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" class="regular-text" value="<?php echo esc_attr( $value ); ?>" size="25" /><br />
                    <span class="description"><?php echo __( 'Por favor, insira seu ' . strtolower( $label ) . '.', 'wip' ); ?></span>
                </td>
            </tr>
            <?php
        }
        ?>
            <input type="hidden" name="latitude" id="latitude" value="<?php echo $user ? esc_attr( get_user_meta( $user->ID, 'latitude', true ) ) : ''; ?>" />
            <input type="hidden" name="longitude" id="longitude" value="<?php echo $user ? esc_attr( get_user_meta( $user->ID, 'longitude', true ) ) : ''; ?>" />
        </table>
        <?php
    }

    public function save_custom_registration_fields( $user_id ) {
        $this->save_fields( $user_id );
    }

    private function save_fields( $user_id ) {
        foreach ( $this->fields as $field => $label ) {
            if ( ! empty( $_POST[ $field ] ) ) {
                update_user_meta( $user_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        if ( ! empty( $_POST['latitude'] ) ) {
            update_user_meta( $user_id, 'latitude', sanitize_text_field( $_POST['latitude'] ) );
        }
        if ( ! empty( $_POST['longitude'] ) ) {
            update_user_meta( $user_id, 'longitude', sanitize_text_field( $_POST['longitude'] ) );
        }
    }

    public function save_custom_profile_fields( $user_id ) {
        if ( current_user_can( 'edit_user', $user_id ) ) {
            $this->save_fields( $user_id );
        }
    }
}

new Registration_Fields();
