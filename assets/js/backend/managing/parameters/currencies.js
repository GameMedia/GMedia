function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"managing-parameters/Currencies/getCurrenciesData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_currencies'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_country').val(data.id_country);
											jQuery('#code').val(data.code);
											jQuery('#name').val(data.name);
											jQuery('#description').val(data.description);
											jQuery('#display').val(data.display);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_currencies');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_country = jQuery('#id_country').val(),
		code = jQuery('#code').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		display = jQuery('#display').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_currencies');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"managing-parameters/currencies/saveCurrencies",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_country' : id_country,
					'code' : code,
					'name' : name,
					'description' : description,
					'display' : display,
					'status' : status
				  },
			beforeSend: loadingShow('#form_currencies'),
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
										loadingHide('#form_currencies')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_code').val('');
	jQuery('#search_name').val('');
	jQuery('#search_id_country').val('');
	jQuery('#search_display').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#code').val('');	
	jQuery('#name').val('');	
	jQuery('#description').val('');	
	jQuery('#display').val('');	
	jQuery('#id_country').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
