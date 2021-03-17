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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-file"></i> Issue Receipt  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back()"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button>&nbsp;<button class="btn btn-primary d-print-none" onclick="window.print()"><i class="fas fa-print"></i>>&nbsp;Print</button></h4></div>
					<input type="hidden" class="form-control" id="issu_id" value="<?php
					if (isset($_REQUEST['issu_id']) && !empty($_REQUEST['issu_id'])) {
						echo $_REQUEST['issu_id'];
					}
					?>">
                </div>
                <div class="row"> 
					<div class="col-6">
						<table class="table">							
							<tr>
								<th>Issue No</th>
								<td><span class="issu_custom_issueno"></span></td>
							</tr>
							<tr>
								<th>Date</th>
								<td><span class="issu_date"></span> | <span class="issu_time"></span></td>
							</tr>							
						</table>
					</div>
                    <div class="col-6">
						<table class="table table-bordered">
							<tr>
								<th>Issue Institute</th>
								<td><span class="issue_institute_desc"></span></td>
							</tr>
							<tr>
								<th>Send Institute</th>
								<td><span class="send_institute_desc"></span></td>
							</tr>
						</table>
					</div>

                </div>
                <div class="row bg-light">                   
                    <div class="col-12">
						<p class="issu_description"></p>
					</div>                    
                </div>
                <div class="row">                   
                    <div class="col-12">
						<table id="tblIssueItem" class="table table-bordered table-stripped">
							<thead class="thead-dark">
								<tr>                               
									<th></th>
									<th>Item</th>
									<th>Attribute - Valuation</th>
									<th>Available Qty</th>                                        
									<th>Issued Qty</th>                                        
									<th>Receive Institute Action</th>                                        
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
		function issueReceiptViewer() {
			var issu_id = $('#issu_id').val();
			var tbldata = "";
			$.post('controllers/issueController.php', {action: 'getIssueByIDReport', issu_id: issu_id}, function (issueJSON) {
				$.each(issueJSON, function (index, qdt) {
					console.log(index)
					$('.issue_institute_desc').html('').append('<strong><small>(' + qdt.issue_prov_name + '/' + qdt.issue_zol_name + '/' + qdt.issue_div_name + '/' + qdt.issue_insttype_name + ')</small><br>' + qdt.issue_inst_name + '</strong><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.issue_inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.issue_inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.issue_inst_email);
					$('.send_institute_desc').html('').append('<strong><small>(' + qdt.send_prov_name + '/' + qdt.send_zol_name + '/' + qdt.send_div_name + '/' + qdt.send_insttype_name + ')</small><br>' + qdt.send_inst_name + '</strong><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.send_inst_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.send_inst_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.send_inst_email);
					$('.issu_date').html('').append(qdt.issu_date);
					$('.issu_time').html('').append(qdt.issu_time);
					$('.issu_description').html('').append(qdt.issu_description);
					$('.issu_custom_issueno').html('').append(qdt.issu_custom_issueno);
				});
			}, "json");
			$.post('controllers/issueController.php', {action: 'getAllIssueItem', istm_issue_id: issu_id}, function (issueItemJSON) {
				if (issueItemJSON === undefined || issueItemJSON.length === 0 || issueItemJSON === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="5" class="bg-danger text-center"> -- Issue items not available -- </td>';
					tbldata += '</tr>';					
				} else {
					$.each(issueItemJSON, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>' + index + '</td>';
						tbldata += '<td>' + qdt.itm_name + '(' + qdt.itm_code + ')</td>';
						tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
						tbldata += '<td>' + qdt.stk_qty + '</td>';
						tbldata += '<td>' + qdt.istm_qty + '</td>';
						//0 - not take action, 1 - full added, 2 - full return,3 - partially added & return
						if(parseInt(qdt.istm_status) == 0){
							tbldata += '<td>Action Not Taken</td>';
						}else if(parseInt(qdt.istm_status) == 1){
							tbldata += '<td>Fully Received</td>';
						}else if(parseInt(qdt.istm_status) == 2){
							tbldata += '<td>Fully Returned</td>';
						}else if(parseInt(qdt.istm_status) == 3){
							tbldata += '<td>Partially Received and rest returned back</td>';
						}
						tbldata += '</tr>';
					});
				}
				
				$('#tblIssueItem tbody').html('').append(tbldata);

			}, "json");
		}





		$(document).ready(function () {
			// Executes when the HTML document is loaded and the DOM is ready
			issueReceiptViewer();


		});
    </script>
</body>
</html>