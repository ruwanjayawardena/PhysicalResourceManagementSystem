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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-file"></i> Issue Receipts &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row justify-content-center">                  
                    <div class="col-9">
                        <div class="table-responsive">
                            <table id="tblIssue" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Status</th>                                        
                                        <th>Issue No</th>                                        
                                        <th>Send Institute</th>                                        
                                        <th>Issue Date/Time</th>                                        
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
		function tblIssue(callback) {
			var tbldata = "";
			$.post('controllers/issueController.php', {action: 'getAllIssue'}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="4" class="bg-danger text-center"> -- Issuing not available -- </td>';
					tbldata += '</tr>';
					$('#tblIssue tbody').html('').append(tbldata);
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>';
						if (parseInt(qdt.issu_status) == 0) {
							tbldata += '<div class="btn-group btn-group-sm">';
							tbldata += '<button class="btn btn-warning btn_prepare" value="' + qdt.issu_id + '"><i class="fas fa-edit"></i> Prepare </button>';
							tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.issu_id + '"><i class="fas fa-trash-alt"></i></button>';
							tbldata += '</div>';
						} else {
							tbldata += '<button class="btn btn-sm btn-primary btn_viewReceipt" value="' + qdt.issu_id + '"><i class="fas fa-file"></i> View Receipt</button>';
						}

						tbldata += '</td>';
						tbldata += '<td></td>';
						//0 - preparing, 1 - submited & pending ,2- accepted & processing, 3 - completed
						if (parseInt(qdt.issu_status) == 0) {
							tbldata += '<td> Preparing </td>';
						} else if (parseInt(qdt.issu_status) == 1) {
							tbldata += '<td> Issued and Pending Receiving </td>';
						} else if (parseInt(qdt.issu_status) == 2) {
							tbldata += '<td> Receiving Accepted & Processing</td>';
						} else if (parseInt(qdt.issu_status) == 3) {
							tbldata += '<td> Receiving Processe Completed </td>';
						}
						tbldata += '<td>' + qdt.issu_custom_issueno + '</td>';
						tbldata += '<td><strong>' + qdt.inst_name + '</strong><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.inst_email + '</td>';
						tbldata += '<td>' + qdt.issu_date + ' | ' + qdt.issu_time + '</td>';
						tbldata += '</tr>';
					});


					if ($.fn.DataTable.isDataTable('#tblIssue')) {
						//re initialize 
						$('#tblIssue').DataTable().destroy();
						$('#tblIssue tbody').empty();
						$('#tblIssue tbody').html('').append(tbldata);
						$('#tblIssue').DataTable({
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
						$('#tblIssue tbody').html('').append(tbldata);
						$('#tblIssue').DataTable({
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
					var issu_id = $(this).val();
//					swal({
//						title: "Processing !",
//						text: "Please wait for issue prepaing section",
//						type: "success",
//						timer: 1800,
//						showConfirmButton: false
//					});
//					setTimeout(function () {
						window.location.href = 'issueItem.php?issu_id=' + issu_id;
//					}, 2300);
				});
				
				$('.btn_viewReceipt').click(function () {
					var issu_id = $(this).val();
//					swal({
//						title: "Processing !",
//						text: "Please wait for issue receipt information section",
//						type: "success",
//						timer: 1800,
//						showConfirmButton: false
//					});
//					setTimeout(function () {
						window.location.href = 'viewIssueReceipt.php?issu_id=' + issu_id;
//					}, 2300);
				});

				$('.btn_delete').click(function () {
					var issu_id = $(this).val();
					swal({
						title: "Are you sure?",
						text: "Do you want to delete this processing issue recept ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						cancelButtonClass: "btn-light",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false
					}, function () {
						$.post('controllers/issueController.php', {action: 'deleteIssue', issu_id: issu_id}, function (e) {
							if (parseInt(e.msgType) == 1) {
								swal("Good Job!", e.msg, "success");
								tblIssue();
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
			tblIssue();

		});
    </script>
</body>
</html>