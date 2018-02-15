function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"transactions/order/getOrderData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_order'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').html(data.first_name + ' ' + data.last_name);
											jQuery('#address').html(data.address);
											jQuery('#city').html(data.city);
											jQuery('#state').html(data.state);
											jQuery('#ziptal-code').html(data.ziptal_code);
											jQuery('#phone').html(data.phone);
											jQuery('#additional-info').html(data.additional_info);
											
											jQuery('#billing-name').html(data.billing_first_name + ' ' + data.billing_last_name);
											jQuery('#billing-address').html(data.billing_address);
											jQuery('#billing-city').html(data.billing_city);
											jQuery('#billing-state').html(data.billing_state);
											jQuery('#billing-ziptal-code').html(data.billing_ziptal_code);
											jQuery('#billing-phone').html(data.billing_phone);
											jQuery('#status').val(data.status);
											jQuery('#status-display').html(data.status);
											
											jQuery('#payment-account-bank-destination').html(data.payment_account_bank_destination);
											jQuery('#payment-account-bank').html(data.payment_account_bank);
											jQuery('#payment-account-number').html(data.payment_account_number);
											jQuery('#payment-account-name').html(data.payment_account_name);
											jQuery('#payment-date').html(data.payment_date);
											jQuery('#payment-total').html(data.payment_total_display);
											
											var body = "";
											for(var i=0; i<data.details.length; i++){
												body += '<tr>';
												body += '	<td class="p-image">';
												body += '		<a href="products/detail/'+data.details[i]['code']+'"><img alt="" src="'+data.details[i]['url_ori']+'" class="floatleft" style="height:95px;width:95px"></a>';
												body += '	</td>';
												body += '	<td class="p-name"><a href="products/detail/'+data.details[i]['code']+'"> '+data.details[i]['name_product']+' </a></td>';
												body += '	<td class="edit"></td>';
												body += '	<td class="p-amount">'+data.details[i]['actual_price_display']+'</td>';
												body += '	<td class="p-quantity">'+data.details[i]['qty']+'</td>';
												body += '	<td class="p-total">'+data.details[i]['subtotal_display']+'</td>';
												body += '</tr>';
											}
											
											jQuery('#detail-product').html(body);
											
											jQuery('#payment-method').html(data.payment_method);
											jQuery('#shippingFee').html(data.shipping_fee_display);
											jQuery('#subTotal').html(data.subtotal_display);
											jQuery('#grandTotal').html(data.grandtotal_display);
											jQuery('#meta_keywords').val(data.meta_keywords);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_order');
									}
		   });	
}

function save(){
	var id 			= jQuery('#id').val(),
		status 		= jQuery('#status').val();
	
	var form = $('#form_order');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"transactions/order/saveOrder",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'status' : status
				  },
			beforeSend: loadingShow('#form_order'),
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
										loadingHide('#form_order')
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
	jQuery('#name').html('');
	jQuery('#address').html('');
	jQuery('#city').html('');
	jQuery('#state').html('');
	jQuery('#ziptal-code').html('');
	jQuery('#phone').html('');
	jQuery('#additional-info').html('');
	
	jQuery('#billing-name').html('');
	jQuery('#billing-address').html('');
	jQuery('#billing-city').html('');
	jQuery('#billing-state').html('');
	jQuery('#billing-ziptal-code').html('');
	jQuery('#billing-phone').html('');
	jQuery('#status').val('');
	jQuery('#status-display').html('');
	
	jQuery('#payment-account-bank-destination').html('');
	jQuery('#payment-account-bank').html('');
	jQuery('#payment-account-number').html('');
	jQuery('#payment-account-name').html('');
	jQuery('#payment-date').html('');
	jQuery('#payment-total').html('');
	jQuery('#detail-product').html('');
	
	jQuery('#payment-method').html('');
	jQuery('#shippingFee').html('');
	jQuery('#subTotal').html('');
	jQuery('#grandTotal').html('');
	jQuery('#update_by').html('');
	jQuery('#update_time').html('');
}
