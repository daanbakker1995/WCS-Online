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
                <h3>Bevestiging archivering</h3>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u dit offerte wilt archiveren?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <a class="btn btn-danger btn-ok">Archiveren</a>
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
                        Offerte Archief
                        <small>Overzicht</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <?php //alert if quotation is succesfully archived
            if(isset($_GET["archive"]) && $_GET["archive"] == 1): ?>
                <div class="alert alert-success">
                    <strong>Geslaagd!</strong> offerte succesvol gearchiveerd.
                </div>
            <?php endif; ?>
            <?php //alert if quotation not archived
            if(isset($_GET["archive"]) && $_GET["archive"] == 0): ?>
                <div class="alert alert-danger">
                    <strong>fout!</strong> offerte niet gearchiveerd.
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Offerte nr.</th>
                                <th>Datum aangemaakt</th>
                                <th>Klantnaam</th>
                                <th>Total prijs</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $quotations = get_quotations_archived();
                            foreach($quotations as $quotation ):
                                $user = get_customer_info($quotation["customer_id"]);
                                $total_price = get_quotation_total_price($quotation["quotation_id"]);
                                ?>
                                <tr>
                                    <td><?= $quotation["quotation_id"] ?></td>
                                    <td><?= $quotation["quotation_date"] ?></td>
                                    <td>
                                        <b>Naam: </b><?= $user["customer_name"] ?><br>
                                        <b>Email: </b><?= $user["customer_email"] ?><br>
                                        <b>Adres: </b><br>
                                        <?= $user["customer_address"] ?><br>
                                        <?= $user["customer_zipcode"].", ".$user["customer_location"] ?><br>
                                        <b>Bedrijf: </b><?= $user["customer_company"] ?><br>
                                    </td>
                                    <td><?= "&euro;".number_format($total_price, 2, ',', ' ') ?></td>
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


