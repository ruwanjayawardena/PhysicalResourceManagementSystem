<?php include './access_control/session_controler.php'; ?> 
<!doctype html>
<html lang="en">
    <head>
        <?php include './includes/head-block.php'; ?>  
        <style>
            .card-body {    
                color: #000000 !important;   
                font-weight: 700 !important;
            }

            /*checkbox*/
            .checkbox label:after, 
            .radio label:after {
                content: '';
                display: table;
                clear: both;
            }

            .checkbox .cr,
            .radio .cr {
                position: relative;
                display: inline-block;
                border: 1px solid #a9a9a9;
                border-radius: .25em;
                width: 1.3em;
                height: 1.3em;
                float: left;
                margin-right: .5em;
            }

            .radio .cr {
                border-radius: 50%;
            }

            .checkbox .cr .cr-icon,
            .radio .cr .cr-icon {
                position: absolute;
                font-size: .8em;
                line-height: 0;
                top: 50%;
                left: 20%;
            }

            .radio .cr .cr-icon {
                margin-left: 0.04em;
            }

            .checkbox label input[type="checkbox"],
            .radio label input[type="radio"] {
                display: none;
            }

            .checkbox label input[type="checkbox"] + .cr > .cr-icon,
            .radio label input[type="radio"] + .cr > .cr-icon {
                transform: scale(3) rotateZ(-20deg);
                opacity: 0;
                transition: all .3s ease-in;
            }

            .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
            .radio label input[type="radio"]:checked + .cr > .cr-icon {
                transform: scale(1) rotateZ(0deg);
                opacity: 1;
            }

            .checkbox label input[type="checkbox"]:disabled + .cr,
            .radio label input[type="radio"]:disabled + .cr {
                opacity: .5;
            }


            .list-group-item-info {
                color: #6fbbc7;
                background-color: #000000;
            }

            .list-group-item-dark {
                color: #c5cad0;
                background-color: #114f8e;
            }

        </style>
    </head>
    <body>
        <!--navbar-->
        <?php include 'includes/backend-navbar.php'; ?>       
        <input type="hidden" id="usrcat_id" value="<?php
        if (isset($_REQUEST['usrcat_id']) && !empty($_REQUEST['usrcat_id'])) {
            echo $_REQUEST['usrcat_id'];
        }
        ?>">  
        <!--body content-->
        <input type="hidden" id="selectedforassign" value="">
        <input type="hidden" id="selectedforremove" value="">
        <section class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h4 class="text-uppercase admin-page-heading"><i class="fas fa-user-circle"></i> Assign Privileges &nbsp;&nbsp;<button class="btn btn-light d-print-none" onclick="window.history.back(-1);"><i class="fas fa-chevron-circle-left"></i>&nbsp;Back</button></h4>                       
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 pb-4">
                        <div class="card text-white bg-dark mb-3">
                            <div class="card-header">Available Privileges <br><small>Select and Press assign selected button for assign privileges</small> <br><button class="btn btn-light d-print-none btn-assignselected"><i class="fas fa-cogs"></i> Assign Selected</button></div>
                            <div class="card-body">
                                <ul class="list-group availablePrivileges list-group-flush">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 pb-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Assigned Privileges  <br><small>Select and Press remove selected button for remove assigned privileges</small><br><button class="btn btn-danger d-print-none btn-removeselected"><i class="fas fa-cogs"></i> Remove Selected</button></div>
                            <div class="card-body">
                                <ul class="list-group assignedPrivileges list-group-flush">

                                </ul>
                            </div>
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
        function availablePrivileges() {
            var asn_usercategory = $('#usrcat_id').val();
            var privilege = "";
            $.post('controllers/privilegeController.php', {action: 'availablePrivilegesInstitute',asn_usercategory:asn_usercategory}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    privilege += '<div class="bg-warning alert"> No available privileges </div>';
                } else {
                    $.each(e, function (index, qdt) {
                        if (parseInt(qdt.prvg_menu_level) == 1) {
                            privilege += '<li class="list-group-item list-group-item-info">';
                            privilege += '<div class="checkbox">';
                            privilege += '<label>';
                            privilege += '<input type="checkbox" class="av_prvg" value="' + qdt.prvg_id + '">';
                            privilege += '<span class="cr"><i class="cr-icon fas fa-check"></i></span> ' + qdt.prvg_name;
                            privilege += '</label>';
                            privilege += '</div>';
                            if (parseInt(qdt.prvg_has_submenu) == 1) {
                                privilege += '<ul class="list-group">';
                                $.each(e, function (indexsub, qdtsub) {
                                    if (parseInt(qdt.prvg_id) == parseInt(qdtsub.prvg_main_prvg_id)) {
                                        privilege += '<li class="list-group-item list-group-item-dark">';
                                        privilege += '<div class="checkbox">';
                                        privilege += '<label>';
                                        privilege += '<input type="checkbox" class="av_prvg" value="' + qdtsub.prvg_id + '">';
                                        privilege += '<span class="cr"><i class="cr-icon fas fa-check"></i></span> ' + qdtsub.prvg_name;
                                        privilege += '</label>';
                                        privilege += '</div>';
                                        privilege += '</li>';
                                    }
                                });
                                privilege += '</ul>';
                            }
                            privilege += '</li>';
                        }
                    });
                }
                $('.availablePrivileges').html('').append(privilege);

                $('.av_prvg').click(function () {
                    madeCheckBoxString('.av_prvg', '#selectedforassign')
                });
            }, "json");
        }

        function assignedPrivileges() {
            var asn_usercategory = $('#usrcat_id').val();
            var privilege = "";
            $.post('controllers/privilegeController.php', {action: 'assignedPrivilegesInstitute', asn_usercategory: asn_usercategory}, function (e) {
                if (e === undefined || e.length === 0 || e === null) {
                    privilege += '<div class="bg-warning alert"> No available privileges </div>';
                } else {
                    $.each(e, function (index, qdt) {
                        if (parseInt(qdt.prvg_menu_level) == 1) {
                            privilege += '<li class="list-group-item list-group-item-info">';
                            privilege += '<div class="checkbox">';
                            privilege += '<label>';
                            privilege += '<input type="checkbox" class="rm_prvg" value="' + qdt.prvg_id + '">';
                            privilege += '<span class="cr"><i class="cr-icon fas fa-check"></i></span> ' + qdt.prvg_name;
                            privilege += '</label>';
                            privilege += '</div>';
                            if (parseInt(qdt.prvg_has_submenu) == 1) {
                                privilege += '<ul class="list-group">';
                                $.each(e, function (indexsub, qdtsub) {
                                    if (parseInt(qdt.prvg_id) == parseInt(qdtsub.prvg_main_prvg_id)) {
                                        privilege += '<li class="list-group-item list-group-item-dark">';
                                        privilege += '<div class="checkbox">';
                                        privilege += '<label>';
                                        privilege += '<input type="checkbox" class="rm_prvg" value="' + qdtsub.prvg_id + '">';
                                        privilege += '<span class="cr"><i class="cr-icon fas fa-check"></i></span> ' + qdtsub.prvg_name;
                                        privilege += '</label>';
                                        privilege += '</div>';
                                        privilege += '</li>';
                                    }
                                });
                                privilege += '</ul>';
                            }
                            privilege += '</li>';
                        }
                    });
                }
                $('.assignedPrivileges').html('').append(privilege);

                $('.rm_prvg').click(function () {
                    madeCheckBoxString('.rm_prvg', '#selectedforremove')
                });
            }, "json");
        }


        function assignselected() {
            var assignselected = $('#selectedforassign').val();
            var asn_usercategory = $('#usrcat_id').val();
            var postdata = {
                action: "assignPrivilege",
                assignselected: assignselected,
                asn_usercategory: asn_usercategory
            }
            $.post('controllers/privilegeController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good Job!", e.msg, "success");
                    availablePrivileges();
                    assignedPrivileges();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }
        
        function removeselected() {
            var removeselected = $('#selectedforremove').val();
            var asn_usercategory = $('#usrcat_id').val();
            var postdata = {
                action: "removeselected",
                removeselected: removeselected,
                asn_usercategory: asn_usercategory
            }
            $.post('controllers/privilegeController.php', postdata, function (e) {
                if (parseInt(e.msgType) == 1) {
                    swal("Good Job!", e.msg, "success");
                    availablePrivileges();
                    assignedPrivileges();
                } else {
                    swal("Alert !", e.msg, "error");
                }
            }, "json");
        }




        $(document).ready(function () {
            // Executes when the HTML document is loaded and the DOM is ready           
            availablePrivileges();
            assignedPrivileges();



            $('.btn-assignselected').click(function (event) {
                assignselected();
            });
            $('.btn-removeselected').click(function (event) {
                removeselected();
            });


        });
    </script>
</body>
</html>