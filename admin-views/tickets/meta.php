<tr>
	<td colspan="2">
		<?php /* save as checked if the ticket has attendee info */ ?>
		<label><input type="checkbox" name="show_attendee_info" id="show_attendee_info" class="ticket_field"> <?php _e( 'Ask for attendee information during  event registration?', 'tribe-events-calendar' ); ?></label>
	</td>
</tr>
<tr class="eventtable ticket_list tribe-tickets-attendee-info-form">
	<td colspan="2">
		<table class="eventtable">
			<tr>
				<td colspan="2" class="titlewrap">
					<h4 class="tribe_sectionheader">Attendee Information</h4>
				</td>
			</tr>
			<tr>
				<td style="width:20%"><?php _e( 'Use Saved Attendee Info Fields:', 'tribe-events-calendar' ); ?></td>
				<td>
					<select style="width: 20%" class="chosen ticket-attendee-info-dropdown" name="ticket-attendee-info[MetaID]"
					        id="saved_ticket-user-meta" title="ticket-attendee-info[MetaID]">
						<option value="0" selected="selected">Use New Attendee Info Fields</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width:20%"><?php _e( 'Attnedee Info Fields Group Name:', 'tribe-events-calendar' ); ?></td>
				<td>
					<input type="text" name="ticket-attendee-info[MetaFieldsName]" size="25" value="">
				</td>
			</tr>
			<tr>
				<td style="width:20%">
					<h5><?php _e( 'Add New Field:', 'tribe-events-calendar' ); ?></h5>
					<ul class="tribe-tickets-attendee-info-options">
						<li id="tribe-tickets-add-text" class="tribe-tickets-attendee-info-option">
							<a href="">Text <span class="dashicons dashicons-plus-alt"></span></a>
						</li>
						<li id="tribe-tickets-add-number" class="tribe-tickets-attendee-info-option">
							<a href="">Number <span class="dashicons dashicons-plus-alt"></span></a>
						</li>
						<li id="tribe-tickets-add-radio" class="tribe-tickets-attendee-info-option">
							<a href="">Radio <span class="dashicons dashicons-plus-alt"></span></a>
						</li>
						<li id="tribe-tickets-add-checkbox" class="tribe-tickets-attendee-info-option">
							<a href="">Checkbox <span class="dashicons dashicons-plus-alt"></span></a>
						</li>
						<li id="tribe-tickets-add-select" class="tribe-tickets-attendee-info-option">
							<a href="">Select <span class="dashicons dashicons-plus-alt"></span></a>
						</li>
					</ul>

				</td>
				<td>
					<h5><?php _e( 'Active Fields:', 'tribe-events-calendar' ); ?></h5>

					<div id="tribe-tickets-attendee-sortables" class="meta-box-sortables ui-sortable">
						<?php /* adding a unique ID to each item here */ ?>
						<div id="tickets_attendee_info_field_1"
						     class="tribe-tickets-attendee-info-active-field postbox closed">
							<div class="handlediv" title="Click to toggle"><br></div>
							<?php
							/*
								heading text should be populated by the value of the label field
								would be neat if it updated in real time as you typed in the label field
							 */
							?>
							<h3 class="hndle ui-sortable-handle"><span>Text:</span> First Name</h3>

							<div class="inside">
								<?php /* Begin text field */ ?>
								<div class="tribe-tickets-input tribe-tickets-input-text">
									<label for="tickets_attendee_info_field">Label:</label>
									<input type="text" name="tickets_attendee_info_field" value="">
								</div>
								<?php /* adding a class based on the input type (tribe-tickets-input-checkbox) */ ?>
								<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
									<label class="prompt"><input type="checkbox"
									                             name="tickets_attendee_info_field_required">
										Required?
									</label>
								</div>
								<div class="tribe-tickets-delete-field">
									<a href="#">Delete this field</a>
								</div>
								<?php /* End text field */ ?>
							</div>
						</div>
						<?php /* adding a unique ID to each item here */ ?>
						<div id="tickets_attendee_info_field_2"
						     class="tribe-tickets-attendee-info-active-field postbox closed">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle ui-sortable-handle"><span>Radio:</span></h3>

							<div class="inside">
								<?php /* Begin radio field */ ?>
								<div class="tribe-tickets-input tribe-tickets-input-text">
									<label for="tickets_attendee_info_field">Label:</label>
									<input type="text" name="tickets_attendee_info_field" value="">
								</div>
								<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
									<label class="prompt"><input type="checkbox"
									                             name="tickets_attendee_info_field_required">
										Required?
									</label>
								</div>
								<div class="tribe-tickets-input tribe-tickets-input-textarea">
									<label for="tickets_attendee_info_field">Options (one per line)</label>
									<textarea name="tickets_attendee_info_field" value="" rows="5"></textarea>
								</div>
								<div class="tribe-tickets-input tribe-tickets-input-text">
									<label for="tickets_attendee_info_field">Default Value:</label>
									<input type="text" name="tickets_attendee_info_field" value="">
								</div>
								<div class="tribe-tickets-delete-field">
									<a href="#">Delete this field</a>
								</div>
								<?php /* End radio field */ ?>
							</div>
						</div>
						<?php /* adding a unique ID to each item here */ ?>
						<div id="tickets_attendee_info_field_3"
						     class="tribe-tickets-attendee-info-active-field postbox closed">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle ui-sortable-handle"><span>Checkbox:</span></h3>

							<div class="inside">
								<?php /* Begin Checkbox field */ ?>
								<div class="tribe-tickets-input tribe-tickets-input-text">
									<label for="tickets_attendee_info_field">Label:</label>
									<input type="text" name="tickets_attendee_info_field" value="">
								</div>
								<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
									<label class="prompt"><input type="checkbox"
									                             name="tickets_attendee_info_field_required">
										Required?
									</label>
								</div>
								<div class="tribe-tickets-input tribe-tickets-input-textarea">
									<label for="tickets_attendee_info_field">Options (one per line)</label>
									<textarea name="tickets_attendee_info_field" value="" rows="5"></textarea>
								</div>
								<div class="tribe-tickets-delete-field">
									<a href="#">Delete this field</a>
								</div>
								<?php /* End checkbox field */ ?>
							</div>
						</div>
						<?php /* adding a unique ID to each item here */ ?>
						<div id="tickets_attendee_info_field_4"
						     class="tribe-tickets-attendee-info-active-field postbox closed">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle ui-sortable-handle"><span>Select:</span></h3>

							<div class="inside">
								<?php /* Begin select field */ ?>
								<div class="tribe-tickets-input tribe-tickets-input-text">
									<label for="tickets_attendee_info_field">Label:</label>
									<input type="text" name="tickets_attendee_info_field" value="">
								</div>
								<div class="tribe-tickets-input tribe-tickets-input-textarea">
									<label for="tickets_attendee_info_field">Options (one per line)</label>
									<textarea name="tickets_attendee_info_field" value="" rows="5"></textarea>
								</div>
								<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
									<label class="prompt"><input type="checkbox"
									                             name="tickets_attendee_info_field_required">
										Required?
									</label>
								</div>
								<div class="tribe-tickets-delete-field">
									<a href="#">Delete this field</a>
								</div>
								<?php /* End select field */ ?>
							</div>
						</div>
						<?php /* adding a unique ID to each item here */ ?>
						<div id="tickets_attendee_info_field_5"
						     class="tribe-tickets-attendee-info-active-field postbox closed">
							<div class="handlediv" title="Click to toggle"><br></div>
							<?php
							/*
								heading text should be populated by the value of the label field
								would be neat if it updated in real time as you typed in the label field
							 */
							?>
							<h3 class="hndle ui-sortable-handle"><span>Number:</span></h3>

							<div class="inside">
								<?php /* Begin text field */ ?>
								<div class="tribe-tickets-input tribe-tickets-input-text">
									<label for="tickets_attendee_info_field">Label:</label>
									<input type="text" name="tickets_attendee_info_field" value="">
								</div>
								<?php /* adding a class based on the input type (tribe-tickets-input-checkbox) */ ?>
								<div class="tribe-tickets-input tribe-tickets-input-checkbox tribe-tickets-required">
									<label class="prompt"><input type="checkbox"
									                             name="tickets_attendee_info_field_required">
										Required?
									</label>
								</div>
								<div class="tribe-tickets-delete-field">
									<a href="#">Delete this field</a>
								</div>
								<?php /* End text field */ ?>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</td>
</tr>
