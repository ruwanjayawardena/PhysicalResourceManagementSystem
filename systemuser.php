<?php include './access_control/systemadmin_auth.php'; ?> 
<!doctype html>
<html lang="en">
    <head>
        <?php include './includes/head-block.php'; ?>        
    </head>
    <body>
        <!--navbar-->
        <?php include 'includes/backend-navbar.php'; ?>       
        <input type="hidden" id="usr_usercategory" value="<?php
        if (isset($_SESSION) && !empty($_SESSION['usr_usercategory'])) {
            echo $_SESSION['usr_usercategory'];
        }
        ?>">
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
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-user"></i> User &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="goDashboard();"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-12 col-xs-12 pb-4">
                        <form id="userform" novalidate>
                            <input type="hidden" class="form-control" id="usr_id">
                            <div class="form-row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cmbUserCategory">Choose User Category</label>
                                        <select class="col-12 form-control cmbUserCategory form-control-chosen" data-placeholder="Choose a user category..." required>
                                            <option value="" disabled selected>Loading...</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please choose user category
                                        </div>
                                    </div>  
                                </div> 
                            </div>
                            <div class="form-row">                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usr_name">Name</label>
                                        <input type="text" class="form-control" id="usr_name" placeholder="Name" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter full name
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usr_phone">Phone</label>
                                        <input type="text" class="form-control" id="usr_phone" placeholder="Phone" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter Phone
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="form-row">                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usr_nic">NIC Number</label>
                                        <input type="text" class="form-control" id="usr_nic" placeholder="NIC" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter NIC Number
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usr_designation">Designation</label>
                                        <input type="text" class="form-control" id="usr_designation" placeholder="Designation" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter Designation
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="form-row">                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usr_email">Email</label>
                                        <input type="email" class="form-control" id="usr_email" placeholder="Email" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter email
                                        </div>
                                    </div>  
                                </div>

                            </div>
                            <div class="form-row">                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usr_username">Username</label>
                                        <input type="text" class="form-control" id="usr_username" placeholder="Username" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter username
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usr_password">Password</label>
                                        <input type="text" class="form-control" id="usr_password" placeholder="Password" autocomplete="off" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-lg fa-exclamation-circle"></i> Please enter password
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
                            <table id="tblUser" class="table table-bordered table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>                                
                                        <th></th>                                
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>NIC</th>
                                        <th>Designation</th>
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
        function tblUser(usr_usercategory,callback) {            
            var tbldata = "";
            $.post('controllers/userController.php', {action: 'getAllUser', usr_usercategory: usr_usercategory}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    tbldata += '<tr>';
                    tbldata += '<td colspan="8" class="bg-danger text-center"> -- Users not available -- </td>';
                    tbldata += '</tr>';
                    $('#tblUser tbody').html('').append(tbldata);
                } else {
                    $.each(e, function (index, qdt) {
                        index++;
                        tbldata += '<tr>';
                        tbldata += '<td>';
                        tbldata += '<div class="btn-group btn-group-sm">';
                        tbldata += '<button class="btn btn-info btn_select" value="' + qdt.usr_id + '"><i class="fas fa-edit"></i></button>';
                        tbldata += '<button class="btn btn-danger btn_delete" value="' + qdt.usr_id + '"><i class="fas fa-trash-alt"></i></button>';
                        tbldata += '</div>';
                        tbldata += '</td>';
                        tbldata += '<td></td>';
                        tbldata += '<td>' + qdt.usr_name + '</td>';
                        tbldata += '<td>' + qdt.usr_username + '</td>';
                        tbldata += '<td>' + qdt.usr_email + '</td>';
                        tbldata += '<td>' + qdt.usr_phone + '</td>';
                        tbldata += '<td>' + qdt.usr_nic + '</td>';
                        tbldata += '<td>' + qdt.usr_designation + '</td>';
                        tbldata += '</tr>';
                    });


                    if ($.fn.DataTable.isDataTable('#tblUser')) {
                        //re initialize 
                        $('#tblUser').DataTable().destroy();
                        $('#tblUser tbody').empty();
                        $('#tblUser tbody').html('').append(tbldata);
                        $('#tblUser').DataTable({
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
                        $('#tblUser tbody').html('').append(tbldata);
                        $('#tblUser').DataTable({
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
                    var usr_id = $(this).val();
                    $.post('controllers/userController.php', {action: 'getUserByID', usr_id: usr_id}, function (e) {
                        $.each(e, function (index, qdt) {
                            $('#usr_id').val(qdt.usr_id);
                            $('#usr_name').val(qdt.usr_name);
                            $('#usr_username').val(qdt.usr_username);
                            $('#usr_email').val(qdt.usr_email);
                            $('#usr_phone').val(qdt.usr_phone);
                            $('#usr_nic').val(qdt.usr_nic);
                            $('#usr_designation').val(qdt.usr_designation);
                            $('#usr_password').prop('disabled', true);
                        });
                    }, "json");
                });

                $('.btn_delete').click(function () {
                    var usr_id = $(this).val();
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to delete this user ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonClass: "btn-light",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.post('controllers/userController.php', {action: 'deleteUser', usr_id: usr_id}, function (e) {
                            if (parseInt(e.msgType) == 1) {
                                swal("Good Job!", e.msg, "success");
                                clearUser();
                                tblUser();
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

        function saveUser() {
            var usr_name = $('#usr_name').val();
            var usr_username = $('#usr_username').val();
            var usr_password = $('#usr_password').val();
            var usr_email = $('#usr_email').val();
            var usr_phone = $('#usr_phone').val();
            var usr_nic = $('#usr_nic').val();
            var usr_designation = $('#usr_designation').val();
            var usr_usercategory = $('.cmbUserCategory').val();
            var postdata = {
                action: "saveUser",
                usr_name: usr_name,
                usr_username: usr_username,
                usr_password: usr_password,
                usr_email: usr_email,
                usr_phone: usr_phone,
                usr_nic: usr_nic,
                usr_designation: usr_designation,
                usr_usercategory: usr_usercategory
            }
            $.post('controllers/userController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good Job!", e.msg, "success");
                    clearUser();
                    tblUser(usr_usercategory);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function editUser() {
            var usr_id = $('#usr_id').val();
            var usr_name = $('#usr_name').val();
            var usr_username = $('#usr_username').val();
            var usr_password = $('#usr_password').val();
            var usr_email = $('#usr_email').val();
            var usr_phone = $('#usr_phone').val();
            var usr_nic = $('#usr_nic').val();
            var usr_designation = $('#usr_designation').val();
            var usr_usercategory = $('.cmbUserCategory').val();
            var postdata = {
                action: "editUser",
                usr_name: usr_name,
                usr_username: usr_username,
                usr_password: usr_password,
                usr_email: usr_email,
                usr_phone: usr_phone,
                usr_nic: usr_nic,
                usr_designation: usr_designation,
                usr_usercategory: usr_usercategory,
                usr_id: usr_id
            }
            $.post('controllers/userController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good Job!", e.msg, "success");
                    clearUser();
                    tblUser(usr_usercategory);
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }

        function clearUser() {
            $('#usr_id').val('');
            $('#usr_name').val('');
            $('#usr_username').val('');
            $('#usr_password').val('');
            $('#usr_email').val('');
            $('#usr_phone').val('');
            $('#usr_nic').val('');
            $('#usr_designation').val('');
            $('#usr_password').prop('disabled', false);
            $('#btn_save').prop('hidden', false);
            $('#btn_edit').prop('hidden', true);
            $('#userform').removeClass('was-validated');
        }

        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready
            var usrcat_institute = $('#usrcat_institute').val();
            cmbUserCategory(usrcat_institute, false, function () {
                var usr_usercategory = $('.cmbUserCategory').val();
                tblUser(usr_usercategory);
            });
            
            $('.cmbUserCategory').change(function () {
                var usr_usercategory = $(this).val();
                tblUser(usr_usercategory);
            });

            const form = $('#userform');

            $('#btn_save').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    saveUser();
                }
            });

            $('#btn_edit').click(function (event) {
                form.submit(false);
                form.addClass('was-validated');
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    editUser();
                }
            });

            $('#btn_clear').click(function (event) {
                form.submit(false);
                clearUser();
            });


        });
    </script>
</body>
</html>