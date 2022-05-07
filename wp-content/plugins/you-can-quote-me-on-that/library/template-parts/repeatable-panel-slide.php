<tr class="panel <?php echo ( $hidden_panel ? 'hidden' : '' ); ?>">

	<td class="sort-handle">
		<i class="icon ycqmot-fa ycqmot-fa-arrows"></i>
	</td>
	
	<td class="width-65 no-padding">
		
		<div class="otb-content-container">
		
			<!-- Content -->
			<div class="content">
				<?php $this->create_form_control( 'you_can_quote_me_on_that_slide_quote', $this->repeatable_fieldset_settings ); ?>
				<?php $this->create_form_control( 'you_can_quote_me_on_that_slide_name', $this->repeatable_fieldset_settings ); ?>
				<?php $this->create_form_control( 'you_can_quote_me_on_that_slide_title', $this->repeatable_fieldset_settings ); ?>
				<?php $this->create_form_control( 'you_can_quote_me_on_that_slide_company', $this->repeatable_fieldset_settings ); ?>
			</div>
			
		</div>
	</td>
	
	<td class="remove-repeatable-panel">
		<a href="#" class="icon" title="Delete this testimonial">
			<i class="ycqmot-fa ycqmot-fa-times"></i>
		</a>
	</td>
	
</tr>
