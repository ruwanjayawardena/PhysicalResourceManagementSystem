<?php include './access_control/superadmin_auth.php'; ?>
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
            <div class="container wrapper">
                <div class="row">
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="usercategory.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-user-circle fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-user-circle fa-lg"></i> User Category </h5>
                                    <p class="card-text">User Category & Privileges <br><small>Super User Panel</small></p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="user.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-user fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-user fa-lg"></i> User</h5>
                                    <p class="card-text">Configure Users<br><small>Super User Panel</small></p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="province.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-map-marked-alt fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-map-marked-alt fa-lg"></i> Province</h5>
                                    <p class="card-text">Configure Province</p>
                                </div>                           
                            </div>
                        </a>
                    </div>                    
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="zonal.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-map-marked-alt fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-map-marked-alt fa-lg"></i> Zone</h5>
                                    <p class="card-text">Configure Zone</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="division.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-map-marked-alt fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-map-marked-alt fa-lg"></i> Division</h5>
                                    <p class="card-text">Configure Division</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="institute.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-warehouse fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-warehouse fa-lg"></i> Institute</h5>
                                    <p class="card-text">Configure Institute</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="institutetype.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-warehouse fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-warehouse fa-lg"></i> Institute Type</h5>
                                    <p class="card-text">Configure Institute Types</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="dashboard_suad_itemsetup.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-sitemap fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-sitemap fa-lg"></i> Item Setup</h5>
                                    <p class="card-text">Item Configure Sub Menu</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="reports-main.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-file fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-file fa-lg"></i> Reports</h5>
                                    <p class="card-text">View All Centralized Reports</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include './includes/end-block.php';
        include './includes/commonJS.php';
        ?>       
    </body>
</html>