<?php
session_start();
//if($_SESSION["ingelogd"] == true){
//
//}
// else {
//       header('location: ./login.php');       
//}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- ADMIN HEADER -->
        <?php include 'include/head.php'; ?>

    </head>

    <body>

        <div id="wrapper">

            <!-- ADMIN MENU -->
            <?php
            $active = "Dashboard";
            include 'include/menu.php';
            ?>

            <div id="page-wrapper">
                <!--data opvragen
          <?php include 'classes/database.php';
            //$stmt = $pdo->prepare("SELECT user_id, user_name, user_email, user_type FROM user");
            //$stmt->execute();
           // $admins = $stmt->fetchAll();
           // foreach ($admins as $admin)
           // {
               // if ($admin["user_type"] == 1)
                {
                  //  $role = "Admin";
                }// elseif ($admin["user_type"] == 2)
                {
                   // $role = "Content Beheerder";
                }// else
                {
                   // $role = "Super Admin";
                }
                ?>
              <div class="row">
                  <div class="col-md-1">
                      <p>//<?php// print($admin["user_id"]); ?></p>
                  </div>
                  <div class="col-md-3">
                            <p>//<?php //print($admin["user_name"]); ?></p>                        
                        </div>
                        <div class="col-md-4">
                            <p>//<?php// print($admin["user_email"]); ?></p>
                        </div>
                        <div class="col-md-2">
                            <p>//<?php //print($role); ?></p>
                        </div>
                        <div class="col-md-2">
                            <button href="gebruiker-wijzigen.php?userid=//<?php// print($admin["user_id"]) ?>" class="btn btn-primary"></button>
                            <button/>
                        </div>
                    <?php //} ?>
                -->
                </div>
                <div class="container-fluid">
                    <div id="page-wrapper">
                        <form action="gebruiker-toegevoegd.php" method="post">
                            <div class="form-group">
                                <label for="user">Gebruikersnaam</label>
                                <input type="text" class="form-control" id="user" required name="user">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" required name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Wachtwoord</label>
                                <input type="password" class="form-control" id="pwd" required name="pwd">
                            </div>
                            <div class="form-group">
                                <label for="role">Rol</label>
                                <select class="form-control" id="role" required name="role">
                                    <option>Admin</option>
                                    <option>Content Beheerder</option>                                 
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="toevoegen"/>
                            </div>
                        </form>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            <script src="js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

            <!-- Morris Charts JavaScript -->
            <script src="js/plugins/morris/raphael.min.js"></script>
            <script src="js/plugins/morris/morris.min.js"></script>
            <script src="js/plugins/morris/morris-data.js"></script>

    </body>

</html>
