<?php

class Tribe__Events__Tickets__Meta {

	public function __construct() {
		add_action( 'tribe_events_tickets_metabox_advanced', array( $this, 'metabox' ), 99 );
	}

	public function metabox() {
		$path = trailingslashit( Tribe__Events__Events::instance()->pluginPath );

		include( $path . 'admin-views/tickets/meta.php' );

		wp_enqueue_style( 'events-tickets-meta', plugins_url( 'resources/tickets-meta.css', dirname( dirname( __FILE__ ) ) ), array(), apply_filters( 'tribe_events_css_version', Tribe__Events__Events::VERSION ) );
		wp_enqueue_script( 'events-tickets-meta', plugins_url( 'resources/tickets-meta.js', dirname( dirname( __FILE__ ) ) ), array(), apply_filters( 'tribe_events_js_version', Tribe__Events__Events::VERSION ) );

	}

}
