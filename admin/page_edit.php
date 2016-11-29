<?php
if(isset($_POST["submit"])){
    if($_POST["title"] != "" && ($_POST["content"] != "")){
        $id = $_GET["id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $content = $_POST["content"];
        $status = $_POST["status"];
        $type = $_POST["type"];
        $location = $_POST["location"];
        if(update_info_page($id,$title, $description, $content, $status, $type, $location)){
            $alert = true;
        }
    }
}
else{
    if(isset($_GET["id"])){
        include 'functions.php';
        $page_info = get_page_info($_GET["id"]);
    }
    else{
        header('location: ./pages_overview.php');
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
                            <small>Bewerken</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Page Content -->
                <div class="row">
                    <form method="post">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="title">Pagina titel</label>
                            <input type="text" class="form-control" id="title" placeholder="Pagina Titel" value="<?= $page_info["page_title"]; ?>">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status">Pagina status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="0" <?php if($page_info["page_status"] == 0) echo "selected" ?>>Concept</option>
                                <option value="1" <?php if($page_info["page_status"] == 1) echo "selected" ?>>Actief</option>
                                <option value="2" <?php if($page_info["page_status"] == 2) echo "selected" ?>>Niet Actief</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status">Pagina type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="0" <?php if($page_info["page_type"] == 0) echo "selected" ?>>Bedrijf(Algemeen)</option>
                                <option value="1" <?php if($page_info["page_type"] == 1) echo "selected" ?>>Drukservice</option>
                                <option value="2" <?php if($page_info["page_type"] == 2) echo "selected" ?>>Computerservice</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status">Locatie</label>
                            <select class="form-control" id="location" name="location">
                                <option value="0" <?php if($page_info["page_location"] == 0) echo "selected" ?>>Hoofdmenu</option>
                                <option value="1" <?php if($page_info["page_location"] == 0) echo "selected" ?>>Submenu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description">Korte omschrijving</label>
                            <textarea class="form-control" name="description" id="description"><?= $page_info["page_description"] ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content"><?= $page_info["page_content"] ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                            <a href="pages_overview.php" class="btn btn-default">Annuleren</a>
                            <input type="submit" class="btn btn-primary" value="Opslaan">
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
