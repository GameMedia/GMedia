function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"managing-masters/agendas/getAgendasData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_agendas'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_agenda_type').val(data.id_agenda_type);
											jQuery('#name').val(data.name);
											jQuery('#address').val(data.address);
											jQuery('#description').val(data.description);
											jQuery('#agenda_date').val(data.agenda_date);
											jQuery('#agenda_date_end').val(data.agenda_date_end);
											jQuery('#agenda_time').val(data.agenda_time);
											jQuery('#agenda_time_end').val(data.agenda_time_end);
											jQuery('#till_end').val(data.till_end);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
																								
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_agendas');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_agenda_type = jQuery('#id_agenda_type').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		address = jQuery('#address').val(),
		agenda_date = jQuery('#agenda_date').val(),
		agenda_date_end = jQuery('#agenda_date_end').val(),
		agenda_time = jQuery('#agenda_time').val(),
		agenda_time_end = jQuery('#agenda_time_end').val(),
		till_end = '0',
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_agendas');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"managing-masters/agendas/saveAgendas",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_agenda_type' : id_agenda_type,
					'name' : name,
					'description' : description,
					'address' : address,
					'agenda_date' : agenda_date,
					'agenda_date_end' : agenda_date_end,
					'agenda_time' : agenda_time,
					'agenda_time_end' : agenda_time_end,
					'till_end' : till_end,
					'status' : status
				  },
			beforeSend: loadingShow('#form_agendas'),
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
										loadingHide('#form_agendas')
									}
		   });	
}
function clearSearchForm(){
	jQuery('#search_id_agenda_type').val('');
	jQuery('#search_name').val('');
	jQuery('#search_description').val('');
	
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#id_agenda_type').val('');
	jQuery('#name').val('');
	jQuery('#description').val('');
	jQuery('#address').val('');
	jQuery('#agenda_date').val('');
	jQuery('#agenda_date_end').val('');
	jQuery('#agenda_time').val('');
	jQuery('#agenda_time_end').val('');
	jQuery('#till_end').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
