(function ( window, document, $ ) {


	$( "#tribe-tickets-attendee-sortables" ).sortable( {
		containment: "parent",
		items: "> div",
		tolerance: "pointer",
		connectWith: '#tribe-tickets-attendee-sortables'
	} );

	$( '#tribetickets' ).on( 'click', '.postbox .hndle, .postbox .handlediv', function () {
		var p = $( this ).parent( '.postbox' ), id = p.attr( 'id' );

		p.toggleClass( 'closed' );

		if ( id ) {
			if ( !p.hasClass( 'closed' ) && $.isFunction( postboxes.pbshow ) )
				self.pbshow( id );
			else if ( p.hasClass( 'closed' ) && $.isFunction( postboxes.pbhide ) )
				self.pbhide( id );
		}

	} ).on( 'click', 'a.add-attendee-field', function ( e ) {

		e.preventDefault();

		var $this = $( this );

		var args = {
			action: 'tribe-tickets-info-render-field',
			type: $this.attr( 'data-type' )
		};

		$.post(
			ajaxurl,
			args,
			function ( response ) {
				if ( response.success ) {
					$( '#tribe-tickets-attendee-sortables' ).append( response.data );
				}
			},
			'json'
		);

	} ).on( 'click', 'a.delete-attendee-field', function ( e ) {
		e.preventDefault();
		$( this ).parent().parent().parent().remove();
	} ).on( 'tribe-tickets-edit', function () {
		$( 'input[name=show_attendee_info]:checked' ).each( function () {
			$( this ).parents( 'tr' ).next( 'tr.tribe-tickets-attendee-info-form' ).show();
		} );

		$( "#tribe-tickets-attendee-sortables" ).sortable( {
			containment: "parent",
			items: "> div",
			tolerance: "pointer",
			connectWith: '#tribe-tickets-attendee-sortables'
		} );
	} );

})( window, document, jQuery );

