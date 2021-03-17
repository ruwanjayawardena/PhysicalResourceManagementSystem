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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-stroopwafel"></i> Item Attribute Type  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6 pb-4">
                        <form id="attributetypeform" novalidate>
                            <input type="hidden" class="form-control" id="attype_id">
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
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="cmbItem">Choose Item</label>
                                        <select class="col-12 form-control cmbItem form-control-chosen" data-placeholder="Choose a item..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose item
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="attype_name">Attribute Type</label>
                                        <input type="text" class="form-control" id="attype_name" placeholder="AttributeType" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter attribute type
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
                            <table id="tblAttributeType" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>                                
                                        <th></th>                                
                                        <th>Attribute Type</th>                                        
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
        function tblAttributeType(attype_item, callback) {
            var tbldata = "";
            $.post('controllers/attributeTypeController.php', {action: 'getAllAttributeType', attype_item: attype_item}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="3" class="bg-danger text-center"> -- Attribute types not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblAttributeType tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.attype_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.attype_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.attype_name + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblAttributeType')) {
                        //re initialize 
                        $('#tblAttributeType').DataTable().destroy();
                        $('#tblAttributeType tbody').empty();
                        $('#tblAttributeType tbody').html('').append(tbldata);
                        $('#tblAttributeType').DataTable({
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
                        $('#tblAttributeType tbody').html('').append(tbldata);
                        $('#tblAttributeType').DataTable({
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
                    var attype_id = $(this).val();
                    $.post('controllers/attributeTypeController.php', {action: 'getAttributeTypeByID', attype_id: attype_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#attype_id').val(qdt.attype_id);
                            $('#attype_name').val(qdt.attype_name);
                            cmbItem(qdt.attype_item);
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var attype_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this attribute type ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/attributeTypeController.php', {action: 'deleteAttributeType', attype_id: attype_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearAttributeType();
                                tblAttributeType(attype_item);
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

        function saveAttributeType() {
            var attype_item = $('.cmbItem').val();
            var attype_name = $('#attype_name').val();
            var postdata = {
                action: "saveAttributeType",
                attype_name: attype_name,
                attype_item: attype_item
            }
            $.post('controllers/attributeTypeController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearAttributeType();
                    tblAttributeType(attype_item);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editAttributeType() {
            var attype_id = $('#attype_id').val();
            var attype_item = $('.cmbItem').val();
            var attype_name = $('#attype_name').val();
            var postdata = {
                action: "editAttributeType",
                attype_id: attype_id,
                attype_name: attype_name,
                attype_item: attype_item
            }
            $.post('controllers/attributeTypeController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearAttributeType();
                    tblAttributeType(attype_item);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearAttributeType() {
            $('#attype_id').val('');
            $('#attype_name').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#attributetypeform').removeClass('was-validated');
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            cmbItemMainCategory(false, function () {
                var itm_maincategory = $('.cmbItemMainCategory').val();
                cmbItemSub1Category(itm_maincategory, false, function () {
                    var itm_sub1category = $('.cmbItemSub1Category').val();
                    cmbItemSub2Category(itm_sub1category, false, function () {
                        var itm_sub2category = $('.cmbItemSub2Category').val();
                        cmbItem(itm_sub2category, false, function (dataAvailable) {
                            //check items availability.for validate data entry part                         
                            if (parseInt(dataAvailable) == 0) {
                                var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of items not available.choose another category or add item under categories</div>';
                                $('.controlMsg').html('').append(controlMsg);
                                $('.form-controllers-div').prop('hidden', true);
                            } else {
                                $('.controlMsg').html('').append("");
                                $('.form-controllers-div').prop('hidden', false);
                            }
                            //end of validation
                            var attype_item = $('.cmbItem').val();
                            tblAttributeType(attype_item);
                        });
                    });
                });
            });

            $('.cmbItemMainCategory').change(function () {
                var itm_maincategory = $(this).val();
                cmbItemSub1Category(itm_maincategory, false, function () {
                    var itm_sub1category = $('.cmbItemSub1Category').val();
                    cmbItemSub2Category(itm_sub1category, false, function () {
                        var itm_sub2category = $('.cmbItemSub2Category').val();
                        cmbItem(itm_sub2category, false, function (dataAvailable) {
                            //check items availability.for validate data entry part                         
                            if (parseInt(dataAvailable) == 0) {
                                var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of items not available.choose another category or add item under categories</div>';
                                $('.controlMsg').html('').append(controlMsg);
                                $('.form-controllers-div').prop('hidden', true);
                            } else {
                                $('.controlMsg').html('').append("");
                                $('.form-controllers-div').prop('hidden', false);
                            }
                            //end of validation
                            var attype_item = $('.cmbItem').val();
                            tblAttributeType(attype_item);
                        });
                    });
                });
            });

            $('.cmbItemSub1Category').change(function () {
                var itm_sub1category = $(this).val();
                cmbItemSub2Category(itm_sub1category, false, function () {
                    var itm_sub2category = $('.cmbItemSub2Category').val();
                    cmbItem(itm_sub2category, false, function (dataAvailable) {
                        //check items availability.for validate data entry part                         
                        if (parseInt(dataAvailable) == 0) {
                            var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of items not available.choose another category or add item under categories</div>';
                            $('.controlMsg').html('').append(controlMsg);
                            $('.form-controllers-div').prop('hidden', true);
                        } else {
                            $('.controlMsg').html('').append("");
                            $('.form-controllers-div').prop('hidden', false);
                        }
                        //end of validation
                        var attype_item = $('.cmbItem').val();
                        tblAttributeType(attype_item);
                    });
                });
            });

            $('.cmbItemSub2Category').change(function () {
                var itm_sub2category = $(this).val();
                cmbItem(itm_sub2category, false, function (dataAvailable) {
                    //check items availability.for validate data entry part                         
                    if (parseInt(dataAvailable) == 0) {
                        var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of items not available.choose another category or add item under categories</div>';
                        $('.controlMsg').html('').append(controlMsg);
                        $('.form-controllers-div').prop('hidden', true);
                    } else {
                        $('.controlMsg').html('').append("");
                        $('.form-controllers-div').prop('hidden', false);
                    }
                    //end of validation
                    var attype_item = $('.cmbItem').val();
                    tblAttributeType(attype_item);
                });
            });

            $('.cmbItem').change(function () {
                var attype_item = $(this).val();
                tblAttributeType(attype_item);
            });

            const form = $('#attributetypeform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveAttributeType();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editAttributeType();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearAttributeType();
            });


        });
    </script>
</body>
</html>