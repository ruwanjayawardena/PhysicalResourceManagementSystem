<?php include './access_control/session_controler.php'; ?> 
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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-file"></i> Centralized Stock Report &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button> <button class="btn btn-primary d-print-none" onclick="refreshPage();"><i class="fa fa-refresh"></i>&nbsp;Refresh</button> <button class="btn btn-dark d-print-none" onclick="window.print();"><i class="fa fa-print"></i>&nbsp;Print</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-12 pb-4 d-print-none">
                        <form id="mainstockform" novalidate>
                            <input type="hidden" class="form-control" id="stk_id">
							<div class="form-row"> 
                                <div class="col-6">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="5">
                                        <label for="cmbProvince">Choose Province</label>
                                        <select class="col-12 form-control cmbProvince form-control-chosen" data-placeholder="Choose a Province..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose province
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="6">
                                        <label for="cmbZonal">Choose Zonal</label>
                                        <select class="col-12 form-control cmbZonal form-control-chosen" data-placeholder="Choose a Zonal..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose zonal
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row"> 
                                <div class="col-6">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="7">
                                        <label for="cmbDivision">Choose Division</label>
                                        <select class="col-12 form-control cmbDivision form-control-chosen" data-placeholder="Choose a division..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose division
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="8">
                                        <label for="cmbInstituteType">Choose Institute Type</label>
                                        <select class="col-12 form-control cmbInstituteType form-control-chosen" data-placeholder="Choose a Institute Type..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose institute type
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
										<input type="radio" name="tblsearchfilter" class="tblsearchfilter" value="9">
                                        <label for="cmbInstitute">Choose Institute </label>
                                        <select class="col-12 form-control cmbInstitute form-control-chosen" data-placeholder="Choose a Institute..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose institute
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        <th>Institute</th>
                                        <th>Item</th>
                                        <th>Status</th>
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
			var cmbProvince = $('.cmbProvince').val();
			var cmbZonal = $('.cmbZonal').val();
			var cmbDivision = $('.cmbDivision').val();
			var cmbInstituteType = $('.cmbInstituteType').val();
			var cmbInstitute = $('.cmbInstitute').val();
			var tbldata = "";
			$.post('controllers/mainStockController.php', {action: 'getAllMainStockFormatCentralized'}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="4" class="bg-danger text-center"> -- Stocks not available -- </td>';
					tbldata += '</tr>';
					$('#tblMainStock tbody').html('').append(tbldata);
				} else {
					var subArr = e;
					$.each(e, function (index, qdt) {
						index++;
						switch (parseInt(tblsearchfilter)) {
							case 5:
								if (parseInt(cmbProvince) == qdt.inst_province) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 6:
								if (parseInt(cmbZonal) == qdt.inst_zonal) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 7:
								if (parseInt(cmbDivision) == qdt.inst_division) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 8:
								if (parseInt(cmbInstituteType) == qdt.inst_institutetype) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 9:
								if (parseInt(cmbInstitute) == qdt.stk_institute) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 4:
								if (parseInt(cmbItem) == qdt.stk_item) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 3:
								if (parseInt(cmbItemSub2Category) == qdt.itm_sub2category) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 2:
								if (parseInt(cmbItemSub1Category) == qdt.itm_sub1category) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 1:
								if (parseInt(cmbItemMainCategory) == qdt.itm_maincategory) {
									tbldata += '<tr>';
									tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
									tbldata += '<td>' + qdt.itm_name + '</td>';
									tbldata += '<td>' + qdt.attributes + '</td>';
									tbldata += '</tr>';
								}
								break;
							case 0:
								tbldata += '<tr>';
								tbldata += '<td>' + qdt.insttype_name + ' - '+qdt.inst_name+'</td>';
								tbldata += '<td>' + qdt.itm_name + '</td>';
								tbldata += '<td>' + qdt.attributes + '</td>';
								tbldata += '</tr>';
								break;
						}
					});
					if (tbldata === "") {
						tbldata += '<tr>';
						tbldata += '<td colspan="3" class="bg-danger text-center"> -- Stocks not available under selected category  -- </td>';
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


			cmbProvince(false, function () {
				var inst_province = $('.cmbProvince').val();
				cmbZonal(inst_province, false, function () {
					var inst_zonal = $('.cmbZonal').val();
					cmbDivision(inst_zonal, false, function (dataAvailable) {
						var inst_division = $('.cmbDivision').val();
						cmbInstituteType(false, function () {
							var cmbInstituteType = $('.cmbInstituteType').val();
							var insttype_ar = cmbInstituteType.split('-');
							var insttype_id = insttype_ar[0];
							cmbInstitute(inst_division, insttype_id);
						});
					});
				});
			});

			// Executes when the HTML document is loaded and the DOM is ready
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
			
			tblMainStock();


			$('.cmbProvince').change(function () {
				var inst_province = $(this).val();
				cmbZonal(inst_province, false, function () {
					var inst_zonal = $('.cmbZonal').val();
					cmbDivision(inst_zonal, false, function () {
						var inst_division = $('.cmbDivision').val();
						cmbInstituteType(false, function () {
							var cmbInstituteType = $('.cmbInstituteType').val();
							var insttype_ar = cmbInstituteType.split('-');
							var insttype_id = insttype_ar[0];
							cmbInstitute(inst_division, insttype_id);
						});
					});
				});
				tblMainStock();
			});

			$('.cmbZonal').change(function () {
				var inst_zonal = $(this).val();
				cmbDivision(inst_zonal, false, function (dataAvailable) {
					var inst_division = $('.cmbDivision').val();
					cmbInstituteType(false, function () {
						var cmbInstituteType = $('.cmbInstituteType').val();
						var insttype_ar = cmbInstituteType.split('-');
						var insttype_id = insttype_ar[0];
						cmbInstitute(inst_division, insttype_id);
					});
				});
				tblMainStock();
			});

			$('.cmbDivision').change(function () {
				var inst_division = $(this).val();
				cmbInstituteType(false, function () {
					var cmbInstituteType = $('.cmbInstituteType').val();
					var insttype_ar = cmbInstituteType.split('-');
					var insttype_id = insttype_ar[0];
					cmbInstitute(inst_division, insttype_id);
				});
				tblMainStock();
			});

			$('.cmbInstituteType').change(function () {
				var insttype_str = $(this).val();
				var insttype_ar = insttype_str.split('-');
				var insttype_nature = insttype_ar[1];
				var insttype_id = insttype_ar[0];
				var inst_division = $('.cmbDivision').val();
				cmbInstitute(inst_division, insttype_id);
				tblMainStock();
			});
			
			$('.cmbInstitute').change(function(){
				tblMainStock();
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




		});
    </script>
</body>
</html>