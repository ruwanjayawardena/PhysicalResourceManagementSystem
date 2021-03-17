<?php include './access_control/systemadmin_auth.php'; ?> 
<!doctype html>
<html lang="en">
    <head>
		<?php include './includes/head-block.php'; ?>        
    </head>
    <body>
        <!--navbar-->
		<?php include 'includes/backend-navbar.php'; ?>       

        <input type="hidden" id="stk_institute" value="<?php
		if (isset($_SESSION) && !empty($_SESSION['usrcat_institute'])) {
			echo $_SESSION['usrcat_institute'];
		}
		?>">
        <!--body content-->
        <section class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-shopping-cart"></i> Main Stock &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button> <button class="btn btn-primary d-print-none" onclick="refreshPage();"><i class="fa fa-refresh"></i>&nbsp;Refresh</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-sm-12 col-xs-12 pb-4">
                        <form id="mainstockform" novalidate>
                            <input type="hidden" class="form-control" id="stk_id">
                            <div class="form-row">   

                                <div class="col-4">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="1">
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
							</div>
							<div class="form-row">  
                                <div class="col-4">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="2">
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
							</div>
							<div class="form-row">  
                                <div class="col-4">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="3">
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
                            <div class="form-row">                                
                                <div class="col-4">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="4">
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
							</div>
							<div class="form-row">  
                                <div class="col-4">
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
                                <div class="col-4">
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
                            </div>
                            <div class="form-row">                                
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="stk_qty">QTY</label>
                                        <input type="text" class="form-control" id="stk_qty" placeholder="Item Qty" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter item qty
                                        </div>
                                    </div>  
                                </div>                                
                            </div>                            
                            <div class="form-group form-controllers-div">
                                <button class="btn btn-success" id="btn_save"><i class="fas fa-save"></i> Save</button>
                                <button class="btn btn-warning" id="btn_edit" hidden><i class="fas fa-edit"></i> Update</button>
                                <button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
                            </div>
                            <div class="form-group controlMsg"></div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tblMainStock" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>                                
                                        <th></th>
                                        <th>Item</th>
                                        <th>Attribute</th>
                                        <th>Qty</th>                                        
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
		function tblMainStock(callback) {
			var tblsearchfilter = 0;
			if ($('.tblsearchfilter').is(':checked')) {
				tblsearchfilter = $('.tblsearchfilter:checked').val();
			}
			var cmbItemMainCategory = $('.cmbItemMainCategory').val();
			var cmbItemSub1Category = $('.cmbItemSub1Category').val();
			var cmbItemSub2Category = $('.cmbItemSub2Category').val();
			var cmbItem = $('.cmbItem').val();
			var tbldata = "";
			$.post('controllers/mainStockController.php', {action: 'getAllMainStock'}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="5" class="bg-danger text-center"> -- Stocks not available -- </td>';
					tbldata += '</tr>';
					$('#tblMainStock tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						switch (parseInt(tblsearchfilter)) {
							case 4:
								if (parseInt(cmbItem) == qdt.stk_item) {
									tbldata += '<tr>';
									tbldata += '<td>';
									tbldata += '<div class="btn-group btn-group-sm">';
									tbldata += '<button class="btn btn-info btn_select" value="' + qdt.stk_id + '"><i class="fas fa-edit"></i></button>';
									tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.stk_id + '"><i class="fas fa-trash-alt"></i></button>';
									tbldata += '</div>';
									tbldata += '</td>';
									tbldata += '<td></td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
//						tbldata += '<td>' + qdt.at_name + ' - Rs. ' + qdt.at_price + '</td>';
									tbldata += '<td>' + qdt.at_name + '</td>';
									tbldata += '<td>' + qdt.stk_qty + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 3:
								if (parseInt(cmbItemSub2Category) == qdt.itm_sub2category) {
									tbldata += '<tr>';
									tbldata += '<td>';
									tbldata += '<div class="btn-group btn-group-sm">';
									tbldata += '<button class="btn btn-info btn_select" value="' + qdt.stk_id + '"><i class="fas fa-edit"></i></button>';
									tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.stk_id + '"><i class="fas fa-trash-alt"></i></button>';
									tbldata += '</div>';
									tbldata += '</td>';
									tbldata += '<td></td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
//						tbldata += '<td>' + qdt.at_name + ' - Rs. ' + qdt.at_price + '</td>';
									tbldata += '<td>' + qdt.at_name + '</td>';
									tbldata += '<td>' + qdt.stk_qty + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 2:
								if (parseInt(cmbItemSub1Category) == qdt.itm_sub1category) {
									tbldata += '<tr>';
									tbldata += '<td>';
									tbldata += '<div class="btn-group btn-group-sm">';
									tbldata += '<button class="btn btn-info btn_select" value="' + qdt.stk_id + '"><i class="fas fa-edit"></i></button>';
									tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.stk_id + '"><i class="fas fa-trash-alt"></i></button>';
									tbldata += '</div>';
									tbldata += '</td>';
									tbldata += '<td></td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
//						tbldata += '<td>' + qdt.at_name + ' - Rs. ' + qdt.at_price + '</td>';
									tbldata += '<td>' + qdt.at_name + '</td>';
									tbldata += '<td>' + qdt.stk_qty + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 1:
								if (parseInt(cmbItemMainCategory) == qdt.itm_maincategory) {
									tbldata += '<tr>';
									tbldata += '<td>';
									tbldata += '<div class="btn-group btn-group-sm">';
									tbldata += '<button class="btn btn-info btn_select" value="' + qdt.stk_id + '"><i class="fas fa-edit"></i></button>';
									tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.stk_id + '"><i class="fas fa-trash-alt"></i></button>';
									tbldata += '</div>';
									tbldata += '</td>';
									tbldata += '<td></td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
//						tbldata += '<td>' + qdt.at_name + ' - Rs. ' + qdt.at_price + '</td>';
									tbldata += '<td>' + qdt.at_name + '</td>';
									tbldata += '<td>' + qdt.stk_qty + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 0:
								tbldata += '<tr>';
								tbldata += '<td>';
								tbldata += '<div class="btn-group btn-group-sm">';
								tbldata += '<button class="btn btn-info btn_select" value="' + qdt.stk_id + '"><i class="fas fa-edit"></i></button>';
								tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.stk_id + '"><i class="fas fa-trash-alt"></i></button>';
								tbldata += '</div>';
								tbldata += '</td>';
								tbldata += '<td></td>';
								tbldata += '<td>' + qdt.itm_name + '</td>';
//						tbldata += '<td>' + qdt.at_name + ' - Rs. ' + qdt.at_price + '</td>';
								tbldata += '<td>' + qdt.at_name + '</td>';
								tbldata += '<td>' + qdt.stk_qty + '</td>';
								tbldata += '</tr>';
								break;
						}
					});


					if ($.fn.DataTable.isDataTable('#tblMainStock')) {
						//re initialize 
						$('#tblMainStock').DataTable().destroy();
						$('#tblMainStock tbody').empty();
						$('#tblMainStock tbody').html('').append(tbldata);
						$('#tblMainStock').DataTable({
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
						$('#tblMainStock tbody').html('').append(tbldata);
						$('#tblMainStock').DataTable({
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
					var stk_id = $(this).val();
					$.post('controllers/mainStockController.php', {action: 'getMainStockByID', stk_id: stk_id}, function (e) {
						$.each(e, function (index, qdt) {
							$('#stk_id').val(qdt.stk_id);
							$('#stk_qty').val(qdt.stk_qty);
							cmbAttributeType(qdt.stk_item, qdt.at_attributetype, function () {
								cmbAttribute(qdt.at_attributetype, qdt.stk_item_attribute);
							});
						});
					}, "json");
				});

				$('.btn_delete').click(function () {
					var stk_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this stock ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/mainStockController.php', {action: 'deleteMainStock', stk_id: stk_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								clearMainStock();
								tblMainStock(stk_item);
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

		function saveMainStock() {
			var stk_institute = $('#stk_institute').val();
			var stk_item = $('.cmbItem').val();
			var stk_item_attribute = $('.cmbAttribute').val();
			var stk_qty = $('#stk_qty').val();
			var postdata = {
				action: "saveMainStock",
				stk_institute: stk_institute,
				stk_item: stk_item,
				stk_item_attribute: stk_item_attribute,
				stk_qty: stk_qty
			}
			$.post('controllers/mainStockController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good Job!", e.msg, "success");
					clearMainStock();
					tblMainStock(stk_item);
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function editMainStock() {
			var stk_id = $('#stk_id').val();
			var stk_institute = $('#stk_institute').val();
			var stk_item = $('.cmbItem').val();
			var stk_item_attribute = $('.cmbAttribute').val();
			var stk_qty = $('#stk_qty').val();
			var postdata = {
				action: "editMainStock",
				stk_institute: stk_institute,
				stk_item: stk_item,
				stk_item_attribute: stk_item_attribute,
				stk_qty: stk_qty,
				stk_id: stk_id
			}
			$.post('controllers/mainStockController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good Job!", e.msg, "success");
					clearMainStock();
					tblMainStock(stk_item);
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function clearMainStock() {
			$('#stk_id').val('');
			$('#stk_qty').val('');
			$('#btn_save').prop('hidden', false);
			$('#btn_edit').prop('hidden', true);
			$('#mainstockform').removeClass('was-validated');
		}

		function refreshPage() {
			$('.tblsearchfilter').prop('checked',false);
			$('#stk_id').val('');
			$('#stk_qty').val('');
			$('#btn_save').prop('hidden', false);
			$('#btn_edit').prop('hidden', true);
			$('#mainstockform').removeClass('was-validated');
			cmbItemMainCategory(false, function () {
				var itm_maincategory = $('.cmbItemMainCategory').val();
				cmbItemSub1Category(itm_maincategory, false, function () {
					var itm_sub1category = $('.cmbItemSub1Category').val();
					cmbItemSub2Category(itm_sub1category, false, function () {
						var itm_sub2category = $('.cmbItemSub2Category').val();
						cmbItem(itm_sub2category, false, function () {
							var attype_item = $('.cmbItem').val();
							tblMainStock();
							cmbAttributeType(attype_item, false, function () {
								var at_attributetype = $('.cmbAttributeType').val();
								cmbAttribute(at_attributetype, false, function (dataAvailable) {
									//check items availability.for validate data entry part                         
									if (parseInt(dataAvailable) == 0) {
										var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attributes not available under the items.</div>';
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
		}

		$(document).ready(function () {

			// Executes when the HTML document is loaded and the DOM is ready
			cmbItemMainCategory(false, function () {
				var itm_maincategory = $('.cmbItemMainCategory').val();
				cmbItemSub1Category(itm_maincategory, false, function () {
					var itm_sub1category = $('.cmbItemSub1Category').val();
					cmbItemSub2Category(itm_sub1category, false, function () {
						var itm_sub2category = $('.cmbItemSub2Category').val();
						cmbItem(itm_sub2category, false, function () {
							var attype_item = $('.cmbItem').val();
							tblMainStock();
							cmbAttributeType(attype_item, false, function () {
								var at_attributetype = $('.cmbAttributeType').val();
								cmbAttribute(at_attributetype, false, function (dataAvailable) {
									//check items availability.for validate data entry part                         
									if (parseInt(dataAvailable) == 0) {
										var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attributes not available under the items.</div>';
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


			$('.cmbItemMainCategory').change(function () {
				var itm_maincategory = $(this).val();
				cmbItemSub1Category(itm_maincategory, false, function () {
					var itm_sub1category = $('.cmbItemSub1Category').val();
					cmbItemSub2Category(itm_sub1category, false, function () {
						var itm_sub2category = $('.cmbItemSub2Category').val();
						cmbItem(itm_sub2category, false, function () {
							var attype_item = $('.cmbItem').val();
							tblMainStock();
							cmbAttributeType(attype_item, false, function () {
								var at_attributetype = $('.cmbAttributeType').val();
								cmbAttribute(at_attributetype, false, function (dataAvailable) {
									//check items availability.for validate data entry part                         
									if (parseInt(dataAvailable) == 0) {
										var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attributes not available under the items.</div>';
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

			$('.tblsearchfilter').click(function () {
				tblMainStock();
			});


			$('.cmbItemSub1Category').change(function () {
				var itm_sub1category = $(this).val();
				cmbItemSub2Category(itm_sub1category, false, function () {
					var itm_sub2category = $('.cmbItemSub2Category').val();
					cmbItem(itm_sub2category, false, function () {
						var attype_item = $('.cmbItem').val();
						tblMainStock();
						cmbAttributeType(attype_item, false, function () {
							var at_attributetype = $('.cmbAttributeType').val();
							cmbAttribute(at_attributetype, false, function (dataAvailable) {
								//check items availability.for validate data entry part                         
								if (parseInt(dataAvailable) == 0) {
									var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attributes not available under the items.</div>';
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


			$('.cmbItemSub2Category').change(function () {
				var itm_sub2category = $(this).val();
				cmbItem(itm_sub2category, false, function () {
					var attype_item = $('.cmbItem').val();
					tblMainStock();
					cmbAttributeType(attype_item, false, function () {
						var at_attributetype = $('.cmbAttributeType').val();
						cmbAttribute(at_attributetype, false, function (dataAvailable) {
							//check items availability.for validate data entry part                         
							if (parseInt(dataAvailable) == 0) {
								var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attributes not available under the items.</div>';
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


			$('.cmbItem').change(function () {
				var attype_item = $(this).val();
				tblMainStock();
				cmbAttributeType(attype_item, false, function () {
					var at_attributetype = $('.cmbAttributeType').val();
					cmbAttribute(at_attributetype, false, function (dataAvailable) {
						//check items availability.for validate data entry part                         
						if (parseInt(dataAvailable) == 0) {
							var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attributes not available under the items.</div>';
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


			$('.cmbAttributeType').change(function () {
				var at_attributetype = $(this).val();
				cmbAttribute(at_attributetype, false, function (dataAvailable) {
					//check items availability.for validate data entry part                         
					if (parseInt(dataAvailable) == 0) {
						var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attributes not available under the items.</div>';
						$('.controlMsg').html('').append(controlMsg);
						$('.form-controllers-div').prop('hidden', true);
					} else {
						$('.controlMsg').html('').append("");
						$('.form-controllers-div').prop('hidden', false);
					}
					//end of validation
				});
			});


			const form = $('#mainstockform');

			$('#btn_save').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					saveMainStock();
				}
			});

			$('#btn_edit').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					editMainStock();
				}
			});

			$('#btn_clear').click(function (event) {
				form.submit(false);
				clearMainStock();
			});


		});
    </script>
</body>
</html>