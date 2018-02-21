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
								  <option value="2" data-column="2" selected>Bussiness Field</option>
								  <option value="3" data-column="3" selected>Name</option>
								  <option value="4" data-column="4" selected>Timezone</option>
								  <option value="5" data-column="5" selected>Phone Prefix</option>
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
									<th width="70px">Country</th>
									<th width="70px">Bus. Field</th>
									<th>Name</th>
									<th width="90px">Phone No.</th>
									<th width="120px">E-mail</th>
									<th width="70px">is Active?</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_country" id="search_id_country" class="form-control form-filter input-sm">
											<option value="">- All Country -</option>
											<?php foreach($countries['rows'] as $key) { ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<select name="search_id_business_field" id="search_id_business_field" class="form-control form-filter input-sm">
											<option value="">- All Type -</option>
											<?php foreach($business_fields['rows'] as $key) { ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name"></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_phone" name="search_phone" placeholder="Search by Phone"></td>
									<td><input type="text" class="form-control form-filter input-sm" id="search_email" name="search_email" placeholder="Search by Email"></td>
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
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><?php echo $pageTitle;?></h4>
							</div>
							<form action="javascript:;" id="form_companies" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<select class="form-control" id="list-jabatan" name="list-jabatan" style="display:none">
										<?php
										if($positions['count']){
										foreach($positions['rows'] as $key){
										?><option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option><?php
										} } 
										?>
									</select>
									<select class="form-control" id="list-ship-type" name="list-ship-type" style="display:none">
										<?php
										if($ship_types['count']){
										foreach($ship_types['rows'] as $key){
										?><option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option><?php
										} } 
										?>
									</select>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Company Name</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="255" name="name" id="name" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Modal Disetor</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="255" name="modal_disetor" id="modal_disetor" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">NPWP</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
											<input type="text" maxlength="255" name="npwp" id="npwp" data-required="1" class="form-control" title="Name" placeholder="Name" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Bidang Usaha</label>
									  <div class="col-md-9">
										<select class="form-control" id="business_fields" name="business_fields">
											<option value="">- Bidang Usaha -</option>
											<?php
											if($business_fields['count']){
											foreach($business_fields['rows'] as $key){
											?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php
											} } 
											?>
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Jenis Usaha</label>
									  <div class="col-md-9">
										<div class="checkbox-list">
										<?php
										if($business_types['count']){
										$i=1;
										foreach($business_types['rows'] as $key){
										?>
										<div class="col-lg-6">
											<input type="checkbox" class="form-control business_types" name="business_types_" id="business_types_<?php echo $key['id'];?>" value="<?php echo $key['id'];?>" /> <?php echo $key['name'];?>
										</div>
										<?php							
										} } 
										?>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Alamat</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<textarea class="form-control" id="address" name="address" cols="3"></textarea>
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label"></label>
									  <div class="col-md-9">
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
													<input type="text" maxlength="255" name="city" id="city" data-required="1" class="form-control" title="Name" placeholder="Name" />
													<span class="help-block">Kota <span class="require">*</span></span>
												</div>
										  </div>
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a provinsi" data-container="body"></i>
													<input type="text" maxlength="255" name="region" id="region" data-required="1" class="form-control" title="Provinsi" placeholder="Provinsi" />
													<span class="help-block">Provinsi <span class="require">*</span></span>
												</div>
										  </div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label"></label>
									  <div class="col-md-9">
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a ziptal code" data-container="body"></i>
													<input type="text" maxlength="255" name="ziptal_code" id="ziptal_code" data-required="1" class="form-control" title="Ziptal Code" placeholder="Ziptal Code" />
													<span class="help-block">Kode Pos <span class="require">*</span></span>
												</div>
										  </div>
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please choose a negara" data-container="body"></i>
													<select class="form-control" id="id_country" name="id_country">
														<?php
														if($countries['count']){
														foreach($countries['rows'] as $key){
														?><option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option><?php
														} } 
														?>
													</select>
													<span class="help-block">Negara <span class="require">*</span></span>
												</div>
										  </div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label"></label>
									  <div class="col-md-9">
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a phone" data-container="body"></i>
													<input type="text" maxlength="255" name="phone" id="phone" data-required="1" class="form-control" title="Phone" placeholder="+62 21 351 4348" />
													<span class="help-block">Phone <span class="require">*</span></span>
												</div>
										  </div>
										  <div class="col-md-6">
												<div class="input-icon right">
													<i class="fa fa-exclamation tooltips" data-original-title="please write a fax" data-container="body"></i>
													<input type="text" maxlength="255" name="fax" id="fax" data-required="1" class="form-control" title="Fax" placeholder="+62 21 351 4348" />
													<span class="help-block">Fax <span class="require">*</span></span>
												</div>
										  </div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">E-mail</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a e-mail" data-container="body"></i>
											<input type="text" maxlength="255" name="email" id="email" data-required="1" class="form-control" title="E-mail" placeholder="E-mail" />
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Website</label>
									  <div class="col-md-9">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please write a website" data-container="body"></i>
											<input type="text" maxlength="255" name="website" id="website" data-required="1" class="form-control" title="Website" placeholder="Website" />
										</div>
									  </div>
									</div>
									
									<!-- Document -->
									<div class="form-group">
									  <label  class="col-md-3 control-label">SK Kemen. Hukum dan Ham</label>
									  <div class="col-md-9">
										<div class="input-icon right" id="skkemenkumham"></div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">SIUPAL/ SIOPSUS</label>
									  <div class="col-md-9">
										<div class="input-icon right" id="siupal_siopsus"></div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Logo Perusahaan</label>
									  <div class="col-md-9">
										<div class="input-icon right" id="logo"></div>
									  </div>
									</div>
									<div class="form-group">
									  <label  class="col-md-3 control-label">Foto Kapal</label>
									  <div class="col-md-9">
										<div class="input-icon right" id="foto_kapal"></div>
									  </div>
									</div>
									
									<h4>Dewan Komisaris</h4>
									<div class="col-md-12 margin-bottom-30">
										<div class="form-group" id="list-komisaris"></div>
									</div>
									
									<h4>Dewan Direksi</h4>
									<div class="col-md-12 margin-bottom-30">
										<div class="form-group" id="list-direksi"></div>
									</div>
									
									<h4>Armada</h4>
									<div class="col-md-12 margin-bottom-30">
										<div class="form-group" id="list-armada"></div>
									</div>
									
									<h4>Person in Charge</h4>
									<div class="col-md-12 margin-bottom-30">
										<div class="form-group" id="list-pic"></div>
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
				
				<!-- Modal Re-Generate -->
				<a href="#" class="btn default yellow-stripe" id="btn-regenerate" data-target="#formReGenerate" data-toggle="modal" style="display:none"><span class="hidden-480">Add <?php echo $pageTitle;?> </span></a>
				<div id="formReGenerate" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h3>Re-generate User Password Confirmation</h3>
							</div>
							<div class="modal-body">
								<p>Are you sure want to Re-generate Password and send for this Company?</p>
							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn">Cancel</button>
								<button type="button" data-dismiss="modal" class="btn green" onClick="saveAct('0')">Confirm Not Send</button>
								<button type="button" data-dismiss="modal" class="btn blue" onClick="saveAct('1')">Confirm Send</button>
							</div>
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
	
	<script type="text/javascript" src="assets/js/backend/management/member/companies.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						name: {minlength: 4,required: true},
						code: {required: true}
						};			
			
            FormValidation.init('form_companies', rules);
            
			TableAjax.init("datatable", "member-management/companies/loadCompanies");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
						
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
