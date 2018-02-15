function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"characters-management/characters/getCharactersData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_characters'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_game').val(data.id_game);
											jQuery('#id_character_element').val(data.id_character_element);
											jQuery('#id_character_grade').val(data.id_character_grade);
											jQuery('#id_character_type').val(data.id_character_type);
											jQuery('#id_gallery').val(data.id_gallery);
											jQuery('#name').val(data.name);
											jQuery('#power').val(data.power);
											jQuery('#description').val(data.description);
											jQuery('#atk').val(data.atk);
											jQuery('#hp').val(data.hp);
											jQuery('#def').val(data.def);
											jQuery('#mdef').val(data.mdef);
											jQuery('#speed').val(data.speed);
											jQuery('#crit_rate').val(data.crit_rate);
											jQuery('#crit_res_rate').val(data.crit_res_rate);
											jQuery('#hit_chance').val(data.hit_chance);
											jQuery('#dodge_rate').val(data.dodge_rate);
											jQuery('#dmg').val(data.dmg);
											jQuery('#dmg_reduce').val(data.dmg_reduce);
											jQuery('#pvp_dmg').val(data.pvp_dmg);
											jQuery('#pvp_immune').val(data.pvp_immune);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_characters');
									}
		   });	
}

function save(){

	var id = jQuery('#id').val(),
		id_game = jQuery('#id_game').val(),
		id_character_element = jQuery('#id_character_element').val(),
		id_character_grade = jQuery('#id_character_grade').val(),
		id_character_type = jQuery('#id_character_type').val(),
		id_gallery = jQuery('#id_gallery').val(),
		name = jQuery('#name').val(),
		power = jQuery('#power').val(),
		description = jQuery('#description').val(),
		atk = jQuery('#atk').val(),
		hp = jQuery('#hp').val(),
		def = jQuery('#def').val(),
		mdef = jQuery('#mdef').val(),
		speed = jQuery('#speed').val(),
		crit_rate = jQuery('#crit_rate').val(),
		crit_res_rate = jQuery('#crit_res_rate').val(),
		hit_chance = jQuery('#hit_chance').val(),
		dodge_rate = jQuery('#dodge_rate').val(),
		dmg = jQuery('#dmg').val(),
		dmg_reduce = jQuery('#dmg_reduce').val(),
		pvp_dmg = jQuery('#pvp_dmg').val(),
		pvp_immune = jQuery('#pvp_immune').val(),
		path_ori = jQuery('#path_ori').val(),
		path_thumb = jQuery('#path_thumb').val(),
		url_ori = jQuery('#url_ori').val(),
		url_thumb = jQuery('#url_thumb').val(),
		mime_type = jQuery('#img_mime').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_characters');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"characters-management/characters/saveCharacters",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_game' : id_game,
					'id_character_element' : id_character_element,
					'id_character_grade' : id_character_grade,
					'id_character_type' : id_character_type,
					'id_gallery' : id_gallery,
					'name' : name,
					'power' : power,
					'description' : description,
					'atk' : atk,
					'hp' : hp,
					'def' : def,
					'mdef' : mdef,
					'speed' : speed,
					'crit_rate' : crit_rate,
					'crit_res_rate' : crit_res_rate,
					'hit_chance' : hit_chance,
					'dodge_rate' : dodge_rate,
					'dmg' : dmg,
					'dmg_reduce' : dmg_reduce,
					'pvp_dmg' : pvp_dmg,
					'pvp_immune' : pvp_immune,
					'path_ori' : path_ori,
					'path_thumb' : path_thumb,
					'url_ori' : url_ori,
					'url_thumb' : url_thumb,
					'mime_type' : mime_type,
					'status' : status
				  },
			beforeSend: loadingShow('#form_characters'),
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
										loadingHide('#form_characters')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_id_character_element').val('');
	jQuery('#search_name').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#id_game').val('');	
	jQuery('#id_character_element').val('');
	jQuery('#id_character_grade').val('');
	jQuery('#id_character_type').val('');
	jQuery('#id_gallery').val('');
	jQuery('#name').val('');
	jQuery('#power').val('');
	jQuery('#description').val('');
	jQuery('#atk').val('');
	jQuery('#hp').val('');
	jQuery('#def').val('');
	jQuery('#mdef').val('');
	jQuery('#speed').val('');
	jQuery('#crit_rate').val('');
	jQuery('#crit_res_rate').val('');
	jQuery('#hit_chance').val('');
	jQuery('#dodge_rate').val('');
	jQuery('#dmg').val('');
	jQuery('#dmg_reduce').val('');
	jQuery('#pvp_dmg').val('');
	jQuery('#pvp_immune').val('');
	jQuery('#path_ori').val('');
	jQuery('#path_thumb').val('');
	jQuery('#url_ori').val('');
	jQuery('#url_thumb').val('');
	jQuery('#img_mime').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}

function showView(value){
	if(value == 0){
		jQuery('#list-characters').css('display', 'inline');
		jQuery('#view-characters').css('display', 'none');
	} else if(value == 1){
		jQuery('#list-characters').css('display', 'none');
		jQuery('#view-characters').css('display', 'inline');
	} 
}

$(function () {
    'use strict';
    $('#fileupload').fileupload({
		url: domain+"managing-masters/galleries/uploadGalleries?files",
		type: 'POST',
		cache: false,
		dataType: 'json',
		processData: false, // Don't process the files
		charactersType: false, // Set characters type to false as jQuery will tell the server its a query string request,
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
