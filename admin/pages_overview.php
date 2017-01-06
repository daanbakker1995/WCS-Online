<?php
include 'functions.php';
include "check_login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ADMIN HEADER -->
    <?php include 'include/head.php'; ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Bevestiging</h3>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u deze pagina wilt verwijderen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <a class="btn btn-danger btn-ok">Verwijder pagina</a>
            </div>
        </div>
    </div>
</div>

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

                <!-- /.row -->
                <?php //alert if page is succesfully added
                if(isset($_GET["add_page"]) && $_GET["add_page"] == 1): ?>
                    <div class="alert alert-success">
                        <strong>Geslaagd!</strong> De pagina is toegevoegd.
                    </div>
                <?php endif; ?>


                <!-- /.row -->
                <?php //alert if page is succesfully added
                if(isset($_GET["page_edit"]) && $_GET["page_edit"] == 1): ?>
                    <div class="alert alert-success">
                        <strong>Geslaagd!</strong> De pagina is succesvol bewerkt.
                    </div>
                <?php endif; ?>


                <!-- /.row -->
                <?php //alert if page is succesfully added
                if(isset($_GET["delete"]) && $_GET["delete"] == 1): ?>
                    <div class="alert alert-success">
                        <strong>Geslaagd!</strong> De pagina is succesvol verwijderd.
                    </div>
                <?php endif; ?>

                <!-- /.row -->
                <?php //alert if page is not added
                if(isset($_GET["delete"]) && $_GET["delete"] == 0): ?>
                    <div class="alert alert-danger">
                        <strong>Fout!</strong> Er is iets fout gegaan tijdens het verwijderen.
                    </div>
                <?php endif; ?>


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
                                        <td><a href="../information_page.php?id=<?php echo $page_info['page_id'] ?>"><?= $page_info["page_title"]; ?></a></td>

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
                                        <td>Submenu</td>
                                        <?php endif; ?>
                                        <td><a href="page_edit.php?id=<?= $page_info["page_id"] ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                            <a href="#" data-href="page_delete.php?id=<?= $page_info["page_id"] ?>" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" ><span class="fa fa-trash"></span></a>
                                        </td>
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

    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>

</body>

</html>
