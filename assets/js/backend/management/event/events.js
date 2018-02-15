function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"event-management/events/getEventsData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_events'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').val(data.name);
											jQuery('#address').val(data.address);
											jQuery('#short_description').val(data.short_description);
											jQuery('#capacity').val(data.capacity);
											jQuery('#event_date').val(data.event_date);
											jQuery('#event_date_end').val(data.event_date_end);
											jQuery('#event_time').val(data.event_time);
											jQuery('#event_time_end').val(data.event_time_end);
											jQuery('#till_end').val(data.till_end);
											CKEDITOR.instances.long_description.setData( data.long_description );
												
											if(data.isRegister) {
												jQuery('#isRegister').attr('checked', 'checked');
											} else 
												jQuery('#isRegister').attr('checked');
																							
											bootstrapSwitch('isRegister', data.isRegister);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
																								
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_events');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		name = jQuery('#name').val(),
		short_description = jQuery('#short_description').val(),
		long_description = CKEDITOR.instances.long_description.getData(),
		address = jQuery('#address').val(),
		capacity = jQuery('#capacity').val(),
		event_date = jQuery('#event_date').val(),
		event_date_end = jQuery('#event_date_end').val(),
		event_time = jQuery('#event_time').val(),
		event_time_end = jQuery('#event_time_end').val(),
		till_end = '0',
		isRegister = jQuery('#isRegister').is(':checked') ? 1 : 0;
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_events');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"event-management/events/saveEvents",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'name' : name,
					'short_description' : short_description,
					'long_description' : long_description,
					'address' : address,
					'capacity' : capacity,
					'event_date' : event_date,
					'event_date_end' : event_date_end,
					'event_time' : event_time,
					'event_time_end' : event_time_end,
					'till_end' : till_end,
					'isRegister' : isRegister,
					'status' : status
				  },
			beforeSend: loadingShow('#form_events'),
			success: function(data) {
										sessOut(data);
										if(data.success){
                    						error.hide();
                    						UIToastr.showToaster("success", data.title, data.message);	
                    						$('#datatable').DataTable().ajax.reload();
											clearForm();
											jQuery(".btn-close-modal").trigger("click");
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										loadingHide('#form_events')
									}
		   });	
}
function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_description').val('');
	
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#name').val('');
	jQuery('#short_description').val('');
	CKEDITOR.instances.long_description.setData('');
	jQuery('#address').val('');
	jQuery('#capacity').val('');
	jQuery('#event_date').val('');
	jQuery('#event_date_end').val('');
	jQuery('#event_time').val('');
	jQuery('#event_time_end').val('');
	jQuery('#till_end').val('');
	
	jQuery('#isRegister').prop('checked', false);
	
	bootstrapSwitch('isRegister', false);
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
