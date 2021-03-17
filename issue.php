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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-user-circle"></i> Issue <span class="badge badge-dark">Step 1</span> <small>Create Issue Note  </small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>

				<form id="issuestep1form" novalidate>
					<div class="row">
						<div class="col-lg-3 col-sm-12 col-xs-12 pb-4">
							<div class="form-row">
								<input type="hidden" class="form-control" id="usrcat_id">
								<div class="col-12">
									<div class="form-group">
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
								<div class="col-12">
									<div class="form-group">
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
								<div class="col-12">
									<div class="form-group">
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

								<div class="col-12">
									<div class="form-group">
										<label for="cmbInstituteType">Choose Institute Type</label>
										<select class="col-12 form-control cmbInstituteType form-control-chosen" data-placeholder="Choose a Institute type..." required>
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

								<div class="col-12 bg-light">
									<div class="form-group ">
										<label for="cmbInstitute">Choose Institute</label>
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
						</div>  
						<div class="col">
							<div class="form-row">
								<div class="col-5">
									<div class="form-group">
										<label for="issu_custom_issueno">Custom Issue No</label>
										<input type="text" class="form-control" id="issu_custom_issueno" placeholder="Issue No" autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Issue No
										</div>
									</div> 
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="issu_description">Description</label>
										<testarea class="form-control summernote" id="issu_description" placeholder="Issue Description" autocomplete="off" required></testarea>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter Issue Note
										</div>
									</div> 
								</div>
								<div class="form-group form-controllers-div">
									<button class="btn btn-success" id="btn_save"><i class="fas fa-save"></i> Continue</button>
									<button class="btn btn-warning" id="btn_edit" hidden><i class="fas fa-edit"></i> Update</button>
									<button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
								</div>
								<div class="form-group controlMsg"></div>
							</div>
						</div>



					</div>
				</form>		

			</div>		
		</section>
		<?php
		include './includes/end-block.php';
		include './includes/comboboxJS.php';
		include './includes/commonJS.php';
		?>  
		<script>

			function saveIssue() {
				var issu_custom_issueno = $('#issu_custom_issueno').val();
				var issu_description = $('#issu_description ').summernote('code');
				var issu_send_institute = $('.cmbInstitute').val();
				var postdata = {
					action: "saveIssue",
					issu_custom_issueno: issu_custom_issueno,
					issu_description: issu_description,
					issu_send_institute: issu_send_institute
				}
				$.post('controllers/issueController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal({
							title: "Good Job!",
							text: e.msg,
							type: "success",
							timer: 1800,
							showConfirmButton: false
						});
						setTimeout(function () {
							window.location.href = 'issueItem.php?issu_id=' + e.issu_id;
						}, 2300);
						clearIssue();
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function clearIssue() {
				$('#issu_custom_issueno').val('');
				$('#btn_save').prop('hidden', false);
				$('#btn_edit').prop('hidden', true);
				$('#issu_description').summernote('reset');
				$('#issu_description').summernote('code', '');
				$('#issuestep1form').removeClass('was-validated');
			}

			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				$('.summernote').summernote({
					height: 300
				});

				cmbProvince(false, function () {
					var inst_province = $('.cmbProvince').val();
					cmbZonal(inst_province, false, function () {
						var inst_zonal = $('.cmbZonal').val();
						cmbDivision(inst_zonal, false, function () {
							var inst_division = $('.cmbDivision').val();
							cmbInstituteType(false, function () {
								var inst_institutetype = $('.cmbInstituteType').val();
								cmbInstituteExceptLoggedOne(inst_division, inst_institutetype, false, function (dataAvailable) {
									//check items availability.for validate data entry part                         
									if (parseInt(dataAvailable) == 0) {
										var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of institute not available under selected divition & institute type.</div>';
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

				$('.cmbProvince').change(function () {
					var inst_province = $(this).val();
					cmbZonal(inst_province, false, function () {
						var inst_zonal = $('.cmbZonal').val();
						cmbDivision(inst_zonal, false, function () {
							var inst_division = $('.cmbDivision').val();
							cmbInstituteType(false, function () {
								var inst_institutetype = $('.cmbInstituteType').val();
								cmbInstituteExceptLoggedOne(inst_division, inst_institutetype, false, function (dataAvailable) {
									//check items availability.for validate data entry part                         
									if (parseInt(dataAvailable) == 0) {
										var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of institute not available under selected divition & institute type.</div>';
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

				$('.cmbZonal').change(function () {
					var inst_zonal = $(this).val();
					cmbDivision(inst_zonal, false, function () {
						var inst_division = $('.cmbDivision').val();
						cmbInstituteType(false, function () {
							var inst_institutetype = $('.cmbInstituteType').val();
							cmbInstituteExceptLoggedOne(inst_division, inst_institutetype, false, function (dataAvailable) {
								//check items availability.for validate data entry part                         
								if (parseInt(dataAvailable) == 0) {
									var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of institute not available under selected divition & institute type.</div>';
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

				$('.cmbDivision').change(function () {
					var inst_division = $(this).val();
					cmbInstituteType(false, function () {
						var inst_institutetype = $('.cmbInstituteType').val();
						cmbInstituteExceptLoggedOne(inst_division, inst_institutetype, false, function (dataAvailable) {
							//check items availability.for validate data entry part                         
							if (parseInt(dataAvailable) == 0) {
								var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of institute not available under selected divition & institute type.</div>';
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

				$('.cmbInstituteType').change(function () {
					var inst_institutetype = $(this).val();
					var inst_division = $('.cmbDivision').val();
					cmbInstituteExceptLoggedOne(inst_division, inst_institutetype, false, function (dataAvailable) {
						//check items availability.for validate data entry part                         
						if (parseInt(dataAvailable) == 0) {
							var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of institute not available under selected divition & institute type.</div>';
							$('.controlMsg').html('').append(controlMsg);
							$('.form-controllers-div').prop('hidden', true);
						} else {
							$('.controlMsg').html('').append("");
							$('.form-controllers-div').prop('hidden', false);
						}
						//end of validation
					});
				});


				const form = $('#issuestep1form');

				$('#btn_save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						saveIssue();
					}
				});


				$('#btn_clear').click(function (event) {
					form.submit(false);
					clearIssue();
				});

			});
		</script>
	</body>
</html>