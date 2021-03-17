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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-stroopwafel"></i> Item Attributes  &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-6 pb-4">
                        <form id="attributeform" novalidate>
                            <input type="hidden" class="form-control" id="at_id">
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
                                <div class="col-6">
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cmbAttributeType">Choose Attribute Type</label>
                                        <select class="col-12 form-control cmbAttributeType form-control-chosen" data-placeholder="Choose a attribute type..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose item attribute type
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="at_name">Attribute</label>
                                        <input type="text" class="form-control" id="at_name" placeholder="Attribute" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter attribute type
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="at_price">Valuation</label>
                                        <input type="text" class="form-control" id="at_price" placeholder="Valuation" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter valuation
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
                            <table id="tblAttribute" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>                                
                                        <th></th>                                
                                        <th>Attribute</th>                                        
                                        <th>Valuation</th>                                        
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
        function tblAttribute(at_attributetype, callback) {
            var tbldata = "";
            $.post('controllers/attributeController.php', {action: 'getAllAttribute', at_attributetype: at_attributetype}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="4" class="bg-danger text-center"> -- Attributes not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblAttribute tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.at_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.at_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.at_name + '</td>';
                        tbldata += '<td>' + qdt.at_price + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblAttribute')) {
                        //re initialize 
                        $('#tblAttribute').DataTable().destroy();
                        $('#tblAttribute tbody').empty();
                        $('#tblAttribute tbody').html('').append(tbldata);
                        $('#tblAttribute').DataTable({
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
                        $('#tblAttribute tbody').html('').append(tbldata);
                        $('#tblAttribute').DataTable({
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
                    var at_id = $(this).val();
                    $.post('controllers/attributeController.php', {action: 'getAttributeByID', at_id: at_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#at_id').val(qdt.at_id);
                            $('#at_name').val(qdt.at_name);
                            $('#at_price').val(qdt.at_price);
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var at_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this attribute ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/attributeController.php', {action: 'deleteAttribute', at_id: at_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearAttribute();
                                tblAttribute(at_attributetype);
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

        function saveAttribute() {
            var at_attributetype = $('.cmbAttributeType').val();
            var at_name = $('#at_name').val();
            var at_price = $('#at_price').val();
            var postdata = {
                action: "saveAttribute",
                at_name: at_name,
                at_attributetype: at_attributetype,
                at_price: at_price
            }
            $.post('controllers/attributeController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearAttribute();
                    tblAttribute(at_attributetype);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editAttribute() {
            var at_id = $('#at_id').val();
            var at_attributetype = $('.cmbAttributeType').val();
            var at_name = $('#at_name').val();
            var at_price = $('#at_price').val();
            var postdata = {
                action: "editAttribute",
                at_id: at_id,
                at_name: at_name,
                at_attributetype: at_attributetype,
                at_price: at_price
            }
            $.post('controllers/attributeController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good job!", e.msg, "success");
                    clearAttribute();
                    tblAttribute(at_attributetype);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearAttribute() {
            $('#at_id').val('');
            $('#at_name').val('');
            $('#at_price').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#attributeform').removeClass('was-validated');
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            cmbItemMainCategory(false, function () {
                var itm_maincategory = $('.cmbItemMainCategory').val();
                cmbItemSub1Category(itm_maincategory, false, function () {
                    var itm_sub1category = $('.cmbItemSub1Category').val();
                    cmbItemSub2Category(itm_sub1category, false, function () {
                        var itm_sub2category = $('.cmbItemSub2Category').val();
                        cmbItem(itm_sub2category, false, function () {
                            var attype_item = $('.cmbItem').val();
                            cmbAttributeType(attype_item, false, function (dataAvailable) {
                                //check items availability.for validate data entry part                         
                                if (parseInt(dataAvailable) == 0) {
                                    var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attribute types not available.choose at least one attribute type and try to add attributes</div>';
                                    $('.controlMsg').html('').append(controlMsg);
                                    $('.form-controllers-div').prop('hidden', true);
                                } else {
                                    $('.controlMsg').html('').append("");
                                    $('.form-controllers-div').prop('hidden', false);
                                }
                                //end of validation
                                var at_attributetype = $('.cmbAttributeType').val();
                                tblAttribute(at_attributetype);
                            });
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
                        cmbItem(itm_sub2category, false, function () {
                            var attype_item = $('.cmbItem').val();
                            cmbAttributeType(attype_item, false, function (dataAvailable) {
                                //check items availability.for validate data entry part                         
                                if (parseInt(dataAvailable) == 0) {
                                    var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attribute types not available.choose at least one attribute type and try to add attributes</div>';
                                    $('.controlMsg').html('').append(controlMsg);
                                    $('.form-controllers-div').prop('hidden', true);
                                } else {
                                    $('.controlMsg').html('').append("");
                                    $('.form-controllers-div').prop('hidden', false);
                                }
                                //end of validation
                                var at_attributetype = $('.cmbAttributeType').val();
                                tblAttribute(at_attributetype);
                            });
                        });
                    });
                });
            });

            $('.cmbItemSub1Category').change(function () {
                var itm_sub1category = $(this).val();
                cmbItemSub2Category(itm_sub1category, false, function () {
                    var itm_sub2category = $('.cmbItemSub2Category').val();
                    cmbItem(itm_sub2category, false, function () {
                        var attype_item = $('.cmbItem').val();
                        cmbAttributeType(attype_item, false, function (dataAvailable) {
                            //check items availability.for validate data entry part                         
                            if (parseInt(dataAvailable) == 0) {
                                var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attribute types not available.choose at least one attribute type and try to add attributes</div>';
                                $('.controlMsg').html('').append(controlMsg);
                                $('.form-controllers-div').prop('hidden', true);
                            } else {
                                $('.controlMsg').html('').append("");
                                $('.form-controllers-div').prop('hidden', false);
                            }
                            //end of validation
                            var at_attributetype = $('.cmbAttributeType').val();
                            tblAttribute(at_attributetype);
                        });
                    });
                });
            });

            $('.cmbItemSub2Category').change(function () {
                var itm_sub2category = $(this).val();
                cmbItem(itm_sub2category, false, function () {
                    var attype_item = $('.cmbItem').val();
                    cmbAttributeType(attype_item, false, function (dataAvailable) {
                        //check items availability.for validate data entry part                         
                        if (parseInt(dataAvailable) == 0) {
                            var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attribute types not available.choose at least one attribute type and try to add attributes</div>';
                            $('.controlMsg').html('').append(controlMsg);
                            $('.form-controllers-div').prop('hidden', true);
                        } else {
                            $('.controlMsg').html('').append("");
                            $('.form-controllers-div').prop('hidden', false);
                        }
                        //end of validation
                        var at_attributetype = $('.cmbAttributeType').val();
                        tblAttribute(at_attributetype);
                    });
                });
            });

            $('.cmbItem').change(function () {
                var attype_item = $(this).val();
                cmbAttributeType(attype_item, false, function (dataAvailable) {
                    //check items availability.for validate data entry part                         
                    if (parseInt(dataAvailable) == 0) {
                        var controlMsg = '<div class="alert bg-warning"><strong>NOTE</strong> Data saving restricted! becasue of attribute types not available.choose at least one attribute type and try to add attributes</div>';
                        $('.controlMsg').html('').append(controlMsg);
                        $('.form-controllers-div').prop('hidden', true);
                    } else {
                        $('.controlMsg').html('').append("");
                        $('.form-controllers-div').prop('hidden', false);
                    }
                    //end of validation
                    var at_attributetype = $('.cmbAttributeType').val();
                    tblAttribute(at_attributetype);
                });
            });

            $('.cmbAttributeType').change(function () {
                var at_attributetype = $(this).val();
                tblAttribute(at_attributetype);
            });

            const form = $('#attributeform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveAttribute();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editAttribute();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearAttribute();
            });

        });
    </script>
</body>
</html>