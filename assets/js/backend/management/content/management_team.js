function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"content-management/management_team/getManagement_TeamData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_contents'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_gallery').val(data.id_gallery);
											jQuery('#position').val(data.position);
											jQuery('#name').val(data.name);
											jQuery('#short_desc').val(data.short_desc);
											jQuery('#sequence').val(data.sequence);
											CKEDITOR.instances.long_desc.setData( data.long_desc );
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_contents');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_gallery = jQuery('#id_gallery').val(),
		position = jQuery('#position').val(),
		name = jQuery('#name').val(),
		short_desc = jQuery('#short_desc').val(),
		long_desc = CKEDITOR.instances.long_desc.getData(),
		path_ori = jQuery('#path_ori').val(),
		path_thumb = jQuery('#path_thumb').val(),
		url_ori = jQuery('#url_ori').val(),
		url_thumb = jQuery('#url_thumb').val(),
		mime_type = jQuery('#img_mime').val(),
		sequence = jQuery('#sequence').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_contents');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"content-management/management_team/saveManagement_Team",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_gallery' : id_gallery,
					'position' : position,
					'name' : name,
					'short_desc' : short_desc,
					'long_desc' : long_desc,
					'path_ori' : path_ori,
					'path_thumb' : path_thumb,
					'url_ori' : url_ori,
					'url_thumb' : url_thumb,
					'mime_type' : mime_type,
					'sequence' : sequence,
					'status' : status
				  },
			beforeSend: loadingShow('#form_contents'),
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
										loadingHide('#form_contents')
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
	jQuery('#id_gallery').val('');	
	jQuery('#position').val('');
	jQuery('#name').val('');
	jQuery('#short_desc').val('');
	CKEDITOR.instances.long_desc.setData('');
	jQuery('#path_ori').val('');
	jQuery('#path_thumb').val('');
	jQuery('#url_ori').val('');
	jQuery('#url_thumb').val('');
	jQuery('#img_mime').val('');
	jQuery('#sequence').val('');
	
	jQuery('#status').prop('checked', true);
	
	bootstrapSwitch('status', true);
}

$(function () {
    'use strict';
    $('#fileupload').fileupload({
		url: domain+"managing-masters/galleries/uploadGalleries?files",
		type: 'POST',
		cache: false,
		dataType: 'json',
		processData: false, // Don't process the files
		contentType: false, // Set content type to false as jQuery will tell the server its a query string request,
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
