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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-user-circle"></i> GRN <small>Receive By Supplier</small> <span class="badge badge-dark">Step 2</span> <small>Add GRN Items  </small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button>&nbsp;<button class="btn btn-success d-print-none" id="btn_completegrn"><i class="fas fa-stop-circle"></i> GRN Complete</button></h4>                       
                    </div>
                </div>

				<input type="hidden" class="form-control" id="grn_id" value="<?php
				if (isset($_REQUEST['grn_id']) && !empty($_REQUEST['grn_id'])) {
					echo $_REQUEST['grn_id'];
				}
				?>">
				<div class="row">
					<div class="col-lg-5 col-sm-12">
						<form id="grnstep2form" novalidate>
							<div class="row">
								<div class="col-lg-6 col-sm-12 col-xs-12 pb-4">
									<div class="form-row">
										<input type="hidden" class="form-control" id="grtm_id">
										<div class="col-12">
											<div class="form-group">
												<label>
													<span class="grn_custom_no"></span><br>
													<span class="grn_description"></span><br>
													<span class="grn_supplier_desc"></span>
												</label>                                        
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="cmbItemMainCategory">Choose Main Category</label>
												<select class="col-12 form-control cmbItemMainCategory form-control-chosen" data-placeholder="Choose a main category..." required>
													<option value="" disabled selected>Loading...</option>
												</select>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please choose item main category
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="cmbItemSub1Category">Choose 1<sup>st</sup> Sub Category</label>
												<select class="col-12 form-control cmbItemSub1Category form-control-chosen" data-placeholder="Choose a 1st sub category..." required>
													<option value="" disabled selected>Loading...</option>
												</select>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please choose item 1st sub category
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="cmbItemSub2Category">Choose 2<sup>nd</sup> Sub Category</label>
												<select class="col-12 form-control cmbItemSub2Category form-control-chosen" data-placeholder="Choose a 2nd sub category..." required>
													<option value="" disabled selected>Loading...</option>
												</select>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please choose item 2st sub category
												</div>
											</div>
										</div>
									</div>
								</div>  
								<div class="col">
									<div class="form-row">	
										<div class="col-12">
											<div class="form-group">
												<label for="cmbItem">Choose Item</label>
												<select class="col-12 form-control cmbItem form-control-chosen" data-placeholder="Choose a item..." required>
													<option value="" disabled selected>Loading...</option>
												</select>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please choose item
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="cmbAttributeType">Choose Attribute Type</label>
												<select class="col-12 form-control cmbAttributeType form-control-chosen" data-placeholder="Choose a attribute type..." required>
													<option value="" disabled selected>Loading...</option>
												</select>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please choose item attribute type
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="cmbAttribute">Choose Attributes</label>
												<select class="col-12 form-control cmbAttribute form-control-chosen" data-placeholder="Choose a attribute ..." required>
													<option value="" disabled selected>Loading...</option>
												</select>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please choose item attribute 
												</div>
											</div>
										</div>							
										<div class="col-12">
											<div class="form-group">
												<label for="itm_available_qty">Available Qty</label>
												<input type="text" class="form-control" id="itm_available_qty" disabled="true">
											</div>
										</div>	
										<div class="col-5">
											<div class="form-group">
												<label for="grtm_qty">GRN Qty</label>
												<input type="number" class="form-control" id="grtm_qty" placeholder="GRN Qty" autocomplete="off" value="0" min="0" required>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please enter GRN Qty
												</div>
											</div> 
										</div>	
										<div class="col-5">
											<div class="form-group">
												<label for="grtm_unitprice">Unit Price</label>
												<input type="text" class="form-control" id="grtm_unitprice" placeholder="Unit Price" autocomplete="off" required>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Unit Price
												</div>
											</div> 
										</div>	
										<div class="col-12">
											<div class="form-group">
												<label for="grtm_description">Description</label>
												<textarea class="form-control" id="grtm_description" placeholder="Description" autocomplete="off" rows="3" required></textarea>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Description
												</div>
											</div> 
										</div>	
										<div class="col-12">
											<div class="form-group form-controllers-div">
												<button class="btn btn-primary" id="btn_save"><i class="fas fa-save"></i> Add</button>
												<button class="btn btn-warning" id="btn_edit" hidden><i class="fas fa-edit"></i> Update</button>
												<button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
											</div>
											<div class="form-group controlMsg"></div>
										</div>

									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col">
						<div class="col-12">
							<div class="table-responsive">
								<table id="tblGrnItemSupplier" class="table table-bordered table-hover" style="width:100%">
									<thead class="thead-dark">
										<tr>
											<th></th>                                
											<th></th>
											<th>Item</th>
											<th>Attribute - Valuation</th>
											<th>Available Qty</th>                                        
											<th>GRN Qty</th>                                        
											<th>Unit Price</th>                                       
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
		</section>
		<?php
		include './includes/end-block.php';
		include './includes/comboboxJS.php';
		include './includes/commonJS.php';
		?>  
		<script>
			function tblGrnItemSupplier(callback) {
				var grtm_grn_id = $('#grn_id').val()
				var tbldata = "";
				$.post('controllers/grnController.php', {action: 'getAllGrnItemSupplier', grtm_grn_id: grtm_grn_id}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						tbldata += '<tr>';
						tbldata += '<td colspan="8" class="bg-danger text-center"> -- GRN items not available -- </td>';
						tbldata += '</tr>';
						$('#tblGrnItemSupplier tbody').html('').append(tbldata);
					} else {
						$.each(e, function (index, qdt) {
							index++;
							tbldata += '<tr>';
							tbldata += '<td>';
							tbldata += '<div class="btn-group btn-group-sm">';
							tbldata += '<button class="btn btn-info btn_select" value="' + qdt.grtm_id + '"><i class="fas fa-edit"></i></button>';
							tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.grtm_id + '"><i class="fas fa-trash-alt"></i></button>';
							tbldata += '</div>';
							tbldata += '</td>';
							tbldata += '<td></td>';
							tbldata += '<td><h5 style="font-size:10.5pt">' + qdt.itm_name + ' <span class="badge badge-dark">' + qdt.itm_code + '</span></h5></td>';
							tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
							tbldata += '<td>' + qdt.stk_qty + '</td>';
							tbldata += '<td>' + qdt.grtm_qty + '</td>';
							tbldata += '<td>Rs.' + qdt.grtm_unitprice + '</td>';
							tbldata += '<td>' + qdt.grtm_description + '</td>';
							tbldata += '</tr>';
						});


						if ($.fn.DataTable.isDataTable('#tblGrnItemSupplier')) {
							//re initialize 
							$('#tblGrnItemSupplier').DataTable().destroy();
							$('#tblGrnItemSupplier tbody').empty();
							$('#tblGrnItemSupplier tbody').html('').append(tbldata);
							$('#tblGrnItemSupplier').DataTable({
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
							$('#tblGrnItemSupplier tbody').html('').append(tbldata);
							$('#tblGrnItemSupplier').DataTable({
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



					$('.btn_select').click(function () {
						$('#btn_save').prop('hidden', true);
						$('#btn_edit').prop('hidden', false);
						var grtm_id = $(this).val();
						$.post('controllers/grnController.php', {action: 'getGrnItemSupplierByID', grtm_id: grtm_id}, function (e) {
							$.each(e, function (index, qdt) {
								$('#grtm_id').val(qdt.grtm_id);
								cmbItemMainCategory(qdt.itm_maincategory, function () {
									cmbItemSub1Category(qdt.itm_maincategory, qdt.itm_sub1category, function () {
										cmbItemSub2Category(qdt.itm_sub1category, qdt.itm_sub2category, function () {
											cmbItem(qdt.itm_sub2category, qdt.grtm_item, function () {
												cmbAttributeType(qdt.grtm_item, qdt.at_attributetype, function () {
													cmbAttribute(qdt.at_attributetype, qdt.grtm_item_attribute, function (dataAvailable) {
														//check items availability.for validate data entry part                        
														if (parseInt(dataAvailable) == 0) {
															var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item attributes not available.</div>';
															$('.controlMsg').html('').append(controlMsg);
															$('.form-controllers-div').prop('hidden', true);
														} else {
															$('.controlMsg').html('').append("");
															$('.form-controllers-div').prop('hidden', false);
														}
														//end of validation
														//get available stock qry
														getAvailableItemQTY(qdt.grtm_item, qdt.grtm_item_attribute);
														$('#grtm_qty').val(qdt.grtm_qty);
														$('#grtm_unitprice').val(qdt.grtm_unitprice);
														$('#grtm_description').val(qdt.grtm_description);
													});
												});
											});
										});
									});
								});
							});
						}, "json");
					});

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
									clearGrnItem()();
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
					var postdata = {
						action: "completeGrn",
						grn_id: grn_id
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
								window.location.href = 'grnsupplierinfotable.php';
							}, 2300);
							swal("Good Job!", e.msg, "success");
						} else {
							swal("Alert !", e.msg, "error");
						}
					}, "json");
				});



			}

			function saveGrnItem() {
				var grtm_description = $('#grtm_description').val();
				var grtm_unitprice = $('#grtm_unitprice').val();
				var grtm_qty = $('#grtm_qty').val();
				var grtm_item = $('.cmbItem').val();
				var grtm_item_attribute = $('.cmbAttribute').val();
				var grtm_grn_id = $('#grn_id').val();
				var postdata = {
					action: "saveGrnItemSupplier",
					grtm_description: grtm_description,
					grtm_unitprice: grtm_unitprice,
					grtm_qty: grtm_qty,
					grtm_item: grtm_item,
					grtm_item_attribute: grtm_item_attribute,
					grtm_grn_id: grtm_grn_id
				}
				$.post('controllers/grnController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good Job!", e.msg, "success");
						clearGrnItem();
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function editGrnItem() {
				var grtm_id = $('#grtm_id').val();
				var grtm_description = $('#grtm_description').val();
				var grtm_unitprice = $('#grtm_unitprice').val();
				var grtm_qty = $('#grtm_qty').val();
				var grtm_item = $('.cmbItem').val();
				var grtm_item_attribute = $('.cmbAttribute').val();
				var postdata = {
					action: "editGrnItemSupplier",
					grtm_id: grtm_id,
					grtm_description: grtm_description,
					grtm_unitprice: grtm_unitprice,
					grtm_qty: grtm_qty,
					grtm_item: grtm_item,
					grtm_item_attribute: grtm_item_attribute
				}
				$.post('controllers/grnController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good Job!", e.msg, "success");
						clearGrnItem();
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function clearGrnItem() {
				$('#grtm_qty').val('');
				$('#grtm_id').val('');
				$('#grtm_description').val('');
				$('#grtm_unitprice').val('');
				$('#btn_save').prop('hidden', false);
				$('#btn_edit').prop('hidden', true);
				$('#grnstep2form').removeClass('was-validated');
				tblGrnItemSupplier();
			}

			function getAvailableItemQTY(stk_item, stk_item_attribute, callback) {
				var dataAvailable = 0;
				$.post('controllers/mainStockController.php', {action: 'getAvailableItemQTY', stk_item: stk_item, stk_item_attribute: stk_item_attribute}, function (qty) {
					$('#itm_available_qty').val(qty);

					if (qty === 'Not available Stock') {
						dataAvailable = 0;
					} else {
						dataAvailable = 1;
					}

					if (callback !== undefined) {
						if (typeof callback === 'function') {
							callback(dataAvailable, qty);
						}
					}
				});
			}

			function getGrnStep1DataByID() {
				var grn_id = $('#grn_id').val();
				$.post('controllers/grnController.php', {action: 'getGrnSupplierByID', grn_id: grn_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('.grn_custom_no').html('').append('<strong>GRN No : </strong><span class="badge badge-warning">' + qdt.grn_custom_no + '</span>');
						$('.grn_description').html('').append('<strong>Grn Description : </strong>' + qdt.grn_description);
						$('.grn_supplier_desc').html('').append('<strong>Supplier : </strong><i><strong>' + qdt.sup_name + '</strong></i><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.sup_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.sup_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.sup_email);

					});
				}, "json");
			}

			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				getGrnStep1DataByID();
				tblGrnItemSupplier();
				cmbItemMainCategory(false, function () {
					var itm_maincategory = $('.cmbItemMainCategory').val();
					cmbItemSub1Category(itm_maincategory, false, function () {
						var itm_sub1category = $('.cmbItemSub1Category').val();
						cmbItemSub2Category(itm_sub1category, false, function () {
							var itm_sub2category = $('.cmbItemSub2Category').val();
							cmbItem(itm_sub2category, false, function () {
								var attype_item = $('.cmbItem').val();
								cmbAttributeType(attype_item, false, function () {
									var at_attributetype = $('.cmbAttributeType').val();
									cmbAttribute(at_attributetype, false, function (dataAvailable) {
										var stk_item_attribute = $('.cmbAttribute').val();
										//check items availability.for validate data entry part                         
										if (parseInt(dataAvailable) == 0) {
											var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item attributes not available.</div>';
											$('.controlMsg').html('').append(controlMsg);
											$('.form-controllers-div').prop('hidden', true);
										} else {
											$('.controlMsg').html('').append("");
											$('.form-controllers-div').prop('hidden', false);
										}
										//end of validation
										//get available stock qry
										getAvailableItemQTY(attype_item, stk_item_attribute);
									});
								});
							});
						});
					});
				});


				$('.cmbItemMainCategory').change(function () {
					var itm_maincategory = $(this).val();
					cmbItemSub1Category(itm_maincategory, false, function () {
						var itm_sub1category = $('.cmbItemSub1Category').val();
						cmbItemSub2Category(itm_sub1category, false, function () {
							var itm_sub2category = $('.cmbItemSub2Category').val();
							cmbItem(itm_sub2category, false, function () {
								var attype_item = $('.cmbItem').val();
								cmbAttributeType(attype_item, false, function () {
									var at_attributetype = $('.cmbAttributeType').val();
									cmbAttribute(at_attributetype, false, function (dataAvailable) {
										var stk_item_attribute = $('.cmbAttribute').val();
										//check items availability.for validate data entry part                         
										if (parseInt(dataAvailable) == 0) {
											var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item attributes not available.</div>';
											$('.controlMsg').html('').append(controlMsg);
											$('.form-controllers-div').prop('hidden', true);
										} else {
											$('.controlMsg').html('').append("");
											$('.form-controllers-div').prop('hidden', false);
										}
										//end of validation
										getAvailableItemQTY(attype_item, stk_item_attribute);
									});
								});
							});
						});
					});
				});

				$('.cmbItemSub1Category').change(function () {
					var itm_sub1category = $(this).val();
					cmbItemSub2Category(itm_sub1category, false, function () {
						var itm_sub2category = $('.cmbItemSub2Category').val();
						cmbItem(itm_sub2category, false, function () {
							var attype_item = $('.cmbItem').val();
							cmbAttributeType(attype_item, false, function () {
								var at_attributetype = $('.cmbAttributeType').val();
								cmbAttribute(at_attributetype, false, function (dataAvailable) {
									var stk_item_attribute = $('.cmbAttribute').val();
									//check items availability.for validate data entry part                         
									if (parseInt(dataAvailable) == 0) {
										var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item attributes not available.</div>';
										$('.controlMsg').html('').append(controlMsg);
										$('.form-controllers-div').prop('hidden', true);
									} else {
										$('.controlMsg').html('').append("");
										$('.form-controllers-div').prop('hidden', false);
									}
									//end of validation
									getAvailableItemQTY(attype_item, stk_item_attribute);
								});
							});
						});
					});
				});

				$('.cmbItemSub2Category').change(function () {
					var itm_sub2category = $(this).val();
					cmbItem(itm_sub2category, false, function () {
						var attype_item = $('.cmbItem').val();
						cmbAttributeType(attype_item, false, function () {
							var at_attributetype = $('.cmbAttributeType').val();
							cmbAttribute(at_attributetype, false, function (dataAvailable) {
								var stk_item_attribute = $('.cmbAttribute').val();
								//check items availability.for validate data entry part                         
								if (parseInt(dataAvailable) == 0) {
									var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item attributes not available.</div>';
									$('.controlMsg').html('').append(controlMsg);
									$('.form-controllers-div').prop('hidden', true);
								} else {
									$('.controlMsg').html('').append("");
									$('.form-controllers-div').prop('hidden', false);
								}
								//end of validation
								getAvailableItemQTY(attype_item, stk_item_attribute);
							});
						});
					});
				});

				$('.cmbItem').change(function () {
					var attype_item = $(this).val();
					cmbAttributeType(attype_item, false, function () {
						var at_attributetype = $('.cmbAttributeType').val();
						cmbAttribute(at_attributetype, false, function (dataAvailable) {
							var stk_item_attribute = $('.cmbAttribute').val();
							//check items availability.for validate data entry part                         
							if (parseInt(dataAvailable) == 0) {
								var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item attributes not available.</div>';
								$('.controlMsg').html('').append(controlMsg);
								$('.form-controllers-div').prop('hidden', true);
							} else {
								$('.controlMsg').html('').append("");
								$('.form-controllers-div').prop('hidden', false);
							}
							//end of validation
							getAvailableItemQTY(attype_item, stk_item_attribute);
						});
					});
				});

				$('.cmbAttributeType').change(function () {
					var at_attributetype = $(this).val();
					cmbAttribute(at_attributetype, false, function (dataAvailable) {
						var stk_item_attribute = $('.cmbAttribute').val();
						var attype_item = $('.cmbItem').val();
						//check items availability.for validate data entry part                         
						if (parseInt(dataAvailable) == 0) {
							var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item attributes not available.</div>';
							$('.controlMsg').html('').append(controlMsg);
							$('.form-controllers-div').prop('hidden', true);
						} else {
							$('.controlMsg').html('').append("");
							$('.form-controllers-div').prop('hidden', false);
						}
						//end of validation
						getAvailableItemQTY(attype_item, stk_item_attribute);
					});
				});

				$('.cmbAttribute').change(function () {
					var stk_item_attribute = $(this).val();
					var attype_item = $('.cmbItem').val();
					getAvailableItemQTY(attype_item, stk_item_attribute);
				});


				const form = $('#grnstep2form');


				$('#grtm_qty').keyup(function () {
					var grtm_qty = $(this).val();
					if ($.isNumeric(grtm_qty)) {
						if (parseInt(grtm_qty) < 0) {
							$('#grtm_qty').val(0);
						}
					} else {
						$('#grtm_qty').val(0);
					}
				});

				$('#grtm_unitprice').keyup(function () {
					var grtm_unitprice = $(this).val();
					if ($.isNumeric(grtm_unitprice)) {
						if (parseInt(grtm_unitprice) < 0) {
							$('#grtm_unitprice').val('0.00');
						}
					} else {
						$('#grtm_unitprice').val('0.00');
					}
				});


				$('#btn_save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						saveGrnItem();
					}
				});

				$('#btn_edit').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						editGrnItem();
					}
				});


				$('#btn_clear').click(function () {
					form.submit(false);
					clearGrnItem();
				});

				$('#btn_completegrn').click(function () {
					form.submit(false);
					completeGrn();
				});

			});
		</script>
	</body>
</html>