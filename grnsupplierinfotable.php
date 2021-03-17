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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-file"></i> GRN Info - Supplier &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row justify-content-center">                  
                    <div class="col-9">
                        <div class="table-responsive">
                            <table id="tblGrn" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Status</th>                                        
                                        <th>GRN No</th>                                        
                                        <th>Supplier</th>                                        
                                        <th>Receive Date/Time</th>                                        
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
		function tblGrn(callback) {
			var tbldata = "";
			$.post('controllers/grnController.php', {action: 'getAllGrnSupplier'}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="6" class="bg-danger text-center"> -- Supplier GRN not available -- </td>';
					tbldata += '</tr>';
					$('#tblGrn tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>';
						if (parseInt(qdt.grn_status) == 0) {
							tbldata += '<div class="btn-group btn-group-sm">';
							tbldata += '<button class="btn btn-warning btn_prepare" value="' + qdt.grn_id + '"><i class="fas fa-edit"></i> Prepare </button>';
							tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.grn_id + '"><i class="fas fa-trash-alt"></i></button>';
							tbldata += '</div>';
						} else {
							tbldata += '<button class="btn btn-sm btn-primary btn_viewReceipt" value="' + qdt.grn_id + '"><i class="fas fa-file"></i> View Receipt</button>';
						}
						tbldata += '</td>';
						tbldata += '<td></td>';
						//0 - preparing, 1 - completed & stock update
						if (parseInt(qdt.grn_status) == 0) {
							tbldata += '<td> Preparing </td>';
						} else if (parseInt(qdt.grn_status) == 1) {
							tbldata += '<td> completed & stock update </td>';
						}
						tbldata += '<td>' + qdt.grn_custom_no + '</td>';
						tbldata += '<td><strong>' + qdt.sup_name + '</strong><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.sup_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.sup_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.sup_email + '</td>';
						tbldata += '<td>' + qdt.grn_date + ' | ' + qdt.grn_time + '</td>';
						tbldata += '</tr>';
					});


					if ($.fn.DataTable.isDataTable('#tblGrn')) {
						//re initialize 
						$('#tblGrn').DataTable().destroy();
						$('#tblGrn tbody').empty();
						$('#tblGrn tbody').html('').append(tbldata);
						$('#tblGrn').DataTable({
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
						$('#tblGrn tbody').html('').append(tbldata);
						$('#tblGrn').DataTable({
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



				$('.btn_prepare').click(function () {
					var grn_id = $(this).val();
					window.location.href = 'grnSupplierItem.php?grn_id=' + grn_id;
				});

				$('.btn_viewReceipt').click(function () {
					var grn_id = $(this).val();
					window.location.href = 'viewGrnSupplierReceipt.php?grn_id=' + grn_id;
				});

				$('.btn_delete').click(function () {
					var grn_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this processing Supplier GRN ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/grnController.php', {action: 'deleteGrn', grn_id: grn_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								tblGrn();
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



		$(document).ready(function () {
			// Executes when the HTML document is loaded and the DOM is ready
			tblGrn();

		});
    </script>
</body>
</html>