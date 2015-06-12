<?php

class Tribe__Events__Tickets__Meta {

	const META_KEY = '_tribe_tickets_meta';
	const TEMPLATES_META_KEY = '_tribe_tickets_meta_templates';

	public function __construct() {
		add_action( 'tribe_events_tickets_metabox_advanced',   array( $this, 'metabox'                  ), 99, 2 );
		add_action( 'wp_ajax_tribe-tickets-info-render-field', array( $this, 'ajax_render_fields'       )        );
		add_action( 'wp_ajax_tribe-tickets-load-saved-fields', array( $this, 'ajax_render_saved_fields' )        );
		add_action( 'tribe_events_tickets_save_ticket',        array( $this, 'save_meta'                ), 10, 3 );
	}

	public function metabox( $post_id, $ticket_id ) {
		$path = trailingslashit( Tribe__Events__Main::instance()->pluginPath );

		if ( ! empty( $ticket_id ) ) {
			$active_meta = get_post_meta( $ticket_id, self::META_KEY, true );
		}

		if ( empty( $active_meta ) ) {
			$active_meta = array();
		}

		$templates = get_option( self::TEMPLATES_META_KEY, array() );

		if ( ! empty( $templates ) ) {
			$templates = array_filter( array_keys( $templates ) );
		}

		include( $path . 'src/admin-views/tickets/meta.php' );

		wp_enqueue_style( 'events-tickets-meta', plugins_url( 'resources/css/tickets-meta.css', dirname( dirname( __FILE__ ) ) ), array(), apply_filters( 'tribe_events_css_version', Tribe__Events__Main::VERSION ) );
		wp_enqueue_script( 'events-tickets-meta', plugins_url( 'resources/js/tickets-meta.js', dirname( dirname( __FILE__ ) ) ) , array(), apply_filters( 'tribe_events_js_version', Tribe__Events__Main::VERSION ) );

	}

	public function save_meta( $post_id, $ticket, $data ) {

		delete_post_meta( $ticket->ID, self::META_KEY );

		$meta = array();

		foreach ( (array) $data['tribe-tickets-input'] as $input ) {
			// ToDo: Obviously refactor after demo

			$type     = $data[ 'tribe-tickets-input-' . $input . '-type' ];
			$required = isset( $data[ 'tribe-tickets-input-' . $input . '-required' ] ) ? $data[ 'tribe-tickets-input-' . $input . '-required' ] : '';
			$label    = $data[ 'tribe-tickets-input-' . $input . '-label' ];
			$options  = isset( $data[ 'tribe-tickets-input-' . $input . '-options' ] ) ? $data[ 'tribe-tickets-input-' . $input . '-options' ] : '';

			$meta[] = array(
				'type'     => $type,
				'required' => $required,
				'label'    => $label,
				'extra'    => array(
					'options' => $options
				)
			);
		}

		update_post_meta( $ticket->ID, self::META_KEY, $meta );

		// Save templates too
		if ( isset( $data['tribe-tickets-save-fieldset'] ) && ! empty( $data['tribe-tickets-saved-fieldset-name'] ) ) {
			$existing = get_option( self::TEMPLATES_META_KEY, array() );
			$key = $this->_get_fieldset_name( $data['tribe-tickets-saved-fieldset-name'], $meta );
			$existing[ $key ] = $meta;
			update_option( self::TEMPLATES_META_KEY, $existing );
		}

	}

	private function _get_fieldset_name( $name, $content ) {
		$existing = get_option( self::TEMPLATES_META_KEY, array() );

		// If we don't have a fieldset with this name, use it.
		if ( empty( $existing[ $name ] ) ) {
			return $name;
		}

		// If we have the name but with the same content, it's the same fieldset
		if ( md5( serialize( $content ) ) == md5( serialize( $existing[ $name ] ) ) ) {
			return $name;
		}

		$count    = 1;
		$new_name = $name;
		while ( ! empty( $existing[ $new_name ] ) ) {
			$new_name = $name . ' ' . $count;
		}

		return $new_name;
	}

	public function ajax_render_fields() {

		$response = array(
			'success' => false,
			'data'    => ''
		);

		if ( empty( $_POST['type'] ) ) {
			wp_send_json( $response );
		}

		$response['data'] = $this->get_render_field( $_POST['type'] );
		if ( ! empty( $response['data'] ) ) {
			$response['success'] = true;
		}

		wp_send_json( $response );
	}

	public function ajax_render_saved_fields() {

		$response = array(
			'success' => false,
			'data'    => ''
		);

		if ( empty( $_POST['fieldset'] ) ) {
			wp_send_json( $response );
		}

		$existing = get_option( self::TEMPLATES_META_KEY, array() );

		if ( ! isset( $existing[ $_POST['fieldset'] ] ) ) {
			wp_send_json( $response );
		}

		foreach ( (array) $existing[ $_POST['fieldset'] ] as $field ) {
			$response['data'] .= $this->get_render_field( $field['type'], $field );
		}

		if ( ! empty( $response['data'] ) ) {
			$response['success'] = true;
		}

		wp_send_json( $response );
	}

	public function get_render_field( $type, $data = array() ) {
		$path     = trailingslashit( Tribe__Events__Main::instance()->pluginPath );
		$name     = $path . 'src/admin-views/tickets/fields/' . sanitize_file_name( $type ) . '.php';
		$wrapper  = $path . 'src/admin-views/tickets/fields/_field.php';

		if ( ! file_exists( $name ) ) {
			return '';
		}


		// ToDo: Obviously refactor after demo

		$field_id = rand();
		$label    = ! empty( $data['label'] ) ? $data['label'] : '';
		$required = ! empty( $data['required'] ) ? $data['required'] : '';
		$options  = ! empty( $data['extra']['options'] ) ? $data['extra']['options'] : '';

		ob_start();
		$type_name = ucwords( $type );
		include $wrapper;
		$field = ob_get_clean();

		ob_start();
		include $name;
		$response = str_replace( '##FIELD_EXTRA_DATA##', ob_get_clean(), $field );

		return $response;
	}

}
