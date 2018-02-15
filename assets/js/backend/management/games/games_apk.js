function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"games-management/games_apk/getGames_ApkData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_games_apk'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#type').val(data.type);
											jQuery('#name').val(data.name);
											jQuery('#description').val(data.description);
											jQuery('#path_ori').val(data.path_ori);
											jQuery('#url_ori').val(data.url_ori);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_games_apk');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		type = jQuery('#type').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		path_ori = jQuery('#path_ori').val(),
		url_ori = jQuery('#url_ori').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_games_apk');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"games-management/games_apk/saveGames_Apk",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'type' : type,
					'name' : name,
					'description' : description,
					'path_ori' : path_ori,
					'url_ori' : url_ori,
					'status' : status
				  },
			beforeSend: loadingShow('#form_games_apk'),
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
										loadingHide('#form_games_apk')
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
	jQuery('#path_ori').val('');
	jQuery('#url_ori').val('');
	jQuery('#display-text').html('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}

$(function () {
    'use strict';
    $('#fileupload').fileupload({
		url: domain+"games-management/games_apk/uploadGames_Apk?files",
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
				jQuery('#path_ori').val(data.files['path_ori']);
				jQuery('#url_ori').val(data.files['url_ori']);
				jQuery('#display-text').html(domain+data.files['url_ori']);
			} else {
				$('.progress-bar').css(
					'width', '0%'
				);
				UIToastr.showToaster("error", "Upload Games", data.message);
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
