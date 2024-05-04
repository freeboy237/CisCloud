<!DOCTYPE html>
<?php
require('config.php');
session_start();
    if(isset($_SESSION['username'])){

        try{
            $connxx = new PDO("mysql:host=localhost;dbname=kdrive","root",'');
            //On définit le mode d'erreur de PDO sur Exception
            $connxx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // echo 'connxexion réussie';
        }
        
        /*On capture les exceptions si une exception est lancée et on affiche
         *les informations relatives à celle-ci*/
        catch(PDOException $e){
          echo "Erreur : " . $e->getMessage();
        }
        $res = ("SELECT DISTINCT ip FROM usersonline");
          $res = $connxx->prepare($res);
          $res->execute();
          $online=0;
          while( $res->fetch() ){
            $online = $online + 1;
          }
          
        //compteur de connecter 
        $id=$_SESSION['userid'];
          $ip = $_SERVER['REMOTE_ADDR'];
          $where = $_SERVER['REQUEST_URI'];
          $timestamp = time();
           //log activity stored
          
           //end logs
          $timeout = 300;
          $noofrows = 0;
          $result1 = ("SELECT * FROM usersonline");
          $result1 = $connxx ->prepare($result1);
          $result1 ->execute();
          while ($result2 = $result1 ->fetch()) {
            if ($result2[1] == $ip) {
              $noofrows = 1;
            }
          }
          if ($noofrows == 1) {
            $cpt=("UPDATE usersonline SET timestamp = '$timestamp', url = '$where' WHERE ip = '$ip'");
            $cpt = $connxx ->prepare($cpt);
             $cpt ->execute();
          }
          $username=$_SESSION['username'];
          if ($noofrows == 0) {
            $result5 = ("INSERT INTO usersonline (ip, id_user, timestamp, url) VALUES ('$ip','$username', '$timestamp', '$where')");
             $result5 = $connx -> prepare($result5);
             $result5 -> execute();
          }
          
          $alt = $timestamp-$timeout;
          $result4 = ("DELETE FROM usersonline WHERE timestamp < '$alt'");
          $result4 = $connx->prepare($result4);
          $result4 ->execute();
          
         
          if ($online == 1) {
           //echo "$online user online";
          } else {
        //  echo "$online users online";
          }
        // on recupere les informations du users 
        $req='SELECT * from users where nom="'.$_SESSION['username'].'"';
		$req = $connxx->prepare($req);
		$req->execute();
		$dn = $req-> fetch();
        //On compte le nombre de nouveaux messages que lutilisateur a
$nb_new_pm =('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"');
$nb_new_pm = $connxx->prepare($nb_new_pm);
$nb_new_pm->execute();
$nb_new_pm = $nb_new_pm -> fetch();
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Post-Kdrive</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="kdrive.jpg" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Bienvenue sur la platforme kdrive</p>
               </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white">kdrive</i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php"><img src="kdrive.jpg" alt="logo" style="border-radius:45px;"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="pages/samples/avatar/<?php echo $dn['avatar'];?>" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $_SESSION['username'];?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="activity_log.php">
                  <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['userid']; ?>">
                  <i class="mdi mdi mdi-format-list-bulleted-type me-2 text-dark"></i> Profil </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="pages/samples/list_pm.php">
                  <i class="mdi mdi mdi mdi-gmail me-2 text-dark"></i> Messages </a>
                  <div class="dropdown-divider"></div>
                  <?php
                    if($dn['grade']==1){
                   ?>
                   <a class="dropdown-item" href="#">
                  <i class="mdi mdi mdi-google-circles me-2 text-info"></i> administration </a>
                  <div class="dropdown-divider"></div>
                   <?php     
                    }
                  ?>
                <a class="dropdown-item" href="pages/samples/login.php">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <?php
                 if($nb_new_pm['nb_new_pm']>0 ){
                  ?>
                  <span class="count-symbol bg-warning"></span>
                  <?php
                }?>
                
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages (<?php echo $nb_new_pm['nb_new_pm']?>)</h6>
                <div class="dropdown-divider"></div>
                
                  <?php
                  $nb_pm1 = ('select * from pm where user1="'.$id.'" limit 5');
                  $nb_pm1 = $connxx->prepare($nb_pm1);
                  $nb_pm1->execute();
                 // $sql = "SELECT * FROM users WHERE id = ?";
                //  $ps = $conn->prepare($sql);
                  ?>
                  <?php
//On affiche la liste des messages non-lus
while($dn1 = $nb_pm1 -> fetch())
{
          //$id2=$dn1['user2'];
					//$ps->execute([$id2]);
			  	//$p = $ps->fetch();
?>
     <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/logo-mini.svg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $dn1['user2']; ?> <?php echo $dn1['title']; ?></h6>
                    <p class="text-gray mb-0"> <?php echo date('d/m/Y H:i:s' ,$dn1['timestamp']); ?></p>
                  </div>
                </a>
<?php

}
$conn -> close();
?>
                  
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center"><?php echo $nb_new_pm['nb_new_pm']?> new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="pages/samples/login.php">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="pages/samples/avatar/<?php echo $dn['avatar'];?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION['username']?></span>
                  <span class="text-secondary text-small">KD-<?php echo $_SESSION['userid']?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="menu-title">Tableau de bord</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">kDrive Services</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-arrow-down-drop-circle"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/access.php">Premium Access</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/access.php">Gold Access</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/icons/mdi.html">
                <span class="menu-title">Compte</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Configuration</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Données et Statistique </span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">gestionnaire de tache</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">kDrive for e-school</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Professionnel </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/forms/primary_school.php"> Primaire </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Secondaire </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html">Superieure</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Autres </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Processus</h6>
                </div>
                <a href="new_categories.php" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Ajouter un Pro...</a>
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="list-star  mt-8">
                    <li>Professionnel</li>
                    <li>Académique<mark class="text-success">En cours</mark></li>
                  </ul>
                </div>
              </span>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-cash-multiple"></i>
                </span> Compte Principale
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Aperçu de vos Opérations  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Dépense par semaine <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">CFA 15,0000</h2>
                    <h6 class="card-text">augmentation 60%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Dépot hebdomadaire  <i class="mdi mdi-cash mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">45,6334 </h2>
                    <h6 class="card-text">Diminution 10%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Solde Courant  <i class="mdi mdi-cash-usd mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $online; ?></h2>
                    <h6 class="card-text">augmentation 5<?php echo $online; ?>% </h6>
                  </div>
                </div>
              </div>
            </div>
            <?php 
                if(isset($_POST['title'],$_POST['description'])){
                    $title=$_POST['title'];
                    $title.='<hr>';
                    $title.=$_POST['description'];
                    $content=$_POST['content'];
                    $public=$_POST['public'];
                    $id=time();
                    if ($_FILES['image']['error']) {
                        switch ($_FILES['mon_fichier']['error']){
                          case 1: // UPLOAD_ERR_INI_SIZE
                            echo "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                            break;
                          case 2: // UPLOAD_ERR_FORM_SIZE
                            echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                            break;
                          case 3: // UPLOAD_ERR_PARTIAL
                            echo "L'envoi du fichier a été interrompu pendant le transfert !";
                            break;
                          case 4: // UPLOAD_ERR_NO_FILE
                            echo "Le fichier que vous avez envoyé a une taille nulle !";
                            break;
                        }
                    }else{
                        $nomf = $_FILES['image']['name'];
                        $nomdestination = './upload_file/file.jpg';
                        move_uploaded_file($_FILES["image"]["tmp_name"], "upload_file/" . $_FILES["image"]["name"]);
                      }
                      if ($_FILES['file']['error']) {
                        switch ($_FILES['mon_fichier']['error']){
                          case 1: // UPLOAD_ERR_INI_SIZE
                            echo "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                            break;
                          case 2: // UPLOAD_ERR_FORM_SIZE
                            echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                            break;
                          case 3: // UPLOAD_ERR_PARTIAL
                            echo "L'envoi du fichier a été interrompu pendant le transfert !";
                            break;
                          case 4: // UPLOAD_ERR_NO_FILE
                            echo "Le fichier que vous avez envoyé a une taille nulle !";
                            break;
                        }
                    }else{
                        $nom_f = $_FILES['file']['name'];
                        $nomdestination = './upload_doc/file.jpg';
                        move_uploaded_file($_FILES["file"]["tmp_name"], "upload_doc/" . $_FILES["file"]["name"]);
                      }  
                    if(isset($_SESSION['username'])){
                    $stmt=('INSERT INTO `publication`(`id_post`, `files`, `description`, `like`, `id_users`, `comments`,`public`, `timestamp`) VALUES("'.$id.'","'.$nom_f.'","'.$title.'","'.$nomf.'", "'.$_SESSION['userid'].'","'.$content.'","'.$public.'","'.$id.'" )');
                        $stmt = $connx -> prepare($stmt);
                        $query=('INSERT INTO `notification`(`id_notif`, `description`, `id_users`, `status`, `title`, `timestamp`) VALUES ("'.$id.'","New Post","'.$_SESSION['userid'].'",1,"PS","'.$id.'")');
                        $query=$connx->prepare($query);
                        $query->execute();
                        if($stmt->execute()){
                            $messages="<b class=\"btn btn-success\">Opérations effectuées avec success Toutes les option disponibles dans les parametres </b>";
                        }else{
                            $messages="<b class=\"btn btn-danger\">Une erreur est surve lors de l'envoie</b>";
                        }
                    }else{
                    $messages="<b class=\"btn btn-danger\">Désolé mais les mots de passe ne corespondent pas !</b>";
                    }
                   }
                   if(isset($messages)){
                    echo $messages;
                   }
            ?>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <center><h4 class="card-title">Nouvelle Publication </h4>
                    <p class="card-description"> <img src="assets/images/logo.png" width="150px" style="border-radius:15px;"/></p></center>
                    <form class="forms-sample" style="font-weight:bold;" method="POST" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Titre</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Titre" name="title">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Description</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Poste" name="description">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Contenu</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="content">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Images </label>
                        <input type="file" class="form-control" id="exampleInputPassword1" placeholder="fiel" name="image">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Fichier</label>
                        <input type="file" class="form-control" id="exampleInputConfirmPassword1" placeholder="file" name="file">
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="public" checked value="yes"> Public </label><i class="mdi mdi-file-tree"></i>
                      </div>
                      <button type="submit" class="btn btn-gradient-danger me-2">Envoyer</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                  </div>
              </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright ©kdrive.com 2024</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">  <a href="" target="_blank">kdrive admin template</a> from kdrive.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<?php
}else{
?>

    <meta http-equiv="refresh" content="0;url=pages/samples/login.html">
<?php
}
?>