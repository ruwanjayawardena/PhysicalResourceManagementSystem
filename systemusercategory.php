<?php include './access_control/systemadmin_auth.php'; ?> 
<!doctype html>
<html lang="en">
    <head>
        <?php include './includes/head-block.php'; ?>        
    </head>
    <body>
        <!--navbar-->
        <?php include 'includes/backend-navbar.php'; ?> 
        <input type="hidden" id="usrcat_institute" value="<?php
        if (isset($_SESSION) && !empty($_SESSION['usrcat_institute'])) {
            echo $_SESSION['usrcat_institute'];
        }
        ?>">
               <?php
//        Array ( [usr_id] => 3 [usr_name] => test2 [usr_username] => test2 [usr_usercategory] => 2 [inst_division] => 1 [inst_zonal] => 1 [inst_province] => 1 [inst_institutetype] => 1 [inst_selection_key] => 3 [usrcat_institute] => 1 [usr_is_superadmin] => 0 ) 1        
               ?>
        <!--body content-->
        <section class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-user-circle"></i> User Category &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-12 col-xs-12 pb-4">
                        <form id="usercategoryform" novalidate>
                            <input type="hidden" class="form-control" id="usrcat_id">                           

                            <div class="form-row">                               

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usrcat_name">User Category</label>
                                        <input type="tel" class="form-control" id="usrcat_name" placeholder="Category Name" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter category name
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
                            <table id="tblUserCategory" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>                                
                                        <th></th>                                
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
        function tblUserCategory(callback) {
            var usrcat_institute = $('#usrcat_institute').val();
            var tbldata = "";
            $.post('controllers/userCategoryController.php', {action: 'getAllUserCategory', usrcat_institute: usrcat_institute}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="3" class="bg-danger text-center"> -- User category not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblUserCategory tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.usrcat_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.usrcat_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '&nbsp;&nbsp;<button class="btn btn-sm btn-dark btn-assignprvg" value="' + qdt.usrcat_id + '"><i class="fas fa-cog"></i> Assign Privileges</button>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.usrcat_name + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblUserCategory')) {
                        //re initialize 
                        $('#tblUserCategory').DataTable().destroy();
                        $('#tblUserCategory tbody').empty();
                        $('#tblUserCategory tbody').html('').append(tbldata);
                        $('#tblUserCategory').DataTable({
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
                        $('#tblUserCategory tbody').html('').append(tbldata);
                        $('#tblUserCategory').DataTable({
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


                $('.btn-assignprvg').click(function () {
                    var usrcat_id = $(this).val();
                    window.location.href = "assignprivilege_institute.php?usrcat_id=" + usrcat_id;
                });



                $('.btn_select').click(function () {
                    $('#btn_save').prop('hidden', true);
                    $('#btn_edit').prop('hidden', false);
                    var usrcat_id = $(this).val();
                    $.post('controllers/userCategoryController.php', {action: 'getUserCategoryByID', usrcat_id: usrcat_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#usrcat_id').val(qdt.usrcat_id);
                            $('#usrcat_name').val(qdt.usrcat_name);
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var usrcat_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this user category ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/userCategoryController.php', {action: 'deleteUserCategory', usrcat_id: usrcat_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearUserCategory();
                                tblUserCategory();
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

        function saveUserCategory() {
            var usrcat_name = $('#usrcat_name').val();
            var usrcat_institute = $('#usrcat_institute').val();
            var postdata = {
                action: "saveUserCategory",
                usrcat_name: usrcat_name,
                usrcat_institute: usrcat_institute
            }
            $.post('controllers/userCategoryController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good Job!", e.msg, "success");
                    clearUserCategory();
                    tblUserCategory();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editUserCategory() {
            var usrcat_id = $('#usrcat_id').val();
            var usrcat_name = $('#usrcat_name').val();
            var usrcat_institute = $('#usrcat_institute').val();
            var postdata = {
                action: "editUserCategory",
                usrcat_name: usrcat_name,
                usrcat_institute: usrcat_institute,
                usrcat_id: usrcat_id
            }
            $.post('controllers/userCategoryController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good Job!", e.msg, "success");
                    clearUserCategory();
                    tblUserCategory();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearUserCategory() {
            $('#usrcat_id').val('');
            $('#usrcat_name').val('');
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#usercategoryform').removeClass('was-validated');
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            tblUserCategory();
            const form = $('#usercategoryform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveUserCategory();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editUserCategory();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearUserCategory();
            });


        });
    </script>
</body>
</html>