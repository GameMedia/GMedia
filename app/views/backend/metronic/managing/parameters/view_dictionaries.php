				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.css" type="text/css"/>
				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.css" type="text/css"/>
				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>bootstrap-multiselect/bootstrap-multiselect.css" type="text/css"/>
				<!--<div class="row margin-top-20">-->
				<div class="col-md-12 column sortable">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase"><?php echo $pageTitle;?></span>
							</div>
							<div class="actions">
								<select id="colList" multiple="multiple" class="toggle-vis yellow-stripe">
								  <option value="0" data-column="0" selected>Rec</option>
								  <option value="1" data-column="1" selected>Country</option>
								  <option value="2" data-column="2" selected>Code</option>
								  <option value="3" data-column="3" selected>Value</option>
								  <option value="4" data-column="4" selected>Action</option>
								</select>
								<?php if($accessAdd){?>
								<a href="#" class="btn default yellow-stripe" data-target="#formAdd" data-toggle="modal">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">Add <?php echo $pageTitle;?> </span>
								</a>
								<?php } ?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<div class="table-actions-wrapper">
									<span></span>
								</div>
								<table class="table table-striped table-bordered table-hover" id="datatable">
								<thead>
								<tr role="row" class="heading">
									<th class="no-sort" width="50px">Rec.</th>
									<th width="130px">Country</th>
									<th width="130px">Code</th>
									<th>Value</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select class="form-control form-filter input-sm" id="search_id_country" name="search_id_country">
											<?php 
											foreach($countries['rows'] as $key){
											?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td><input type="text" name="search_code" id="search_code" class="form-control form-filter input-sm" placeholder="Search by Code"></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_value" name="search_value" placeholder="Search by Value"></td>
									<td>
										<div class="margin-bottom-5">
											<button class="btn btn-sm yellow filter-submit margin-bottom" title="Search" id="btn-filter-table"><i class="fa fa-search"></i></button>
											<button class="btn btn-sm red filter-cancel" title="Reset" onclick="clearSearchForm()"><i class="fa fa-times"></i></button>
										</div>
										
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--</div>-->
				<!-- /.modal -->
				<div id="formAdd" class="modal fade" tabindex="-1" data-backdrop="static" data-width="400" data-keyboard="false" data-attention-animation="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_dictionaries" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Code</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a country code" data-container="body"></i>
											<input type="text" maxlength="50" name="code" id="code" class="form-control form-filter" title="Dictionary Code" placeholder="Dictionary Code">
										</div>
									  </div>
									</div>
									<?php 
									foreach($countries['rows'] as $key){
									?>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Values <?php echo $key['name'];?></label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a Value <?php echo $key['name'];?>" data-container="body"></i>
											<input type="text" maxlength="255" country="<?php echo $key['id'];?>" name="value_<?php echo $key['id'];?>" id="value_<?php echo $key['id'];?>" class="form-control country" title="<?php echo $key['name'];?>" placeholder="<?php echo $key['name'];?>" />
										</div>
									  </div>
									</div>
									<?php } ?>
								</div>
								<div class="modal-footer">
									<p style="float:left">Last update by <i id="update_by"></i> On <i id="update_time"></i></p>
									<button type="button" class="btn btn-close-modal" data-dismiss="modal" onclick="clearForm()">Close</button>
									<button type="submit" class="btn red<?php echo ($accessEdit)?' btn-edit':'';?><?php echo ($accessAdd)?' btn-add':'';?>"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
	<script type="text/javascript" src="assets/js/backend/datatables.js?<?php echo date("mdH");?>"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/managing/parameters/dictionaries.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						code: {required: true}
						};			
			
            FormValidation.init('form_dictionaries', rules);
            
			TableAjax.init("datatable", "managing-parameters/dictionaries/loadDictionaries");
			loadDictionaries();
			UIToastr.init();
			
			bootstrapMultiselect("colList");
						
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>