<?php
include 'functions.php';
if($_SESSION["ingelogd"] == true){
}
 else {
       header('location: ./login.php');       
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ADMIN HEADER -->
    <?php include 'include/head.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- ADMIN MENU -->
        <?php
            $active = "Dashboard";
             include 'include/menu.php';
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistieken</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= count_requests(); ?></div>
                                        <div>Nieuwe Aanvragen</div>
                                    </div>
                                </div>
                            </div>
                            <a href="quotation_request_overview.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-eur fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= count_invoices(); ?></div>
                                        <div>Aantal Facturen</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-laptop fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= count_hardware_products(); ?></div>
                                        <div>Hardware Producten</div>
                                    </div>
                                </div>
                            </div>
                            <a href="product_overview.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-truck fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?= count_copy_products()?></div>
                                        <div>Drukservice Porducten</div>
                                    </div>
                                </div>
                            </div>
                            <a href="drukservice_overview.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Bekijk details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info">
                            <a class="btn btn-primary" target="_blank" href="https://analytics.google.com/analytics/web/?hl=nl&pli=1#report/defaultid/a89317406w132489073p136458998/">Google Analytics</a>
                            <strong>Meer statistieken!</strong> Om Google analytics te zien op de knop.
                        </div>
                    </div>
                </div>
                <!--  /.row-->

                <div class="row">
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-file-text-o fa-fw"></i> Offertes</h3>
                            </div>
                            <div class="panel-body">
                                <div class="text-right">
                                    <a href="quotation_overview.php">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nummer</th>
                                            <th>Klant</th>
                                            <th>Datum</th>
                                            <th>Bedrag</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $quotations = get_quotations_limit_10();
                                        foreach($quotations as $quotation):
                                            $user = get_customer_info($quotation["customer_id"]);
                                            $total_price = get_quotation_total_price($quotation["quotation_id"]);
                                            ?>
                                            <tr>
                                                <td><?= $quotation['quotation_id'] ?></td>
                                                <td><?= $user["customer_name"] ?></td>
                                                <td><?= date('d-m-Y', strtotime($quotation["quotation_date"] )); ?></td>
                                                <td class="price"><?= $total_price ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="quotation_overview.php">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-eur fa-fw"></i> Facturen</h3>
                            </div>
                            <div class="panel-body">
                                <div class="text-right">
                                    <a href="invoice_overview.php">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nummer</th>
                                                <th>Klant</th>
                                                <th>Datum</th>
                                                <th>Bedrag</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $quotations = get_quotations_limit_10();
                                            foreach($quotations as $quotation):
                                                $user = get_customer_info($quotation["customer_id"]);
                                                $total_price = get_quotation_total_price($quotation["quotation_id"]);
                                        ?>
                                            <tr>
                                                <td><?= $quotation['quotation_id'] ?></td>
                                                <td><?= $user["customer_name"] ?></td>
                                                <td><?= date('d-m-Y', strtotime($quotation["quotation_date"] )); ?></td>
                                                <td class="price"><?= $total_price ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-laptop fa-fw"></i> Hardware Producten</h3>
                            </div>
                            <div class="panel-body">
                                <div class="text-right">
                                    <a href="product_overview.php">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Afbeelding</th>
                                                <th>Naam</th>
                                                <th>Prijs</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $products = get_products_limit_10();
                                        foreach($products as $product):
                                            ?>
                                            <tr>
                                                <td><img src="../<?= $product['product_image'] ?>" class="image_responsive" width="100%"> </td>
                                                <td><?= $product['product_name'] ?></td>
                                                <td class="price"><?= $product['product_price']  ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="product_overview.php">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-list fa-fw"></i> Pagina's</h3>
                            </div>
                            <div class="panel-body">
                                <div class="text-right">
                                    <a href="pages_overview.php">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Naam</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $pages = get_pages_limit_10();
                                        foreach($pages as $page_info):
                                            ?>
                                            <tr>
                                                <td><a href="../information_page.php?id=<?php echo $page_info['page_id'] ?>"><?= $page_info["page_title"]; ?></a></td>

                                                <?php if($page_info["page_status"] == 1):?>
                                                    <td class="color-green"> Actief</td>
                                                <?php elseif($page_info["page_status"] == 2):?>
                                                    <td class="color-red"> Niet Actief</td>
                                                <?php else:?>
                                                    <td class="color-yellow"> Concept</td>
                                                <?php endif;?>

                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="pages_overview.php">Bekijk Alles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
