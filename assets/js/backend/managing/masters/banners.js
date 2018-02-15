function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"managing-masters/banners/getBannersData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_banners'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#type').val(data.type);
											jQuery('#name').val(data.name);
											jQuery('#description').val(data.description);
																						
											if(data.type == 'Video'){
												jQuery('#type-image').css('display', 'none');
												jQuery('#type-video').css('display', 'inline');
												jQuery('#video').val();
												jQuery('#video').val();
												jQuery('#video').val();
												jQuery('#video').val();
											} else if(data.type == 'Image'){
												jQuery('#type-image').css('display', 'inline');
												jQuery('#type-video').css('display', 'none');
												jQuery('#path_ori').val(data.path_ori);
												jQuery('#path_thumb').val(data.path_thumb);
												jQuery('#url_thumb').val(data.url_thumb);
												jQuery('#url_ori').val(data.url_ori);
											}
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
										loadingHide('#form_banners');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		type = jQuery('#type').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
		
		if(type == 'Video'){
			var path_ori = jQuery('#video').val(),
				path_thumb = jQuery('#video').val(),
				url_thumb = jQuery('#video').val(),
				url_ori = jQuery('#video').val();
		} else if(type == 'Image'){
			var path_ori = jQuery('#path_ori').val(),
				path_thumb = jQuery('#path_thumb').val(),
				url_thumb = jQuery('#url_thumb').val(),
				url_ori = jQuery('#url_ori').val();
		}
	
	var form = $('#form_banners');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"managing-masters/banners/saveBanners",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'type' : type,
					'name' : name,
					'description' : description,
					'path_ori' : path_ori,
					'path_thumb' : path_thumb,
					'url_ori' : url_ori,
					'url_thumb' : url_thumb,
					'status' : status
				  },
			beforeSend: loadingShow('#form_banners'),
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
										loadingHide('#form_banners')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_type').val('');
	jQuery('#search_name').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#type').val('');
	jQuery('#name').val('');
	jQuery('#description').val('');
	jQuery('#video').val('');
	jQuery('#path_ori').val('');
	jQuery('#path_thumb').val('');
	jQuery('#url_ori').val('');
	jQuery('#url_thumb').val('');
	jQuery('#img_mime').val('');
	jQuery('#display-banner').html('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}

function checkType(value){
	if(value == 'Video'){
		jQuery('#type-image').css('display', 'none');
		jQuery('#type-video').css('display', 'inline');
	} else if(value == 'Image'){
		jQuery('#type-image').css('display', 'inline');
		jQuery('#type-video').css('display', 'none');
	} else {
		jQuery('#type-image').css('display', 'none');
		jQuery('#type-video').css('display', 'none');
	}
}

$(function () {
    'use strict';
    $('#fileupload').fileupload({
		url: domain+"managing-masters/banners/uploadBanners?files",
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
				jQuery('#path_thumb').val(data.files['path_ori']);
				jQuery('#url_ori').val(data.files['url_ori']);
				jQuery('#url_thumb').val(data.files['url_ori']);
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
