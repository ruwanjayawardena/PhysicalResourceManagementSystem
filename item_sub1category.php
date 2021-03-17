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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-sitemap"></i> Item 1<sup>st</sup> Sub Category  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-12 pb-4">
                        <form id="categoryform" novalidate>
                            <input type="hidden" class="form-control" id="scat_id">
                            <div class="form-row">     
                                <div class="col-8">
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
                            </div>
                            <div class="form-row">                                
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="scat_code">Code</label>
                                        <input type="text" class="form-control" id="scat_code" placeholder="Code" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter category code
                                        </div>
                                    </div>                           
                                </div>
                            </div>
                            <div class="form-row">     
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="scat_name">Name</label>
                                        <input type="text" class="form-control" id="scat_name" placeholder="Name" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter category name
                                        </div>
                                    </div> 
                                </div>
                            </div>                           
                            <div class="form-row pb-3">     
                                <div class="col-8 bg-light chkDiv">
                                    <div class="form-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="addDefault2ndSub">
											<label class="form-check-label" for="addDefault2ndSub">Add <span class="badge badge-dark">Default</span> 2<sup>nd</sup> sub category</label>
										</div>
                                    </div> 
                                </div>
                            </div>                           
                            <div class="form-group">
                                <button class="btn btn-success" id="btn_save"><i class="fas fa-save"></i> Save</button>
                                <button class="btn btn-warning" id="btn_edit" hidden><i class="fas fa-edit"></i> Update</button>
                                <button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tblItemSub1Category" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Code</th>                                        
                                        <th>Category</th>                                        
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
		function tblItemSub1Category(scat_maincategory, callback) {
			var tbldata = "";
			$.post('controllers/itemSub1CategoryController.php', {action: 'getAllItemSub1Category', scat_maincategory: scat_maincategory}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="4" class="bg-danger text-center"> -- Item sub category not available -- </td>';
					tbldata += '</tr>';
					$('#tblItemSub1Category tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>';
						tbldata += '<div class="btn-group btn-group-sm">';
						tbldata += '<button class="btn btn-info btn_select" value="' + qdt.scat_id + '"><i class="fas fa-edit"></i></button>';
						tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.scat_id + '"><i class="fas fa-trash-alt"></i></button>';
						tbldata += '</div>';
						tbldata += '</td>';
						tbldata += '<td></td>';
						tbldata += '<td>' + qdt.scat_code + '</td>';
						tbldata += '<td>' + qdt.scat_name + '</td>';
						tbldata += '</tr>';
					});


					if ($.fn.DataTable.isDataTable('#tblItemSub1Category')) {
						//re initialize 
						$('#tblItemSub1Category').DataTable().destroy();
						$('#tblItemSub1Category tbody').empty();
						$('#tblItemSub1Category tbody').html('').append(tbldata);
						$('#tblItemSub1Category').DataTable({
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
						$('#tblItemSub1Category tbody').html('').append(tbldata);
						$('#tblItemSub1Category').DataTable({
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
					$('.chkDiv').prop('hidden', true);
					$('#btn_save').prop('hidden', true);
					$('#btn_edit').prop('hidden', false);
					var scat_id = $(this).val();
					$.post('controllers/itemSub1CategoryController.php', {action: 'getItemSub1CategoryByID', scat_id: scat_id}, function (e) {
						$.each(e, function (index, qdt) {
							$('#scat_id').val(qdt.scat_id);
							$('#scat_code').val(qdt.scat_code);
							$('#scat_name').val(qdt.scat_name);
							cmbItemMainCategory(qdt.scat_maincategory);
						});
					}, "json");
				});

				$('.btn_delete').click(function () {
					var scat_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this category ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/itemSub1CategoryController.php', {action: 'deleteItemSub1Category', scat_id: scat_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								clearItemSub1Category();
								tblItemSub1Category(scat_maincategory);
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

		function saveItemSub1Category() {
			var addDefault2ndSub = 0;
			if ($('#addDefault2ndSub').is(':checked')) {
				addDefault2ndSub = 1
			} else {
				addDefault2ndSub = 0;
			}
			var scat_maincategory = $('.cmbItemMainCategory').val();
			var scat_code = $('#scat_code').val();
			var scat_name = $('#scat_name').val();
			var postdata = {
				action: "saveItemSub1Category",
				scat_code: scat_code,
				scat_maincategory: scat_maincategory,
				scat_name: scat_name,
				addDefault2ndSub: addDefault2ndSub
			}
			$.post('controllers/itemSub1CategoryController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearItemSub1Category();
					tblItemSub1Category(scat_maincategory);
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function editItemSub1Category() {
			var scat_id = $('#scat_id').val();
			var scat_maincategory = $('.cmbItemMainCategory').val();
			var scat_code = $('#scat_code').val();
			var scat_name = $('#scat_name').val();
			var postdata = {
				action: "editItemSub1Category",
				scat_id: scat_id,
				scat_code: scat_code,
				scat_maincategory: scat_maincategory,
				scat_name: scat_name
			}
			$.post('controllers/itemSub1CategoryController.php', postdata, function (e) {
				if (parseInt(e.msgType) == 1) {
					swal("Good job!", e.msg, "success");
					clearItemSub1Category();
					tblItemSub1Category(scat_maincategory);
				} else {
					swal("Alert !", e.msg, "error");
				}
			}, "json");
		}

		function clearItemSub1Category() {
			$('.chkDiv').prop('hidden', false);
			$('#scat_id').val('');
			$('#scat_code').val('');
			$('#scat_name').val('');
			$('#addDefault2ndSub').prop('checked', false);
			$('#btn_save').prop('hidden', false);
			$('#btn_edit').prop('hidden', true);
			$('#categoryform').removeClass('was-validated');
		}

		$(document).ready(function () {
			// Executes when the HTML document is loaded and the DOM is ready
			cmbItemMainCategory(false, function () {
				var scat_maincategory = $('.cmbItemMainCategory').val();
				tblItemSub1Category(scat_maincategory);
			});

			$('.cmbItemMainCategory').change(function () {
				var scat_maincategory = $(this).val();
				tblItemSub1Category(scat_maincategory);
			});

			const form = $('#categoryform');

			$('#btn_save').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					saveItemSub1Category();
				}
			});

			$('#btn_edit').click(function (event) {
				form.submit(false);
				form.addClass('was-validated');
				if (form[0].checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
					editItemSub1Category();
				}
			});

			$('#btn_clear').click(function (event) {
				form.submit(false);
				clearItemSub1Category();
			});


		});
    </script>
</body>
</html>