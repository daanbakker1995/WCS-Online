<?php include 'functions.php'; ?>
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
                      <a href="./page_add.php" class="btn btn-primary">Toevoegen</a><br><br>
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
                                    <th>Locatie in menu</th>
                                    <th>Opties</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $pages = get_info_pages();
                                foreach($pages as $page_info ):
                                ?>
                                    <tr>
                                        <td><?= $page_info["page_title"]; ?></td>

                                        <?php if($page_info["page_status"] == 1):?>
                                        <td class="color-green"> Actief</td>
                                       <?php elseif($page_info["page_status"] == 2):?>
                                        <td class="color-red"> Niet Actief</td>
                                        <?php else:?>
                                        <td class="color-yellow"> Concept</td>
                                        <?php endif;?>

                                        <?php if($page_info["page_type"] == 0):?>
                                            <td> Bedrijf(Algemeen)</td>
                                        <?php elseif($page_info["page_type"] == 1):?>
                                            <td> Drukservice</td>
                                        <?php else:?>
                                            <td> Computerservice</td>
                                        <?php endif;?>

                                        <td><?= $page_info["page_description"]; ?></td>
                                        <?php if($page_info["page_location"] == 0):?>
                                        <td>Hoofdmenu</td>
                                        <?php else:?>
                                        <td>Hoofdmenu</td>
                                        <?php endif; ?>
                                        <td><a href="page_edit.php?id=<?= $page_info["page_id"] ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                            <a href="#" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                    </tr>
                                <?php endforeach; ?>
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
