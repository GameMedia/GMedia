function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"member-management/ipka/getIpkaData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_ipka'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data['id']);
											jQuery('#id_company').val(data['id_company']);
											jQuery('#id_ship_type').val(data['id_ship_type']);
											jQuery('#nama_kapal').val(data['nama_kapal']);
											jQuery('#status_kapal').val(data['status_kapal']);
											jQuery('#bendera').val(data['bendera']);
											jQuery('#class').val(data['class']);
											jQuery('#call_sign').val(data['call_sign']);
											jQuery('#principal').val(data['principal']);
											jQuery('#ukuran').val(data['ukuran']);
											jQuery('#grt').val(data['grt']);
											jQuery('#nt').val(data['nt']);
											jQuery('#tenaga').val(data['tenaga']);
											jQuery('#pencharter').val(data['pencharter']);
											jQuery('#start_date').val(data['start_date']);
											jQuery('#end_date').val(data['end_date']);
											jQuery('#status').val(data['status']);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_ipka');
									}
		   });	
}

function save(){	
	var id = jQuery('#id').val(),
		id_company = jQuery('#id_company').val(),
		id_ship_type = jQuery('#id_ship_type').val(),
		nama_kapal = jQuery('#nama_kapal').val(),
		status_kapal = jQuery('#status_kapal').val(),
		bendera = jQuery('#bendera').val(),
		class_ = jQuery('#class').val(),
		call_sign = jQuery('#call_sign').val(),
		principal = jQuery('#principal').val(),
		ukuran = jQuery('#ukuran').val(),
		grt = jQuery('#grt').val(),
		nt = jQuery('#nt').val(),
		tenaga = jQuery('#tenaga').val(),
		pencharter = jQuery('#pencharter').val(),
		start_date = jQuery('#start_date').val(),
		end_date = jQuery('#end_date').val(),
		status = jQuery('#status').val();
	
	var form = $('#form_ipka');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"member-management/ipka/saveIpka",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_company' : id_company,
					'id_ship_type' : id_ship_type,
					'nama_kapal' : nama_kapal,
					'status_kapal' : status_kapal,
					'bendera' : bendera,
					'class' : class_,
					'call_sign' : call_sign,
					'principal' : principal,
					'ukuran' : ukuran,
					'grt' : grt,
					'nt' : nt,
					'tenaga' : tenaga,
					'pencharter' : pencharter,
					'start_date' : start_date,
					'end_date' : end_date,
					'status' : status
				  },
			beforeSend: loadingShow('#form_ipka'),
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
										loadingHide('#form_ipka')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_nama_kapal').val('');
	jQuery('#search_url').val('');
	jQuery('#search_status').val('');
}

function clearForm(){	
	jQuery('#id').val('');	
	jQuery('#nama_kapal').val('');
	jQuery('#id_company').val('');
	jQuery('#id_ship_type').val('');
	jQuery('#status_kapal').val('');
	jQuery('#bendera').val('');
	jQuery('#call_sign').val('');
	jQuery('#principal').val('');
	jQuery('#ukuran').val('');
	jQuery('#grt').val('');
	jQuery('#nt').val('');
	jQuery('#tenaga').val('');
	jQuery('#pencharter').val('');
	jQuery('#start_date').val('');
	jQuery('#end_date').val('');
}

