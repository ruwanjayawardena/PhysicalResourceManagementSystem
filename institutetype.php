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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-warehouse"></i> Institute Type  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6 pb-4">
                        <form id="institutetypeform" novalidate>
                            <input type="hidden" class="form-control" id="insttype_id">
                            <div class="form-group">
								<label for="insttype_nature">Choose Institute Type Nature</label>
                                <div class="form-check">
									<input class="form-check-input insttype_nature" type="radio" name="insttype_nature" id="insttype_nature_0" value="0" checked>
									<label class="form-check-label" for="insttype_nature_0">
										Other
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input insttype_nature" type="radio" name="insttype_nature" id="insttype_nature_1" value="1">
									<label class="form-check-label" for="insttype_nature_1">
										School
									</label>
								</div>
                                <div class="valid-feedback">
                                    <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                </div>
                                <div class="invalid-feedback">
                                    <i class="fas fa-lg fa-exclamation-circle"></i> Please enter institute type
                                </div>
                            </div>                           
                            <div class="form-group">
                                <label for="insttype_name">Institute Type</label>
                                <input type="text" class="form-control" id="insttype_name" placeholder="Institute Type" autocomplete="off" required>
                                <div class="valid-feedback">
                                    <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                </div>
                                <div class="invalid-feedback">
                                    <i class="fas fa-lg fa-exclamation-circle"></i> Please enter institute type
                                </div>
                            </div>                           
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success" id="btn_save"><i class="fas fa-save"></i> Save</button>
                                <button class="btn btn-warning" id="btn_edit" hidden><i class="fas fa-edit"></i> Update</button>
                                <button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tblInstituteType" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Institute Type</th>                                        
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
		function tblInstituteType(callback) {
			var tbldata = "";
			$.post('controllers/instituteController.php', {action: 'getAllInstituteType'}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="3" class="bg-danger text-center"> -- Institute Type not available -- </td>';
					tbldata += '</tr>';
					$('#tblInstituteType tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>';
						tbldata += '<div class="btn-group btn-group-sm">';
						tbldata += '<button class="btn btn-info btn_select" value="' + qdt.insttype_id + '"><i class="fas fa-edit"></i></button>';
						tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.insttype_id + '"><i class="fas fa-trash-alt"></i></button>';
						tbldata += '</div>';
						tbldata += '</td>';
						tbldata += '<td></td>';
						tbldata += '<td>' + qdt.insttype_name + '</td>';
						tbldata += '</tr>';
					});


					if ($.fn.DataTable.isDataTable('#tblInstituteType')) {
						//re initialize 
						$('#tblInstituteType').DataTable().destroy();
						$('#tblInstituteType tbody').empty();
						$('#tblInstituteType tbody').html('').append(tbldata);
						$('#tblInstituteType').DataTable({
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
						$('#tblInstituteType tbody').html('').append(tbldata);
						$('#tblInstituteType').DataTable({
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
					var insttype_id = $(this).val();
					$.post('controllers/instituteController.php', {action: 'getInstituteTypeByID', insttype_id: insttype_id}, function (e) {
						$.each(e, function (index, qdt) {
							$('#insttype_id').val(qdt.insttype_id);
							$('#insttype_name').val(qdt.insttype_name);
							$('.insttype_nature[value=' + qdt.insttype_nature + ']').prop('checked', true);
							if (qdt.insttype_nature == 1) {
								//school
								$('#insttype_name').prop('disabled', true);
							} else {
								//other
								$('#insttype_name').prop('disabled', false);
							}
						});
					}, "json");
				});

				$('.btn_delete').click(function () {
					var insttype_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this institute type ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/instituteController.php', {action: 'deleteInstituteType', insttype_id: insttype_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								clearInstituteType();
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

		function saveInstituteType() {
			var insttype_name = $('#insttype_name').val();
			var insttype_nature = $('.insttype_nature:checked').val();
			var postdata = {
				action: "saveInstituteType",
				insttype_name: insttype_name,
				insttype_nature: insttype_nature
			}
			$.post('controllers/instituteController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearInstituteType();
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function editInstituteType() {
			var insttype_id = $('#insttype_id').val();
			var insttype_name = $('#insttype_name').val();
			var insttype_nature = $('.insttype_nature:checked').val();
			var postdata = {
				action: "editInstituteType",
				insttype_id: insttype_id,
				insttype_name: insttype_name,
				insttype_nature: insttype_nature
			}
			$.post('controllers/instituteController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearInstituteType();
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function clearInstituteType() {
			$('#insttype_name').prop('disabled', false);
			$('.insttype_nature[value=0]').prop('checked', true);
			$('#insttype_id').val('');
			$('#insttype_name').val('');
			$('#btn_save').prop('hidden', false);
			$('#btn_edit').prop('hidden', true);
			$('#institutetypeform').removeClass('was-validated');
			tblInstituteType();
		}

		$(document).ready(function () {
			// Executes when the HTML document is loaded and the DOM is ready
			tblInstituteType();
			const form = $('#institutetypeform');

			$('#btn_save').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					saveInstituteType();
				}
			});

			$('#btn_edit').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					editInstituteType();
				}
			});

			$('#btn_clear').click(function () {
				form.submit(false);
				clearInstituteType();
			});

			$('.insttype_nature').click(function () {
				var insttype_nature = $(this).val();
				if (this.checked) {
					if (parseInt(insttype_nature) == 1) {
						$('#insttype_name').val('School');
						$('#insttype_name').prop('disabled', true);
					} else {
						$('#insttype_name').val('');
						$('#insttype_name').prop('disabled', false);
					}
				}
			});


		});
    </script>
</body>
</html>