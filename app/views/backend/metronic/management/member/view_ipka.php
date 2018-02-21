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
								  <option value="1" data-column="1" selected>Company</option>
								  <option value="2" data-column="2" selected>Ship Type</option>
								  <option value="3" data-column="3" selected>Ship Name</option>
								  <option value="4" data-column="4" selected>Principal</option>
								  <option value="5" data-column="5" selected>Chartered By</option>
								  <option value="6" data-column="6" selected>Is Active?</option>
								  <option value="7" data-column="7" selected>Action</option>
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
									<th width="120px">Company</th>
									<th width="80px">Ship Type</th>
									<th>Ship Name</th>
									<th>Principal</th>
									<th width="100px">Chartered By</th>
									<th width="70px">is Active?</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_company" id="search_id_company" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php foreach($companies['rows'] as $key) { ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<select name="search_id_ship_type" id="search_id_ship_type" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php foreach($ship_types['rows'] as $key) { ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_nama_kapal" name="search_nama_kapal" placeholder="Search by Nama Kapal">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_pricinpal" name="search_pricinpal" placeholder="Search by Principal">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_pencharter" name="search_pencharter" placeholder="Search by Pencharter">
									</td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
											<option value="2">Need Confirmation</option>
											<option value="3">Suspend</option>
										</select>
									</td>
									<td>
										<div class="margin-bottom-5">
											<button class="btn btn-sm yellow filter-submit margin-bottom" title="Search"><i class="fa fa-search"></i></button>
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
							<form action="javascript:;" id="form_ipka" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Company</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<select name="id_company" id="id_company" data-required="1" class="form-control" title="Company" >
												<option value="">- All -</option>
												<?php foreach($companies['rows'] as $key) { ?>
												<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
												<?php } ?>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Ship Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="255" name="nama_kapal" id="nama_kapal" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Ship Status</label>
									  <div class="col-md-9">
										<div class="radio-list">
										<label class="radio-inline">
											<div class="radio" id="uniform-business_fields">
												<span><input type="radio" name="status_kapal" id="status_kapal" value="Sewa" checked=""></span>
											</div> Sewa dari pihak ketiga </label>
										<label class="radio-inline">
											<div class="radio" id="uniform-business_fields">
												<span><input type="radio" name="status_kapal" id="status_kapal" value="Milik" checked=""></span>
											</div> Milik (Dalam satu Grup) </label>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Ship Type</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<select name="id_ship_type" id="id_ship_type" data-required="1" class="form-control" title="Tipe Kapal">
												<option value="">- All -</option>
												<?php foreach($ship_types['rows'] as $key) { ?>
												<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
												<?php } ?>
											</select>
										</div>
									  </div>
									</div>	
									<div class="form-group">
									  <label  class="col-md-3 control-label">Flag</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a bendera" data-container="body"></i>
											<input type="text" maxlength="255" name="bendera" id="bendera" data-required="1" class="form-control" title="Bendera" placeholder="Bendera" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Call Sign</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a call sign" data-container="body"></i>
											<input type="text" maxlength="255" name="call_sign" id="call_sign" data-required="1" class="form-control" title="Call Sign" placeholder="Call Sign" />
										</div>
									  </div>
									</div>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Class</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a class" data-container="body"></i>
											<input type="text" maxlength="255" name="class" id="class" data-required="1" class="form-control" title="Class" placeholder="Class" />
										</div>
									  </div>
									</div>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Principal</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a principal" data-container="body"></i>
											<input type="text" maxlength="255" name="principal" id="principal" data-required="1" class="form-control" title="Principal" placeholder="Principal" />
										</div>
									  </div>
									</div>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Size</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a ukuran" data-container="body"></i>
											<input type="text" maxlength="255" name="ukuran" id="ukuran" data-required="1" class="form-control" title="Ukuran" placeholder="Ukuran" />
										</div>
									  </div>
									</div>									
									<div class="form-group">
									  <label  class="col-md-3 control-label"></label>
									  <div class="col-md-9">
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a grt" data-container="body"></i>
													<input type="text" maxlength="255" name="grt" id="grt" data-required="1" class="form-control" title="GRT" placeholder="GRT" />
													<span class="help-block">GRT <span class="require">*</span></span>
												</div>
										  </div>
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a nt" data-container="body"></i>
													<input type="text" maxlength="255" name="nt" id="nt" data-required="1" class="form-control" title="NT" placeholder="NT" />
													<span class="help-block">NT <span class="require">*</span></span>
												</div>
										  </div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Tenaga</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a tenaga" data-container="body"></i>
											<input type="text" maxlength="255" name="tenaga" id="tenaga" data-required="1" class="form-control" title="Tenaga" placeholder="Tenaga" />
										</div>
									  </div>
									</div>	
									<div class="form-group">
									  <label  class="col-md-3 control-label">Chartered By</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a Pencharter" data-container="body"></i>
											<input type="text" maxlength="255" name="pencharter" id="pencharter" data-required="1" class="form-control" title="Pencharter" placeholder="Pencharter" />
										</div>
									  </div>
									</div>	
									<div class="form-group">
									  <label  class="col-md-3 control-label"></label>
									  <div class="col-md-9">
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a grt" data-container="body"></i>
													<input type="text" maxlength="255" name="start_date" id="start_date" data-required="1" class="form-control" title="Start Date" placeholder="<?php echo date('Y-m-d');?>" />
													<span class="help-block">Start Date <span class="require">*</span></span>
												</div>
										  </div>
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a end date" data-container="body"></i>
													<input type="text" maxlength="255" name="end_date" id="end_date" data-required="1" class="form-control" title="End Date" placeholder="<?php echo date('Y-m-d');?>" />
													<span class="help-block">End Date <span class="require">*</span></span>
												</div>
										  </div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Status</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<select id="status" name="status" class="form-control">
												<option value="1">Active</option>
												<option value="3">Suspend</option>
												<option value="2">Waiting Confirmation</option>
											</select>
										</div>
									  </div>
									</div>
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
	
	<script type="text/javascript" src="assets/js/backend/management/member/ipka.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						name: {minlength: 4,required: true},
						email: {required: true, email: true},
						id_event: {required: true},
						id_company: {required: true}
						};			
			
            FormValidation.init('form_ipka', rules);
            
			TableAjax.init("datatable", "member-management/ipka/loadIpka");
			UIToastr.init();
			
			bootstrapMultiselect("colList");	
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
