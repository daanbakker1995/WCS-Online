<?php
/**
 * The menu for the admin panel.
 * reminder: This file is beeing includes so don't make paths from this file.
 */

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">WCS-Online</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION["email"]; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li <?php if($active == "Dashboard") echo "class='active'" ?>>
                <a href="./"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li <?php if($active == "Informatie") echo "class='active'" ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#pages"><i class="fa fa-fw fa-list"></i> Pagina's<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="pages" class="collapse">
                    <li>
                        <a href="homepages_overview.php" >Homepagina's</a>
                    </li>
                    <li>
                        <a href="pages_overview.php" >Informatiepagina's</a>
                    </li>
                </ul>
            </li>
            <li <?php if($active == "Factuur") echo "class='active'" ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#quotation"><i class="fa fa-fw fa-file-o"></i> Offertes overzicht<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="quotation" class="collapse">
                    <li>
                        <a href="quotation_request_overview.php">Aanvragen</a>
                    </li>
                    <li>
                        <a href="quotation_overview.php">Offertes</a>
                    </li>
                    <li>
                        <a href="invoice_overview.php">facturen</a>
                    </li>
                    <li>
                            <a href="quotation_archive_overview.php">Archief</a>
                    </li>
                </ul>
            </li>
            <li <?php if($active == "Catalogus") echo "class='active'" ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#products"><i class="fa fa-fw fa-laptop"></i> Hardware catalogus<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="products" class="collapse">
                    <li>
                        <a href="product_overview.php">Overzicht</a>
                    </li>
                </ul>
            </li>
            <li <?php if ($active == "Copyservice") echo "class='active'" ?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#drukservice"><i class="fa fa-fw fa-laptop"></i> Drukservice<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drukservice" class="collapse">
                    <li>
                        <a href="drukservice_overview.php">Overzicht</a>
                    </li>
                </ul>
            </li>            
            <li>
                <a href="../"><i class="fa fa-fw fa-sign-out"></i> Naar Website</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
