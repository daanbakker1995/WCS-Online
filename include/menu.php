<?php
/**
 * Created by PhpStorm.
 * User: Daan
 * Date: 1-12-2016
 * Time: 10:24
 */
if(!isset($_SESSION["service"])){
    header('location: ./');
}

?>

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
                <?php if($_SESSION['service'] == 1){?>
                <li>
                    <a href="homepage.php?service=computerservice">naar computer service</a>
                </li>
                <?php }elseif($_SESSION['service'] == 2){?>
                <li>
                    <a href="homepage.php?service=drukservice">naar druk service</a>
                </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="./homepage.php">Home</a>
                </li>
                <?php
                if($_SESSION['service'] == 1) {?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informatie <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $session_active = 1; // copy
                            $db->query("select page_id, page_title, page_type, page_status, page_location from content_page");
                            $pages = $db->resultset();
                            foreach ($pages as $page) {
                                if($page["page_type"] == $_SESSION['service'] || $page["page_type"] == "0"){
                                    if($page["page_status"] == 1){
                                        if($page["page_location"] == 1){
                                            echo "<li><a href='information_page.php?id=". $page["page_id"] ."'>".$page["page_title"]."</a></li>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                    $db->query("select page_id, page_title, page_type, page_status, page_location from content_page");
                    $pages = $db->resultset();
                    foreach ($pages as $page) {
                        if($page["page_type"] == $_SESSION['service'] ||  $page["page_type"] == "0"){
                            if($page["page_status"] == 1){
                                if($page["page_location"] == 0){
                                    echo "<li><a href='information_page.php?id=". $page["page_id"] ."'>".$page["page_title"]."</a></li>";
                                }
                            }
                        }
                    }
                }
                elseif($_SESSION['service'] == 2) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Informatie <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $db->query("select page_id, page_title, page_type, page_status, page_location from content_page");
                            $pages = $db->resultset();
                            foreach ($pages as $page) {
                                if ($page["page_type"] == $_SESSION['service'] || $page["page_type"] == "0") {
                                    if ($page["page_status"] == 1) {
                                        if ($page["page_location"] == 1) {
                                            echo "<li><a href='information_page.php?id=". $page["page_id"] ."'>" . $page["page_title"] . "</a></li>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                    $db->query("select page_id, page_title, page_type, page_status, page_location from content_page");
                    $pages = $db->resultset();
                    foreach ($pages as $page) {
                        if ($page["page_type"] == $_SESSION['service'] || $page["page_type"] == "0") {
                            if ($page["page_status"] == 1) {
                                if ($page["page_location"] == 0) {
                                    echo "<li><a href='information_page.php?id=". $page["page_id"] ."'>" . $page["page_title"] . "</a></li>";
                                }
                            }
                        }
                    }
                }
                ?>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
