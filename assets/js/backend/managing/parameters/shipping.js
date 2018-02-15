function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"managing-parameters/Shipping/getShippingData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_shipping'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_state').val(data.id_state);
											jQuery('#price').val(data.price);
											jQuery('#etd').val(data.etd);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_shipping');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_state = jQuery('#id_state').val(),
		price = jQuery('#price').val(),
		etd = jQuery('#etd').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_shipping');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"managing-parameters/shipping/saveShipping",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_state' : id_state,
					'price' : price,
					'etd' : etd,
					'status' : status
				  },
			beforeSend: loadingShow('#form_shipping'),
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
										loadingHide('#form_shipping')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_price').val('');
	jQuery('#search_id_state').val('');
	jQuery('#search_etd').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');
	jQuery('#price').val('');
	jQuery('#etd').val('');
	jQuery('#id_state').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
