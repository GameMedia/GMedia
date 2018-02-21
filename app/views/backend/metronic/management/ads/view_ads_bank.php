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
								  <option value="3" data-column="3" selected>Image</option>
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
									<th width="100px">Category</th>
									<th>Company</th>
									<th>Name</th>
									<th width="120px">Publish</th>
									<th class="no-sort" width="80px">Image</th>
									<th width="70px">is Active?</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_ads_category" id="search_id_ads_category" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php foreach($ads['rows'] as $key){ ?>
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
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td></td>
									<td></td>
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
							<form action="javascript:;" id="form_ads_bank" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Ads Category</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose an category" data-container="body"></i>
											<select id="id_ads_category" name="id_ads_category" data-required="1" class="form-control">
												<option value="">- Choose Event -</option>
												<?php foreach($ads['rows'] as $key){ ?>
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
									  <label  class="col-md-3 control-label">Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="255" name="name" id="name" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Redirect URL</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose an redirect url" data-container="body"></i>
											<input type="text" name="redirect_url" id="redirect_url" data-required="1" class="form-control" title="Redirect URL" placeholder="Redirect URL" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Publish Date</label>
									  <div class="col-md-3">
										<input type="text" class="form-control" id="publish_date" name="publish_date" placeholder="Start Publish" />
									  </div>
									  <div class="col-md-3">
										<input type="text" class="form-control" id="unpublish_date" name="unpublish_date" placeholder="End Publish" />
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-lg-3 control-label">Ads Image<span class="require">*</span></label>
									  <div class="col-lg-9">
										<div class="input-icon right">
											<input type="hidden" id="path_ori" name="path_ori"/>
											<input type="hidden" id="url_ori" name="url_ori"/>
											<input type="hidden" id="file_mime" name="file_mime"/>
											<i class="fa fa-exclamation tooltips" data-original-title="please choose " data-container="body"></i>
											<input type="file" name="fileupload" id="fileupload" data-required="1" class="form-control" title="File" placeholder="File" value="Select File..."/>
											<!-- The global progress bar -->
											<div id="progress" class="progress" style="margin-top:10px;">
												<div class="progress-bar progress-bar-success"></div>
											</div>
											<span class="help-block" id="display" style="display:none"></span>									
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">is Active?</label>
									  <div class="col-md-3">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose is Active" data-container="body"></i>
											<select id="status" name="status" class="form-control" title="Status">
												<option value="">- Choose Status -</option>
												<option value="1">Active</option>
												<option value="0">Inactive</option>
												<option value="2">Waiting</option>
												<option value="3">Suspend</option>
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
				
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?php echo ASSETS_PLUGINS;?>jquery-file-upload/js/jquery.iframe-transport.js"></script>
	<script src="<?php echo ASSETS_PLUGINS;?>jquery-file-upload/js/jquery.fileupload.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
	<script type="text/javascript" src="assets/js/backend/datatables.js?<?php echo date("mdH");?>"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/management/ads/ads_bank.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						type: {required: true},
						name: {minlength: 4,required: true},
						description: {required: true},
						publish_time: {required: true}
						};			
			
            FormValidation.init('form_ads_bank', rules);
            
			TableAjax.init("datatable", "ads-management/ads_bank/loadAds_Bank");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
			
			$( "#publish_date, #unpublish_date" ).datepicker({
			  changeMonth: true,
			  changeYear: true,
			  dateFormat: 'yy-mm-dd'
			});
			
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
