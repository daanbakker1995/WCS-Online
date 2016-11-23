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
    $active = "Informatie";
    include 'include/menu.php';
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Informatiepagina's
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
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Naam</th>
                                    <th>Status</th>
                                    <th>Categorie</th>
                                    <th>Omschrijving</th>
                                    <th>Opties</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Reparatie Service</td>
                                    <td class="color-green"> Actief</td>
                                    <td>Computer</td>
                                    <td> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</td>
                                    <td><a href="#" class="btn btn-primary"><span class="fa fa-pencil"></span></a><a href="#" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                </tr>
                                <tr>
                                    <td>Nieuwe Actie</td>
                                    <td class="color-red"> Niet Actief</td>
                                    <td>Service <informatie></informatie></td>
                                    <td> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</td>
                                    <td><a href="#" class="btn btn-primary"><span class="fa fa-pencil"></span></a><a href="#" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                </tr>
                                <tr>
                                    <td>Concept</td>
                                    <td class="color-yellow"> Concept</td>
                                    <td>Service <informatie></informatie></td>
                                    <td> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</td>
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
