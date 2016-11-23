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
    $active = "Catalogus";
    include 'include/menu.php';
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Hardware producten
                            <small>Overzicht</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <a href="#" class="btn btn-primary">Toevoegen</a><br><br>
                    </div>
                </div>
                <!-- /.row -->


                <!-- Page Content -->
                <div class="row">
                    <div class="col-lg-10">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Product nummer</th>
                                    <th></th>
                                    <th>Naam</th>
                                    <th>Omschrijving</th>
                                    <th>Specsificaties</th>
                                    <th>Prijs</th>
                                    <th>Opties</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img class="img-responsive" src="http://picscdn.redblue.de/doi/pixelboxx-mss-71216561/fee_325_225_png/HP-15-AY082ND"/></td>
                                    <td>HP 15-AC120NDD</td>
                                    <td> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</td>
                                    <td> Beeldscherm: 15,6 inch (1366 x 768)
                                        Processor: Intel Core i3-5005U
                                        Werkgeheugen: 8 GB
                                        Opslag: 1 TB HDD
                                        Grafische kaart: Intel HD Graphics 5500</td>
                                    <td class="price">400,-</td>
                                    <td><a href="#" class="btn btn-primary"><span class="fa fa-pencil"></span></a><a href="#" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                </tr>
                                </tbody>
                            </table>
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

</body>

</html>
