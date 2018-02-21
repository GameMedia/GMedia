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
								  <option value="2" data-column="2" selected>Name</option>
								  <option value="3" data-column="3" selected>Paspor No.</option>
								  <option value="4" data-column="4" selected>Phone</option>
								  <option value="5" data-column="5" selected>Is Active?</option>
								  <option value="6" data-column="6" selected>Action</option>
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
									<th>Name</th>
									<th width="70px">Paspor No.</th>
									<th width="100px">Phone</th>
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
										<input type="text" class="form-control form-filter input-sm" id="search_name" name="search_name" placeholder="Search by Name">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_paspor_no" name="search_paspor_no" placeholder="Search by Principal">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" id="search_phone" name="search_phone" placeholder="Search by Pencharter">
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
							<form action="javascript:;" id="form_abtc" class="form-horizontal">
								<div class="modal-body">
									<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
									<div class="form-group">
									  <label  class="col-md-4 control-label">Company</label>
									  <div class="col-md-8">
										<div class="input-icon right">
											<i class="fa fa-exclamation tooltips" data-original-title="please Choose a company" data-container="body"></i>
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
									  <label for="tenaga" class="col-lg-4 control-label">Nama Lengkap </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="name" name="name">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Jenis Kelamin </label>
									  <div class="col-lg-3">
										<select class="form-control" id="gender" name="gender">
											<option value="L">Laki-laki</option>
											<option value="P">Perempuan</option>
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Tempat, Tanggal Lahir </label>
									  <div class="col-lg-5">
										<input type="text" class="form-control" id="birth_place" name="birth_place">
									  </div>
									  <div class="col-lg-3">
										<input type="text" class="form-control" id="birth_date" name="birth_date">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Alamat </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="address" name="address">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Kota </label>
									  <div class="col-lg-3">
										  <input type="text" class="form-control" id="city" name="city">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-6 control-label">Kode Pos </label>
										<div class="col-lg-6">
										  <input type="text" class="form-control" id="ziptal_code" name="ziptal_code">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Phone</label>
									  <div class="col-lg-4">
										<input type="text" class="form-control" id="phone" name="phone">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Pekerjaan </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="occupation" name="occupation">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Perusahaan/Instansi </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="company" name="company">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Bidang </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="field" name="field">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Alamat Kantor </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="office_address" name="office_address">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Kota </label>
									  <div class="col-lg-3">
										  <input type="text" class="form-control" id="office_city" name="office_city">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-6 control-label">Kode Pos </label>
										<div class="col-lg-6">
										  <input type="text" class="form-control" id="office_ziptal_code" name="office_ziptal_code">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Phone </label>
									  <div class="col-lg-3">
										<input type="text" class="form-control" id="office_phone" name="office_phone">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-3 control-label">Fax</label>
										<div class="col-lg-9">
										  <input type="text" class="form-control" id="office_fax" name="office_fax">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Email </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="office_email" name="office_email">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Referensi di Luar Negeri </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="reference_address" name="reference_address">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Kota </label>
									  <div class="col-lg-3">
										  <input type="text" class="form-control" id="reference_city" name="reference_city">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-6 control-label">Kode Pos </label>
										<div class="col-lg-6">
										  <input type="text" class="form-control" id="reference_ziptal_code" name="reference_ziptal_code">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Phone </label>
									  <div class="col-lg-3">
										<input type="text" class="form-control" id="reference_phone" name="reference_phone">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-3 control-label">Fax</label>
										<div class="col-lg-9">
										  <input type="text" class="form-control" id="reference_fax" name="reference_fax">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Email </label>
									  <div class="col-lg-8">
										<input type="text" class="form-control" id="reference_email" name="reference_email">
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Paspor No. </label>
									  <div class="col-lg-3">
										<input type="text" class="form-control" id="paspor_no" name="paspor_no">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-6 control-label">Tgl </label>
										<div class="col-lg-6">
										  <input type="text" class="form-control" id="paspor_date" name="paspor_date">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Dikeluarkan di </label>
									  <div class="col-lg-3">
										<input type="text" class="form-control" id="paspor_issue" name="paspor_issue">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-6 control-label">Berlaku s/d </label>
										<div class="col-lg-6">
										  <input type="text" class="form-control" id="paspor_expired" name="paspor_expired">
										</div>
									  </div>
									</div>
									<div class="form-group">
									  <label for="tenaga" class="col-lg-4 control-label">Nomor KTP </label>
									  <div class="col-lg-3">
										<input type="text" class="form-control" id="identification_no" name="identification_no">
									  </div>
									  <div class="col-lg-5">
										<label for="tenaga" class="col-lg-6 control-label">Berlaku s/d </label>
										<div class="col-lg-6">
										  <input type="text" class="form-control" id="identification_expired" name="identification_expired">
										</div>
									  </div>
									</div>
									
									<div class="form-group">
									  <label  class="col-md-4 control-label">Status</label>
									  <div class="col-md-8">
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
	
	<script type="text/javascript" src="assets/js/backend/management/member/abtc.js?<?php echo date("mdH");?>"></script>
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
			
            FormValidation.init('form_abtc', rules);
            
			TableAjax.init("datatable", "member-management/abtc/loadAbtc");
			UIToastr.init();
			
			bootstrapMultiselect("colList");	
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>
