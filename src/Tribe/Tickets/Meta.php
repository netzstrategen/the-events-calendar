<?php

class Tribe__Events__Tickets__Meta {

	const META_KEY = '_tribe_tickets_meta';
	const TEMPLATES_META_KEY = '_tribe_tickets_meta_templates';

	public function __construct() {
		add_action( 'tribe_events_tickets_metabox_advanced',   array( $this, 'metabox'            ), 99, 2 );
		add_action( 'wp_ajax_tribe-tickets-info-render-field', array( $this, 'ajax_render_fields' )        );
		add_action( 'wp_ajax_tribe-tickets-load-saved-fields', array( $this, 'ajax_render_saved_fields' )  );
		add_action( 'tribe_events_tickets_save_ticket',        array( $this, 'save_meta'          ), 10, 3 );
	}

	public function metabox( $post_id, $ticket_id ) {
		$path = trailingslashit( Tribe__Events__Events::instance()->pluginPath );

		if ( ! empty( $ticket_id ) ) {
			$active_meta = get_post_meta( $ticket_id, self::META_KEY, true );
		}

		if ( empty( $active_meta ) ) {
			$active_meta = array();
		}

		$templates = get_option( self::TEMPLATES_META_KEY, array() );

		if ( ! empty( $templates ) ) {
			$templates = array_keys( $templates );
		}

		include( $path . 'admin-views/tickets/meta.php' );

		wp_enqueue_style( 'events-tickets-meta', plugins_url( 'resources/tickets-meta.css', dirname( dirname( __FILE__ ) ) ), array(), apply_filters( 'tribe_events_css_version', Tribe__Events__Events::VERSION ) );
		wp_enqueue_script( 'events-tickets-meta', plugins_url( 'resources/tickets-meta.js', dirname( dirname( __FILE__ ) ) ), array(), apply_filters( 'tribe_events_js_version', Tribe__Events__Events::VERSION ) );

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
		if ( isset( $data['tribe-tickets-input-save-name'] ) ) {
			$existing = get_option( self::TEMPLATES_META_KEY, array() );
			$existing[ $data['tribe-tickets-input-save-name'] ] = $meta;
			update_option( self::TEMPLATES_META_KEY, $existing );
		}

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

		// ToDo: Obviously refactor after demo. This is hardcoded data (derp)

		$response = array(
			'success' => false,
			'data'    => ''
		);

		ob_start(); ?>

		<div id="field-1436727693" class="tribe-tickets-attendee-info-active-field postbox closed">
			<div class="handlediv" title="Click to toggle"><br></div>
			<h3 class="hndle ui-sortable-handle"><span>Text:</span></h3>

			<div class="inside">
				<input type="hidden" class="ticket_field" name="tribe-tickets-input-1436727693-type" value="text">
				<input type="hidden" class="ticket_field" name="tribe-tickets-input[]" value="1436727693">

				<div class="tribe-tickets-input tribe-tickets-input-text">
					<label for="tickets_attendee_info_field">Label:</label>
					<input type="text" class="ticket_field" name="tribe-tickets-input-1436727693-label" value="First Name">
				</div>

				<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
					<label class="prompt"><input type="checkbox" class="ticket_field"
					                             name="tribe-tickets-input-1436727693-required" value="on">
						Required?
					</label>
				</div>
				<div class="tribe-tickets-delete-field">
					<a href="#" class="delete-attendee-field">Delete this field</a>
				</div>
			</div>
		</div>
		<div id="field-1899078293" class="tribe-tickets-attendee-info-active-field postbox closed">
			<div class="handlediv" title="Click to toggle"><br></div>
			<h3 class="hndle ui-sortable-handle"><span>Select:</span></h3>

			<div class="inside">
				<input type="hidden" class="ticket_field" name="tribe-tickets-input-1899078293-type" value="select">
				<input type="hidden" class="ticket_field" name="tribe-tickets-input[]" value="1899078293">

				<div class="tribe-tickets-input tribe-tickets-input-text">
					<label for="tickets_attendee_info_field">Label:</label>
					<input type="text" class="ticket_field" name="tribe-tickets-input-1899078293-label" value="Shirt Size">
				</div>

				<div class="tribe-tickets-input tribe-tickets-input-textarea">
					<label for="tickets_attendee_info_field">Options (one per line)</label>
					<textarea name="tribe-tickets-input-1417191045-options" class="ticket_field" value="" rows="5">
Small
Medium
Large
					</textarea>
				</div>

				<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
					<label class="prompt"><input type="checkbox" class="ticket_field"
					                             name="tribe-tickets-input-1899078293-required" value="on">
						Required?
					</label>
				</div>
				<div class="tribe-tickets-delete-field">
					<a href="#" class="delete-attendee-field">Delete this field</a>
				</div>
			</div>
		</div>

		<?php $response['data'] = ob_get_clean();;
		if ( ! empty( $response['data'] ) ) {
			$response['success'] = true;
		}

		wp_send_json( $response );
	}

	public function get_render_field( $type, $data = array() ) {
		$path     = trailingslashit( Tribe__Events__Events::instance()->pluginPath );
		$name     = $path . 'admin-views/tickets/fields/' . sanitize_file_name( $type ) . '.php';
		$wrapper  = $path . 'admin-views/tickets/fields/_field.php';

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
