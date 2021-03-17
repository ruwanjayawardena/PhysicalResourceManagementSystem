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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-map-marked-alt"></i> Zonal  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6 pb-4">
                        <form id="zonalform" novalidate>
                            <input type="hidden" class="form-control" id="zol_id">
                            <div class="form-group">
                                <label for="cmbProvince">Choose Province</label>
                                <select class="col-12 form-control cmbProvince form-control-chosen" data-placeholder="Choose a province..." required>
                                    <option value="" disabled selected>Loading...</option>
                                </select>
                                <div class="valid-feedback">
                                    <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                </div>
                                <div class="invalid-feedback">
                                    <i class="fas fa-lg fa-exclamation-circle"></i> Please choose province
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zol_name">Zonal</label>
                                <input type="text" class="form-control" id="zol_name" placeholder="Zonal" autocomplete="off" required>
                                <div class="valid-feedback">
                                    <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                </div>
                                <div class="invalid-feedback">
                                    <i class="fas fa-lg fa-exclamation-circle"></i> Please enter zonal
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
                            <table id="tblZonal" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Zonal</th>                                        
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
        function tblZonal(zol_province, callback) {
            var tbldata = "";
            $.post('controllers/zonalController.php', {action: 'getAllZonal', zol_province: zol_province}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="3" class="bg-danger text-center"> -- Zonal not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblZonal tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.zol_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.zol_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.zol_name + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblZonal')) {
                        //re initialize 
                        $('#tblZonal').DataTable().destroy();
                        $('#tblZonal tbody').empty();
                        $('#tblZonal tbody').html('').append(tbldata);
                        $('#tblZonal').DataTable({
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
                        $('#tblZonal tbody').html('').append(tbldata);
                        $('#tblZonal').DataTable({
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
                    var zol_id = $(this).val();
                    $.post('controllers/zonalController.php', {action: 'getZonalByID', zol_id: zol_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#zol_id').val(qdt.zol_id);
                            $('#zol_name').val(qdt.zol_name);
                            cmbProvince(qdt.prov_id);
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var zol_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this zonal ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/zonalController.php', {action: 'deleteZonal', zol_id: zol_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearZonal();
                                tblZonal(zol_province);
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

        function saveZonal() {
            var zol_province = $('.cmbProvince').val();
            var zol_name = $('#zol_name').val();
            var postdata = {
                action: "saveZonal",
                zol_name: zol_name,
                zol_province: zol_province
            }
            $.post('controllers/zonalController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearZonal();
                    tblZonal(zol_province);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editZonal() {
            var zol_id = $('#zol_id').val();
            var zol_province = $('.cmbProvince').val();
            var zol_name = $('#zol_name').val();
            var postdata = {
                action: "editZonal",
                zol_id: zol_id,
                zol_name: zol_name,
                zol_province: zol_province
            }
            $.post('controllers/zonalController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearZonal();
                    tblZonal(zol_province);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearZonal() {
            $('#zol_id').val('');
            $('#zol_name').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#zonalform').removeClass('was-validated');
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            cmbProvince(false, function () {
                var zol_province = $('.cmbProvince').val();
                tblZonal(zol_province);
            });

            $('.cmbProvince').change(function () {
                var zol_province = $(this).val();
                tblZonal(zol_province);
            });

            const form = $('#zonalform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveZonal();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editZonal();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearZonal();
            });


        });
    </script>
</body>
</html>