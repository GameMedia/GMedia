function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"content-management/videos/getVideosData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_videos'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').val(data.name);
											jQuery('#description').val(data.description);
											jQuery('#url').val(data.url);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_videos');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		url = jQuery('#url').val(),
		type = jQuery('#type').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_videos');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"content-management/videos/saveVideos",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'name' : name,
					'description' : description,
					'url' : url,
					'type' : type,
					'status' : status
				  },
			beforeSend: loadingShow('#form_videos'),
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
										loadingHide('#form_videos')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_url').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');		
	jQuery('#name').val('');	
	jQuery('#description').val('');	
	jQuery('#url').val('');	
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
