function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"product-management/Products/getProductsData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_products'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').val(data.name);
											jQuery('#meta_keywords').val(data.meta_keywords);
											jQuery('#id_product_type').val(data.id_product_type);
											jQuery('#id_warranty').val(data.id_warranty);
											jQuery('#id_currency').val(data.id_currency);
											jQuery('#id_weight').val(data.id_weight);
											jQuery('#id_gallery').val(data.id_gallery);
											jQuery('#parent').val(data.parent);
											jQuery('#short_description').val(data.short_description);
											CKEDITOR.instances.long_description.setData( data.long_description );
											jQuery('#price').val(data.price);
											jQuery('#discount').val(data.discount);
											jQuery('#price_discount').val(data.actual_price);
											jQuery('#ship_weight').val(data.ship_weight);
											jQuery('#warranty').val(data.warranty);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_products');
									}
		   });	
}

function save(){
	var id 			= jQuery('#id').val(),
		name 		= jQuery('#name').val(),
		meta_keywords= jQuery('#meta_keywords').val(),
		id_product_type = jQuery('#id_product_type').val(),
		id_warranty = jQuery('#id_warranty').val(),
		id_currency = jQuery('#id_currency').val(),
		id_weight 	= jQuery('#id_weight').val(),
		parent 		= jQuery('#parent').val(),
		short_description = jQuery('#short_description').val(),
		long_description = CKEDITOR.instances.long_description.getData(),
		price 		= jQuery('#price').val(),
		discount 	= jQuery('#discount').val(),
		ship_weight = jQuery('#ship_weight').val(),
		warranty 	= jQuery('#warranty').val(),
		status 		= jQuery('#status').is(':checked') ? 1 : 0,
		id_gallery = jQuery('#id_gallery').val(),
		path_ori = jQuery('#path_ori').val(),
		path_thumb = jQuery('#path_thumb').val(),
		url_ori = jQuery('#url_ori').val(),
		url_thumb = jQuery('#url_thumb').val(),
		mime_type = jQuery('#img_mime').val();
	
	var id = jQuery('#id').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		display = jQuery('#display').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_products');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"product-management/products/saveProducts",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_product_type' : id_product_type,
					'id_warranty' : id_warranty,
					'id_currency' : id_currency,
					'id_weight' : id_weight,
					'name' : name,
					'meta_keywords' : meta_keywords,
					'parent' : parent,
					'short_description' : short_description,
					'long_description' : long_description,
					'price' : price,
					'discount' : discount,
					'ship_weight' : ship_weight,
					'warranty' : warranty,
					'status' : status,
					'id_gallery' : id_gallery,
					'path_ori' : path_ori,
					'path_thumb' : path_thumb,
					'url_ori' : url_ori,
					'url_thumb' : url_thumb,
					'mime_type' : mime_type,
				  },
			beforeSend: loadingShow('#form_products'),
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
										loadingHide('#form_products')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_code').val('');
	jQuery('#search_name').val('');
	jQuery('#search_description').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#name').val('');
	jQuery('#meta_keywords').val('');
	jQuery('#id_product_type').val('');
	jQuery('#id_product_warranty').val('');
	jQuery('#id_currency').val('');
	jQuery('#id_weight').val('');
	jQuery('#parent').val('');
	jQuery('#short_description').val('');
	CKEDITOR.instances.long_description.setData('');
	jQuery('#price').val('');
	jQuery('#discount').val('');
	jQuery('#ship_weight').val('');
	jQuery('#warranty').val('');
	jQuery('#icon').val('');
	jQuery('#id_gallery').val('');	
	jQuery('#short_desc').val('');
	jQuery('#path_ori').val('');
	jQuery('#path_thumb').val('');
	jQuery('#url_ori').val('');
	jQuery('#url_thumb').val('');
	jQuery('#img_mime').val('');
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
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
