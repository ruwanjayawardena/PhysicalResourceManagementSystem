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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-trash"></i> Remove <small>Stocked Item Remove  </small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
				<div class="row">
					<div class="col">
						<form id="removeform" novalidate>
							<div class="row">
								<div class="col-lg-6 col-sm-12 col-xs-12 pb-4">
									<div class="form-row">
										<input type="hidden" class="form-control" id="rm_id">										
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

									</div>
								</div>  
								<div class="col">
									<div class="form-row">										
										<div class="col-7">
											<div class="form-group">
												<label for="rm_custom_no">Remove ID</label>
												<input type="text" class="form-control" id="rm_custom_no" placeholder="Remove Custom No" autocomplete="off"  required>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Issue Qty
												</div>
											</div> 
										</div>
										<div class="col-5">
											<div class="form-group">
												<label for="rm_qty">Remove Qty</label>
												<input type="number" class="form-control" id="rm_qty" placeholder="Remove Qty" autocomplete="off" value="0" required>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Issue Qty
												</div>
											</div> 
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="rm_desc">Description</label>
												<testarea class="form-control summernote" id="rm_desc" placeholder="Remove Description" autocomplete="off" required></testarea>
												<div class="valid-feedback">
													<i class="fas fa-lg fa-check-circle"></i> Looks good! 
												</div>
												<div class="invalid-feedback">
													<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Removing Description/Note
												</div>
											</div> 
										</div>
										<div class="col-12">
											<div class="form-group form-controllers-div">
												<button class="btn btn-primary" id="btn_save"><i class="fas fa-trash"></i> Remove</button>
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
								<table id="tblRemove" class="table table-bordered table-hover" style="width:100%">
									<thead class="thead-dark">
										<tr>
											<th></th>                                
											<th></th>
											<th>Remove ID</th>
											<th>Item</th>
											<th>Attribute - Valuation</th>
											<th>Available Qty</th>                                        
											<th>Removed Qty</th>                                        
											<th>Description</th>                                        
											<th>Date | Time</th>                                        
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
			function tblRemove(callback) {
				var tbldata = "";
				$.post('controllers/removeController.php', {action: 'getAllRemove'}, function (e) {
					if (e === undefined || e.length === 0 || e === null) {
						tbldata += '<tr>';
						tbldata += '<td colspan="9" class="bg-danger text-center"> -- Removed items not available -- </td>';
						tbldata += '</tr>';
						$('#tblRemove tbody').html('').append(tbldata);
					} else {
						$.each(e, function (index, qdt) {
							index++;
							tbldata += '<tr>';
							tbldata += '<td>';
							tbldata += '<div class="btn-group btn-group-sm">';
//							tbldata += '<button class="btn btn-info btn_select" value="' + qdt.rm_id + '"><i class="fas fa-edit"></i></button>';
							tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.rm_id + '"><i class="fas fa-trash-alt"></i></button>';
							tbldata += '</div>';
							tbldata += '</td>';
							tbldata += '<td></td>';
							tbldata += '<td>' + qdt.rm_custom_no + '</td>';
							tbldata += '<td>' + qdt.itm_name + '(' + qdt.itm_code + ')</td>';
							tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
							tbldata += '<td>' + qdt.stk_qty + '</td>';
							tbldata += '<td>' + qdt.rm_qty + '</td>';
							tbldata += '<td>' + qdt.rm_desc + '</td>';
							tbldata += '<td>' + qdt.rm_date + ' | ' + qdt.rm_time + '</td>';
							tbldata += '</tr>';
						});


						if ($.fn.DataTable.isDataTable('#tblRemove')) {
							//re initialize 
							$('#tblRemove').DataTable().destroy();
							$('#tblRemove tbody').empty();
							$('#tblRemove tbody').html('').append(tbldata);
							$('#tblRemove').DataTable({
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
							$('#tblRemove tbody').html('').append(tbldata);
							$('#tblRemove').DataTable({
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



//					$('.btn_select').click(function () {
//						$('#btn_save').prop('hidden', true);
//						$('#btn_edit').prop('hidden', false);
//						var rm_id = $(this).val();
//						$.post('controllers/removeController.php', {action: 'getRemoveByID', rm_id: rm_id}, function (e) {
//							$.each(e, function (index, qdt) {
//								$('#rm_id').val(qdt.rm_id);
//								$('#rm_custom_no').val(qdt.rm_custom_no);
//								$('#rm_qty').val(qdt.rm_qty);
//								$('#rm_desc').summernote('reset');
//								$('#rm_desc').summernote('code', qdt.rm_desc);
//								cmbItemMainCategory(qdt.itm_maincategory, function () {
//									cmbItemSub1Category(qdt.itm_maincategory, qdt.itm_sub1category, function () {
//										cmbItemSub2Category(qdt.itm_sub1category, qdt.itm_sub2category, function () {
//											cmbItem(qdt.itm_sub2category, qdt.rm_item, function () {
//												cmbAttributeType(qdt.rm_item, qdt.at_attributetype, function () {
//													cmbAttribute(qdt.at_attributetype, qdt.rm_item_attribute, function () {
//														//get available stock qry
//														getAvailableItemQTY(qdt.rm_item, qdt.rm_item_attribute, function (dataAvailable) {
//															//check items availability.for validate data entry part
//															if (parseInt(dataAvailable) == 0) {
//																var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item stock not available.</div>';
//																$('.controlMsg').html('').append(controlMsg);
//																$('.form-controllers-div').prop('hidden', true);
//															} else {
//																$('.controlMsg').html('').append("");
//																$('.form-controllers-div').prop('hidden', false);
//															}
//															$('#istm_qty').val(qdt.istm_qty);
//															//end of validation
//														});
//													});
//												});
//											});
//										});
//									});
//								});
//							});
//						}, "json");
//					});

					$('.btn_delete').click(function () {
						var rm_id = $(this).val();
						swal({
							title: "Re - Stock Removed Item !",
							text: "Are you sure want to re-stock this removing ?",
							type: "warning",
							showCancelButton: true,
							confirmButtonClass: "btn-success",
							cancelButtonClass: "btn-light",
							confirmButtonText: "Yes, Re-Stock Now",
							closeOnConfirm: false
						}, function () {
							$.post('controllers/removeController.php', {action: 'deleteRemove', rm_id: rm_id}, function (e) {
								if (parseInt(e.msgType) == 1) {
									swal("Good Job!", e.msg, "success");
									clearRemove()();
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



			function saveRemove() {
				var rm_item = $('.cmbItem').val();
				var rm_item_attribute = $('.cmbAttribute').val();
				var rm_qty = $('#rm_qty').val();
				var rm_custom_no = $('#rm_custom_no').val();
				var rm_desc = $('#rm_desc ').summernote('code');
				var postdata = {
					action: "saveRemove",
					rm_item: rm_item,
					rm_item_attribute: rm_item_attribute,
					rm_qty: rm_qty,
					rm_custom_no: rm_custom_no,
					rm_desc: rm_desc
				}
				$.post('controllers/removeController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good Job!", e.msg, "success");
						clearRemove();
						getAvailableItemQTY(rm_item, rm_item_attribute);
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function editRemove() {
				var rm_id = $('#rm_id').val();
				var rm_item = $('.cmbItem').val();
				var rm_item_attribute = $('.cmbAttribute').val();
				var rm_qty = $('#rm_qty').val();
				var rm_custom_no = $('#rm_custom_no').val();
				var rm_desc = $('#rm_desc ').summernote('code');
				var postdata = {
					action: "editRemove",
					rm_item: rm_item,
					rm_item_attribute: rm_item_attribute,
					rm_qty: rm_qty,
					rm_custom_no: rm_custom_no,
					rm_desc: rm_desc,
					rm_id: rm_id
				}
				$.post('controllers/removeController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal("Good Job!", e.msg, "success");
						clearRemove();						
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function clearRemove() {
				$('#rm_custom_no').val('');
				$('#rm_qty').val('');
				$('#rm_desc').summernote('reset');
				$('#rm_desc').summernote('code', '');
				$('#btn_save').prop('hidden', false);
				$('#btn_edit').prop('hidden', true);
				$('#removeform').removeClass('was-validated');
				tblRemove();
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



			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				$('.summernote').summernote({
					height: 150
				});
				tblRemove();
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

				$('.cmbItemSub2Category').change(function () {
					var itm_sub2category = $(this).val();
					cmbItem(itm_sub2category, false, function () {
						var attype_item = $('.cmbItem').val();
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

				$('.cmbItem').change(function () {
					var attype_item = $(this).val();
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

				$('.cmbAttributeType').change(function () {
					var at_attributetype = $(this).val();
					cmbAttribute(at_attributetype, false, function () {
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


				const form = $('#removeform');


				$('#rm_qty').keyup(function () {
					var qty = $('#itm_available_qty').val();
					var rm_qty = $(this).val();
					if (parseInt(rm_qty) > parseInt(qty)) {
						$('#rm_qty').val(qty);
					} else if (parseInt(rm_qty) < 0) {
						$('#rm_qty').val(0);
					}
				});


				$('#btn_save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						saveRemove();
					}
				});

				$('#btn_edit').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						editRemove();
					}
				});


				$('#btn_clear').click(function () {
					form.submit(false);
					clearRemove();
				});

			});
		</script>
	</body>
</html>