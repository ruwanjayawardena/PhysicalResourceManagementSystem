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
                        <a href="item_maincategory.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-sitemap fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-sitemap fa-lg"></i> Item Main Category</h5>
                                    <p class="card-text">Configure Main Category</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="item_sub1category.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-sitemap fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-sitemap fa-lg"></i> Item 1<sup>st</sup> Sub Category</h5>
                                    <p class="card-text">Configure 1<sup>st</sup> Sub Category</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="item_sub2category.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-sitemap fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-sitemap fa-lg"></i> Item 2<sup>nd</sup> Sub Category</h5>
                                    <p class="card-text">Configure 2<sup>nd</sup> Sub Category</p>
                                </div>                           
                            </div>
                        </a>
                    </div>                    
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="item_attributetype.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-stroopwafel fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-stroopwafel fa-lg"></i> Item Attribute Type </h5>
                                    <p class="card-text">Configure Attribute Type</p>
                                </div>                           
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="item_attribute.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-stroopwafel fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-stroopwafel fa-lg"></i> Item Attributes </h5>
                                    <p class="card-text">Configure Attributes</p>
                                </div>                           
                            </div>
                        </a>
                    </div>                    
                    <div class="col-lg-3 col-sm-4 col-xs-12 hvr-grow">
                        <a href="item.php" class="text-decoration-none">
                            <div class="card text-white bg-primary">
                                <div class="card-header text-center d-none d-sm-block"><i class="fas fa-sitemap fa-4x"></i></div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-sitemap fa-lg"></i> Item </h5>
                                    <p class="card-text">Configure Item</p>
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