<?php
include 'functions.php';
include "check_login.php";

$page_info = get_homepage_info($_GET["id"]); // get the information of the homepage.

if(isset($_POST["submit"])){
    if(($_POST["homepage_header_title"] != "") && ($_POST["s_1_header"] != "")&& ($_POST["s_2_header"] != "")&& ($_POST["s_3_header"] != "")){ // if all headers are nog empty
        $new_page_info['id'] = $_GET["id"];
        $new_page_info["homepage_header_title"] = $_POST["homepage_header_title"];
        $new_page_info["homepage_header_content"] = $_POST["homepage_header_content"];
        $new_page_info["homepage_header_button_text"] = $_POST["homepage_header_button_text"];
        $new_page_info["homepage_header_button_link"] = $_POST["homepage_header_button_link"];
        $new_page_info["s_1_header"] = $_POST["s_1_header"];
        $new_page_info["s_1_content"] = $_POST["s_1_content"];
        $new_page_info["s_1_b_text"] = $_POST["s_1_b_text"];
        $new_page_info["s_1_b_link"] = $_POST["s_1_b_link"];
        $new_page_info["s_2_header"] = $_POST["s_2_header"];
        $new_page_info["s_2_content"] = $_POST["s_2_content"];
        $new_page_info["s_2_b_text"] = $_POST["s_2_b_text"];
        $new_page_info["s_2_b_link"] = $_POST["s_2_b_link"];
        $new_page_info["s_3_header"] = $_POST["s_3_header"];
        $new_page_info["s_3_content"] = $_POST["s_3_content"];
        $new_page_info["s_3_b_text"] = $_POST["s_3_b_text"];
        $new_page_info["s_3_b_link"] = $_POST["s_3_b_link"];

        if(update_homepage($new_page_info)){ // if update the homepage.
            header('location: ./homepages_overview.php?page_edit=1'); // redirect user to overview with page_edit set to 1(success).
        }
        else{
            $errors[] = "Er is iets fout gegaan tijdens het bijwerken."; // add error to the array errors.
        }
    }
    else{
        $errors[] = "Niet alle titels zijn ingevuld."; // add error to the array errors.
    }
}
elseif(isset($_POST["submit-image"])){ // if post submit-image is set.
    $dir = "../images/"; // set the directory for the image.
    if($_GET["id"] == 1){ // if id is 1 image file_name if 'copy'.
        $file_name = "copy";
    }
    else{ // else file_name is 'computer'
        $file_name = "computer";
    }
    if($_FILES['file_upload']['type'] == 'image/png' ){ // if the uploaded file type is 'PNG'.
        $full_file_name = $file_name.".png"; // set var full_file_name with the file_name and type.
    }
    elseif($_FILES['file_upload']['type'] == 'image/jpeg'){ // if the uploaded file type is 'JPEG/JPG'.
        $full_file_name = $file_name.".jpg"; // set var full_file_name with the file_name and type.
    }

    if (!file_exists($dir)) { // if the directory doesn't exist.
        mkdir($dir, 0777, true); // make the directory and set the mode to 777 and allow nested pathname.
    }

    if(isset($_FILES["file_upload"])){ // if an file is uploaded

        if($_FILES['file_upload']['error'] > 0){ // if there are nog errors with the uploaded file.
            $errors[] = 'Er iets mis gegaan tijdens het uploaden.'; // set errors array with an error.
        }
        if($_FILES['file_upload']['type'] != 'image/png' && $_FILES['file_upload']['type']!= 'image/jpeg'){ // if file type if not png/jpg/jpeg.
            $errors[] = 'Dit bestand wordt niet ondersteund.'; // set errors array with an error.
        }

        if($_FILES['file_upload']['size'] > 1000000){ // if img size is bigger than 1000kb.
            $errors[] = 'Dit bestand is te groot kies een kleiner bestand.'; // set errors array with an error.
        }
        if(empty($errors)) { // if no errors are set.
            if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $dir . $full_file_name)) { // move temp file to target directory.
                if(update_homepage_image("./images/".$full_file_name,$_GET["id"])){ // update database.
                    $success[] = "De abeelding is geupload en bijgewerkt."; // set success array.
                }
            }
        }

    }
}
elseif(!isset($_GET["id"])){ // if page id is not set
    header('location: ./homepages_overview.php'); // redirect to homepage overview page.
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ADMIN HEADER -->
    <?php include 'include/head.php'; ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- CKEDITOR -->
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

            <?php if(isset($errors)): // if any errors are set ?>
                <div class="alert alert-danger">
                    <strong>Let Op! Er is iets fout gegaan.</strong>
                    <?php foreach($errors as $error): //for each error create new list line. ?>
                    <li><?= $error // echo the error. ?></li>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if(isset($success)): // if succes array is set.?>
                <div class="alert alert-success">
                    <strong>Succes!</strong>
                    <?php foreach($success as $a): // for each error create new list line ?>
                    <li><?= $a // echo the success text. ?></li>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <div class="modal fade" id="upload-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Uploaden afbeelding</h3>
                        </div>
                        <form method='post' enctype='multipart/form-data' action=''>
                            <div class="modal-body">
                                Bestand: <input type='file' name='file_upload' accept="image/*">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                                <input type='submit' class="btn btn-primary" name="submit-image" value="Afbeelding uploaden en opslaan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <form method="post">
                <!-- header -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="thumbnail">
                        <img src="../<?= $page_info["homepage_header_image"];?>" class="image-responsive" width="100%">
                            <div class="caption">
                                <a href="#" data-href="page_delete.php?id=<?= $page_info["page_id"] ?>" class="btn btn-primary" data-toggle="modal" data-target="#upload-image" >Nieuwe afbeelding</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="homepage_header_title">Header titel</label>
                            <input type="text" class="form-control" id="homepage_header_title" name="homepage_header_title" placeholder="Header Titel" value="<?= $page_info["homepage_header_title"]; ?>">
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
                                    <label for="s_1_header">Titel</label>
                                    <input type="text" class="form-control" id="s_1_header" name="s_1_header" placeholder="Header Titel" value="<?= $page_info["homepage_service_one_header"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="s_1_content">Inhoud tekst</label>
                                    <textarea class="form-control" id="s_1_content" name="s_1_content" rows="10" ><?= $page_info["homepage_service_one_content"] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="s_1_b_text">Knop tekst</label>
                                        <input type="text" class="form-control" id="s_1_b_text" name="s_1_b_text" value="<?= $page_info["homepage_service_one_button_text"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="s_1_b_link">Knop Link</label>
                                        <input type="text" class="form-control" id="s_1_b_link" name="s_1_b_link" value="<?= $page_info["homepage_header_button_link"]; ?>">
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
                                    <label for="s_2_header">Titel</label>
                                    <input type="text" class="form-control" id="s_2_header" name="s_2_header" placeholder="Header Titel" value="<?= $page_info["homepage_service_two_header"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="s_2_content">Inhoud tekst</label>
                                    <textarea class="form-control" name="s_2_content" id="s_2_content" rows="10" ><?= $page_info["homepage_service_two_content"] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="s_2_b_text">Knop tekst</label>
                                        <input type="text" class="form-control" id="s_2_b_text" name="s_2_b_text" value="<?= $page_info["homepage_service_two_button_text"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="s_2_b_link">Knop Link</label>
                                        <input type="text" class="form-control" id="s_2_b_link" name="s_2_b_link" value="<?= $page_info["homepage_header_button_link"]; ?>">
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
                                    <label for="s_3_header">Titel</label>
                                    <input type="text" class="form-control" id="s_3_header" name="s_3_header" value="<?= $page_info["homepage_service_three_header"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="s_3_content">Inhoud tekst</label>
                                    <textarea class="form-control" name="s_3_content" id="s_3_content" rows="10" ><?= $page_info["homepage_service_three_content"] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="s_3_b_text">Knop tekst</label>
                                        <input type="text" class="form-control" id="s_3_b_text" name="s_3_b_text" value="<?= $page_info["homepage_service_three_button_text"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="s_3_b_link">Knop Link</label>
                                        <input type="text" class="form-control" id="s_3_b_link" name="s_3_b_link" value="<?= $page_info["homepage_header_button_link"]; ?>">
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
    $('#upload-image').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
