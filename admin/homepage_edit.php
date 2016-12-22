<?php
if(isset($_POST["submit"])){
    include 'functions.php';
    if($_POST["title"] != "" && ($_POST["content"] != "")){
        $page_info['id'] = $_GET["id"];
        $page_info['title'] = $_POST["title"];
        $page_info['description'] = $_POST["description"];
        $page_info['content'] = $_POST["content"];
        $page_info['status'] = $_POST["status"];
        $page_info['type'] = $_POST["type"];
        $page_info['location'] = $_POST["location"];
        if(update_info_page($page_info)){
            header('location: ./pages_overview.php?page_edit=1');
        }
        else{
            $error = "Er is iets fout gegaan.";
        }
    }
}
else{
    if(isset($_GET["id"])){
        include 'functions.php';
        $page_info = get_homepage_info($_GET["id"]);
    }
    else{
        header('location: ./homepages_overview.php');
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
                        Homepagina
                        <small>Bewerken</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <strong>Fout!</strong> <?= $error ?>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <form method="post">
                <!-- header -->
                <div class="row">
                    <div class="col-lg-6">
                        <!-- TODO upload homepage_header_image -->
                        <a href="#" class="thumbnail">
                            <img src="../<?= $page_info["homepage_header_image"];?>" class="image-responsive" width="100%">
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="homepage_header_title">Header titel</label>
                            <input type="text" class="form-control" id="homepage_header_title" name="homepage_header_title  " placeholder="Header Titel" value="<?= $page_info["homepage_header_title"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="homepage_header_content">Header inhoud</label>
                            <textarea class="form-control" name="homepage_header_content" id="homepage_header_content" rows="5" ><?= $page_info["homepage_header_content"] ?></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="homepage_header_button_text">Knop tekst</label>
                                <input type="text" class="form-control" id="homepage_header_button_text" name="homepage_header_button_text" value="<?= $page_info["homepage_header_button_text"]; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="homepage_header_button_link">Knop Link</label>
                                <input type="text" class="form-control" id="homepage_header_button_link" name="homepage_header_button_link" value="<?= $page_info["homepage_header_button_link"]; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /header -->

                <!-- services -->
                <div class="row">
                    <!-- service_one -->
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">kolom 1</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="homepage_service_one_header">Titel</label>
                                    <input type="text" class="form-control" id="homepage_service_one_header" name="homepage_service_one_header  " placeholder="Header Titel" value="<?= $page_info["homepage_service_one_header"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="homepage_service_one_content">Inhoud tekst</label>
                                    <textarea class="form-control" name="homepage_service_one_content" id="homepage_service_one_content" rows="10" ><?= $page_info["homepage_service_one_content"] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="homepage_service_one_button_text">Knop tekst</label>
                                        <input type="text" class="form-control" id="homepage_service_one_button_text" name="homepage_service_one_button_text" value="<?= $page_info["homepage_service_one_button_text"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="homepage_service_one_button_link">Knop Link</label>
                                        <input type="text" class="form-control" id="homepage_service_one_button_link" name="homepage_service_one_button_link" value="<?= $page_info["homepage_header_button_link"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /service_one -->
                    <!-- service_two -->
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">kolom 2</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="homepage_service_two_header">Titel</label>
                                    <input type="text" class="form-control" id="homepage_service_two_header" name="homepage_service_two_header  " placeholder="Header Titel" value="<?= $page_info["homepage_service_two_header"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="homepage_service_two_content">Inhoud tekst</label>
                                    <textarea class="form-control" name="homepage_service_two_content" id="homepage_service_two_content" rows="10" ><?= $page_info["homepage_service_two_content"] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="homepage_service_two_button_text">Knop tekst</label>
                                        <input type="text" class="form-control" id="homepage_service_two_button_text" name="homepage_service_two_button_text" value="<?= $page_info["homepage_service_two_button_text"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="homepage_service_two_button_link">Knop Link</label>
                                        <input type="text" class="form-control" id="homepage_service_two_button_link" name="homepage_service_two_button_link" value="<?= $page_info["homepage_header_button_link"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /service_two -->
                    <!-- service_three -->
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">kolom 3</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="homepage_service_three_header">Titel</label>
                                    <input type="text" class="form-control" id="homepage_service_three_header" name="homepage_service_three_header  " placeholder="Header Titel" value="<?= $page_info["homepage_service_three_header"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="homepage_service_three_content">Inhoud tekst</label>
                                    <textarea class="form-control" name="homepage_service_three_content" id="homepage_service_three_content" rows="10" ><?= $page_info["homepage_service_three_content"] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="homepage_service_three_button_text">Knop tekst</label>
                                        <input type="text" class="form-control" id="homepage_service_three_button_text" name="homepage_service_three_button_text" value="<?= $page_info["homepage_service_three_button_text"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="homepage_service_three_button_link">Knop Link</label>
                                        <input type="text" class="form-control" id="homepage_service_three_button_link" name="homepage_service_three_button_link" value="<?= $page_info["homepage_header_button_link"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /service_three -->
                </div>
                <!-- /services -->

                <!-- buttons -->
                <div class="row">
                    <div class="col-lg-12">
                        <a href="pages_overview.php" class="btn btn-default">Annuleren</a>
                        <input type="submit" class="btn btn-primary" name="submit" value="Opslaan">
                    </div>
                </div>
                <!-- /buttons -->

            </form>
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
