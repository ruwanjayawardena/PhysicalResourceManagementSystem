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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-cart-arrow-down"></i> GRN <small>Receive By Institute</small> <span class="badge badge-dark">Step 1</span> <small>Create GRN </small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>

				<form id="grnstep1form" novalidate>
					<div class="row justify-content-center">						
						<div class="col-lg-8 col-sm-12">
							<div class="form-row">
								<div class="col-lg-5 col-sm-12">
									<div class="form-group">
										<label for="grn_custom_no">GRN No</label>
										<input type="text" class="form-control" id="grn_custom_no" placeholder="GRN No" autocomplete="off" required>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter GRN No
										</div>
									</div> 
								</div>
							</div>
							<div class="form-row">
								<div class="col-lg-5 com-sm-12">
									<div class="form-group">
										<label for="cmbIssue">Issuing Received Institute</label>
										<select class="col-12 form-control cmbIssue form-control-chosen" data-placeholder="Choose a Received Issuing..." required>
											<option value="" disabled selected>Loading...</option>
										</select>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please choose Received Issuing
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="grn_description">Description</label>
										<testarea class="form-control summernote" id="grn_description" placeholder="GRN Description" autocomplete="off" required></testarea>
										<div class="valid-feedback">
											<i class="fas fa-lg fa-check-circle"></i> Looks good! 
										</div>
										<div class="invalid-feedback">
											<i class="fas fa-lg fa-exclamation-circle"></i> Please enter GRN Description
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

			function saveGRN() {
//				1 = supplier , 2 = institute
				var grn_type = 2;
				var grn_custom_no = $('#grn_custom_no').val();
				var grn_description = $('#grn_description ').summernote('code');
				var grn_issue_id = $('.cmbIssue').val();
				var postdata = {
					action: "saveGrnInstitute",
					grn_type: grn_type,
					grn_custom_no: grn_custom_no,
					grn_description: grn_description,
					grn_issue_id: grn_issue_id,
				}
				$.post('controllers/grnController.php', postdata, function (e) {
					if (parseInt(e.msgType) == 1) {
						swal({
							title: "Good Job!",
							text: e.msg,
							type: "success",
							timer: 1800,
							showConfirmButton: false
						});
						setTimeout(function () {
							window.location.href = 'grnInstituteItem.php?grn_id=' + e.grn_id+'&issu_id='+grn_issue_id;
						}, 2300);
						clearGRN();
					} else {
						swal("Alert !", e.msg, "error");
					}
				}, "json");
			}

			function clearGRN() {
				$('#grn_custom_no').val('');
				$('#btn_save').prop('hidden', false);
				$('#btn_edit').prop('hidden', true);
				$('#grn_description').summernote('reset');
				$('#grn_description').summernote('code', '');
				$('#grnstep1form').removeClass('was-validated');
			}

			$(document).ready(function () {
				// Executes when the HTML document is loaded and the DOM is ready
				cmbIssue(false, function (dataAvailable) {
					//check issuing availability.for validate data entry part                         
					if (parseInt(dataAvailable) == 0) {
						var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> GRN Creation restricted! becasue of Issueing not available.</div>';
						$('.controlMsg').html('').append(controlMsg);
						$('.form-controllers-div').prop('hidden', true);
					} else {
						$('.controlMsg').html('').append("");
						$('.form-controllers-div').prop('hidden', false);
					}
					//end of validation
				});

				$('.summernote').summernote({
					height: 300
				});


				const form = $('#grnstep1form');

				$('#btn_save').click(function (event) {
					form.submit(false);
					form.addClass('was-validated');
					if (form[0].checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
						saveGRN();
					}
				});


				$('#btn_clear').click(function () {
					form.submit(false);
					clearGRN();
				});

			});
		</script>
	</body>
</html>