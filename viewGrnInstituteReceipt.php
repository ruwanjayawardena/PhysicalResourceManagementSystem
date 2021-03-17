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
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-file"></i> GRN Receipt <small>Receive By Institute(Issue)</small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back()"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button>&nbsp;<button class="btn btn-primary d-print-none" onclick="window.print()"><i class="fas fa-print"></i>>&nbsp;Print</button></h4></div>
					<input type="hidden" class="form-control" id="grn_id" value="<?php
					if (isset($_REQUEST['grn_id']) && !empty($_REQUEST['grn_id'])) {
						echo $_REQUEST['grn_id'];
					}
					?>">
					<input type="hidden" class="form-control" id="issu_id" value="<?php
					if (isset($_REQUEST['issu_id']) && !empty($_REQUEST['issu_id'])) {
						echo $_REQUEST['issu_id'];
					}
					?>">
                </div>
                <div class="row"> 					
                    <div class="col-6">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>GRN No</th>
									<td class="grn_custom_no"></td>
								</tr>										
								<tr>
									<th>GRN Created Date | Time</th>
									<td><span class="grn_date"></span> | <span class="grn_time"></span></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-6">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>Issue No</th>
									<td class="issu_custom_issueno"></td>
								</tr>
								<tr>
									<th>Issued Date | Time</th>
									<td><span class="issu_date"></span> | <span class="issu_time"></span></td>
								</tr>
								<tr>
									<th>Issued Institute</th>
									<td class="issue_institute_desc"></td>										
								</tr>
								<tr>
									<th>Issue Description</th>
									<td class="issu_description"></td>
								</tr>								
							</tbody>
						</table>
					</div>

                </div>
                <div class="row bg-light mb-2">                   
                    <div class="col-12">
						<p class="grn_description"></p>
					</div>                    
                </div>
                <div class="row">                   
                    <div class="col-12">
						<table id="tblGrnItem" class="table table-bordered table-stripped">
							<thead class="thead-dark">
								<tr>
									<th>Item</th>
									<th>Attribute - Valuation</th>									
									<th>GRN Added Item Status</th>                                        
									<th>GRN Added Qty</th>                                        
									<th>GRN Returned Qty</th>
									<th>Description</th>                                       
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
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
		function grnReceiptViewer() {
			var grn_id = $('#grn_id').val();
			var issu_id = $('#issu_id').val();
			var tbldata = "";
			$.post('controllers/issueController.php', {action: 'getIssueByIDReport', issu_id: issu_id}, function (e) {
				$.each(e, function (index, qdt) {
					$('.issu_custom_issueno').html('').append(qdt.issu_custom_issueno);
					$('.issue_institute_desc').html('').append('<strong><small>(' + qdt.issue_prov_name + '/' + qdt.issue_zol_name + '/' + qdt.issue_div_name + '/' + qdt.issue_insttype_name + ')</small><br>' + qdt.issue_inst_name + '</strong><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.issue_inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.issue_inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.issue_inst_email);
					$('.issu_description').html('').append(qdt.issu_description);
					$('.issu_date').html('').append(qdt.issu_date);
					$('.issu_time').html('').append(qdt.issu_time);
					$('.issu_send_institute_desc').html('').append('<strong>Issue Send Institute : </strong><i><strong>' + qdt.inst_name + '</strong></i><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.inst_email);

				});
			}, "json");
			$.post('controllers/grnController.php', {action: 'getGrnInstituteByID', grn_id: grn_id}, function (e) {
				$.each(e, function (index, qdt) {
					$('.grn_custom_no').html('').append(qdt.grn_custom_no);
					$('.grn_description').html('').append(qdt.grn_description);
					$('.grn_date').html('').append(qdt.grn_date);
					$('.grn_time').html('').append(qdt.grn_time);

				});
			}, "json");

			$.post('controllers/grnController.php', {action: 'getAllGrnItemInstitute', grtm_grn_id: grn_id}, function (e) {
				if (e === undefined || e.length === 0 || e === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="9" class="bg-danger text-center"> -- GRN items not available -- </td>';
					tbldata += '</tr>';
				} else {
					$.each(e, function (index, qdt) {
						index++;
						tbldata += '<tr>';											
						tbldata += '<td><h5 style="font-size:10.5pt">' + qdt.itm_name + ' <span class="badge badge-dark">' + qdt.itm_code + '</span></h5></td>';
						tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
//							1 - full added, 2 - full return,3 - partially added & return
						if (parseInt(qdt.grtm_status) == 1) {
							tbldata += '<td> Full Qty added </td>';
						} else if (parseInt(qdt.grtm_status) == 2) {
							tbldata += '<td> Full Qty returned</td>';
						} else if (parseInt(qdt.grtm_status) == 3) {
							tbldata += '<td> Partially Added and rest QTY returned</td>';
						}
						tbldata += '<td>' + qdt.grtm_qty + '</td>';
						if (parseInt(qdt.grtm_status) == 1) {
							tbldata += '<td> Not Returned </td>';
						} else if (parseInt(qdt.grtm_status) == 2) {
							tbldata += '<td>' + qdt.grtm_return_qty + '</td>';
						} else if (parseInt(qdt.grtm_status) == 3) {
							if (parseInt(qdt.grtm_return_qty) == 0) {
								tbldata += '<td> Not Returned </td>';
							} else {
								tbldata += '<td>' + qdt.grtm_return_qty + '</td>';
							}
						}

						tbldata += '<td>' + qdt.grtm_description + '</td>';
						tbldata += '</tr>';
					});


				}
				$('#tblGrnItem tbody').html('').append(tbldata);
			}, "json");

		}





		$(document).ready(function () {
			// Executes when the HTML document is loaded and the DOM is ready
			grnReceiptViewer();


		}
		);
    </script>
</body>
</html>