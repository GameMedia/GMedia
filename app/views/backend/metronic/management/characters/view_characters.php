				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>datatables/plugins/bootstrap/dataTables.bootstrap.css" type="text/css"/>
				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>bootstrap-toastr/toastr.min.css" type="text/css"/>
				<link rel="stylesheet" href="<?php echo ASSETS_PLUGINS;?>bootstrap-multiselect/bootstrap-multiselect.css" type="text/css"/>
				<!--<div class="row margin-top-20">-->
				<div class="col-md-12 column sortable" id="list-characters">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase"><?php echo $pageTitle;?></span>
							</div>
							<div class="actions">
								<select id="colList" multiple="multiple" class="toggle-vis yellow-stripe">
								  <option value="0" data-column="0" selected>Rec</option>
								  <option value="1" data-column="1" selected>Game</option>
								  <option value="2" data-column="2" selected>Element</option>
								  <option value="3" data-column="3" selected>Grade</option>
								  <option value="4" data-column="4" selected>Type</option>
								  <option value="5" data-column="5" selected>Name</option>
								  <option value="6" data-column="6" selected>Image</option>
								  <option value="7" data-column="7" selected>Is Active?</option>
								  <option value="8" data-column="8" selected>Action</option>
								</select>
								<?php if($accessAdd){?>
								<a href="javascript:;" class="btn default yellow-stripe" onclick="showView(1)">
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
									<th width="100px">Game</th>
									<th width="100px">Element</th>
									<th width="100px">Grade</th>
									<th width="100px">Type</th>
									<th>Name</th>
									<th class="no-sort" width="80px">Image</th>
									<th width="70px">is Active?</th>
									<th  class="no-sort"width="100px">Actions</th>
								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<select name="search_id_game" id="search_id_game" data-required="1" class="form-control form-filter input-sm" title="Game">
											<option value="">- All Game -</option>
											<?php foreach($games['rows'] as $key){ ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<select name="search_id_character_element" id="search_id_character_element" data-required="1" class="form-control form-filter input-sm" title="Type">
											<option value="">- All Element -</option>
											<?php foreach($characters_elements['rows'] as $key){ ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<select name="search_id_character_grade" id="search_id_character_grade" data-required="1" class="form-control form-filter input-sm" title="Type">
											<option value="">- All Grade -</option>
											<?php foreach($characters_grades['rows'] as $key){ ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<select name="search_id_character_type" id="search_id_character_type" data-required="1" class="form-control form-filter input-sm" title="Type">
											<option value="">- All Type -</option>
											<?php foreach($characters_types['rows'] as $key){ ?>
											<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
											<?php } ?>
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
				<!-- <div id="formAdd" class="modal fade" tabindex="-1" data-backdrop="static" data-width="400" data-keyboard="false" data-attention-animation="true">-->
				<div class="col-md-12 column sortable" id="view-characters" style="display:none">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase"><?php echo $pageTitle;?></span>
							</div>
							<div class="actions">
								<a href="javascript:;" class="btn default yellow-stripe" onclick="showView(0)">
									<i class="fa fa-bars"></i><span class="hidden-480"> Lists <?php echo $pageTitle;?> </span>
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<form action="javascript:;" id="form_characterss" class="form-horizontal">
									<div class="modal-body">
										<input type="hidden" name="id" id="id" readonly class="span6 m-wrap"/>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Game</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please choose an Website" data-container="body"></i>
												<select name="id_game" id="id_game" data-required="1" class="form-control" title="Website">
													<option value="">- Choose game -</option>
													<?php foreach($games['rows'] as $key){ ?>
													<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
													<?php } ?>
												</select>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Elements</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please choose an Elements" data-container="body"></i>
												<select name="id_character_element" id="id_character_element" data-required="1" class="form-control" title="Element">
													<option value="">- Choose Element -</option>
													<?php foreach($characters_elements['rows'] as $key){ ?>
													<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
													<?php } ?>
												</select>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Grade</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please choose an Grade" data-container="body"></i>
												<select name="id_character_grade" id="id_character_grade" data-required="1" class="form-control" title="Grade">
													<option value="">- Choose Grade -</option>
													<?php foreach($characters_grades['rows'] as $key){ ?>
													<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
													<?php } ?>
												</select>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Type</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please choose an Grade" data-container="body"></i>
												<select name="id_character_type" id="id_character_type" data-required="1" class="form-control" title="Type">
													<option value="">- Choose Type -</option>
													<?php foreach($characters_types['rows'] as $key){ ?>
													<option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
													<?php } ?>
												</select>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Name</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please write a name" data-container="body"></i>
												<input type="text" maxlength="255" name="name" id="name" data-required="1" class="form-control" title="Name" placeholder="Name" />
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Power</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please write a power" data-container="body"></i>
												<input type="text" maxlength="255" name="power" id="power" data-required="1" class="form-control" title="Power" placeholder="Power" />
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Description</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please write a Description" data-container="body"></i>
												<textarea name="description" id="description" data-required="1" class="form-control" title="Description" rows="5"></textarea>
											</div>
										  </div>
										</div>						
										<div class="form-group">
										  <label  class="col-md-2 control-label">ATK</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="atk" id="atk" data-required="1" class="form-control" title="ATK" placeholder="ATK"/>
											</div>
										  </div>
										  <label  class="col-md-2 control-label">HP</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="hp" id="hp" data-required="1" class="form-control" title="HP" placeholder="HP"/>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">DEF</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="def" id="def" data-required="1" class="form-control" title="DEF" placeholder="DEF"/>
											</div>
										  </div>
										  <label  class="col-md-2 control-label">MDEF</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="mdef" id="mdef" data-required="1" class="form-control" title="MDEF" placeholder="MDEF"/>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Speed</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="speed" id="speed" data-required="1" class="form-control" title="Speed" placeholder="Speed"/>
											</div>
										  </div>
										  <label  class="col-md-2 control-label">Crit Rate</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<i>%</i>
												<input type="text" maxlength="20" name="crit_rate" id="crit_rate" data-required="1" class="form-control" title="Crit Rate" placeholder="Crit Rate"/>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Crit Res Rate</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<i>%</i>
												<input type="text" maxlength="20" name="crit_res_rate" id="crit_res_rate" data-required="1" class="form-control" title="Crit Res Rate" placeholder="Crit Res Rate"/>
											</div>
										  </div>
										  <label  class="col-md-2 control-label">Hit Chance</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="hit_chance" id="hit_chance" data-required="1" class="form-control" title="Hit Chance" placeholder="Hit Chance"/>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Dodge Rate</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<i>%</i>
												<input type="text" maxlength="20" name="dodge_rate" id="dodge_rate" data-required="1" class="form-control" title="Dodge Rate" placeholder="Dodge Rate"/>
											</div>
										  </div>
										  <label  class="col-md-2 control-label">DMG</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="dmg" id="dmg" data-required="1" class="form-control" title="DMG" placeholder="DMG"/>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">DMG Reduce</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<i>%</i>
												<input type="text" maxlength="20" name="dmg_reduce" id="dmg_reduce" data-required="1" class="form-control" title="DMG Reduce" placeholder="DMG Reduce"/>
											</div>
										  </div>
										  <label  class="col-md-2 control-label">PVP DMG</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<input type="text" maxlength="20" name="pvp_dmg" id="pvp_dmg" data-required="1" class="form-control" title="PVP DMG" placeholder="PVP DMG"/>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">PVP Immune</label>
										  <div class="col-md-4">
											<div class="input-icon right">
												<i>%</i>
												<input type="text" maxlength="20" name="pvp_immune" id="pvp_immune" data-required="1" class="form-control" title="PVP Immune" placeholder="PVP Immune"/>
											</div>
										  </div>
										</div>
										<div class="form-group">
										  <label  class="col-md-2 control-label">Image</label>
										  <div class="col-md-10">
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
										  <label  class="col-md-2 control-label">is Active?</label>
										  <div class="col-md-10">
											<div class="input-icon right">
												<i class="fa fa-exclamation tooltips" data-original-title="please choose is Active" data-container="body"></i>
												<input type="checkbox" id="status" name="status" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
											</div>
										  </div>
										</div>
									</div>
									<div class="modal-footer">
										<p style="float:left">Last update by <i id="update_by"></i> On <i id="update_time"></i></p>
										<button type="button" class="btn btn-close-modal" data-dismiss="modal" onclick="clearForm();showView(0)">Close</button>
										<button type="submit" class="btn red<?php echo ($accessEdit)?' btn-edit':'';?><?php echo ($accessAdd)?' btn-add':'';?>"><i class="fa fa-save"></i> Save</button>
									</div>
								</form>
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
	
	<script type="text/javascript" src="assets/js/backend/management/characters/characters.js?<?php echo date("mdH");?>"></script>
	<script type="text/javascript">
		var deleteID = "",
			deleteLangID = "";
		
		jQuery(document).ready(function() {	
			//Define Validation
			var rules = {
						id_game: {required: true},
						id_character_element: {required: true},
						name: {minlength: 2,required: true}
						};			
			
            FormValidation.init('form_characterss', rules);
            
			TableAjax.init("datatable", "characters-management/characters/loadCharacters");
			UIToastr.init();
			
			bootstrapMultiselect("colList");
		});
    </script>
<?php $this->load->view($folderLayout.'_modal');?>