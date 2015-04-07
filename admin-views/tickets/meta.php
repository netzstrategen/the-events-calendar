<table class="eventtable ticket_list ticket_meta_form">
	<tbody>
	<tr>
		<td colspan="2" class="titlewrap">
			<h4 class="tribe_sectionheader">Attendee Information</h4>
		</td>
	</tr>
	<tr>
		<td style="width:170px"><?php _e( 'Use Saved Attendee Info Fields:', 'tribe-events-calendar' ); ?></td>
		<td>
			<select class="chosen ticket-attendee-info-dropdown" name="ticket-attendee-info[MetaID]"
			        id="saved_ticket-user-meta" title="ticket-attendee-info[MetaID]">
				<option value="0" selected="selected">Use New Attendee Info Fields</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width:170px"><?php _e( 'Attnedee Info Fields Group Name:', 'tribe-events-calendar' ); ?></td>
		<td>
			<input type="text" name="ticket-attendee-info[MetaFieldsName]" size="25" value="">
		</td>
	</tr>
	<tr>
		<td style="width:170px">
			<h5><?php _e( 'Add New Field:', 'tribe-events-calendar' ); ?></h5>
			<ul class="tribe-tickets-attendee-info-options">
				<li class="tribe-tickets-attendee-info-option">
					<a href="">Text <span class="dashicons dashicons-plus-alt"></span></a>
				</li>
				<li class="tribe-tickets-attendee-info-option">
					<a href="">Radio <span class="dashicons dashicons-plus-alt"></span></a>
				</li>
				<li class="tribe-tickets-attendee-info-option">
					<a href="">Checkbox <span class="dashicons dashicons-plus-alt"></span></a>
				</li>
				<li class="tribe-tickets-attendee-info-option">
					<a href="">Select <span class="dashicons dashicons-plus-alt"></span></a>
				</li>
			</ul>

		</td>
		<td>
			<h5><?php _e( 'Active Fields:', 'tribe-events-calendar' ); ?></h5>
			<div id="tribe-tickets-attendee-sortables" class="meta-box-sortables ui-sortable">
				<div id="tickets_attendee_info_field_1" class="tribe-tickets-attendee-info-active-field tribe-tickets-attendee-field postbox closed">
					<div class="handlediv" title="Click to toggle"><br></div>
					<h3 class="hndle ui-sortable-handle"><span>Text:</span> First Name</h3>

					<div class="inside">
						<div class="tribe-tickets-input tribe-tickets-input-text">
							<label for="tickets_attendee_info_field">Label:</label>
							<input type="text" name="tickets_attendee_info_field" value="">
						</div>
						<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
							<label class="prompt"><input type="checkbox" name="tickets_attendee_info_field_required">
								Required?</label>
						</div>
						<div class="tribe-tickets-delete-field">
							<a href="#">Delete this field</a>
						</div>
					</div>
				</div>
				<div id="tickets_attendee_info_field_2" class="tribe-tickets-attendee-info-active-field tribe-tickets-attendee-field postbox closed">
					<div class="handlediv" title="Click to toggle"><br></div>
					<h3 class="hndle ui-sortable-handle"><span>Select:</span> </h3>

					<div class="inside">
						<div class="tribe-tickets-input tribe-tickets-input-text">
							<label for="tickets_attendee_info_field">Label:</label>
							<input type="text" name="tickets_attendee_info_field" value="">
						</div>
						<div class="tribe-tickets-input tribe-tickets-input-textarea">
							<label for="tickets_attendee_info_field">Options (one per line)</label>
							<textarea name="tickets_attendee_info_field" value="" rows="5"></textarea>
						</div>
						<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
							<label class="prompt"><input type="checkbox" name="tickets_attendee_info_field_required">
								Required?</label>
						</div>
						<div class="tribe-tickets-delete-field">
							<a href="#">Delete this field</a>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
	</tbody>
</table>
