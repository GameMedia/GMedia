function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"event-management/event_members/getEvent_MembersData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_event_members'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_event').val(data.id_event);
											jQuery('#id_company').val(data.id_company);
											jQuery('#name').val(data.name);
											jQuery('#address').val(data.address);
											jQuery('#gender').val(data.gender);
											jQuery('#phone').val(data.phone);
											jQuery('#email').val(data.email);
												
											if(data.isValidation) {
												jQuery('#isValidation').attr('checked', 'checked');
											} else 
												jQuery('#isValidation').attr('checked');
																							
											bootstrapSwitch('isValidation', data.isValidation);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
																								
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_event_members');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_event = jQuery('#id_event').val(),
		id_company = jQuery('#id_company').val(),
		name = jQuery('#name').val(),
		gender = jQuery('#gender').val(),
		address = jQuery('#address').val(),
		phone = jQuery('#phone').val(),
		email = jQuery('#email').val(),
		isValidation = jQuery('#isValidation').is(':checked') ? 1 : 0;
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_event_members');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"event-management/event_members/saveEvent_Members",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_event' : id_event,
					'id_company' : id_company,
					'name' : name,
					'gender' : gender,
					'address' : address,
					'phone' : phone,
					'email' : email,
					'isValidation' : isValidation,
					'status' : status
				  },
			beforeSend: loadingShow('#form_event_members'),
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
										loadingHide('#form_event_members')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_id_event').val('');
	jQuery('#search_id_company').val('');
	
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#id_event').val('');	
	jQuery('#id_company').val('');	
	jQuery('#name').val('');
	jQuery('#gender').val('');
	jQuery('#address').val('');
	jQuery('#phone').val('');
	jQuery('#email').val('');
	
	jQuery('#isValidation').prop('checked', false);
	
	bootstrapSwitch('isValidation', false);
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
