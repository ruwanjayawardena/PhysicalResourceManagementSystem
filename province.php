<?php include './access_control/session_controler.php';  ?> 
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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-map-marked-alt"></i> Province  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6 pb-4">
                        <form id="provinceform" novalidate>
                            <input type="hidden" class="form-control" id="prov_id">
                            <div class="form-group">
                                <label for="prov_name">Province</label>
                                <input type="text" class="form-control" id="prov_name" placeholder="Province" autocomplete="off" required>
                                <div class="valid-feedback">
                                    <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                </div>
                                <div class="invalid-feedback">
                                    <i class="fas fa-lg fa-exclamation-circle"></i> Please enter province
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
                            <table id="tblProvince" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Province</th>                                        
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
        function tblProvince(callback) {
            var tbldata = "";
            $.post('controllers/provinceController.php', {action: 'getAllProvince'}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="3" class="bg-danger text-center"> -- Province not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblProvince tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.prov_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.prov_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.prov_name + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblProvince')) {
                        //re initialize 
                        $('#tblProvince').DataTable().destroy();
                        $('#tblProvince tbody').empty();
                        $('#tblProvince tbody').html('').append(tbldata);
                        $('#tblProvince').DataTable({
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
                        $('#tblProvince tbody').html('').append(tbldata);
                        $('#tblProvince').DataTable({
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
                    var prov_id = $(this).val();
                    $.post('controllers/provinceController.php', {action: 'getProvinceByID', prov_id: prov_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#prov_id').val(qdt.prov_id);
                            $('#prov_name').val(qdt.prov_name);
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var prov_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this province ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/provinceController.php', {action: 'deleteProvince', prov_id: prov_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearProvince();
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

        function saveProvince() {
            var prov_name = $('#prov_name').val();
            var postdata = {
                action: "saveProvince",
                prov_name: prov_name
            }
            $.post('controllers/provinceController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearProvince();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editProvince() {
            var prov_id = $('#prov_id').val();
            var prov_name = $('#prov_name').val();
            var postdata = {
                action: "editProvince",
                prov_id: prov_id,
                prov_name: prov_name
            }
            $.post('controllers/provinceController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearProvince();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearProvince() {
            $('#prov_id').val('');
            $('#prov_name').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#provinceform').removeClass('was-validated');
            tblProvince();
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            tblProvince();
            const form = $('#provinceform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveProvince();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editProvince();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearProvince();
            });


        });
    </script>
</body>
</html>