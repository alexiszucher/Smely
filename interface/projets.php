<?php 
  require 'Functions/projet.php';
  require 'Functions/rapport.php';

  if(isset($_GET['projet']))
  {
    $_SESSION['idProjet'] = $_GET['projet'];
    $_SESSION['libelleProjet'] = libelleProjet();
  }

  header("Content-Type: text/html; charset=utf-8");
  require 'header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $_SESSION['libelleProjet']; ?></h1>
            <button type="button" class="btn btn-primary"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp&nbspAjouter un projet</button>
          </div>

          <!-- Content Row -->
          <div class="row">
            </div>

            

          <!-- Content Row -->

          <div class="row">

           
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              

            </div>

            <div class="col-lg-12 mb-4">

            <!--Ajouter un rapport-->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un projet</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header"></div>
                        <a class="dropdown-item" href="?afficher_rapports=true">Afficher tous les rapports</a>
                        <!--<a class="dropdown-item" href="#">Another action</a>-->
                        <!--<div class="dropdown-divider"></div>-->
                        <!--<a class="dropdown-item" href="#">Something else here</a>-->
                      </div>
                    </div>
                  </div>
                <div class="card-body">
                  <div class="text-center">
                    <h4><b>Ajouter un projet</b></h4><br><br>
                  </div>
                  <form method="post">
                    <div class="form-group">
                      <input type="text" name="libelleProjet" class="form-control" id="exampleFormControlInput1" placeholder="Libellé du projet">
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                  </form>
              </div>
            </div>


            <!-- Message de succès création rapport -->
            <?php
              if(isset($_POST['libelleProjet']))
              {
                creationProjet($_POST['libelleProjet']);
              }
            ?>














  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="js/script.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
