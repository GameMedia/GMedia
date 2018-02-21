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
									<th width="100px">Type</th>
									<th>Name</th>
									<th class="no-sort" width="80px">Image</th>
									<th width="70px">is Active?</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_type" id="search_type" data-required="1" class="form-control form-filter input-sm" title="Type">
											<option value="">- All Type -</option>
											<option value="Content">Content</option>
											<option value="Banner">Banner</option>
											<option value="Profile">Profile</option>
											<option value="Photo">Photo</option>
										</select>
									</td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name"></td>
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
							<form action="javascript:;" id="form_profile_pengurus" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
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
									  <label  class="col-md-3 control-label">Position</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a position" data-container="body"></i>
											<input type="text" maxlength="50" name="position" id="position" data-required="1" class="form-control" title="Posisiton" placeholder="Position" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Description</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a short desc" data-container="body"></i>
											<textarea name="description" id="description" data-required="1" class="form-control" title="Short Description" placeholder="Short Description" rows="5"></textarea>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Image</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="hidden" id="path_thumb" name="path_thumb"/>
											<input type="hidden" id="path_ori" name="path_ori"/>
											<input type="hidden" id="url_thumb" name="url_thumb"/>
											<input type="hidden" id="url_ori" name="url_ori"/>
											<input type="hidden" id="img_width" name="img_width"/>
											<input type="hidden" id="img_height" name="img_height"/>
											<input type="hidden" id="img_mime" name="img_mime"/>
											<i class="fa fa-exclamation tooltips" data-original-title="please choose " data-container="body"></i>
											<input type="file" name="fileupload" id="fileupload" data-required="1" class="form-control" title="File" placeholder="File" value="Select File..."/>
											<!-- The global progress bar -->
											<div id="progress" class="progress" style="margin-top:10px;">
												<div class="progress-bar progress-bar-success"></div>
											</div>
											<span class="help-block" id="display-banner" style="display:none"></span>									
										</div>
									  </div>
									</div>	
									<div class="form-group">
									  <label  class="col-md-3 control-label">is Active?</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please choose is Active" data-container="body"></i>
											<input type="checkbox" id="status" name="status" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
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
	
	<script type="text/javascript" src="assets/js/backend/managing/masters/profile_pengurus.js?<?php echo date("mdH");?>"></script>
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
			
            FormValidation.init('form_profile_pengurus', rules);
            
			TableAjax.init("datatable", "managing-masters/profile_pengurus/loadProfile_Pengurus");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
			
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
