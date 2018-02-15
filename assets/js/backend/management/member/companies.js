function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"member-management/companies/getCompaniesData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_companies'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.companies['id']);
											jQuery('#name').val(data.companies['name']);
											jQuery('#modal_disetor').val(data.companies['modal_disetor']);
											jQuery('#email').val(data.companies['email']);
											jQuery('#business_fields').val(data.companies['id_business_field']);
											jQuery('#address').val(data.companies['address']);
											jQuery('#city').val(data.companies['city']);
											jQuery('#region').val(data.companies['region']);
											jQuery('#id_country').val(data.companies['id_country']);
											jQuery('#ziptal_code').val(data.companies['ziptal_code']);
											jQuery('#phone').val(data.companies['phone']);
											jQuery('#fax').val(data.companies['fax']);
											jQuery('#npwp').val(data.companies['npwp']);
											jQuery('#website').val(data.companies['website']);
											jQuery('#status').val(data.companies['status']);
											
											for(var i=0; i<data.business_type.length; i++){
												$('#business_types_'+data.business_type[i]['id_business_field']).prop('checked', true);
												$('#business_types_'+data.business_type[i]['id_business_field']).parent().attr('class', 'checked');
											}
																						
											for(var i=0; i<data.komisaris.length; i++){
												if(data.komisaris[i]['type'] == 'Komisaris')
													addKomisaris(i, data.komisaris[i]['name'], data.komisaris[i]['id_position']);
													
												if(data.komisaris[i]['type'] == 'Direksi')
													addDireksi(i, data.komisaris[i]['name'], data.komisaris[i]['id_position']);
											}
											
											for(var i=0; i<data.armada.length; i++){
													addArmada(i, data.armada[i]['name'], data.armada[i]['id_ship_type'], data.armada[i]['gt']);
											}
											
											for(var i=0; i<data.pic.length; i++){
													addPic(i, data.pic[i]['name'], data.pic[i]['id_position'], data.pic[i]['email'], data.pic[i]['phone']);
											}
											
											for(var i=0; i<data.files.length; i++){
												if(data.files[i]['type'] == "SKMENKUMHAM")
													jQuery('#skkemenkumham').html("<a href='"+data.url+data.files[i]['url_ori']+"' target='_blank'>SK Kementrian Hukum dan Ham</a>");
													
												if(data.files[i]['type'] == "SIUPAL-SIOPSUS")
													jQuery('#siupal_siopsus').html("<a href='"+data.url+data.files[i]['url_ori']+"' target='_blank'>SIUPAL/SIOPSUS</a>");
													
												if(data.files[i]['type'] == "Logo Perusahaan")
													jQuery('#logo').html("<a href='"+data.url+data.files[i]['url_ori']+"' target='_blank'>Logo Perusahaan</a>");
													
												if(data.files[i]['type'] == "Foto Kapal")
													jQuery('#foto_kapal').html("<a href='"+data.url+data.files[i]['url_ori']+"' target='_blank'>Foto Kapal</a>");
											}
											jQuery('#update_by').html(data.companies['update_by']);
											jQuery('#update_time').html(data.companies['update_time']);
										} else {
											
										}
										loadingHide('#form_companies');
									}
		   });	
}

function save(){
	jQuery("#btn-regenerate").trigger("click");
}

