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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-user-circle"></i> Issue <span class="badge badge-dark">Step 2</span> <small>Add Issue Items  </small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button>&nbsp;<button class="btn btn-success d-print-none" id="btn_completeissue"><i class="fas fa-stop-circle"></i> Issue Complete</button></h4>                       
                    </div>
                </div>

				<input type="hidden" class="form-control" id="issu_id" value="<?php
				if (isset($_REQUEST['issu_id']) && !empty($_REQUEST['issu_id'])) {
					echo $_REQUEST['issu_id'];
				}
				?>">
				<div class="row">
					<div class="col">
						<form id="issuestep2form" novalidate>
							<div class="row">
								<div class="col-lg-6 col-sm-12 col-xs-12 pb-4">
									<div class="form-row">
										<input type="hidden" class="form-control" id="istm_id">
										<div class="col-12">
											<div class="form-group">
												<label>
													<span class="issu_custom_issueno"></span><br>
													<span class="issu_description"></span><br>
													<span class="issu_send_institute_desc"></span>
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
												<label for="istm_qty">Issue Qty</label>
												<input type="number" class="form-control" id="istm_qty" placeholder="Issue Qty" autocomplete="off" value="0" required>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Issue Qty
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
								<table id="tblIssueItem" class="table table-bordered table-hover" style="width:100%">
									<thead class="thead-dark">
										<tr>
											<th></th>                                
											<th></th>
											<th>Item</th>
											<th>Attribute - Valuation</th>
											<th>Available Qty</th>                                        
											<th>Issued Qty</th>                                        
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
			function tblIssueItem(callback) {
				var istm_issue_id = $('#issu_id').val()
				var tbldata = "";
				$.post('controllers/issueController.php', {action: 'getAllIssueItem', istm_issue_id: istm_issue_id}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						tbldata += '<tr>';
						tbldata += '<td colspan="6" class="bg-danger text-center"> -- Issue items not available -- </td>';
						tbldata += '</tr>';
						$('#tblIssueItem tbody').html('').append(tbldata);
					} else {
						$.each(e, function (index, qdt) {
							index++;
							tbldata += '<tr>';
							tbldata += '<td>';
							tbldata += '<div class="btn-group btn-group-sm">';
							tbldata += '<button class="btn btn-info btn_select" value="' + qdt.istm_id + '"><i class="fas fa-edit"></i></button>';
							tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.istm_id + '"><i class="fas fa-trash-alt"></i></button>';
							tbldata += '</div>';
							tbldata += '</td>';
							tbldata += '<td></td>';
							tbldata += '<td>' + qdt.itm_name + '(' + qdt.itm_code + ')</td>';
							tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
							tbldata += '<td>' + qdt.stk_qty + '</td>';
							tbldata += '<td>' + qdt.istm_qty + '</td>';
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



					$('.btn_select').click(function () {
						$('#btn_save').prop('hidden', true);
						$('#btn_edit').prop('hidden', false);
						var istm_id = $(this).val();
						$.post('controllers/issueController.php', {action: 'getIssueItemByID', istm_id: istm_id}, function (e) {
							$.each(e, function (index, qdt) {
								$('#istm_id').val(qdt.istm_id);
								cmbItemMainCategory(qdt.itm_maincategory, function () {
									cmbItemSub1Category(qdt.itm_maincategory, qdt.itm_sub1category, function () {
										cmbItemSub2Category(qdt.itm_sub1category, qdt.itm_sub2category, function () {
											cmbItem(qdt.itm_sub2category, qdt.istm_item, function () {
												cmbAttributeType(qdt.istm_item, qdt.at_attributetype, function () {
													cmbAttribute(qdt.at_attributetype, qdt.istm_item_attribute, function () {
														//get available stock qry
														getAvailableItemQTY(qdt.istm_item, qdt.istm_item_attribute, function (dataAvailable) {
															//check items availability.for validate data entry part
															if (parseInt(dataAvailable) == 0) {
																var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
																$('.controlMsg').html('').append(controlMsg);
																$('.form-controllers-div').prop('hidden', true);
															} else {
																$('.controlMsg').html('').append("");
																$('.form-controllers-div').prop('hidden', false);
															}
															$('#istm_qty').val(qdt.istm_qty);
															//end of validation
														});
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
						var istm_id = $(this).val();
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
							$.post('controllers/issueController.php', {action: 'deleteIssueItem', istm_id: istm_id}, function (e) {
								if (parseInt(e.msgType) == 1) {
									swal("Good Job!", e.msg, "success");
									clearIssueItem()();
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

			function completeIssue() {

				swal({
					title: "Issue Receipt?",
					text: "Do you want to complete these issuing recept ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-success",
					cancelButtonClass: "btn-light",
					confirmButtonText: "Yes, complete this!",
					closeOnConfirm: false
				}, function () {
					var issu_id = $('#issu_id').val();
					var postdata = {
						action: "completeIssue",
						issu_id: issu_id
					}
					$.post('controllers/issueController.php', postdata, function (e) {
						if (parseInt(e.msgType) == 1) {
							swal({
								title: "Good Job!",
								text: e.msg + 'Please wait for navigating issuing information section',
								type: "success",
								timer: 1800,
								showConfirmButton: false
							});
							setTimeout(function () {
								window.location.href = 'issueinfotable.php';
							}, 2300);
							swal("Good Job!", e.msg, "success");
						} else {
							swal("Alert !", e.msg, "error");
						}
					}, "json");
				});



			}

			function saveIssueItem() {
				var istm_issue_id = $('#issu_id').val();
				var istm_item = $('.cmbItem').val();
				var istm_item_attribute = $('.cmbAttribute').val();
				var istm_qty = $('#istm_qty').val();
				var postdata = {
					action: "saveIssueItem",
					istm_issue_id: istm_issue_id,
					istm_item: istm_item,
					istm_item_attribute: istm_item_attribute,
					istm_qty: istm_qty
				}
				$.post('controllers/issueController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good Job!", e.msg, "success");
						clearIssueItem();
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function editIssueItem() {
				var istm_id = $('#istm_id').val();
				var istm_item = $('.cmbItem').val();
				var istm_item_attribute = $('.cmbAttribute').val();
				var istm_qty = $('#istm_qty').val();
				var postdata = {
					action: "editIssueItem",
					istm_id: istm_id,
					istm_item: istm_item,
					istm_item_attribute: istm_item_attribute,
					istm_qty: istm_qty
				}
				$.post('controllers/issueController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good Job!", e.msg, "success");
						clearIssueItem();
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function clearIssueItem() {
				$('#istm_qty').val('');
				$('#istm_id').val('');
				$('#btn_save').prop('hidden', false);
				$('#btn_edit').prop('hidden', true);
				$('#issuestep2form').removeClass('was-validated');
				tblIssueItem();
			}

			function getAvailableItemQTY(stk_item, stk_item_attribute, callback) {
				var dataAvailable = 0;
				$.post('controllers/mainStockController.php', {action: 'getAvailableItemQTY', stk_item: stk_item, stk_item_attribute: stk_item_attribute}, function (qty) {
					$('#itm_available_qty').val(qty);


					$('#istm_qty').prop('max', qty);
					$('#istm_qty').prop('min', 0);
					$('#istm_qty').val(0);

					if ($.isNumeric(qty)) {
						$('#istm_qty').prop('disabled', false);
					} else {
						$('#istm_qty').prop('disabled', true);
					}

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

			function getIssueStep1DataByID() {
				var issu_id = $('#issu_id').val();
				$.post('controllers/issueController.php', {action: 'getIssueByID', issu_id: issu_id}, function (e) {
					$.each(e, function (index, qdt) {
						$('.issu_custom_issueno').html('').append('<strong>Issue No : </strong><span class="badge badge-warning">' + qdt.issu_custom_issueno + '</span>');
						$('.issu_description').html('').append('<strong>Issue Note : </strong>' + qdt.issu_description);
						$('.issu_send_institute_desc').html('').append('<strong>Issue Send Institute : </strong><i><strong>' + qdt.inst_name + '</strong></i><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.inst_email);

					});
				}, "json");
			}

			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				getIssueStep1DataByID();
				tblIssueItem();
				cmbItemMainCategory(false, function () {
					var itm_maincategory = $('.cmbItemMainCategory').val();
					cmbItemSub1Category(itm_maincategory, false, function () {
						var itm_sub1category = $('.cmbItemSub1Category').val();
						cmbItemSub2Category(itm_sub1category, false, function () {
							var itm_sub2category = $('.cmbItemSub2Category').val();
							cmbItem(itm_sub2category, false, function () {
								var attype_item = $('.cmbItem').val();
								//								tblMainStock(attype_item);
								cmbAttributeType(attype_item, false, function () {
									var at_attributetype = $('.cmbAttributeType').val();
									cmbAttribute(at_attributetype, false, function () {
										//get available stock qry
										var stk_item_attribute = $('.cmbAttribute').val();
										getAvailableItemQTY(attype_item, stk_item_attribute, function (dataAvailable) {
											//check items availability.for validate data entry part                         
											if (parseInt(dataAvailable) == 0) {
												var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
												$('.controlMsg').html('').append(controlMsg);
												$('.form-controllers-div').prop('hidden', true);
											} else {
												$('.controlMsg').html('').append("");
												$('.form-controllers-div').prop('hidden', false);
											}
											//end of validation
										});
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
								//								tblMainStock(attype_item);
								cmbAttributeType(attype_item, false, function () {
									var at_attributetype = $('.cmbAttributeType').val();
									cmbAttribute(at_attributetype, false, function () {
										var stk_item_attribute = $('.cmbAttribute').val();
										getAvailableItemQTY(attype_item, stk_item_attribute, function (dataAvailable) {
											//check items availability.for validate data entry part                         
											if (parseInt(dataAvailable) == 0) {
												var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
												$('.controlMsg').html('').append(controlMsg);
												$('.form-controllers-div').prop('hidden', true);
											} else {
												$('.controlMsg').html('').append("");
												$('.form-controllers-div').prop('hidden', false);
											}
											//end of validation
										});
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
							//							tblMainStock(attype_item);
							cmbAttributeType(attype_item, false, function () {
								var at_attributetype = $('.cmbAttributeType').val();
								cmbAttribute(at_attributetype, false, function (dataAvailable) {
									var stk_item_attribute = $('.cmbAttribute').val();
									getAvailableItemQTY(attype_item, stk_item_attribute, function (dataAvailable) {
										//check items availability.for validate data entry part                         
										if (parseInt(dataAvailable) == 0) {
											var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
											$('.controlMsg').html('').append(controlMsg);
											$('.form-controllers-div').prop('hidden', true);
										} else {
											$('.controlMsg').html('').append("");
											$('.form-controllers-div').prop('hidden', false);
										}
										//end of validation
									});
								});
							});
						});
					});
				});

				$('.cmbItemSub2Category').change(function () {
					var itm_sub2category = $(this).val();
					cmbItem(itm_sub2category, false, function () {
						var attype_item = $('.cmbItem').val();
						//						tblMainStock(attype_item);
						cmbAttributeType(attype_item, false, function () {
							var at_attributetype = $('.cmbAttributeType').val();
							cmbAttribute(at_attributetype, false, function (dataAvailable) {
								var stk_item_attribute = $('.cmbAttribute').val();
								getAvailableItemQTY(attype_item, stk_item_attribute, function (dataAvailable) {
									//check items availability.for validate data entry part                         
									if (parseInt(dataAvailable) == 0) {
										var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
										$('.controlMsg').html('').append(controlMsg);
										$('.form-controllers-div').prop('hidden', true);
									} else {
										$('.controlMsg').html('').append("");
										$('.form-controllers-div').prop('hidden', false);
									}
									//end of validation
								});
							});
						});
					});
				});

				$('.cmbItem').change(function () {
					var attype_item = $(this).val();
					//					tblMainStock(attype_item);
					cmbAttributeType(attype_item, false, function () {
						var at_attributetype = $('.cmbAttributeType').val();
						cmbAttribute(at_attributetype, false, function (dataAvailable) {
							var stk_item_attribute = $('.cmbAttribute').val();
							getAvailableItemQTY(attype_item, stk_item_attribute, function (dataAvailable) {
								//check items availability.for validate data entry part                         
								if (parseInt(dataAvailable) == 0) {
									var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
									$('.controlMsg').html('').append(controlMsg);
									$('.form-controllers-div').prop('hidden', true);
								} else {
									$('.controlMsg').html('').append("");
									$('.form-controllers-div').prop('hidden', false);
								}
								//end of validation
							});
						});
					});
				});

				$('.cmbAttributeType').change(function () {
					var at_attributetype = $(this).val();
					cmbAttribute(at_attributetype, false, function (dataAvailable) {
						var stk_item_attribute = $('.cmbAttribute').val();
						var attype_item = $('.cmbItem').val();
						getAvailableItemQTY(attype_item, stk_item_attribute, function (dataAvailable) {
							//check items availability.for validate data entry part                         
							if (parseInt(dataAvailable) == 0) {
								var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
								$('.controlMsg').html('').append(controlMsg);
								$('.form-controllers-div').prop('hidden', true);
							} else {
								$('.controlMsg').html('').append("");
								$('.form-controllers-div').prop('hidden', false);
							}
							//end of validation
						});
					});
				});

				$('.cmbAttribute').change(function () {
					var stk_item_attribute = $(this).val();
					var attype_item = $('.cmbItem').val();
					getAvailableItemQTY(attype_item, stk_item_attribute, function (dataAvailable) {
						//check items availability.for validate data entry part
						if (parseInt(dataAvailable) == 0) {
							var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
							$('.controlMsg').html('').append(controlMsg);
							$('.form-controllers-div').prop('hidden', true);
						} else {
							$('.controlMsg').html('').append("");
							$('.form-controllers-div').prop('hidden', false);
						}
						//end of validation
					});
				});


				const form = $('#issuestep2form');


				$('#istm_qty').keyup(function () {
					var qty = $('#itm_available_qty').val();
					var istm_qty = $(this).val();
					if (parseInt(istm_qty) > parseInt(qty)) {
						$('#istm_qty').val(qty);
					} else if (parseInt(istm_qty) < 0) {
						$('#istm_qty').val(0);
					}
				});





				$('#btn_save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						saveIssueItem();
					}
				});

				$('#btn_edit').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						editIssueItem();
					}
				});


				$('#btn_clear').click(function () {
					form.submit(false);
					clearIssueItem();
				});

				$('#btn_completeissue').click(function () {
					form.submit(false);
					completeIssue();
				});

			});
		</script>
	</body>
</html>