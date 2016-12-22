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
                            Homepagina's
                            <small>Overzicht</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <?php //alert if page is succesfully edited
                if(isset($_GET["page_edit"]) && $_GET["page_edit"] == 1): ?>
                    <div class="alert alert-success">
                        <strong>Geslaagd!</strong> De pagina is succesvol bewerkt.
                    </div>
                <?php endif; ?>
                <?php //alert if page is not edited
                if(isset($_GET["page_edit"]) && $_GET["page_edit"] == 0): ?>
                    <div class="alert alert-danger">
                        <strong>fout!</strong> De pagina is niet bewerkt.
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="thumbnail thumbnail-copy">
                            <img src="../images/color-paint-palette-wall-painting.jpg" class="image-responsive"><br>
                            <div class="caption">
                                <h3>Copy Service</h3>
                                <p>Dit is de homepagina van de copy service. klik hieronder om de pagina te bewerken of te bekijken</p>
                                <p><a href="homepage_edit.php?id=1" class="btn btn-primary btn-lg" role="button">Bewerken</a> <a href="../homepage.php?service=drukservice" class="btn btn-default btn-lg" role="button">Naar website</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="thumbnail thumbnail-computer">
                            <img src="../images/woman-typing-writing-windows.jpg" class="image-responsive"><br>
                            <div class="caption">
                                <h3>Computer service</h3>
                                <p>Dit is de homepagina van de computer service. klik hieronder om de pagina te bewerken of te bekijken</p>
                                <p><a href="homepage_edit.php?id=2" class="btn btn-primary btn-lg" role="button">Bewerken</a> <a href="../homepage.php?service=computerservice" class="btn btn-default btn-lg" role="button">Naar website</a></p>
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

    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>

</body>

</html>
