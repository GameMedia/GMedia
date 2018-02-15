function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"member-management/abtc/getAbtcData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_abtc'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data['id']);											
											jQuery('#id_company').val(data['id_company']);
											jQuery('#name').val(data['name']);
											jQuery('#gender').val(data['gender']);
											jQuery('#birth_place').val(data['birth_place']);
											jQuery('#birth_date').val(data['birth_date']);
											jQuery('#address').val(data['address']);
											jQuery('#city').val(data['city']);
											jQuery('#ziptal_code').val(data['ziptal_code']);
											jQuery('#phone').val(data['phone']);
											jQuery('#occupation').val(data['occupation']);
											jQuery('#company').val(data['company']);
											jQuery('#field').val(data['field']);
											jQuery('#office_address').val(data['office_address']);
											jQuery('#office_city').val(data['office_city']);
											jQuery('#office_ziptal_code').val(data['office_ziptal_code']);
											jQuery('#office_phone').val(data['office_phone']);
											jQuery('#office_fax').val(data['office_fax']);
											jQuery('#office_email').val(data['office_email']);
											jQuery('#reference_address').val(data['reference_address']);
											jQuery('#reference_city').val(data['reference_city']);
											jQuery('#reference_ziptal_code').val(data['reference_ziptal_code']);
											jQuery('#reference_phone').val(data['reference_phone']);
											jQuery('#reference_fax').val(data['reference_fax']);
											jQuery('#reference_email').val(data['reference_email']);
											jQuery('#paspor_no').val(data['paspor_no']);
											jQuery('#paspor_date').val(data['paspor_date']);
											jQuery('#paspor_issue').val(data['paspor_issue']);
											jQuery('#paspor_expired').val(data['paspor_expired']);
											jQuery('#identification_no').val(data['identification_no']);
											jQuery('#identification_expired').val(data['identification_expired']);
											
											jQuery('#status').val(data['status']);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_abtc');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_company = jQuery('#id_company').val(),
		name = jQuery('#name').val(),
		gender = jQuery('#gender').val(),
		birth_place = jQuery('#birth_place').val(),
		birth_date = jQuery('#birth_date').val(),
		address = jQuery('#address').val(),
		city = jQuery('#city').val(),
		ziptal_code = jQuery('#ziptal_code').val(),
		phone = jQuery('#phone').val(),
		occupation = jQuery('#occupation').val(),
		company = jQuery('#company').val(),
		field = jQuery('#field').val(),
		office_address = jQuery('#office_address').val(),
		office_city = jQuery('#office_city').val(),
		office_ziptal_code = jQuery('#office_ziptal_code').val(),
		office_phone = jQuery('#office_phone').val(),
		office_fax = jQuery('#office_fax').val(),
		office_email = jQuery('#office_email').val(),
		reference_address = jQuery('#reference_address').val(),
		reference_city = jQuery('#reference_city').val(),
		reference_ziptal_code = jQuery('#reference_ziptal_code').val(),
		reference_phone = jQuery('#reference_phone').val(),
		reference_fax = jQuery('#reference_fax').val(),
		reference_email = jQuery('#reference_email').val(),
		paspor_no = jQuery('#paspor_no').val(),
		paspor_date = jQuery('#paspor_date').val(),
		paspor_issue = jQuery('#paspor_issue').val(),
		paspor_expired = jQuery('#paspor_expired').val(),
		identification_no = jQuery('#identification_no').val(),
		identification_expired = jQuery('#identification_expired').val(),
		status = jQuery('#status').val();
	
	var form = $('#form_abtc');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"member-management/abtc/saveAbtc",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_company' : id_company,
					'name' : name,
					'gender' : gender,
					'birth_place' : birth_place,
					'birth_date' : birth_date,
					'address' : address,
					'city' : city,
					'ziptal_code' : ziptal_code,
					'phone' : phone,
					'occupation' : occupation,
					'company' : company,
					'field' : field,
					'office_address' : office_address,
					'office_city' : office_city,
					'office_ziptal_code' : office_ziptal_code,
					'office_phone' : office_phone,
					'office_fax' : office_fax,
					'office_email' : office_email,
					'office_reference_address' : reference_address,
					'reference_address' : reference_address,
					'reference_city' : reference_city,
					'reference_ziptal_code' : reference_ziptal_code,
					'reference_phone' : reference_phone,
					'reference_fax' : reference_fax,
					'reference_email' : reference_email,
					'paspor_no' : paspor_no,
					'paspor_date' : paspor_date,
					'paspor_issue' : paspor_issue,
					'paspor_expired' : paspor_expired,
					'identification_no' : identification_no,
					'identification_expired' : identification_expired,
					'status' : status
				  },
			beforeSend: loadingShow('#form_abtc'),
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
										loadingHide('#form_abtc')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_id_company').val('');
	jQuery('#search_paspor_no').val('');
	jQuery('#search_phone').val('');
	jQuery('#search_status').val('');
}

function clearForm(){	
	jQuery('#id').val('');
	jQuery('#id_company').val('');
	jQuery('#name').val('');
	jQuery('#gender').val('');
	jQuery('#birth_place').val('');
	jQuery('#birth_date').val('');
	jQuery('#address').val('');
	jQuery('#city').val('');
	jQuery('#ziptal_code').val('');
	jQuery('#phone').val('');
	jQuery('#occupation').val('');
	jQuery('#company').val('');
	jQuery('#field').val('');
	jQuery('#office_address').val('');
	jQuery('#office_city').val('');
	jQuery('#office_ziptal_code').val('');
	jQuery('#office_phone').val('');
	jQuery('#office_fax').val('');
	jQuery('#office_email').val('');
	jQuery('#reference_address').val('');
	jQuery('#reference_city').val('');
	jQuery('#reference_ziptal_code').val('');
	jQuery('#reference_phone').val('');
	jQuery('#reference_fax').val('');
	jQuery('#reference_email').val('');
	jQuery('#paspor_no').val('');
	jQuery('#paspor_date').val('');
	jQuery('#paspor_issue').val('');
	jQuery('#paspor_expired').val('');
	jQuery('#identification_no').val('');
	jQuery('#identification_expired').val('');
}

