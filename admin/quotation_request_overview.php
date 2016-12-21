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
                <h3>Bevestiging afwijzing</h3>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u deze aanvraag wilt afwijzen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <a class="btn btn-danger btn-ok">Afwijzen</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-accept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Bevestiging Aanmaken offerte</h3>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u deze aanvraag wilt <strong>goedkeuren en een offerte</strong> wilt maken?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <a class="btn btn-success btn-ok">Aanmaken</a>
            </div>
        </div>
    </div>
</div>

<div id="wrapper">

    <!-- ADMIN MENU -->
    <?php
    $active = "Factuur";
    include 'include/menu.php';
    ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Offerte aanvraag
                        <small>Overzicht</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <?php //alert if page is succesfully added
            if(isset($_GET["accept"]) && $_GET["accept"] == 1): ?>
                <div class="alert alert-success">
                    <strong>Geslaagd!</strong> de aanvraag is goedgekeurd.
                </div>
            <?php endif; ?>

            <!-- /.row -->
            <?php //alert if page is not added
            if(isset($_GET["accept"]) && $_GET["accept"] == 0): ?>
                <div class="alert alert-danger">
                    <strong>Fout!</strong> Er is iets fout gegaan tijdens het goedkeuren.
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Klantnaam</th>
                                <th>Product afbeelding</th>
                                <th>Product informatie</th>
                                <th>Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $requests = get_quotation_requests();
                            foreach($requests as $request_info ):
                                $user = get_customer_info($request_info["customer_id"]);
                                $product = get_product_info($request_info["product_id"]);
                                ?>
                                <tr>
                                    <td><?= $request_info["request_date"] ?></td>
                                    <td>
                                        <b>Naam: </b><?= $user["customer_name"] ?><br>
                                        <b>Email: </b><?= $user["customer_email"] ?><br>
                                        <b>Adres: </b><br>
                                        <?= $user["customer_address"] ?><br>
                                        <?= $user["customer_zipcode"].", ".$user["customer_location"] ?><br>
                                        <b>Bedrijf: </b><?= $user["customer_company"] ?><br>
                                    </td>
                                    <td><img src="../<?= $product["product_image"] ?>" class="img-responsive" width="150px"> </td>
                                    <td>
                                        <b>Naam:</b> <?= $product["product_name"] ?><br>
                                        <b>Omschrijving:</b> <?= $product["product_name"] ?><br>
                                    </td>
                                    <td>
                                        <a href="#" data-href="quotation_request_accept.php?id=<?= $request_info["request_id"] ?>" class="btn btn-success" data-toggle="modal" data-target="#confirm-accept" >Offerte aanmaken</a>
                                        <a href="#" data-href="quotation_request_decline.php?id=<?= $request_info["request_id"] ?>" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" >Aanvraag afwijzen</a>
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
    $('#confirm-accept').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

</body>

</html>
