<!DOCTYPE html>


<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>hompage-copy</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/small-business.css" rel="stylesheet">
    <!--- theme --->
    <link href="css/small-business.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar  navbar-inverse header-color navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="images/logo.png" alt="">
            </a>
           
             
        </div> 
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav">
                <li>
                   <a href="homepage-hardware.php">naar computer service</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
           
    <!-- Heading Row -->
    <div class="row">
        <div class="col-md-8">
            <form method='post' enctype='multipart/form-data' action=''>
                File: <input type='file' name='file_upload'>
                <input type='submit' name="verzenden" value="verzenden">
            </form>
            
           <?php 
               if (!file_exists('offerte/')) {
                    mkdir('offerte/', 0777, true);
                }
                
                if(isset($_FILES["file_upload"])){
                    
    
                    
                    if($_FILES['file_upload']['error'] > 0){
                        die('Er iets mis gegaan tijdens het uploaden.');
                    }

                    if($_FILES['file_upload']['type'] != 'image/png' && $_FILES['file_upload']['type']!= 'image/jpeg'){
                        die('Dit bestand wordt niet ondersteund.');
                    }

                    if($_FILES['file_upload']['size'] > 500000){
                        die('Dit bestand is te groot kies een kleiner bestand.');
                    }

                    if(!move_uploaded_file($_FILES['file_upload']['tmp_name'], 'offerte/' . $_FILES['file_upload']['name'])){
                        die('Error uploading file - check destination is writeable.');
                    }

                   
                }
            ?>
        </div>
        <!-- /.col-md-8 -->
        <div class="col-md-4">

            <h1>uw image komt hier!☺</h1>
          <?php
               if(isset($_FILES["file_upload"])){
                     echo "<img width='250px' src='offerte/".$_FILES['file_upload']['name']."'";
                     
               }
             
          ?>
          
       
        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <hr>


   
    <!-- /.row -->

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website <?= date("Y")?></p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
