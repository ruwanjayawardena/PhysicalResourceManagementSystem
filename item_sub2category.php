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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-sitemap"></i> Item 2<sup>nd</sup> Sub Category  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-12 pb-4">
                        <form id="categoryform" novalidate>
                            <input type="hidden" class="form-control" id="s2cat_id">
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
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="cmbItemSub1Category">Choose 1<sup>st</sup> Sub Category</label>
                                        <select class="col-12 form-control cmbItemSub1Category form-control-chosen" data-placeholder="Choose a 1st sub category..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose item 1st sub category
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">                                
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="s2cat_code">Code</label>
                                        <input type="text" class="form-control" id="s2cat_code" placeholder="Code" autocomplete="off" required>
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
                                        <label for="s2cat_name">Name</label>
                                        <input type="text" class="form-control" id="s2cat_name" placeholder="Name" autocomplete="off" required>
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
                            <table id="tblItemSub2Category" class="table table-bordered table-hover" style="width:100%">
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
        function tblItemSub2Category(s2cat_subcategory, callback) {
            var tbldata = "";
            $.post('controllers/itemSub2CategoryController.php', {action: 'getAllItemSub2Category', s2cat_subcategory: s2cat_subcategory}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="4" class="bg-danger text-center"> -- Item sub category not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblItemSub2Category tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.s2cat_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.s2cat_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.s2cat_code + '</td>';
                        tbldata += '<td>' + qdt.s2cat_name + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblItemSub2Category')) {
                        //re initialize 
                        $('#tblItemSub2Category').DataTable().destroy();
                        $('#tblItemSub2Category tbody').empty();
                        $('#tblItemSub2Category tbody').html('').append(tbldata);
                        $('#tblItemSub2Category').DataTable({
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
                        $('#tblItemSub2Category tbody').html('').append(tbldata);
                        $('#tblItemSub2Category').DataTable({
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
                    var s2cat_id = $(this).val();
                    $.post('controllers/itemSub2CategoryController.php', {action: 'getItemSub2CategoryByID', s2cat_id: s2cat_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#s2cat_id').val(qdt.s2cat_id);
                            $('#s2cat_code').val(qdt.s2cat_code);
                            $('#s2cat_name').val(qdt.s2cat_name);
                            cmbItemMainCategory(qdt.scat_maincategory, function () {
                                cmbItemSub1Category(qdt.scat_maincategory, qdt.s2cat_subcategory);
                            });
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var s2cat_id = $(this).val();
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
                        $.post('controllers/itemSub2CategoryController.php', {action: 'deleteItemSub2Category', s2cat_id: s2cat_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearItemSub2Category();
                                tblItemSub2Category(s2cat_subcategory);
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

        function saveItemSub2Category() {
            var s2cat_subcategory = $('.cmbItemSub1Category').val();
            var s2cat_code = $('#s2cat_code').val();
            var s2cat_name = $('#s2cat_name').val();
            var postdata = {
                action: "saveItemSub2Category",
                s2cat_code: s2cat_code,
                s2cat_subcategory: s2cat_subcategory,
                s2cat_name: s2cat_name
            }
            $.post('controllers/itemSub2CategoryController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearItemSub2Category();
                    tblItemSub2Category(s2cat_subcategory);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editItemSub2Category() {
            var s2cat_id = $('#s2cat_id').val();
            var s2cat_subcategory = $('.cmbItemSub1Category').val();
            var s2cat_code = $('#s2cat_code').val();
            var s2cat_name = $('#s2cat_name').val();
            var postdata = {
                action: "editItemSub2Category",
                s2cat_id: s2cat_id,
                s2cat_code: s2cat_code,
                s2cat_subcategory: s2cat_subcategory,
                s2cat_name: s2cat_name
            }
            $.post('controllers/itemSub2CategoryController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearItemSub2Category();
                    tblItemSub2Category(s2cat_subcategory);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearItemSub2Category() {
            $('#s2cat_id').val('');
            $('#s2cat_code').val('');
            $('#s2cat_name').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#categoryform').removeClass('was-validated');
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            cmbItemMainCategory(false, function () {
                var scat_maincategory = $('.cmbItemMainCategory').val();
                cmbItemSub1Category(scat_maincategory, false, function () {
                    var s2cat_subcategory = $('.cmbItemSub1Category').val();
                    tblItemSub2Category(s2cat_subcategory);
                })
            });

            $('.cmbItemMainCategory').change(function () {
                var scat_maincategory = $(this).val();
                cmbItemSub1Category(scat_maincategory, false, function () {
                    var s2cat_subcategory = $('.cmbItemSub1Category').val();
                    tblItemSub2Category(s2cat_subcategory);
                })
            });

            $('.cmbItemSub1Category').change(function () {
                var s2cat_subcategory = $(this).val();
                tblItemSub2Category(s2cat_subcategory);
            });

            const form = $('#categoryform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveItemSub2Category();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editItemSub2Category();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearItemSub2Category();
            });


        });
    </script>
</body>
</html>