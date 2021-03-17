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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-truck"></i> Supplier  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6 pb-4">
                        <form id="supplierform" novalidate>
                            <input type="hidden" class="form-control" id="sup_id">
                            <div class="col-9">
								<div class="form-group">
									<label for="sup_name">Name</label>
									<input type="text" class="form-control" id="sup_name" placeholder="Name" autocomplete="off" required>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please enter name
									</div>
								</div>  
							</div>
							<div class="col-5">
								<div class="form-group">
									<label for="sup_phone">Phone</label>
									<input type="tel" class="form-control" id="sup_phone" placeholder="Phone" autocomplete="off" required>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please enter phone
									</div>
								</div>   
							</div>
							<div class="col-7">
								<div class="form-group">
									<label for="sup_email">Email</label>
									<input type="email" class="form-control" id="sup_email" placeholder="Email" autocomplete="off" required>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please enter email
									</div>
								</div>        
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="sup_address">Address</label>
									<textarea class="form-control" id="sup_address" placeholder="Address" rows="3" autocomplete="off" required></textarea>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please enter address
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
                            <table id="tblSupplier" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Supplier</th>                                        
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
		function tblSupplier(callback) {
			var tbldata = "";
			$.post('controllers/supplierController.php', {action: 'getAllSupplier'}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="3" class="bg-danger text-center"> -- Supplier not available -- </td>';
					tbldata += '</tr>';
					$('#tblSupplier tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>';
						tbldata += '<div class="btn-group btn-group-sm">';
						tbldata += '<button class="btn btn-info btn_select" value="' + qdt.sup_id + '"><i class="fas fa-edit"></i></button>';
						tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.sup_id + '"><i class="fas fa-trash-alt"></i></button>';
						tbldata += '</div>';
						tbldata += '</td>';
						tbldata += '<td></td>';
						tbldata += '<td><strong>' + qdt.sup_name + '</strong><br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> '+qdt.sup_phone+'<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> '+qdt.sup_email+'</td>';
						tbldata += '</tr>';
					});


					if ($.fn.DataTable.isDataTable('#tblSupplier')) {
						//re initialize 
						$('#tblSupplier').DataTable().destroy();
						$('#tblSupplier tbody').empty();
						$('#tblSupplier tbody').html('').append(tbldata);
						$('#tblSupplier').DataTable({
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
						$('#tblSupplier tbody').html('').append(tbldata);
						$('#tblSupplier').DataTable({
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
					var sup_id = $(this).val();
					$.post('controllers/supplierController.php', {action: 'getSupplierByID', sup_id: sup_id}, function (e) {
						$.each(e, function (index, qdt) {
							$('#sup_id').val(qdt.sup_id);
							$('#sup_name').val(qdt.sup_name);
							$('#sup_phone').val(qdt.sup_phone);
							$('#sup_email').val(qdt.sup_email);
							$('#sup_address').val(qdt.sup_address);
						});
					}, "json");
				});

				$('.btn_delete').click(function () {
					var sup_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this supplier ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/supplierController.php', {action: 'deleteSupplier', sup_id: sup_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								clearSupplier();
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

		function saveSupplier() {
			var sup_name = $('#sup_name').val();
			var sup_address = $('#sup_address').val();
			var sup_phone = $('#sup_phone').val();
			var sup_email = $('#sup_email').val();
			var postdata = {
				action: "saveSupplier",
				sup_name: sup_name,
				sup_address: sup_address,
				sup_phone: sup_phone,
				sup_email: sup_email
			}
			$.post('controllers/supplierController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearSupplier();
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function editSupplier() {
			var sup_id = $('#sup_id').val();
			var sup_name = $('#sup_name').val();
			var sup_address = $('#sup_address').val();
			var sup_phone = $('#sup_phone').val();
			var sup_email = $('#sup_email').val();
			var postdata = {
				action: "editSupplier",
				sup_id: sup_id,
				sup_name: sup_name,
				sup_address: sup_address,
				sup_phone: sup_phone,
				sup_email: sup_email
			}
			$.post('controllers/supplierController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearSupplier();
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function clearSupplier() {
			$('#sup_id').val('');
			$('#sup_name').val('');
			$('#sup_address').val('');
			$('#sup_phone').val('');
			$('#sup_email').val('');
			$('#btn_save').prop('hidden', false);
			$('#btn_edit').prop('hidden', true);
			$('#supplierform').removeClass('was-validated');
			tblSupplier();
		}

		$(document).ready(function () {
			// Executes when the HTML document is loaded and the DOM is ready
			tblSupplier();
			const form = $('#supplierform');

			$('#btn_save').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					saveSupplier();
				}
			});

			$('#btn_edit').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					editSupplier();
				}
			});

			$('#btn_clear').click(function () {
				form.submit(false);
				clearSupplier();
			});


		});
    </script>
</body>
</html>