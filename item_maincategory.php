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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-sitemap"></i> Item Main Category  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-12 pb-4">
                        <form id="categoryform" novalidate>
                            <input type="hidden" class="form-control" id="mcat_id">
                            <div class="form-row">                                
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="mcat_code">Code</label>
                                        <input type="text" class="form-control" id="mcat_code" placeholder="Code" autocomplete="off" required>
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
                                        <label for="mcat_name">Name</label>
                                        <input type="text" class="form-control" id="mcat_name" placeholder="Name" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter category name
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
                            <table id="tblItemMainCategory" class="table table-bordered table-hover" style="width:100%">
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
        function tblItemMainCategory(callback) {
            var tbldata = "";
            $.post('controllers/itemMainCategoryController.php', {action: 'getAllItemMainCategory'}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="4" class="bg-danger text-center"> -- Item main category not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblItemMainCategory tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.mcat_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.mcat_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.mcat_code + '</td>';
                        tbldata += '<td>' + qdt.mcat_name + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblItemMainCategory')) {
                        //re initialize 
                        $('#tblItemMainCategory').DataTable().destroy();
                        $('#tblItemMainCategory tbody').empty();
                        $('#tblItemMainCategory tbody').html('').append(tbldata);
                        $('#tblItemMainCategory').DataTable({
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
                        $('#tblItemMainCategory tbody').html('').append(tbldata);
                        $('#tblItemMainCategory').DataTable({
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
                    var mcat_id = $(this).val();
                    $.post('controllers/itemMainCategoryController.php', {action: 'getItemMainCategoryByID', mcat_id: mcat_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#mcat_id').val(qdt.mcat_id);
                            $('#mcat_code').val(qdt.mcat_code);
                            $('#mcat_name').val(qdt.mcat_name);
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var mcat_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this main category ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/itemMainCategoryController.php', {action: 'deleteItemMainCategory', mcat_id: mcat_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearItemMainCategory();
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

        function saveItemMainCategory() {
            var mcat_code = $('#mcat_code').val();
            var mcat_name = $('#mcat_name').val();
            var postdata = {
                action: "saveItemMainCategory",
                mcat_code: mcat_code,
                mcat_name: mcat_name
            }
            $.post('controllers/itemMainCategoryController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearItemMainCategory();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editItemMainCategory() {
            var mcat_id = $('#mcat_id').val();
            var mcat_code = $('#mcat_code').val();
            var mcat_name = $('#mcat_name').val();
            var postdata = {
                action: "editItemMainCategory",
                mcat_id: mcat_id,
                mcat_code: mcat_code,
                mcat_name: mcat_name
            }
            $.post('controllers/itemMainCategoryController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearItemMainCategory();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearItemMainCategory() {
            $('#mcat_id').val('');
            $('#mcat_code').val('');
            $('#mcat_name').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#categoryform').removeClass('was-validated');
            tblItemMainCategory();
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            tblItemMainCategory();
            const form = $('#categoryform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveItemMainCategory();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editItemMainCategory();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearItemMainCategory();
            });


        });
    </script>
</body>
</html>