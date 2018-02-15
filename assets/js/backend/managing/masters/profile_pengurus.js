function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"managing-masters/profile_pengurus/getProfile_PengurusData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_profile_pengurus'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#position').val(data.position);
											jQuery('#name').val(data.name);
											jQuery('#description').val(data.description);
											jQuery('#path_ori').val(data.path_ori);
											jQuery('#path_thumb').val(data.path_thumb);
											jQuery('#url_ori').val(data.url_ori);
											jQuery('#url_thumb').val(data.url_thumb);
											jQuery('#img_mime').val(data.mime_type);
											jQuery('#display-banner').html('<img src="'+data.url+data.url_thumb+'" />').css('display','inline');
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_profile_pengurus');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		position = jQuery('#position').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		path_ori = jQuery('#path_ori').val(),
		path_thumb = jQuery('#path_thumb').val(),
		url_ori = jQuery('#url_ori').val(),
		url_thumb = jQuery('#url_thumb').val(),
		mime_type = jQuery('#img_mime').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_profile_pengurus');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"managing-masters/profile_pengurus/saveProfile_Pengurus",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'position' : position,
					'name' : name,
					'description' : description,
					'path_ori' : path_ori,
					'path_thumb' : path_thumb,
					'url_ori' : url_ori,
					'url_thumb' : url_thumb,
					'mime_type' : mime_type,
					'status' : status
				  },
			beforeSend: loadingShow('#form_profile_pengurus'),
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
										loadingHide('#form_profile_pengurus')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_position').val('');
	jQuery('#search_name').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#position').val('');
	jQuery('#name').val('');
	jQuery('#description').val('');
	jQuery('#path_ori').val('');
	jQuery('#path_thumb').val('');
	jQuery('#url_ori').val('');
	jQuery('#url_thumb').val('');
	jQuery('#img_mime').val('');
	jQuery('#display-banner').html('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}

$(function () {
    'use strict';
    $('#fileupload').fileupload({
		url: domain+"managing-masters/profile_pengurus/uploadProfile_Pengurus?files",
		type: 'POST',
		cache: false,
		dataType: 'json',
		processData: false, // Don't process the files
		mastersType: false, // Set masters type to false as jQuery will tell the server its a query string request,
        progressall: function (e, data) {
			$('.progress-bar').css(
                'width', '0%'
            );
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
		success: function(data, textStatus, jqXHR)
		{
			if(data.status){
				jQuery('#id_gallery').val('');
				jQuery('#path_ori').val(data.files['path_ori']);
				jQuery('#path_thumb').val(data.files['path_thumb']);
				jQuery('#url_ori').val(data.files['url_ori']);
				jQuery('#url_thumb').val(data.files['url_thumb']);
				jQuery('#img_width').val(data.files['img_width']);
				jQuery('#img_height').val(data.files['img_height']);
				jQuery('#img_mime').val(data.files['img_mime']);
				jQuery('#display-banner').html('<img src="'+data.icon+'" width="100" />').css('display','inline');
			} else {
				$('.progress-bar').css(
					'width', '0%'
				);
				UIToastr.showToaster("error", "Upload Banner", data.message);
			}
			loadingHide('body');
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			console.log('ERRORS: ' + textStatus);
			// STOP LOADING SPINNER
		}
	});
});
