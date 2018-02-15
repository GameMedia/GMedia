function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"ads-management/ads_bank/getAds_BankData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_ads_bank'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_ads_category').val(data.id_ads_category);
											jQuery('#id_company').val(data.id_company);
											jQuery('#name').val(data.name);
											jQuery('#path_ori').val(data.path_ori);
											jQuery('#redirect_url').val(data.redirect_url);
											jQuery('#url_ori').val(data.url_ori);
											jQuery('#publish_date').val(data.publish_date);
											jQuery('#unpublish_date').val(data.unpublish_date);
											jQuery('#display').html('<img src="'+data.url+data.url_ori+'" width="100" />').css('display','inline');
											
											jQuery('#status').val(data.status);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_ads_bank');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_ads_category = jQuery('#id_ads_category').val(),
		id_company = jQuery('#id_company').val(),
		name = jQuery('#name').val(),
		redirect_url = jQuery('#redirect_url').val(),
		path_ori = jQuery('#path_ori').val(),
		url_ori = jQuery('#url_ori').val(),
		publish_date = jQuery('#publish_date').val(),
		unpublish_date = jQuery('#unpublish_date').val(),
		status = jQuery('#status').val();
	
	var form = $('#form_ads_bank');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"ads-management/ads_bank/saveAds_Bank",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_ads_category' : id_ads_category,
					'id_company' : id_company,
					'name' : name,
					'redirect_url' : redirect_url,
					'path_ori' : path_ori,
					'url_ori' : url_ori,
					'publish_date' : publish_date,
					'unpublish_date' : unpublish_date,
					'status' : status
				  },
			beforeSend: loadingShow('#form_ads_bank'),
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
										loadingHide('#form_ads_bank')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_id_ads_category').val('');
	jQuery('#search_id_company').val('');
	
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#id_ads_category').val('');	
	jQuery('#id_company').val('');	
	jQuery('#name').val('');
	jQuery('#redirect_url').val('');
	jQuery('#path_ori').val('');
	jQuery('#url_ori').val('');
	jQuery('#publish_date').val('');
	jQuery('#unpublish_date').val('');
	jQuery('#display').html('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
	
	jQuery('#update_by').html('');
	jQuery('#update_time').html('');
}

$(function () {
    'use strict';
    $('#fileupload').fileupload({
		url: domain+"ads-management/ads_bank/uploadAds_Bank?files",
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
				jQuery('#file_mime').val(data.files['img_mime']);
				jQuery('#display').html('<img src="'+data.icon+'" width="100" />').css('display','inline');
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
