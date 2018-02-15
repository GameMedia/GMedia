function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"managing-masters/branch/getBranchData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_branch'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#address').val(data.address);
											jQuery('#name').val(data.name);
											jQuery('#phone').val(data.phone);
											jQuery('#fax').val(data.fax);
											jQuery('#email').val(data.email);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_branch');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		address = jQuery('#address').val(),
		name = jQuery('#name').val(),
		phone = jQuery('#phone').val(),
		fax = jQuery('#fax').val(),
		email = jQuery('#email').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_branch');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"managing-masters/branch/saveBranch",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'address' : address,
					'name' : name,
					'phone' : phone,
					'fax' : fax,
					'email' : email,
					'status' : status
				  },
			beforeSend: loadingShow('#form_branch'),
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
										loadingHide('#form_branch')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_address').val('');
	jQuery('#search_phone').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');
	jQuery('#address').val('');
	jQuery('#name').val('');
	jQuery('#phone').val('');
	jQuery('#fax').val('');
	jQuery('#email').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
