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
                <h3>Bevestiging archivering</h3>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u deze factuur wilt archiveren?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <a class="btn btn-danger btn-ok">Archiveren</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Bevestiging factuur aanmaken</h3>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u een factuur wilt maken van deze offerte?</p>
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
    $active = "oferte";
    include 'include/menu.php';
    ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Factuur
                        <small>Overzicht</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <?php //alert if quotation is succesfully archived
            if(isset($_GET["archive"]) && $_GET["archive"] == 1): ?>
                <div class="alert alert-success">
                    <strong>Geslaagd!</strong> Factuur succesvol gearchiveerd.
                </div>
            <?php endif; ?>
            <?php //alert if quotation not archived
            if(isset($_GET["archive"]) && $_GET["archive"] == 0): ?>
                <div class="alert alert-danger">
                    <strong>fout!</strong> Factuur niet gearchiveerd.
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="col-md-2">Factuur nr.</th>
                                    <th class="col-md-2">Datum</th>
                                    <th class="col-md-3">Klantnaam</th>
                                    <th class="col-md-2">Total prijs</th>
                                    <th class="col-md-3">Opties</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $invoices = get_invoices();
                            foreach($invoices as $invoices ):
                                $user = get_customer_info($invoices["customer_id"]);
                                $total_price = get_quotation_total_price($invoices["quotation_id"]);
                                ?>
                                <tr>
                                    <td><?= $invoices["invoice_id"] ?></td>
                                    <td><?= $invoices["invoice_date"] ?></td>
                                    <td>
                                        <b>Naam: </b><?= $user["customer_name"] ?><br>
                                        <b>Email: </b><?= $user["customer_email"] ?><br>
                                        <b>Adres: </b><br>
                                        <?= $user["customer_address"] ?><br>
                                        <?= $user["customer_zipcode"].", ".$user["customer_location"] ?><br>
                                        <?php if($user["customer_company"] != ""){?><b>Bedrijf: </b><?= $user["customer_company"] ?><br><?php } ?>
                                    </td>
                                    <td><?= "&euro;".number_format($total_price, 2, ',', ' ') ?></td>
                                    <td>
                                       <a href="offerte.php?id=<?= $quotation["quotation_id"] ?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="#" class="btn btn-warning"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                        <a href="#" data-href="invoice_archive.php?id=<?= $invoices["invoice_id"] ?>" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-archive" aria-hidden="true"></i></a>
                                        <a href="#" data-href="quotation_to_invoice.php?id=<?= $quotation["quotation_id"] ?>" class="btn btn-success" data-toggle="modal" data-target="#confirm-invoice">Factuur aanmaken</a>
                                       
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
    
    $('#confirm-invoice').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

</body>

</html>