function saveAct(send){	
	
	var id = jQuery('#id').val(),
		name = jQuery('#name').val(),
		modal_disetor = jQuery('#modal_disetor').val(),
		email = jQuery('#email').val(),
		id_business_field = jQuery('#business_fields').val(),
		address = jQuery('#address').val(),
		city = jQuery('#city').val(),
		region = jQuery('#region').val(),
		id_country = jQuery('#id_country').val(),
		ziptal_code = jQuery('#ziptal_code').val(),
		phone = jQuery('#phone').val(),
		fax = jQuery('#fax').val(),
		npwp = jQuery('#npwp').val(),
		website = jQuery('#website').val(),
		status = jQuery('#status').val();
	
	var form = $('#form_companies');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"member-management/companies/saveCompanies",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'name' : name,
					'modal_disetor' : modal_disetor,
					'email' : email,
					'id_business_field' : id_business_field,
					'address' : address,
					'city' : city,
					'region' : region,
					'id_country' : id_country,
					'ziptal_code' : ziptal_code,
					'phone' : phone,
					'fax' : fax,
					'npwp' : npwp,
					'website' : website,
					'status' : status,
					'send' : send
				  },
			beforeSend: loadingShow('#form_companies'),
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
										loadingHide('#form_companies')
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
	jQuery('#modal_disetor').val('');
	jQuery('#email').val('');
	jQuery('#business_fields').val('');
	jQuery('#address').val('');
	jQuery('#city').val('');
	jQuery('#region').val('');
	jQuery('#id_country').val('');
	jQuery('#ziptal_code').val('');
	jQuery('#phone').val('');
	jQuery('#fax').val('');
	jQuery('#npwp').val('');
	jQuery('#website').val('');
		
	$('.business_types').parent().attr('class', '');
		
	$('#list-pic').html('');
	$('#list-komisaris').html('');
	$('#list-armada').html('');
	$('#list-direksi').html('');
	
	jQuery('#skkemenkumham').html("");
	jQuery('#siupal_siopsus').html("");
	jQuery('#logo').html("");	
	jQuery('#foto_kapal').html("");
}


function addPic(id, nama, jabatan, email, phone){
	
	var pic = "";
	pic += '<div class="form-group">';
	pic += '  <div class="col-md-11">';
	pic += '  <div class="col-md-6">';
	pic += '		<div class="input-icon right">';
	pic += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>';
	pic += '			<input type="text" maxlength="255" name="name_pic-'+id+'" id="name_pic-'+id+'" data-required="1" class="form-control" title="Name" placeholder="Name" />';
	pic += '			<span class="help-block">Name PIC <span class="require">*</span></span>';
	pic += '		</div>';
	pic += '  </div>';
	pic += '  <div class="col-md-6">';
	pic += '		<div class="input-icon right">';
	pic += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a provinsi" data-container="body"></i>';
	pic += '			<select class="form-control jabatan_pic" id="jabatan_pic-'+id+'" name="jabatan_pic">'+$('#list-jabatan').html()+'</select>';
	pic += '			<span class="help-block">Jabatan <span class="require">*</span></span>';
	pic += '		</div>';
	pic += '  </div>';
	pic += '  <div class="col-md-6">';
	pic += '		<div class="input-icon right">';
	pic += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>';
	pic += '			<input type="text" maxlength="255" name="email_pic-'+id+'" id="email_pic-'+id+'" data-required="1" class="form-control" title="Name" placeholder="Name" />';
	pic += '			<span class="help-block">Email <span class="require">*</span></span>';
	pic += '		</div>';
	pic += '  </div>';
	pic += '  <div class="col-md-6">';
	pic += '		<div class="input-icon right">';
	pic += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>';
	pic += '			<input type="text" maxlength="255" name="phone_pic-'+id+'" id="phone_pic-'+id+'" data-required="1" class="form-control" title="Name" placeholder="Name" />';
	pic += '			<span class="help-block">Phone <span class="require">*</span></span>';
	pic += '		</div>';
	pic += '  </div>';
	pic += '</div>';
	
	$('#list-pic').append(pic);
	$('#name_pic-'+id).val(nama);
	$('#jabatan_pic-'+id).val(jabatan);
	$('#email_pic-'+id).val(email);
	$('#phone_pic-'+id).val(phone);
}

function removePic(id){
	$('#base-pic-'+id).remove();
}

