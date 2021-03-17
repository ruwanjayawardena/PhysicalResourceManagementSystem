<?php include './access_control/auth.php'; ?>
<!doctype html>
<html lang="en">
    <head>
        <?php include './includes/head-block.php'; ?>
        <link rel="stylesheet" href="assets/css/sign-in.css">
        <style>
            .text-muted {
                font-size: 12pt !important;
            }
        </style>
    </head>
    <body>         
        <div class="container-fluid">                
            <div class="row logoHeading">
                <div class="col-lg-12 col-sm-12"> 
                    <div class="d-flex flex-nowrap justify-content-center align-items-center zoomIn animated">
                        <div class="order-1 pr-2">
                            <img class="systemlogo" src="assets/img/logo/rsz_logo.png" alt="govlogo">
                        </div>
                        <div class="order-2 mt-3">
                            <h1>EDUCATIONAL PHYSICAL RESOURCE MANAGEMENT SYSTEM <br><small>Department of Education, NWP</small></h1>
                        </div>

                    </div>                   

                </div>                                       
            </div>
            <div class="clearfix"></div>
            <div class="row  justify-content-center">                    
                <div class="col-lg-3 col-sm-5 text-center"> 
                    <form class="form-signin pt-auto">                            
                        <h1 class="h3 mb-3 text-uppercase">System log in</h1>
                        <div class="form-group">                               
                            <input type="text" class="form-control" id="usr_username" placeholder="Username/Email" autocomplete="off" required>
                            <div class="valid-feedback">
                                <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                            </div>
                            <div class="invalid-feedback">
                                <i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid username/ email
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="usr_password" placeholder="Password" autocomplete="off" required>
                            <div class="valid-feedback">
                                <i class="fas fa-lg fa-check-circle"></i> Looks good! 
                            </div>
                            <div class="invalid-feedback">
                                <i class="fas fa-lg fa-exclamation-circle"></i> Please Provide valid password
                            </div>
                        </div>  

                        <div class="form-group mb-2 mt-3">
                            <button class="btn btn-lg btn-outline-warning btn-block" id="btn-login">Log in</button>
                        </div>

                        <p class="mt-5 mb-3 text-muted">Department of Education - North Western  &copy; <?php echo date("Y"); ?></p>
                    </form>
                </div>                    
            </div>
        </div>


        <?php
        include './includes/end-block.php';
        ?>
        <script>


            function login() {
                var usr_username = $('#usr_username').val();
                var usr_password = $('#usr_password').val();
                var postData = {
                    usr_username: usr_username,
                    usr_password: usr_password,
                    action: 'login'
                }
                $.post('controllers/userController.php', postData, function (e) {
                    if (e === undefined || e.length === 0 || e === null) {
                        swal("Alert !", "System Error", "warning");
                    } else {
                        if (parseInt(e.msgType) == 1) {
                            swal({
                                title: "Congratulations !",
                                text: "Reload page please wait...",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                            setTimeout(function () {
                                if (parseInt(e.usr_is_superadmin) == 1) {
                                    //super admin
                                    window.location.href = 'dashboard_superadmin.php';
                                } else if (parseInt(e.usr_is_superadmin) == 0) {
                                    //system admin assigned unders institute
                                    window.location.href = 'dashboard.php';
                                } 
                            }, 1700);
                        } else {
                            swal("Alert !", e.msg, "warning");
                        }
                    }
                }, "json");
            }


            $(window).on('load', function () {

                const form = $('.form-signin');

                $('#btn-login').click(function (event) {
                    form.submit(false);
                    form.addClass('was-validated');
                    if (form[0].checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        login();
                    }
                });

                $(document).on('keypress', function (event) {
                    if (event.which == 13) {
                        event.preventDefault();
                        form.submit(false);
                        form.addClass('was-validated');
                        if (form[0].checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            login();
                        }
                    }
                });
            });


        </script>
    </body>
</html>
