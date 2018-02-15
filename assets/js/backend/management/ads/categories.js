function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"ads-management/categories/getCategoriesData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_categories'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#code').val(data.code);
											jQuery('#name').val(data.name);
											jQuery('#position').val(data.position);
											jQuery('#width').val(data.width);
											jQuery('#height').val(data.height);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_categories');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		code = jQuery('#code').val(),
		name = jQuery('#name').val(),
		position = jQuery('#position').val(),
		width = jQuery('#width').val(),
		height = jQuery('#height').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_categories');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"ads-management/categories/saveCategories",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'code' : code,
					'name' : name,
					'position' : position,
					'width' : width,
					'height' : height,
					'status' : status
				  },
			beforeSend: loadingShow('#form_categories'),
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
										loadingHide('#form_categories')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_code').val('');
	jQuery('#search_position').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');
	jQuery('#code').val('');
	jQuery('#name').val('');
	jQuery('#position').val('');
	jQuery('#width').val('');
	jQuery('#height').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
