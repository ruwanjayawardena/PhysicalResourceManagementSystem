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
                <div class="row justify-content-center">                    
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="report-stock-centralized.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-file fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-file fa-lg"></i> Centralized Stock Report</h5>
                                    <p class="card-text">View All Centralized Data</p>
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