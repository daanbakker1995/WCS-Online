<?php
    include 'functions.php';
    include "check_login.php";
    if(isset($_POST["submit"])){
        if($_POST["name"] != "" && ($_POST["type"] != "") && ($_POST["price"] != "") && ($_POST["description"] != "")){
            $category_id = $_POST["type"];
            $price = $_POST["price"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $image = $_POST["image"];

            if(insert_product($category_id, $price, $name, $description, $image)){
                header('location: product_overview.php?add_product=1');
            }
            else{
                $error = "Er is iets fout gegaan.";
            }
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
    $active = "Catalogus";
    include 'include/menu.php';
    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Hardwareproduct toevoegen                           
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
                <div class="row">
                    <form method="post">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="name">Productnaam</label>
                            <input type="text" class="form-control" name="name" id="title" placeholder="Productnaam" required>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="type">Product type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="3">laptop</option>
                                <option value="4">desktop</option>
                                <option value="5">monitor</option>
                                <option value="2">tablet</option>
                                <option value="6">PC-component</option>
                                <option value="7">printer</option>
                                <option value="8">scanner</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="number">Prijs</label>
                            <input type="number" class="form-control" name="price" placeholder="Prijs" required min="0" max="10000" step="0.01">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description">Omschrijving & specificaties</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="image">Afbeelding</label>
                            <input type="text" class="form-control" name="image" id="title" placeholder="Afbeelding URL">
                        </div>
                    </div> 
                    <div class="col-lg-12">
                            <a href="product_overview.php" class="btn btn-default">Annuleren</a>
                            <input type="submit" class="btn btn-primary" name="submit" value="Opslaan">
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
