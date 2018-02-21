				<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-toastr/toastr.min.css"/>
				<!--<div class="row margin-top-20">-->
				<div class="col-md-12 column sortable">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase"><?php echo $pageTitle;?></span>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn default yellow-stripe" href="#" data-toggle="dropdown">
									<i class="fa fa-share"></i>
									<span class="hidden-480">
									Tools </span>
									<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">
											Export to Excel </a>
										</li>
										<li>
											<a href="#">
											Export to CSV </a>
										</li>
										<li>
											<a href="#">
											Export to XML </a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<div class="table-actions-wrapper">
									<span>
									</span>
									<!--<select class="table-group-action-input form-control input-inline input-small input-sm">
										<option value="">Select...</option>
										<option value="Cancel">Cancel</option>
										<option value="Cancel">Hold</option>
										<option value="Cancel">On Hold</option>
										<option value="Close">Close</option>
									</select>
									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>-->
								</div>
								<table class="table table-striped table-bordered table-hover" id="datatable">
								<thead>
								<tr role="row" class="heading">
									<th width="50px">
										 Rec.
									</th>
									<th width="150px">
										 Time
									</th>
									<th width="150px">
										 Action
									</th>
									<th>
										 Menu
									</th>
									<th width="150px">
										 Username
									</th>
									<th width="150px">
										 Employee
									</th>
									<th width="95px">
										 Actions
									</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_entry_time" name="search_entry_time" placeholder="Search by Time">
									</td>
									<td>
										<select name="search_action" id="search_action" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="Login">Login</option>
											<option value="Logout">Logout</option>
											<option value="Save">Save</option>
											<option value="Update">Update</option>
											<option value="Delete">Delete</option>
										</select>
									</td>
									<td>
										<select name="search_id_menu" id="search_id_menu" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php 
											if(isset($sortedMenu['rows'])){ 
												for($i=0; $i<count($sortedMenu['rows']); $i++){
											?>
											<option value="<?php echo $sortedMenu['rows'][$i]['id']; ?>"><?php echo $sortedMenu['rows'][$i]['name']; ?></option>
											<?php 
												}
											}
											?>
										</select>
									</td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
									</td>
									<td></td>
									<td>
										<div class="margin-bottom-5">
											<button class="btn btn-sm yellow filter-submit margin-bottom" onclick="loadAct_History()" title="Search"><i class="fa fa-search"></i></button>
											<button class="btn btn-sm red filter-cancel" title="Reset" onclick="clearSearchForm()"><i class="fa fa-times"></i></button>
										</div>
										
									</td>
								</tr>
								</thead>
								<tbody id="body-table">
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
							<form action="javascript:;" id="form_email_template" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>									
									<div class="form-group">
									  <label  class="col-md-3 control-label">Menu</label>
									  <div class="col-md-9">
										  <label class="control-label" id="menu"></label>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Action</label>
									  <div class="col-md-9">
										  <label class="control-label" id="actions"></label>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Action Time</label>
									  <div class="col-md-9">
										  <label class="control-label" id="entry_time"></label>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Action Username</label>
									  <div class="col-md-9">
										  <label class="control-label" id="username"></label>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Action Employee</label>
									  <div class="col-md-9">
										  <label class="control-label" id="employee"></label>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Data</label>
									  <div class="col-md-9">
										  <label class="control-label" id="data"></label>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Result</label>
									  <div class="col-md-9">
										  <label class="control-label" id="result"></label>
									  </div>
									</div>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-close-modal" data-dismiss="modal" onclick="clearForm()">Close</button>
									<button type="submit" class="btn red<?php echo ($accessEdit)?' btn-edit':'';?><?php echo ($accessAdd)?' btn-add':'';?>"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
	
	<script type="text/javascript" src="assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	
	<script type="text/javascript" src="assets/plugins/bootstrap-toastr/toastr.min.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/tools/act_history.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		var accessEdit = "<?php echo ($accessEdit)?'1':'0';?>";
		var accessDelete = "<?php echo ($accessDelete)?'1':'0';?>";
		
		jQuery(document).ready(function() {	
			TableAjax.init();
			UIToastr.init();
		});
    </script>
	<?php $this->load->view($folderLayout.'_modal');?>
