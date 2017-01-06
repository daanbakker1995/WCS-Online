<?php
include 'functions.php';
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
                    <?php
                    //alert if page is succesfully added
                    if (isset($_GET["add_page"]) && $_GET["add_page"] == 1):
                        ?>
                        <div class="alert alert-success">
                            <strong>Geslaagd!</strong> De pagina is toegevoegd.
                        </div>
<?php endif; ?>


                    <!-- /.row -->
                    <?php
                    //alert if page is succesfully added
                    if (isset($_GET["page_edit"]) && $_GET["page_edit"] == 1):
                        ?>
                        <div class="alert alert-success">
                            <strong>Geslaagd!</strong> De pagina is succesvol bewerkt.
                        </div>
<?php endif; ?>


                    <!-- /.row -->
                    <?php
                    //alert if page is succesfully added
                    if (isset($_GET["delete"]) && $_GET["delete"] == 1):
                        ?>
                        <div class="alert alert-success">
                            <strong>Geslaagd!</strong> De pagina is succesvol verwijderd.
                        </div>
                    <?php endif; ?>

                    <!-- /.row -->
<?php
//alert if page is not added
if (isset($_GET["delete"]) && $_GET["delete"] == 0):
    ?>
                        <div class="alert alert-danger">
                            <strong>Fout!</strong> Er is iets fout gegaan tijdens het verwijderen.
                        </div>
<?php endif; ?>


                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="./user_add.php" class="btn btn-primary">Toevoegen</a><br><br>
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
                                            <th>Email adres</th>
                                            <th>Rol</th>
                                            <th>Activiteit</th>
                                            <th>Opties</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $db = new Database();
                                        $db->query('SELECT user_name, user_email, user_role, user_active, user_id FROM users');
                                        $users = $db->resultset();

                                        foreach ($users as $user):
                                            if ($user["user_role"] == 0)
                                            {
                                                $user["user_role"] = "Super Admin";
                                            } elseif ($user["user_role"] == 1)
                                            {
                                                $user["user_role"] = "Admin";
                                            } else
                                            {
                                                $user["user_role"] = "Content Beheerder";
                                            }
                                            if ($user["user_active"]==1){
                                                $user["user_active"]="Actief";
                                            } else {
                                                $user["user_active"]="Geblokkeerd";
                                            }
                                            ?>
                                            <tr>
                                                <td><?php print($user["user_name"]);?></td>
                                                <td><?php print($user["user_email"]);?></td>
                                                <td><?php print($user["user_role"]);?></td>
                                                <td><?php print($user["user_active"]);?></td>
                                                <td><a href="user_edit.php?id=<?= $user["user_id"] ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                                    <a href="user_delete.php?id=<?= $user["user_id"] ?>" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" ><span class="fa fa-trash"></span></a>
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
            $('#confirm-delete').on('show.bs.modal', function (e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>

    </body>

</html>
