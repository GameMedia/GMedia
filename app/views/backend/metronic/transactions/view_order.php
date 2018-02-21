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
								  <option value="1" data-column="1" selected>Order ID</option>
								  <option value="1" data-column="1" selected>Trans. Date</option>
								  <option value="2" data-column="2" selected>Customer</option>
								  <option value="2" data-column="2" selected>Customer</option>
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
									<th width="100px">Order ID</th>
									<th width="120px">Trans. Date</th>
									<th width="100px">Payment Method</th>
									<th width="250px">Cust.</th>
									<th width="70px">Total Item</th>
									<th width="100px">Grand Total</th>
									<th width="100px">Status</th>
									<th  class="no-sort"width="70px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_payment_code" name="search_payment_code" placeholder="Search by Order ID"></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_transaction_date" name="search_transaction_date" placeholder="Search by Trans. Date"></td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php if(isset($payment_method) && $payment_method){ 
												foreach($payment_method as $key){?>
											<option value="<?php echo $key;?>"><?php echo $key;?></option>
											<?php } } ?>
										</select>
									</td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name"></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_price" name="search_price" placeholder="Search by Display"></td>
									<td></td>
									<td>
										<select name="search_status" id="search_status" class="form-control form-filter input-sm">
											<option value="">- All -</option>
											<?php if(isset($status) && $status){ 
												foreach($status as $key){?>
											<option value="<?php echo $key;?>"><?php echo $key;?></option>
											<?php } } ?>
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
					<div class="modal-dialog modal-full">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_order" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<div class="table-responsive">
										<table>
											<tr>
												<td colspan="2"><h3>Ship to : </h3></td>
												<td width="50px"></td>
												<td colspan="2"><h3>Billing Info : </h3></td>
												<td width="50px"></td>
												<td colspan="2"><h3>Payment Info : </h3></td>
											</tr>
											<tr>
												<td>Name</td>
												<td>: <span id="name"></span></td>
												
												<td></td>
												
												<td>Name</td>
												<td>: <span id="billing-name"></span></td>
												
												<td></td>
												
												<td>Account Bank Dest.</td>
												<td>: <span id="payment-account-bank-destination"></span></td>
											</tr>
											<tr>
												<td>Address</td>
												<td>: <span id="address"></span></td>
												
												<td></td>
												
												<td>Address</td>
												<td>: <span id="billing-address"></span></td>
												
												<td></td>
												
												<td>Cust. Account Bank</td>
												<td>: <span id="payment-account-bank"></span></td>
											</tr>
											<tr>
												<td>City, State</td>
												<td>: <span id="city"></span>, <span id="state"></span></td>
												
												<td></td>
												
												<td>City, State</td>
												<td>: <span id="billing-city"></span>, <span id="billing-state"></span></td>
												
												<td></td>
												
												<td>Cust. Account Num.</td>
												<td>: <span id="payment-account-number"></span></td>
											</tr>
											<tr>
												<td>Ziptal Code</td>
												<td>: <span id="ziptal-code"></span></td>
												
												<td></td>
												
												<td>Ziptal Code</td>
												<td>: <span id="billing-ziptal-code"></span></td>
												
												<td></td>
												
												<td>Cust. Account Name</td>
												<td>: <span id="payment-account-name"></span></td>
											</tr>
											<tr>
												<td>Phone</td>
												<td>: <span id="phone"></span></td>
												
												<td></td>
												
												<td>Phone</td>
												<td>: <span id="billing-phone"></span></td>
												
												<td></td>
												
												<td>Payment Date</td>
												<td>: <span id="payment-date"></span></td>
											</tr>
											<tr>
												<td>Additional Info</td>
												<td>: <span id="additional-info"></span></td>
												
												<td></td>
												
												<td>Payment Method</td>
												<td>: <span id="payment-method"></span></td>
												
												<td></td>
												
												<td>Payment Total</td>
												<td>: <span id="payment-total"></span></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												
												<td></td>
												
												<td>Status Payment</td>
												<td>: <span id="status-display"></span></td>
												
												<td></td>
												
												<td></td>
												<td></td>
											</tr>
										</table>
									</div>
									<div class="clearfix" style="height:30px"></div>
									<div class="cart-table table-responsive">
										<table style="width:100%">
											<thead>
												<tr>
													<th class="p-image">Product Image</th>
													<th class="p-name">Product Name</th>
													<th class="p-edit"></th>
													<th class="p-amount">Unit Price</th>
													<th class="p-quantity">Qty</th>
													<th class="p-total">SubTotal</th>
												</tr>
											</thead>
											<tbody id="detail-product">
											</tbody>
										</table>
									</div>
									<div class="clearfix" style="height:30px"></div>
									<div class="row">
										<div class="col-md-4 floatright">
											<div class="amount-totals">
												<p class="total">
													Subtotal : <span id="subTotal" style="font-weight:bold"></span><br />
													Shipping : <span id="shippingFee" style="font-weight:bold"></span>
												</p>
												<p class="total" style="font-weight:bold">Grand Total : <span id="grandTotal"></span></p>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<p style="float:left">Last update by <i id="update_by"></i> On <i id="update_time"></i></p>
									<select name="status" id="status" class="btn" >
										<?php if(isset($status) && $status){ 
											foreach($status as $key){?>
										<option value="<?php echo $key;?>"><?php echo $key;?></option>
										<?php } } ?>
									</select>
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
	
	<script type="text/javascript" src="assets/js/backend/transactions/order.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						name: {minlength: 4,required: true},
						display: {required: true}
						};			
			
            FormValidation.init('form_order', rules);
            
			TableAjax.init("datatable", "transactions/order/loadOrder");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
