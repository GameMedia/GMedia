var TableAjax = function () {	
    var handleRecords = function () {
        var grid = new Datatable();

        grid.init({
            src: $("#datatable"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { 
                "bStateSave": true, 
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": domain+"tools/act_history/loadAct_History", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    
    /*var table = $('#datatable');
    
    /* Formatting function for row details * /
	function fnFormatDetails(oTable, nTr) {
		var aData = oTable.fnGetData(nTr);
		var sOut = '<table>';
		sOut += '<tr><td>Platform(s):</td><td>' + aData[2] + '</td></tr>';
		sOut += '<tr><td>Engine version:</td><td>' + aData[3] + '</td></tr>';
		sOut += '<tr><td>CSS grade:</td><td>' + aData[4] + '</td></tr>';
		sOut += '<tr><td>Others:</td><td>Could provide a link here</td></tr>';
		sOut += '</table>';

		return sOut;
	}
	
	table.on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            if (oTable.fnIsOpen(nTr)) {
                /* This row is already open - close it * /
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose(nTr);
            } else {
                /* Open this row * /
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
            }
        });
        */

    return {
        //main function to initiate the module
        init: function () {
            handleRecords();
        }
    };
}();

function view(id){
	"use strict";
	
	/*if(!accessEdit){
		saveAccessible(false);
	} else
		saveAccessible(true);*/
	jQuery.ajax({
			url:  domain+"tools/act_history/getAct_HistoryData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_act_history'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#entry_time').html(data.entry_time);
											jQuery('#actions').html(data.actions);
											jQuery('#menu').html(data.name_menu);
											jQuery('#username').html(data.username);
											jQuery('#employee').html(data.name_employee);
											jQuery('#data').html(data.data);
											jQuery('#result').html(data.result);
										} else {
											
										}
										loadingHide('#form_act_history');
									}
		   });	
}

function clearSearchForm(){
	//jQuery('#search_id_privilege').val('');
	jQuery('#search_name').val('');
	jQuery('#search_parent').val('');
	jQuery('#search_icon').val('');
	jQuery('#search_id_menu').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#entry_time').html('');
	jQuery('#actions').html('');
	jQuery('#menu').html('');
	jQuery('#username').html('');
	jQuery('#employee').html('');
	jQuery('#data').html('');
	jQuery('#result').html('');
}
