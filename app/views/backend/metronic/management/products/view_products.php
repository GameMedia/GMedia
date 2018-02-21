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
								  <option value="1" data-column="1" selected>Name</option>
								  <option value="2" data-column="2" selected>Display</option>
								  <option value="3" data-column="3" selected>Is Active?</option>
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
									<th width="100px">Product Type</th>
									<th>Name</th>
									<th width="100px">Price</th>
									<th width="100px">Image</th>
									<th width="70px">is Active?</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_product_type" id="search_id_product_type" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php for($i=0; $i<count($product_type['rows']); $i++){ ?> 
												<option value="<?php echo $product_type['rows'][$i]['id'];?>"><?php echo $product_type['rows'][$i]['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name"></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_price" name="search_price" placeholder="Search by Display"></td>
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
							<form action="javascript:;" id="form_products" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="100" name="name" id="name" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Product Type</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<select class="form-control" name="id_product_type" id="id_product_type" >
												<option value="">- Choose Product Type -</option>
												<?php for($i=0; $i<count($product_type['rows']); $i++){ ?> 
													<option value="<?php echo $product_type['rows'][$i]['id'];?>"><?php echo $product_type['rows'][$i]['name'];?></option>
												<?php } ?>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Child Product of</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<select class="form-control" name="parent" id="parent">
												<option value=""> - Choose Parent - </option>
												<?php for($i=0; $i<count($parents['rows']); $i++){ ?> 
													<option value="<?php echo $parents['rows'][$i]['id'];?>"><?php echo $parents['rows'][$i]['name'];?></option>
												<?php } ?>
											</select>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Meta Keywords</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a meta keywords" data-container="body"></i>
											<input type="text" maxlength="255" name="meta_keywords" id="meta_keywords" data-required="1" class="form-control" title="Meta Keywords" placeholder="Meta Keywords" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Short Description</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a short description" data-container="body"></i>
											<input type="text" maxlength="255" name="short_description" id="short_description" data-required="1" class="form-control" title="Short Description" placeholder="Short Description" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Long Description</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<a href="#" class="btn default yellow-stripe" data-target="#formEditor" data-toggle="modal">
												<i class="fa fa-share"></i>
												<span class="hidden-480">Editor</span>
											</a>
										</div>
									  </div>
									</div>
									<div class="form-group">
										<label  class="col-md-3 control-label">Product Warranty</label>
										<div class="col-md-2">
											<input type="text" class="form-control" name="warranty" id="warranty" />
										</div>
										<div class="col-md-3">
											<select class="form-control" name="id_warranty" id="id_warranty">
												<?php for($i=0; $i<count($warranty['rows']); $i++){ ?> 
													<option value="<?php echo $warranty['rows'][$i]['id'];?>"><?php echo $warranty['rows'][$i]['name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label  class="col-md-3 control-label">Shipping Weight</label>
										<div class="col-md-2">
											<input type="text" class="form-control" name="ship_weight" id="ship_weight" />
										</div>
										<div class="col-md-3">
											<select class="form-control" name="id_weight" id="id_weight">
												<?php for($i=0; $i<count($weight['rows']); $i++){ ?> 
													<option value="<?php echo $weight['rows'][$i]['id'];?>"><?php echo $weight['rows'][$i]['name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Product Price <span class="required"> * </span></label>
										<div class="col-md-2">
											<select class="form-control" name="id_currency" id="id_currency">
												<?php for($i=0; $i<count($currencies['rows']); $i++){ ?> 
													<option value="<?php echo $currencies['rows'][$i]['id'];?>"><?php echo $currencies['rows'][$i]['display'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-5">
											<input type="text" class="form-control" name="price" id="price" />
										</div>
									</div>
									<div class="form-group">
										<label  class="col-md-3 control-label">Discount</label>
										<div class="col-md-2">
											<div class="input-icon right">
												<i>%</i>
												<input type="text" class="form-control" name="discount" id="discount" value="0" maxlength="3"/>
											</div>
										</div>									
									</div>
									<!--<div class="form-group">
										<label class="control-label col-md-3">Icon <span class="required"> * </span>
										</label>
										<div class="col-md-4">
											<select class="form-control" name="icon" id="icon">
												<option value=""> - Choose Icon - </option>
												<option value="fa fa-cutlery">Cutlery</option>
												<option value="fa fa-calendar">Calendar</option>
												<option value="fa fa-female">Female</option>
												<option value="fa fa-bolt">Bolt</option>
												<option value="fa fa-headphones">Headphones</option>
												<option value="fa fa-image">Image</option>
												<option value="fa fa-umbrella">Umbrella</option>
												<option value="fa fa-shopping-cart">Shopping Cart</option>
												<option value="fa fa-home">Home</option>
												<option value="fa fa-plane">Plane</option>
												<option value="fa fa-eye">Eye</option>
											</select>
										</div>
									</div>-->
									<div class="form-group">
										<label class="control-label col-md-3">Final Price <span class="required"> * </span></label>
										<div class="col-md-5">
											<div class="input-icon left">
												<i class="fa fa-money"></i>
												<input type="text" class="form-control" name="price_discount" id="price_discount" readonly/>
											</div>
										</div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Image</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<input type="hidden" id="id_gallery" name="id_gallery"/>
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
				
				<!-- /.modal Editor-->
				<div id="formEditor" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="true">
					<div class="modal-dialog modal-full">
						<div class="modal-content" id="modal-content-editor">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?> - Long Description</h4>
							</div>
							<div class="modal-body" id="modal-body-editor">
								<div class="form-group">
								  <div class="col-md-12">
									<textarea name="long_description" id="long_description" class="m-wrap"></textarea>
								  </div>
								</div>									
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-close-modal" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.js"></script>	
	<script type="text/javascript" src="<?php echo ASSETS_PLUGINS;?>ckeditor/ckeditor.js"></script> 
			
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?php echo ASSETS_PLUGINS;?>jquery-file-upload/js/jquery.iframe-transport.js"></script>
	<script src="<?php echo ASSETS_PLUGINS;?>jquery-file-upload/js/jquery.fileupload.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/datatable.js"></script>
	<script type="text/javascript" src="assets/js/backend/datatables.js?<?php echo date("mdH");?>"></script>
    <script type="text/javascript" src="assets/js/backend/ui-toastr.js"></script>
	
	<script type="text/javascript" src="assets/js/backend/management/products/products.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						name: {minlength: 4,required: true},
						display: {required: true}
						};			
			
            FormValidation.init('form_products', rules);
            
			TableAjax.init("datatable", "product-management/products/loadProducts");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
			
			$(function(){
			  $('#modal-body-editor').css({ height: ($(window).innerHeight()-180)});
			  $('#cke_1_contents').css({ height: ($(window).innerHeight()-340) });
			  $(window).resize(function(){
				$('#modal-body-editor').css({ height: ($(window).innerHeight()-180) });
				$('#cke_1_contents').css({ height: ($(window).innerHeight()-340) });
			  });
			});
			
			CKEDITOR.replace( 'long_description', {
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea'
			});
						
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
