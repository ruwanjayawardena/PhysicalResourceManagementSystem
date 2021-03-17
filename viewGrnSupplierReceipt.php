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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-file"></i> GRN Receipt <small>Receive By Supplier</small>  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back()"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button>&nbsp;<button class="btn btn-primary d-print-none" onclick="window.print()"><i class="fas fa-print"></i>>&nbsp;Print</button></h4></div>
					<input type="hidden" class="form-control" id="grn_id" value="<?php
					if (isset($_REQUEST['grn_id']) && !empty($_REQUEST['grn_id'])) {
						echo $_REQUEST['grn_id'];
					}
					?>">
                </div>
                <div class="row"> 
					<div class="col-6">
						<table class="table">							
							<tr>
								<th>GRN No</th>
								<td><span class="grn_custom_no"></span></td>
							</tr>
							<tr>
								<th>Date</th>
								<td><span class="grn_date"></span> | <span class="grn_time"></span></td>
							</tr>							
						</table>
					</div>
                    <div class="col-6">
						<table class="table table-bordered">
							<tr>
								<th>Supplier</th>
								<td><span class="grn_supplier_desc"></span></td>
							</tr>							
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
									<th></th>
									<th>Item</th>
									<th>Attribute - Valuation</th>                                       
									<th>GRN Qty</th>                                        
									<th>Unit Price</th>                                       
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
			var tbldata = "";
			$.post('controllers/grnController.php', {action: 'getGrnSupplierByID', grn_id: grn_id}, function (grnJSON) {
				$.each(grnJSON, function (index, qdt) {				
				
					$('.grn_supplier_desc').html('').append('<strong>' + qdt.sup_name + '</strong><br><abbr title="Address"><i class="fas fa-thumbtack"></i></abbr> ' + qdt.sup_address + '<br><abbr title="Phone"><i class="fas fa-phone-square"></i></abbr> ' + qdt.sup_phone + '<br><abbr title="Email"><i class="fas fa-envelope-square"></i></abbr> ' + qdt.sup_email);
					$('.grn_date').html('').append(qdt.grn_date);
					$('.grn_time').html('').append(qdt.grn_time);
					$('.grn_description').html('').append(qdt.grn_description);
					$('.grn_custom_no').html('').append(qdt.grn_custom_no);
				});
			}, "json");
			$.post('controllers/grnController.php', {action: 'getAllGrnItemSupplier', grtm_grn_id: grn_id}, function (grnItemJSON) {
				if (grnItemJSON === undefined || grnItemJSON.length === 0 || grnItemJSON === null) {
					tbldata += '<tr>';
					tbldata += '<td colspan="5" class="bg-danger text-center"> -- Grn items not available -- </td>';
					tbldata += '</tr>';
				} else {
					$.each(grnItemJSON, function (index, qdt) {
						index++;
						tbldata += '<tr>';
						tbldata += '<td>' + index + '</td>';
						tbldata += '<td>' + qdt.itm_name + '(' + qdt.itm_code + ')</td>';
						tbldata += '<td>' + qdt.at_name + ' - Rs.' + qdt.at_price + '</td>';
						tbldata += '<td>' + qdt.grtm_qty + '</td>';
						tbldata += '<td>Rs.' + qdt.grtm_unitprice + '</td>';
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


		});
    </script>
</body>
</html>