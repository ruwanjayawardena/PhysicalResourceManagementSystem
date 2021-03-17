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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-file"></i> Stock By Institute Report &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button> <button class="btn btn-primary d-print-none" onclick="refreshPage();"><i class="fa fa-refresh"></i>&nbsp;Refresh</button> <button class="btn btn-dark d-print-none" onclick="window.print();"><i class="fa fa-print"></i>&nbsp;Print</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-12 pb-4 d-print-none">
                        <form id="mainstockform" novalidate>
                            <input type="hidden" class="form-control" id="stk_id">
                            <div class="form-row">   

                                <div class="col-12">
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
                                <div class="col-12">
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
                                <div class="col-12">
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
                                <div class="col-12">
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
                        </form>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tblMainStock" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
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
					tbldata += '<td colspan="3" class="bg-danger text-center"> -- Stocks not available -- </td>';
					tbldata += '</tr>';
					$('#tblMainStock tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						switch (parseInt(tblsearchfilter)) {
							case 4:
								if (parseInt(cmbItem) == qdt.stk_item) {
									tbldata += '<tr>';
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
									tbldata += '<td>' + qdt.itm_name + '</td>';
//						tbldata += '<td>' + qdt.at_name + ' - Rs. ' + qdt.at_price + '</td>';
									tbldata += '<td>' + qdt.at_name + '</td>';
									tbldata += '<td>' + qdt.stk_qty + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 0:
								tbldata += '<tr>';
								tbldata += '<td>' + qdt.itm_name + '</td>';
//						tbldata += '<td>' + qdt.at_name + ' - Rs. ' + qdt.at_price + '</td>';
								tbldata += '<td>' + qdt.at_name + '</td>';
								tbldata += '<td>' + qdt.stk_qty + '</td>';
								tbldata += '</tr>';
								break;
						}
					});
					if (tbldata === "") {
						tbldata += '<tr>';
						tbldata += '<td colspan="3" class="bg-danger text-center"> -- Stock not available under selected category  -- </td>';
						tbldata += '</tr>';
					}
					$('#tblMainStock tbody').html('').append(tbldata);
				}

				if (callback !== undefined) {
					if (typeof callback === 'function') {
						callback();
					}
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
			$('.tblsearchfilter').prop('checked', false);
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




		});
    </script>
</body>
</html>