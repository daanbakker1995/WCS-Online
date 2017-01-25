<?php
$admin_rights = true; // Page is only for admins.
include 'functions.php';
include "check_login.php";
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- ADMIN HEADER -->
        <?php include 'include/head.php'; ?>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </head>

    <body>


        <div id="wrapper">

            <!-- ADMIN MENU -->
            <?php
            $active = "gebruiker";
            include 'include/menu.php';
            ?>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Gebruikers
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
                            <a href="./users_add.php" class="btn btn-primary">Toevoegen</a><br><br>
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
                                        $db->query('SELECT user_name, user_email, user_type, user_active, user_id FROM user');
                                        $users = $db->resultset();

                                        foreach ($users as $user):
                                            if ($user["user_type"] == 0)
                                            {
                                                $user["user_type"] = "Super Admin";
                                            } elseif ($user["user_type"] == 1)
                                            {
                                                $user["user_type"] = "Admin";
                                            } else
                                            {
                                                $user["user_type"] = "Content Beheerder";
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
                                                <td><?php print($user["user_type"]);?></td>
                                                <td><?php print($user["user_active"]);?></td>
                                                <td><a href="users_edit.php?id=<?= $user["user_id"] ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                                    <a href="users_delete.php?id=<?= $user["user_id"] ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
