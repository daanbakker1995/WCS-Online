<?php
    include 'functions.php';
    include "check_login.php";

    if(isset($_POST["submit"])){
        if($_POST["title"] != "" && ($_POST["content"] != "")){ // if the title and content is set.
            $title = $_POST["title"];
            $description = $_POST["description"];
            $content = $_POST["content"];
            $status = $_POST["status"];
            $type = $_POST["type"];
            $location = $_POST["location"];
            if(insert_info_page($title, $description, $content, $status, $type, $location)){ // with the given information use the function insert_info_pages().
                header('location: pages_overview.php?add_page=1'); // if successful send the user to the pages_overview page with the var add_page set to 1(successfully added).
            }
            else{
                $error = "Er is iets fout gegaan."; // if not successful set var error.
            }
        }
        else{
            $error = "Er is iets fout gegaan."; // if not successful set var error.
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ADMIN HEADER -->
    <?php include 'include/head.php'; ?>
    <!-- CKEDOITOR -->
    <script type="text/javascript" src="include/ckeditor/ckeditor.js"></script>

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
                            Informatiepagina
                            <small>Toevoegen</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <?php if(isset($error)): // if var error is set echo var error. ?>
                    <div class="alert alert-danger">
                        <strong>Let op!</strong> <?= $error ?>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <div class="row">
                    <form method="post">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="title">Pagina titel</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Pagina Titel" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status">Pagina status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="0">Concept</option>
                                <option value="1">Actief</option>
                                <option value="2">Niet Actief</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status">Pagina type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="0">Bedrijf(Algemeen)</option>
                                <option value="1">Drukservice</option>
                                <option value="2">Computerservice</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status">Locatie</label>
                            <select class="form-control" id="location" name="location">
                                <option value="0">Hoofdmenu</option>
                                <option value="1">Submenu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description">Korte omschrijving</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                            <a href="pages_overview.php" class="btn btn-default">Annuleren</a>
                            <input type="submit" class="btn btn-primary" name="submit" value="Opslaan">
                    </div>
                    </form>
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- CKEditor -->
    <script>
        CKEDITOR.replace( 'content' );
    </script>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
