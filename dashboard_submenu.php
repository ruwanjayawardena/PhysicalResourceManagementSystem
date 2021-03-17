<?php include './access_control/systemadmin_auth.php'; ?>
<!doctype html>
<html lang="en">
    <head>
        <?php include './includes/head-block.php'; ?>
        <style>
            body{
                background: #DFE0DF;
                color: white;
            }
        </style>
    </head>
    <body>
        <!--navbar-->
        <?php include 'includes/backend-navbar.php'; ?> 
        <!--body content-->
        <section>
            <input type="hidden" id="usr_usercategory" value="<?php
            if (isset($_SESSION) && !empty($_SESSION['usr_id'])) {
                echo $_SESSION['usr_usercategory'];
            }
            ?>">
            <input type="hidden" id="prvg_main_prvg_id" value="<?php
            if (isset($_REQUEST['prvg_main_prvg_id']) && !empty($_REQUEST['prvg_main_prvg_id'])) {
                echo $_REQUEST['prvg_main_prvg_id'];
            }
            ?>">
            <div class="container wrapper">
                <div class="row dashboardControllers justify-content-center">

                </div>
            </div>            
        </section>
        <?php
        include './includes/end-block.php';
        include './includes/commonJS.php';
        ?>   
        <script>
            function loadSystemSubDashboard() {
                var asn_usercategory = $('#usr_usercategory').val();
                var prvg_main_prvg_id = $('#prvg_main_prvg_id').val();
                var dashboard = "";
                $.post('controllers/privilegeController.php', {action: 'assignedPrivileges', asn_usercategory: asn_usercategory}, function (e) {
                    if (e === undefined || e.length === 0 || e === null) {
                        dashboard += '<h1 class="bg-warning alert text-center text-white"> No Privileges assigned.<br><small>Please Contact Administrator</small> </h1>';
                    } else {
                        $.each(e, function (index, qdt) {
                            if (parseInt(qdt.prvg_menu_level) == 2) {
                                if (parseInt(qdt.prvg_main_prvg_id) == parseInt(prvg_main_prvg_id)) {
                                    dashboard += '<div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">';
                                    dashboard += '<a href="' + qdt.prvg_url + '" class="text-decoration-none">';
                                    dashboard += '<div class="card text-white bg-primary">';
                                    dashboard += '<div class="card-header text-center d-none d-sm-block"><i class="' + qdt.prvg_icon_code + ' fa-4x"></i></div>';
                                    dashboard += '<div class="card-body text-center">';
                                    dashboard += '<h5 class="card-title"><i class="' + qdt.prvg_icon_code + ' fa-lg"></i> ' + qdt.prvg_name + ' </h5>';
                                    dashboard += '<p class="card-text">' + qdt.prvg_desc + '</p>';
                                    dashboard += '</div>';
                                    dashboard += '</div>';
                                    dashboard += '</a>';
                                    dashboard += '</div>';
                                }
                            }
                        });
                    }
                    $('.dashboardControllers').html('').append(dashboard);
                }, "json");
            }

            $(document).ready(function () {
                // Executes when the HTML document is loaded and the DOM is ready 
                loadSystemSubDashboard();
            });
        </script>
    </body>
</html>