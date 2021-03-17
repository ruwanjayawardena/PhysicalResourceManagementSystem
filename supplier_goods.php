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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-truck"></i> Supplier Goods  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                     
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6 pb-4">
                        <form id="suppliergoodform" novalidate>
                            <input type="hidden" class="form-control" id="gd_id">
                            <div class="col-9">
								<div class="form-group">
									<label for="cmbSupplier">Choose Supplier</label>
									<select class="col-12 form-control cmbSupplier form-control-chosen" data-placeholder="Choose a Supplier..." required>
										<option value="" disabled selected>Loading...</option>
									</select>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please choose supplier
									</div>
								</div>
							</div>							
                            <div class="col-9">
								<div class="form-group">
									<label for="gd_name">Name</label>
									<input type="text" class="form-control" id="gd_name" placeholder="Name" autocomplete="off" required>
									<div class="valid-feedback">
										<i class="fas fa-lg fa-check-circle"></i> Looks good! 
									</div>
									<div class="invalid-feedback">
										<i class="fas fa-lg fa-exclamation-circle"></i> Please enter name
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
                            <table id="tblSupplierGoods" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Goods</th>                                        
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
		function tblSupplierGoods(gd_supplier, callback) {
			var tbldata = "";
			$.post('controllers/supplierController.php', {action: 'getAllSupplierGoods', gd_supplier: gd_supplier}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="3" class="bg-danger text-center"> -- SupplierGoods not available -- </td>';
					tbldata += '</tr>';
					$('#tblSupplierGoods tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>';
						tbldata += '<div class="btn-group btn-group-sm">';
						tbldata += '<button class="btn btn-info btn_select" value="' + qdt.gd_id + '"><i class="fas fa-edit"></i></button>';
						tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.gd_id + '"><i class="fas fa-trash-alt"></i></button>';
						tbldata += '</div>';
						tbldata += '</td>';
						tbldata += '<td></td>';
						tbldata += '<td><strong>' + qdt.gd_name + '</td>';
						tbldata += '</tr>';
					});
					if ($.fn.DataTable.isDataTable('#tblSupplierGoods')) {
						//re initialize 
						$('#tblSupplierGoods').DataTable().destroy();
						$('#tblSupplierGoods tbody').empty();
						$('#tblSupplierGoods tbody').html('').append(tbldata);
						$('#tblSupplierGoods').DataTable({
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
						$('#tblSupplierGoods tbody').html('').append(tbldata);
						$('#tblSupplierGoods').DataTable({
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
					var gd_id = $(this).val();
					$.post('controllers/supplierController.php', {action: 'getSupplierGoodsByID', gd_id: gd_id}, function (e) {
						$.each(e, function (index, qdt) {
							$('#gd_id').val(qdt.gd_id);
							$('#gd_name').val(qdt.gd_name);
							cmbSupplier(qdt.gd_supplier);
						});
					}, "json");
				});

				$('.btn_delete').click(function () {
					var gd_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this supplier good ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/supplierController.php', {action: 'deleteSupplierGoods', gd_id: gd_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								clearSupplierGoods();
								tblSupplierGoods(gd_supplier);
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

		function saveSupplierGoods() {
			var gd_supplier = $('.cmbSupplier').val();
			var gd_name = $('#gd_name').val();
			var postdata = {
				action: "saveSupplierGoods",
				gd_supplier: gd_supplier,
				gd_name: gd_name
			}
			$.post('controllers/supplierController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearSupplierGoods();
					tblSupplierGoods(gd_supplier);
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function editSupplierGoods() {
			var gd_id = $('#gd_id').val();
			var gd_supplier = $('.cmbSupplier').val();
			var gd_name = $('#gd_name').val();
			var postdata = {
				action: "editSupplierGoods",
				gd_supplier: gd_supplier,
				gd_name: gd_name,
				gd_id: gd_id
			}
			$.post('controllers/supplierController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearSupplierGoods();
					tblSupplierGoods(gd_supplier);
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function clearSupplierGoods() {
			$('#gd_id').val('');
			$('#gd_name').val('');
			$('#btn_save').prop('hidden', false);
			$('#btn_edit').prop('hidden', true);
			$('#suppliergoodform').removeClass('was-validated');
		}

		$(document).ready(function () {
			// Executes when the HTML document is loaded and the DOM is ready
			cmbSupplier(false, function () {
				var gd_supplier = $('.cmbSupplier').val();
				tblSupplierGoods(gd_supplier);
			});
			const form = $('#suppliergoodform');
			
			$('.cmbSupplier').change(function(){
				var gd_supplier = $(this).val();
				tblSupplierGoods(gd_supplier);
			});

			$('#btn_save').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					saveSupplierGoods();
				}
			});

			$('#btn_edit').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					editSupplierGoods();
				}
			});

			$('#btn_clear').click(function () {
				form.submit(false);
				clearSupplierGoods();
			});


		});
    </script>
</body>
</html>