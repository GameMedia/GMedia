function loadDictionaries(){
	jQuery("#btn-filter-table").trigger("click");
}

function view(id, id_country){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"master-management/Dictionaries/getDictionariesData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_dictionaries'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											for(var i=0; i<data.rows.length; i++){
												jQuery('#value_'+data.rows[i]['id_country']).val(data.rows[i]['dictionary']);
												jQuery('#code').val(data.rows[i]['id']);
												jQuery('#id').val(data.rows[i]['id']);
											}
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_dictionaries');
									}
		   });	
}

function save(){
	var country = [],
		language = [],
		id_country = '',
		id = jQuery('#id').val(),
		code = jQuery('#code').val();
	$( ".country" ).each(function( index ) {
		language.push($( this ).val());
		id_country = $( this ).attr('country');
		country.push(id_country);
	});
	
	var form = $('#form_dictionaries');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"master-management/dictionaries/saveDictionaries",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'code' : code,
					'country' : country,
					'value' : language
				  },
			beforeSend: loadingShow('#form_dictionaries'),
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
										loadingHide('#form_dictionaries')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_code').val('');
	jQuery('#search_value').val('');
	jQuery('#search_id_country').val('');
}

function clearForm(){
	$( ".country" ).each(function( index ) {
		$( this ).val('');
	});
		
	jQuery('#code').val('');
}
