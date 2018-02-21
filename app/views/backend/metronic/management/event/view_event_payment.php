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
								  <option value="1" data-column="1" selected>Type</option>
								  <option value="2" data-column="2" selected>Name</option>
								  <option value="3" data-column="3" selected>Datetime</option>
								  <option value="4" data-column="4" selected>Is Active?</option>
								  <option value="5" data-column="5" selected>Action</option>
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
									<th>Event</th>
									<th>Company</th>
									<th>Reg. Code</th>
									<th>Name</th>
									<th width="60px">is Valid</th>
									<th width="70px">is Active?</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_event" id="search_id_event" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php foreach($events['rows'] as $key){ ?>
												<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<select name="search_id_company" id="search_id_company" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php foreach($companies['rows'] as $key){ ?>
												<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_code" name="search_code" placeholder="Search by Reg. Code">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td>
										<select name="search_isValidation" id="search_isValidation" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
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
							<form action="javascript:;" id="form_event_payment" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Event</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose an event" data-container="body"></i>
											<select id="id_event" name="id_event" data-required="1" class="form-control">
												<option value="">- Choose Event -</option>
												<?php foreach($events['rows'] as $key){ ?>
												<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
												<?php } ?>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Company</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose an company" data-container="body"></i>
											<select id="id_company" name="id_company" data-required="1" class="form-control">
												<option value="">- Choose Company -</option>
												<?php foreach($companies['rows'] as $key){ ?>
												<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
												<?php } ?>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Account Bank</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a account bank" data-container="body"></i>
											<input type="text" name="account_bank" id="account_bank" data-required="1" class="form-control" title="Account Bank" placeholder="Account Bank" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Account Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="255" name="account_name" id="account_name" data-required="1" class="form-control" title="Account Name" placeholder="Account Name" />
										</div>
									  </div>
									</div>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Account Number</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a account number" data-container="body"></i>
											<input type="text" name="account_number" id="account_number" data-required="1" class="form-control" title="Account Number" placeholder="Account Number" />
										</div>
									  </div>
									</div>	
									<div class="form-group">
									  <label  class="col-md-3 control-label">Total Payment</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a total payment" data-container="body"></i>
											<input type="text" name="total" id="total" data-required="1" class="form-control" title="Total Payment" placeholder="Total Payment" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Remarks</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a remarks" data-container="body"></i>
											<textarea name="remarks" id="remarks" data-required="1" class="form-control" title="Remarks"></textarea>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">is Valid?</label>
									  <div class="col-md-3">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose is Valid" data-container="body"></i>
											<input type="checkbox" id="isValidation" name="isValidation" class="make-switch" data-on-text="Yes" data-off-text="No">
										</div>
									  </div>
									  <label  class="col-md-3 control-label">is Active?</label>
									  <div class="col-md-3">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose is Active" data-container="body"></i>
											<input type="checkbox" id="status" name="status" class="make-switch" data-on-text="Yes" data-off-text="No">
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
	
	<script type="text/javascript" src="assets/js/backend/management/event/event_payment.js?<?php echo date("mdH");?>"></script>
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
			
            FormValidation.init('form_event_payment', rules);
            
			TableAjax.init("datatable", "event-management/event_payment/loadEvent_Payment");
			UIToastr.init();
			
			bootstrapMultiselect("colList");	
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
