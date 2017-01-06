<!DOCTYPE html>
<?php
include 'admin/classes/Database.php';
$db = new Database();
session_start();

$db->query('SELECT * FROM content_page WHERE page_id=:id');
$db->bind(':id', $_GET['id']);
$page_info = $db->single();

if($page_info["page_type"] == 1){
    $_SESSION['service'] = 1; // drukservice
}elseif($page_info["page_type"] == 2){
    $_SESSION['service'] = 2; // computerservice
}

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>hompage</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/small-business.css" rel="stylesheet">
    <!--- theme --->
    <?php if($_SESSION['service'] == 2) echo "<link href='css/hardware.css' rel='stylesheet'>" ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-89317406-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>

<body>

<?php include 'include/menu.php';?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <h1 class="page-header"><?= $page_info["page_title"] ?></h1>
        <?= $page_info["page_content"] ?>
    </div>
    <!-- /.row -->

    <!-- Footer -->
    <footer>
        <?php include 'include/footer.php';?>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
