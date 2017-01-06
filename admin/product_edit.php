<?php
if(isset($_POST["submit"])){
    include 'functions.php';
    if($_POST["name"] != "" && ($_POST["type"] != "") && ($_POST["price"] != "") && ($_POST["description"] != "")){
        $product_info['id'] = $_GET["id"];
        $product_info['name'] = $_POST["name"];
        $product_info['category'] = $_POST["type"];
        $product_info['price'] = $_POST["price"];
        $product_info['description'] = $_POST["description"];
        $product_info['image'] = $_POST["image"];

        if(update_product($product_info)){
            header('location: ./product_overview.php?product_edit=1');
        }
        else{
            $error = "Er is iets fout gegaan.";
        }
    }
}
else {
    if(isset($_GET["id"])){
        include 'functions.php';
        $product_info = get_product_info($_GET["id"]);
    }
    else{
        header('location: ./product_overview.php');
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
                            Hardwareproduct wijzigen                           
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
                            <input type="text" class="form-control" name="name" id="title" placeholder="Productnaam" value="<?= $product_info["product_name"]; ?> " required>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="type">Product type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="3" <?php if($product_info["category_id"] == 3) echo "selected" ?>>laptop</option>
                                <option value="4" <?php if($product_info["category_id"] == 4) echo "selected" ?>>desktop</option>
                                <option value="5" <?php if($product_info["category_id"] == 5) echo "selected" ?>>monitor</option>
                                <option value="2" <?php if($product_info["category_id"] == 2) echo "selected" ?>>tablet</option>
                                <option value="6" <?php if($product_info["category_id"] == 6) echo "selected" ?>>PC-component</option>
                                <option value="7" <?php if($product_info["category_id"] == 7) echo "selected" ?>>printer</option>
                                <option value="8" <?php if($product_info["category_id"] == 8) echo "selected" ?>>scanner</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="number">Prijs</label>
                            <input type="number" class="form-control" name="price" placeholder="Prijs" value=" <?= $product_info["product_price"]; ?>" required min="0" max="10000" step="0.01">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="description">Omschrijving</label>
                            <textarea class="form-control" name="description" id="description"> <?= $product_info["product_description"]; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="image">Afbeelding</label>
                            <input type="text" class="form-control" name="image" id="title" placeholder="Afbeelding" value=" <?=$product_info["product_image"]; ?>">
                        </div>
                    </div>                       
                    <div class="col-lg-12">
                            <a href="product_overview.php" class="btn btn-default">Annuleren</a>
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
