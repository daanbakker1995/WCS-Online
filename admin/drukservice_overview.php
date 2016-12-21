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
    <!-- Modal Confirm Delete-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Bevestiging</h3>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u dit product wilt verwijderen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <a class="btn btn-danger btn-ok">Verwijder product</a>
            </div>
        </div>
    </div>
</div>
    
<div id="wrapper">

    <!-- ADMIN MENU -->
    <?php
    $active = "Copyservice";
    include 'include/menu.php';
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Drukservice
                            <small>Overzicht</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
               <?php //alert if page is succesfully added
                if(isset($_GET["add_product"]) && $_GET["add_product"] == 1): ?>
                    <div class="alert alert-success">
                        <strong>Geslaagd!</strong> Het product is succesvol toegevoegd.
                    </div>
                <?php endif; ?>
                
                <!-- /.row -->
                <?php //alert if page is succesfully edited
                if(isset($_GET["product_edit"]) && $_GET["product_edit"] == 1): ?>
                    <div class="alert alert-success">
                        <strong>Geslaagd!</strong> Het product is succesvol bewerkt.
                    </div>
                <?php endif; ?>
                
                <!-- /.row -->
                <?php //alert if page is succesfully deleted
                if(isset($_GET["delete"]) && $_GET["delete"] == 1): ?>
                    <div class="alert alert-success">
                        <strong>Geslaagd!</strong> Het product is succesvol verwijderd.
                    </div>
                <?php endif; ?>

                <!-- /.row -->
                <?php //alert if page is not deleted
                if(isset($_GET["delete"]) && $_GET["delete"] == 0): ?>
                    <div class="alert alert-danger">
                        <strong>Fout!</strong> Er is iets fout gegaan tijdens het verwijderen.
                    </div>
                <?php endif; ?>                
                
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <a href="./copy_product_add.php" class="btn btn-primary">Toevoegen</a><br><br>
                    </div>
                </div>
                <!-- /.row -->


                <!-- Page Content -->
                <div class="row">
                    <div class="col-lg-10">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Naam</th>
                                    <th>Afbeelding</th>
                                    <th>Type</th>
                                    <th>Omschrijving</th>
                                    <th>Prijs</th>
                                    <th>Opties</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <!-- Get all copy products in table -->
                                <?php
                                $products = get_copy_products();
                                foreach($products as $product ):
                                ?>
                                <tr>
                                    <td><a href="../product.php?id=<?php echo $product['product_id'] ?>"><?= $product["product_name"]; ?></a></td>
                                    <td><img class="img-responsive" width="100px" src="<?php echo $product["product_image"]; ?>"/></td>
                                    <td><?php echo $product["category_id"]; ?></td>
                                    <td><?php echo $product["product_description"]; ?></td>
                                    <td><?php echo $product["product_price"]; ?></td>
                                    <td><a href="copy_product_edit.php?id=<?= $product["product_id"] ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="#" data-href="copy_product_delete.php?id=<?= $product["product_id"] ?>" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" ><span class="fa fa-trash"></span></a>        
                                        </td>
                                </tr>
                                <?php endforeach ?>
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
    
    <!-- script for modal -->
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>

</body>

</html>
