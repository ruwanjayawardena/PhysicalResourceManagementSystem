<?php include './access_control/session_controler.php'; ?> 
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>        
    </head>
    <body>
        <!--navbar-->
		<?php include 'includes/backend-navbar.php'; ?>       

        <!--body content-->
        <section class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-user-circle"></i> GRN <small>Receive By Institute</small> <span class="badge badge-dark">Step 2</span> <small>Add GRN Items  </small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button>&nbsp;<button class="btn btn-success d-print-none" id="btn_completegrn"><i class="fas fa-stop-circle"></i> GRN Complete</button></h4>                       
                    </div>
                </div>

				<input type="hidden" class="form-control" id="grn_id" value="<?php
				if (isset($_REQUEST['grn_id']) && !empty($_REQUEST['grn_id'])) {
					echo $_REQUEST['grn_id'];
				}
				?>">
				<input type="hidden" class="form-control" id="issu_id" value="<?php
				if (isset($_REQUEST['issu_id']) && !empty($_REQUEST['issu_id'])) {
					echo $_REQUEST['issu_id'];
				}
				?>">
				<div class="row">
					<div class="col-lg-12 col-sm-12">
						<input type="hidden" id="selected_issue_items">
						<h4><span class="badge badge-dark">Received (Issue) Item</span></h4>
						<div class="row">
							<div class="col-3">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<th>Issue No</th>
											<td class="issu_custom_issueno"></td>
										</tr>
										<tr>
											<th>Issued Date | Time</th>
											<td><span class="issu_date"></span> | <span class="issu_time"></span></td>
										</tr>
										<tr>
											<th>Issue Description</th>
											<td class="issu_description"></td>
										</tr>
										<tr>
											<th>Issued Institute</th>
											<td class="issue_institute_desc"></td>										
										</tr>
									</tbody>
								</table>							
							</div>

							<div class="col-9">
								<button class="btn btn-primary mb-2" id="btn_addIssueItem">Add Selected Items</button>
								<div class="alert alert-warning">
									<strong>NOTE</strong> <small>First make changes received item qty,status,description according to your need and after finalize your editing select each items (for process you need to take action for all received items.) by checking checkbox .then press "add selected item" button"</small>
								</div>
								<div class="table-responsive">
									<table id="tblIssueItem" class="table table-bordered table-hover" style="width:100%">
										<thead class="thead-dark">
											<tr>
												<th></th>                                
												<th></th>
												<th>Item</th>
												<th>Attribute - Valuation</th>
												<th>Issued Qty</th>                                        
												<th>GRN Item Adding Status</th>                                        
												<th>GRN Selected Qty</th>                                        
												<th>GRN Item Description</th>                                        
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>				
					<div class="col bg-light p-1">
						<div class="row">
							<div class="col-3">
								<h4><span class="badge badge-warning">GRN Selected Item</span></h4>			
								<table class="table table-bordered">
									<tbody>
										<tr>
											<th>GRN No</th>
											<td class="grn_custom_no"></td>
										</tr>										
										<tr>
											<th>GRN Description</th>
											<td class="grn_description"></td>
										</tr>										
									</tbody>
								</table>							
							</div>
							<div class="col-9 pt-4">
								<div class="table-responsive">
									<table id="tblGrnItemInstitute" class="table table-bordered table-hover" style="width:100%">
										<thead class="thead-dark">
											<tr>
												<th></th>                                
												<th></th>
												<th>Item</th>
												<th>Attribute - Valuation</th>
												<th>Available Qty</th>
												<th>GRN Adding Status</th>                                        
												<th>GRN Selected Qty</th>                                        
												<th>GRN Returned Qty</th>
												<th>Description</th>                                       
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>							

					</div>
				</div>


			</div>		
		</section>
		<?php
		include './includes/end-block.php';
		include './includes/comboboxJS.php';
		include './includes/commonJS.php';
		?>  
		<script>
			function getIssueStep1DataByID() {
				var issu_id = $('#issu_id').val();
				$.post('controllers/issueController.php', {action: 'getIssueByIDReport', issu_id: issu_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('.issu_custom_issueno').html('').append('<h4><span class="badge badge-dark">' + qdt.issu_custom_issueno + '</span></h4>');
						$('.issue_institute_desc').html('').append('<strong><small>(' + qdt.issue_prov_name + '/' + qdt.issue_zol_name + '/' + qdt.issue_div_name + '/' + qdt.issue_insttype_name + ')</small><br>' + qdt.issue_inst_name + '</strong><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.issue_inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.issue_inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.issue_inst_email);
						$('.issu_description').html('').append(qdt.issu_description);
						$('.issu_date').html('').append(qdt.issu_date);
						$('.issu_time').html('').append(qdt.issu_time);
						$('.issu_send_institute_desc').html('').append('<strong>Issue Send Institute : </strong><i><strong>' + qdt.inst_name + '</strong></i><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.inst_email);

					});
				}, "json");
			}

			function tblIssueItem(callback) {
				var istm_issue_id = $('#issu_id').val()
				var grtm_grn_id = $('#grn_id').val();
				var tbldata = "";
				$.post('controllers/issueController.php', {action: 'getAllIssueItemNotInGRN', istm_issue_id: istm_issue_id, grtm_grn_id: grtm_grn_id}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						tbldata += '<tr>';
						tbldata += '<td colspan="8" class="bg-danger text-center"> -- Received items not available -- </td>';
						tbldata += '</tr>';
						$('#tblIssueItem tbody').html('').append(tbldata);
					} else {
						$.each(e, function (index, qdt) {
							index++;
							tbldata += '<tr>';
							tbldata += '<td>';
							tbldata += '<div class="form-group form-check"><input type="checkbox" class="form-check-input chk_selected_issueitem" value="' + qdt.istm_id + '-' + qdt.istm_item + '-' + qdt.istm_item_attribute + '"></div>';
							tbldata += '</td>';
							tbldata += '<td></td>';
							tbldata += '<td>' + qdt.itm_name + '(' + qdt.itm_code + ')</td>';
							tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
							tbldata += '<td id="issued_qty_' + qdt.istm_id + '">' + qdt.istm_qty + '</td>';
							tbldata += '<td>';
							tbldata += '<select class="form-control" id="grtm_status_' + qdt.istm_id + '">'
							tbldata += '<option value="1">Full Add</option>'
							tbldata += '<option value="2">Full Return</option>'
							tbldata += '<option value="3">Partially add and Return</option>'
							tbldata += '</select>'
							tbldata += '</td>';
							tbldata += '<td>';
							tbldata += '<input type="number" class="form-control grn_qtyctrl" id="grtm_qty_' + qdt.istm_id + '" placeholder="GRN Qty" autocomplete="off" value="' + qdt.istm_qty + '" min="0" max="' + qdt.istm_qty + '" required>';
							tbldata += '</td>';
							tbldata += '<td>';
							tbldata += '<textarea class="form-control ctrl_description" id="grtm_description_' + qdt.istm_id + '" placeholder="Description" autocomplete="off" rows="3" required></textarea>';
							tbldata += '</td>';
							tbldata += '</tr>';
						});


						if ($.fn.DataTable.isDataTable('#tblIssueItem')) {
							//re initialize 
							$('#tblIssueItem').DataTable().destroy();
							$('#tblIssueItem tbody').empty();
							$('#tblIssueItem tbody').html('').append(tbldata);
							$('#tblIssueItem').DataTable({
								responsive: {
									details: {
										type: 'column',
										target: 'tr'
									}
								},
								columnDefs: [
									{className: 'control text-right', orderable: false, targets: 1},
									{orderable: false, targets: 0}
								],
								order: [2, 'asc']
							});
						} else {
							//initilized                    
							$('#tblIssueItem tbody').html('').append(tbldata);
							$('#tblIssueItem').DataTable({
								responsive: {
									details: {
										type: 'column',
										target: 'tr'
									}
								},
								columnDefs: [
									{className: 'control text-right', orderable: false, targets: 1},
									{orderable: false, targets: 0}
								],
								order: [2, 'asc']
							});
						}

						$('[data-toggle="tooltip"]').tooltip();
					}

					$('.grn_qtyctrl').keyup(function () {
						var grnqty = $(this).val();
						var max = $(this).attr('max');
						if ($.isNumeric(grnqty)) {
							if (parseInt(grnqty) < 0) {
								$(this).val(0)
							} else if (parseInt(grnqty) > parseInt(max)) {
								$(this).val(max)
							}
						} else {
							$(this).val(0)
						}
					});


					$('.chk_selected_issueitem').click(function () {
						var ar = [];
						var es;
						var v;
						if ($(this).is(':checked')) {
							es = $('.chk_selected_issueitem:checked');
							es.each(function (index) {
								var istmstr = $(this).val();
								var istmAr = istmstr.split('-');
								var istm_id = istmAr[0];
								var grtm_item = istmAr[1];
								var grtm_item_attribute = istmAr[2];
								var grtm_status = $('#grtm_status_' + istm_id).val();
								var grtm_qty = $('#grtm_qty_' + istm_id).val();
								var grtm_description = $('#grtm_description_' + istm_id).val();
								var issued_qty = $('#issued_qty_' + istm_id).html();
								var grtm_return_qty = 0;
//						1 - full added, 2 - full return,3 - partially added & return
								if (parseInt(grtm_status) == 1) {
									grtm_return_qty = 0;
									grtm_qty = issued_qty;
								} else if (parseInt(grtm_status) == 2) {
									grtm_return_qty = issued_qty;
									grtm_qty = 0;
								} else if (parseInt(grtm_status) == 3) {
									grtm_return_qty = parseInt(issued_qty) - parseInt(grtm_qty);
								}
								var storevalue = grtm_item + '-' + grtm_item_attribute + '-' + grtm_status + '-' + grtm_qty + '-' + grtm_return_qty + '-"' + grtm_description + '"';
								ar.push(storevalue);
							});
						} else {
							es = $('.chk_selected_issueitem:checked');
							es.each(function (index) {
								var istmstr = $(this).val();
								var istmAr = istmstr.split('-');
								var istm_id = istmAr[0];
								var grtm_item = istmAr[1];
								var grtm_item_attribute = istmAr[2];
								var grtm_status = $('#grtm_status_' + istm_id).val();
								var grtm_qty = $('#grtm_qty_' + istm_id).val();
								var grtm_description = $('#grtm_description_' + istm_id).val();
								var issued_qty = $('#issued_qty_' + istm_id).html();
								var grtm_return_qty = 0;
//						1 - full added, 2 - full return,3 - partially added & return
								if (parseInt(grtm_status) == 1) {
									grtm_return_qty = 0;
									grtm_qty = issued_qty;
								} else if (parseInt(grtm_status) == 2) {
									grtm_return_qty = issued_qty;
									grtm_qty = 0;
								} else if (parseInt(grtm_status) == 3) {
									grtm_return_qty = parseInt(issued_qty) - parseInt(grtm_qty);
								}
								var storevalue = grtm_item + '-' + grtm_item_attribute + '-' + grtm_status + '-' + grtm_qty + '-' + grtm_return_qty + '-"' + grtm_description + '"';
								ar.push(storevalue);
							});
						}
						v = ar.join(',');
						$('#selected_issue_items').val(v);
					});


					if (callback !== undefined) {
						if (typeof callback === 'function') {
							callback();
						}
					}
				}, "json");
			}

			function tblGrnItemInstitute(callback) {
				var grtm_grn_id = $('#grn_id').val()
				var tbldata = "";
				$.post('controllers/grnController.php', {action: 'getAllGrnItemInstitute', grtm_grn_id: grtm_grn_id}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						tbldata += '<tr>';
						tbldata += '<td colspan="9" class="bg-danger text-center"> -- GRN items not available -- </td>';
						tbldata += '</tr>';
						$('#tblGrnItemInstitute tbody').html('').append(tbldata);
					} else {
						$.each(e, function (index, qdt) {
							index++;
							tbldata += '<tr>';
							tbldata += '<td>';
							tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.grtm_id + '"><i class="fas fa-trash-alt"></i></button>';
							tbldata += '</td>';
							tbldata += '<td></td>';
							tbldata += '<td><h5 style="font-size:10.5pt">' + qdt.itm_name + ' <span class="badge badge-dark">' + qdt.itm_code + '</span></h5></td>';
							tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
							tbldata += '<td>' + qdt.stk_qty + '</td>';
//							1 - full added, 2 - full return,3 - partially added & return
							if (parseInt(qdt.grtm_status) == 1) {
								tbldata += '<td> Full Qty added </td>';
							} else if (parseInt(qdt.grtm_status) == 2) {
								tbldata += '<td> Full Qty returned</td>';
							} else if (parseInt(qdt.grtm_status) == 3) {
								tbldata += '<td> Partially Added and rest QTY returned</td>';
							}
							tbldata += '<td>' + qdt.grtm_qty + '</td>';
							if (parseInt(qdt.grtm_status) == 1) {
								tbldata += '<td> Not Returned </td>';
							} else if (parseInt(qdt.grtm_status) == 2) {
								tbldata += '<td>' + qdt.grtm_return_qty + '</td>';
							} else if (parseInt(qdt.grtm_status) == 3) {
								if (parseInt(qdt.grtm_return_qty) == 0) {
									tbldata += '<td> Not Returned </td>';
								} else {
									tbldata += '<td>' + qdt.grtm_return_qty + '</td>';
								}
							}

							tbldata += '<td>' + qdt.grtm_description + '</td>';
							tbldata += '</tr>';
						});


						if ($.fn.DataTable.isDataTable('#tblGrnItemInstitute')) {
							//re initialize 
							$('#tblGrnItemInstitute').DataTable().destroy();
							$('#tblGrnItemInstitute tbody').empty();
							$('#tblGrnItemInstitute tbody').html('').append(tbldata);
							$('#tblGrnItemInstitute').DataTable({
								responsive: {
									details: {
										type: 'column',
										target: 'tr'
									}
								},
								columnDefs: [
									{className: 'control text-right', orderable: false, targets: 1},
									{orderable: false, targets: 0}
								],
								order: [2, 'asc']
							});
						} else {
							//initilized                    
							$('#tblGrnItemInstitute tbody').html('').append(tbldata);
							$('#tblGrnItemInstitute').DataTable({
								responsive: {
									details: {
										type: 'column',
										target: 'tr'
									}
								},
								columnDefs: [
									{className: 'control text-right', orderable: false, targets: 1},
									{orderable: false, targets: 0}
								],
								order: [2, 'asc']
							});
						}

						$('[data-toggle="tooltip"]').tooltip();
					}

					$('.btn_delete').click(function () {
						var grtm_id = $(this).val();
						swal({
							title: "Are you sure?",
							text: "Do you want to delete this item ?",
							type: "warning",
							showCancelButton: true,
							confirmButtonClass: "btn-danger",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						}, function () {
							$.post('controllers/grnController.php', {action: 'deleteGrnItem', grtm_id: grtm_id}, function (e) {
								if (parseInt(e.msgType) == 1) {
									swal("Good Job!", e.msg, "success");
									tblGrnItemInstitute();
									tblIssueItem();
								} else {
									swal("Error!", e.msg, "error");
								}
							}, "json");
						});
					});

					if (callback !== undefined) {
						if (typeof callback === 'function') {
							callback();
						}
					}
				}, "json");
			}

			function completeGrn() {
				swal({
					title: "GRN Complete ?",
					text: "Do you want to complete these GRN recept ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-success",
					cancelButtonClass: "btn-light",
					confirmButtonText: "Yes, complete this!",
					closeOnConfirm: false
				}, function () {
					var grn_id = $('#grn_id').val();
					var grn_issue_id = $('#issu_id').val();
					var postdata = {
						action: "completeGrnInstitute",
						grn_id: grn_id,
						grn_issue_id: grn_issue_id
					}
					$.post('controllers/grnController.php', postdata, function (e) {
						if (parseInt(e.msgType) == 1) {
							swal({
								title: "Good Job!",
								text: e.msg + 'Please wait for navigating supplier GRN Info section',
								type: "success",
								timer: 1800,
								showConfirmButton: false
							});
							setTimeout(function () {
								window.location.href = 'grninstituteinfotable.php';
							}, 2300);
							swal("Good Job!", e.msg, "success");
						} else {
							swal("Alert !", e.msg, "error");
						}
					}, "json");
				});



			}


			function getGrnStep1DataByID() {
				var grn_id = $('#grn_id').val();
				$.post('controllers/grnController.php', {action: 'getGrnInstituteByID', grn_id: grn_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('.grn_custom_no').html('').append('<h4><span class="badge badge-warning">' + qdt.grn_custom_no + '</span></h4>');
						$('.grn_description').html('').append(qdt.grn_description);

					});
				}, "json");
			}

			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				getGrnStep1DataByID();
				tblGrnItemInstitute();
				tblIssueItem();
				getIssueStep1DataByID();

				$('#btn_addIssueItem').click(function () {
					var selected_issue_items = $('#selected_issue_items').val();
					var grtm_grn_id = $('#grn_id').val();
					swal({
						title: "Add Received Items !",
						text: "Are you sure want to add these items ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-success",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, Add !",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/grnController.php', {action: 'saveGrnItemInstitute', grtm_grn_id: grtm_grn_id, selected_issue_items: selected_issue_items}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								tblGrnItemInstitute();
								tblIssueItem();
							} else {
								swal("Error!", e.msg, "error");
							}
						}, "json");
					});
				});

				$('#btn_completegrn').click(function () {
					completeGrn();
				});

			});
		</script>
	</body>
</html>