function addKomisaris(id, nama, jabatan){	
	var komisaris = "";
	komisaris += '<div class="form-group">';
	komisaris += '  <div class="col-md-11">';
	komisaris += '  <div class="col-md-6">';
	komisaris += '		<div class="input-icon right">';
	komisaris += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>';
	komisaris += '			<input type="text" maxlength="255" name="name_komisaris-'+id+'" id="name_komisaris-'+id+'" data-required="1" class="form-control" title="Name" placeholder="Name" />';
	komisaris += '			<span class="help-block">Name Komisaris <span class="require">*</span></span>';
	komisaris += '		</div>';
	komisaris += '  </div>';
	komisaris += '  <div class="col-md-6">';
	komisaris += '		<div class="input-icon right">';
	komisaris += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a provinsi" data-container="body"></i>';
	komisaris += '			<select class="form-control jabatan_komisaris" id="jabatan_komisaris-'+id+'" name="jabatan_komisaris">'+$('#list-jabatan').html()+'</select>';
	komisaris += '			<span class="help-block">Jabatan <span class="require">*</span></span>';
	komisaris += '		</div>';
	komisaris += '  </div>';
	komisaris += '</div>';
	
	$('#list-komisaris').append(komisaris);
	$('#name_komisaris-'+id).val(nama);
	$('#jabatan_komisaris-'+id).val(jabatan);
}

function removeKomisaris(id){
	$('#base-komisaris-'+id).remove();
}

function addDireksi(id, nama, jabatan){
	var direksi = "";
	direksi += '<div class="form-group">';
	direksi += '  <div class="col-md-11">';
	direksi += '  <div class="col-md-6">';
	direksi += '		<div class="input-icon right">';
	direksi += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>';
	direksi += '			<input type="text" maxlength="255" name="name_direksi-'+id+'" id="name_direksi-'+id+'" data-required="1" class="form-control" title="Name" placeholder="Name" />';
	direksi += '			<span class="help-block">Name Direksi <span class="require">*</span></span>';
	direksi += '		</div>';
	direksi += '  </div>';
	direksi += '  <div class="col-md-6">';
	direksi += '		<div class="input-icon right">';
	direksi += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a provinsi" data-container="body"></i>';
	direksi += '			<select class="form-control jabatan_direksi" id="jabatan_direksi-'+id+'" name="jabatan_direksi">'+$('#list-jabatan').html()+'</select>';
	direksi += '			<span class="help-block">Jabatan <span class="require">*</span></span>';
	direksi += '		</div>';
	direksi += '  </div>';
	direksi += '</div>';
	
	$('#list-direksi').append(direksi);
	$('#name_direksi-'+id).val(nama);
	$('#jabatan_direksi-'+id).val(jabatan);
}

function removeDireksi(id){
	$('#base-direksi-'+id).remove();
}

function addArmada(id, nama, ship_type, gt){
	
	var armada = "";
	armada += '<div class="form-group">';
	armada += '  <div class="col-md-11">';
	armada += '  <div class="col-md-5">';
	armada += '		<div class="input-icon right">';
	armada += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>';
	armada += '			<input type="text" maxlength="255" name="name_armada-'+id+'" id="name_armada-'+id+'" data-required="1" class="form-control" title="Name" placeholder="Name" />';
	armada += '			<span class="help-block">Nama Kapal <span class="require">*</span></span>';
	armada += '		</div>';
	armada += '  </div>';
	armada += '  <div class="col-md-4">';
	armada += '		<div class="input-icon right">';
	armada += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a provinsi" data-container="body"></i>';
	armada += '			<select class="form-control jabatan_armada" id="ship_type_armada-'+id+'" name="ship_type_armada">'+$('#list-ship-type').html()+'</select>';
	armada += '			<span class="help-block">Tipe Kapal <span class="require">*</span></span>';
	armada += '		</div>';
	armada += '  </div>';
	armada += '  <div class="col-md-3">';
	armada += '		<div class="input-icon right">';
	armada += '			<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>';
	armada += '			<input type="text" maxlength="255" name="gt_armada-'+id+'" id="gt_armada-'+id+'" data-required="1" class="form-control" title="Name" placeholder="Name" />';
	armada += '			<span class="help-block">GT/HP <span class="require">*</span></span>';
	armada += '		</div>';
	armada += '  </div>';
	armada += '</div>';
	
	$('#list-armada').append(armada);
	$('#name_armada-'+id).val(nama);
	$('#ship_type_armada-'+id).val(ship_type);
	$('#gt_armada-'+id).val(gt);
}

function removeArmada(id){
	$('#base-armada-'+id).remove();
}
