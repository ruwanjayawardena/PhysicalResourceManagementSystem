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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-sitemap"></i> Item &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-12 pb-4">
                        <form id="categoryform" novalidate>
                            <input type="hidden" class="form-control" id="itm_id">
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
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="cmbItemSub2Category">Choose 2<sup>nd</sup> Sub Category</label>
                                        <select class="col-12 form-control cmbItemSub2Category form-control-chosen" data-placeholder="Choose a 2nd sub category..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose item 2st sub category
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row"> 
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="inst_name">Assign Under</label>
                                        <div class="form-check">
                                            <input class="form-check-input itm_selection_key" type="radio" name="itm_selection_key" id="itm_selection_key1" value="3" checked>
                                            <label class="form-check-label" for="itm_selection_key3">
                                                2<sup>nd</sup> Sub Category
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input itm_selection_key" type="radio" name="itm_selection_key" id="itm_selection_key2" value="2">
                                            <label class="form-check-label" for="itm_selection_key2">
                                                1<sup>st</sup> Sub Category
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input itm_selection_key" type="radio" name="itm_selection_key" id="itm_selection_key1" value="1">
                                            <label class="form-check-label" for="itm_selection_key1">
                                                Main Category
                                            </label>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="itm_code">Code</label>
                                        <input type="text" class="form-control" id="itm_code" placeholder="Code" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter item code
                                        </div>
                                    </div>                           
                                </div>
                            </div>
                            <div class="form-row">     
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="itm_name">Name</label>
                                        <input type="text" class="form-control" id="itm_name" placeholder="Name" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter item name
                                        </div>
                                    </div> 
                                </div>
                            </div>                           
                            <div class="form-group form-controllers-div">
                                <button class="btn btn-success" id="btn_save"><i class="fas fa-save"></i> Save</button>
                                <button class="btn btn-warning" id="btn_edit" hidden><i class="fas fa-edit"></i> Update</button>
                                <button class="btn btn-light" id="btn_clear"><i class="fas fa-undo"></i> Clear</button>
                            </div>
                            <div class="form-group controlMsg"></div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tblItem" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>                                                       

                                        <th></th>                                
                                        <th></th>                                
                                        <th>Code</th>                                        
                                        <th>Item</th>                                        
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
        function tblItem(itm_sub2category, callback) {
            var tbldata = "";
            $.post('controllers/itemController.php', {action: 'getAllItem', itm_sub2category: itm_sub2category}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="4" class="bg-danger text-center"> -- Items not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblItem tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.itm_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.itm_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.itm_code + '</td>';
                        tbldata += '<td>' + qdt.itm_name + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblItem')) {
                        //re initialize 
                        $('#tblItem').DataTable().destroy();
                        $('#tblItem tbody').empty();
                        $('#tblItem tbody').html('').append(tbldata);
                        $('#tblItem').DataTable({
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
                        $('#tblItem tbody').html('').append(tbldata);
                        $('#tblItem').DataTable({
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
                    var itm_id = $(this).val();
                    $.post('controllers/itemController.php', {action: 'getItemByID', itm_id: itm_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#itm_id').val(qdt.itm_id);
                            $('#itm_code').val(qdt.itm_code);
                            $('#itm_name').val(qdt.itm_name);
                            $('.itm_selection_key[value=' + qdt.itm_selection_key + ']').prop('checked', true);
                            cmbItemMainCategory(qdt.itm_maincategory, function () {
                                cmbItemSub1Category(qdt.itm_maincategory, qdt.itm_sub1category, function () {
                                    cmbItemSub2Category(qdt.itm_sub1category, qdt.itm_sub2category);
                                });
                            });
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var itm_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this item ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/itemController.php', {action: 'deleteItem', itm_id: itm_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearItem();
                                tblItem(itm_sub2category);
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

        function saveItem() {
            var itm_code = $('#itm_code').val();
            var itm_name = $('#itm_name').val();
            var itm_selection_key = $('.itm_selection_key:checked').val();
            var itm_maincategory = $('.cmbItemMainCategory').val();
            var itm_sub1category = $('.cmbItemSub1Category').val();
            var itm_sub2category = $('.cmbItemSub2Category').val();
            var postdata = {
                action: "saveItem",
                itm_code: itm_code,
                itm_sub2category: itm_sub2category,
                itm_name: itm_name,
                itm_selection_key: itm_selection_key,
                itm_maincategory: itm_maincategory,
                itm_sub1category: itm_sub1category,
                itm_sub2category: itm_sub2category
            }
            $.post('controllers/itemController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearItem();
                    tblItem(itm_sub2category);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editItem() {
            var itm_id = $('#itm_id').val();
            var itm_code = $('#itm_code').val();
            var itm_name = $('#itm_name').val();
            var itm_selection_key = $('.itm_selection_key:checked').val();
            var itm_maincategory = $('.cmbItemMainCategory').val();
            var itm_sub1category = $('.cmbItemSub1Category').val();
            var itm_sub2category = $('.cmbItemSub2Category').val();
            var postdata = {
                action: "editItem",
                itm_id: itm_id,
                itm_code: itm_code,
                itm_sub2category: itm_sub2category,
                itm_name: itm_name,
                itm_selection_key: itm_selection_key,
                itm_maincategory: itm_maincategory,
                itm_sub1category: itm_sub1category,
                itm_sub2category: itm_sub2category
            }
            $.post('controllers/itemController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearItem();
                    tblItem(itm_sub2category);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearItem() {
            $('#itm_id').val('');
            $('#itm_code').val('');
            $('#itm_name').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#categoryform').removeClass('was-validated');
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            cmbItemMainCategory(false, function () {
                var itm_maincategory = $('.cmbItemMainCategory').val();
                cmbItemSub1Category(itm_maincategory, false, function () {
                    var itm_sub1category = $('.cmbItemSub1Category').val();
                    cmbItemSub2Category(itm_sub1category, false, function (dataAvailable) {
                        //check items availability.for validate data entry part                         
                        if (parseInt(dataAvailable) == 0) {
                            var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item 2nd sub categories not available.add at least one category for it and try to add new items</div>';
                            $('.controlMsg').html('').append(controlMsg);
                            $('.form-controllers-div').prop('hidden', true);
                        } else {
                            $('.controlMsg').html('').append("");
                            $('.form-controllers-div').prop('hidden', false);
                        }
                        //end of validation
                        var itm_sub2category = $('.cmbItemSub2Category').val();
                        tblItem(itm_sub2category);
                    });
                });
            });


            $('.cmbItemMainCategory').change(function () {
                var itm_maincategory = $(this).val();
                cmbItemSub1Category(itm_maincategory, false, function () {
                    var itm_sub1category = $('.cmbItemSub1Category').val();
                    cmbItemSub2Category(itm_sub1category, false, function (dataAvailable) {
                        //check items availability.for validate data entry part                         
                        if (parseInt(dataAvailable) == 0) {
                            var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item 2nd sub categories not available.add at least one category for it and try to add new items</div>';
                            $('.controlMsg').html('').append(controlMsg);
                            $('.form-controllers-div').prop('hidden', true);
                        } else {
                            $('.controlMsg').html('').append("");
                            $('.form-controllers-div').prop('hidden', false);
                        }
                        //end of validation
                        var itm_sub2category = $('.cmbItemSub2Category').val();
                        tblItem(itm_sub2category);
                    });
                });
            });

            $('.cmbItemSub1Category').change(function () {
                var itm_sub1category = $(this).val();
                cmbItemSub2Category(itm_sub1category, false, function (dataAvailable) {
                    //check items availability.for validate data entry part                         
                    if (parseInt(dataAvailable) == 0) {
                        var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of item 2nd sub categories not available.add at least one category for it and try to add new items</div>';
                        $('.controlMsg').html('').append(controlMsg);
                        $('.form-controllers-div').prop('hidden', true);
                    } else {
                        $('.controlMsg').html('').append("");
                        $('.form-controllers-div').prop('hidden', false);
                    }
                    //end of validation
                    var itm_sub2category = $('.cmbItemSub2Category').val();
                    tblItem(itm_sub2category);
                });
            });

            $('.cmbItemSub2Category').change(function () {
                var itm_sub2category = $(this).val();
                tblItem(itm_sub2category);
            });

            const form = $('#categoryform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveItem();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editItem();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearItem();
            });


        });
    </script>
</body>
</html>