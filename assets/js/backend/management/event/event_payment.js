function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"event-management/event_payment/getEvent_PaymentData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_event_payment'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_event').val(data.id_event);
											jQuery('#id_company').val(data.id_company);
											jQuery('#remarks').val(data.remarks);
											jQuery('#account_number').val(data.account_number);
											jQuery('#account_name').val(data.account_name);
											jQuery('#account_bank').val(data.account_bank);
											jQuery('#total').val(data.total);
												
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
										loadingHide('#form_event_payment');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_event = jQuery('#id_event').val(),
		id_company = jQuery('#id_company').val(),
		remarks = jQuery('#remarks').val(),
		account_name = jQuery('#account_name').val(),
		account_number = jQuery('#account_number').val(),
		account_bank = jQuery('#account_bank').val(),
		total = jQuery('#total').val(),
		isValidation = jQuery('#isValidation').is(':checked') ? 1 : 0;
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_event_payment');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"event-management/event_payment/saveEvent_Payment",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_event' : id_event,
					'id_company' : id_company,
					'remarks' : remarks,
					'account_name' : account_name,
					'account_number' : account_number,
					'account_bank' : account_bank,
					'total' : total,
					'isValidation' : isValidation,
					'status' : status
				  },
			beforeSend: loadingShow('#form_event_payment'),
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
										loadingHide('#form_event_payment')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_account_name').val('');
	jQuery('#search_id_event').val('');
	jQuery('#search_id_company').val('');
	
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#id_event').val('');	
	jQuery('#id_company').val('');	
	jQuery('#remarks').val('');
	jQuery('#account_name').val('');
	jQuery('#account_number').val('');
	jQuery('#account_bank').val('');
	jQuery('#total').val('');
	
	jQuery('#isValidation').prop('checked', false);
	
	bootstrapSwitch('isValidation', false);
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
