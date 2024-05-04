<!DOCTYPE html>
<?php
include('config.php');
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
if($dn['grade']!=1 or $dn['grade']!=4){
  $url_home1="login/index.php";
  header('Location: '.$url_home1);
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home-Kdrive</title>
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
          <a class="navbar-brand brand-logo" href="index.php"><img src="kdrive.jpeg" alt="logo" style="border-radius:45px;width:500px; height:110px;"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/kdrive_mini.png" alt="logo" /></a>
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
                  <i class="mdi mdi-account-circle me-2 text-info"></i> Profil </a>
                  <div class="dropdown-divider"></div>
                   <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="setting.php">
                  <i class="mdi mdi mdi-wrench me-2 text-success"></i> Paramétre </a>
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
                  $nb_pm = ('select * from pm where user1="'.$id.'" limit 5');
                  $nb_pm= $connxx->prepare($nb_pm);
                  $nb_pm->execute();
                 // $sql = "SELECT * FROM users WHERE id = ?";
                //  $ps = $conn->prepare($sql);
                  ?>
                  <?php
//On affiche la liste des messages non-lus
while($dn1 = $nb_pm-> fetch())
{
          $id2=$dn1['user2'];
          $query=('SELECT * FROM users WHERE id="'.$id2.'"');
          $query=$connx->prepare($query);
					$query->execute();
			  	$ps = $query->fetch();
?>
     <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="pages/samples/avatar/<?php echo $ps['avatar']; ?>" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $ps['nom']; ?> <label  title="<?php echo $dn1['title']; ?>" ><i class="mdi mdi-message-text"></i> </label></h6>
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
                <?php $query=('SELECT * FROM notification WHERE id_users="'.$_SESSION['userid'].'" and  status=1 and title="LA"');
                      $query = $connx->prepare($query);
                      $query ->execute();
                      $query1=('SELECT * FROM notification WHERE id_users="'.$_SESSION['userid'].'" and  status=1 and title="PS"');
                      $query1 = $connx->prepare($query1);
                      $query1 ->execute();
                      $req=('UPDATE `notification` SET `status`=0 WHERE id_users="'.$_SESSION['userid'].'"');
                      $req =$connx->prepare($req);
                      $req->execute();
                      $query2=('SELECT * FROM notification WHERE id_users="'.$_SESSION['userid'].'" and  status=1 ');
                      $query2 = $connx->prepare($query2);
                      $cpt=$query2->fetch();
                      if($cpt>0){
                ?>
                <span class="count-symbol bg-danger"></span>
                <?php } ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <?php while($rep1=$query1->fetch()){?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Publication journaliere</h6>
                    <p class="text-gray ellipsis mb-0"> <?php echo $rep1['description']; ?> </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                  <?php } ?>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Parametre</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                  <?php while($rep=$query->fetch()){?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"><?php echo $rep['descripyion']; ?> </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                    <?php } ?>
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
                <i class="mdi mdi-home menu-icon text-success"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">CIS Formation</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-arrow-down-drop-circle text-info"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <i class="mdi mdi-pokeball"></i><a class="nav-link" href="pages/ui-features/access.php">CIS Formation</a></li>
                  <li class="nav-item"> <i class="mdi mdi-pokeball"></i><a class="nav-link" href="pages/ui-features/access.php">Cismed-Santé</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="account.php">
                <span class="menu-title">Compte</span>
                <i class="mdi mdi-contacts menu-icon text-warning"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Configuration</span>
                <i class="mdi mdi-format-list-bulleted menu-icon text-primary"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Données et Statistique </span>
                <i class="mdi mdi-chart-bar menu-icon text-danger"></i>
              </a>
            </li>
           <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Filieres</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-settings-box menu-icon text-secondary"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu sm" style="font-size:5px;">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Dept. Informatique et télecom </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/forms/primary_school.php"> Logistique, Import-export et Douane</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Gestion et Assistance de gestion </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html">Graphisme 2d/3d et Multimédias</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Délegué Médical </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Auxiliaire de Pharmacie </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html">Assistant en Cabinet Médical </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Agent Technique de Laboratoire</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Auxiliaire de vie </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Kinésithérapeute Assistant</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Assistant en Cabinet Dentaire</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Assistant Maternité</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Secrétaire Médicale</a></li>


                </ul>
              </div>
            </li>
            <?php if($dn['grade']==1 or $dn['grade']==4){ ?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">administration des Filieres</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-settings-box menu-icon text-secondary"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu sm" style="font-size:5px;">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Dept. Informatique et télecom </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/forms/primary_school.php"> Logistique, Import-export et Douane</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Gestion et Assistance de gestion </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html">Graphisme 2d/3d et Multimédias</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Délegué Médical </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Auxiliaire de Pharmacie </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html">Assistant en Cabinet Médical </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Agent Technique de Laboratoire</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Auxiliaire de vie </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Kinésithérapeute Assistant</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Assistant en Cabinet Dentaire</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Assistant Maternité</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Secrétaire Médicale</a></li>


                </ul>
              </div>
            </li>
            <?php } ?>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Processus</h6>
                </div>
                <a href="pages/forms/primary_school.php" class="btn btn-block btn-lg btn-gradient-info mt-4">+ Ajouter </a>
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
              <h3 class="page-title text-white">
                <span class="page-title-icon bg-gradient-success text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Tableau de bord
              </h3>
              <i class="text-white">Cameroon Institute of spécialisation build version 1.0.0.1</i>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active text-white" aria-current="page">
                    <span></span>Aperçu du tableau de bord  <i class="mdi mdi-alert-circle-outline icon-sm text-white align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-green-gradient card-img-holder text-white" style="">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Données par semaine <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">CFA 15,0000</h2>
                    <h6 class="card-text">augmentation 60%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card  bg-danger card-img-holder text-white" style="" >
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Achat par semaine  <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">45,6334 </h2>
                    <h6 class="card-text">Diminution 10%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-warning card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Visiteurs en ligne  <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $online; ?></h2>
                    <h6 class="card-text">augmentation 5<?php echo $online; ?>% </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left text-white"><i class="mdi mdi-firefox"></i>Médiathéque Numérique</h4>
                      <?php
if(isset($_SESSION['username']) or $dn['grade']==1 or $dn['grade']==4 )
{
?>
	<a href="new_categories.php" class="btn btn-info"><i class="mdi mdi-deviantart"></i>Nouvelle Catégorie</a>
<?php
}
?>
<table class="table table-hover " width="40">
	<tr>
    	<th class="forum_cat"><i class="mdi mdi-book-multiple"></i>Catégorie</th>
    	<th class="forum_ntop"><i class="mdi mdi-border-color"></i>Sujets</th>
    	<th class="forum_nrep"><i class="mdi mdi-calendar-check"></i>Réponses</th>
<?php
if(isset($_SESSION['username']) and $dn['grade']==1)
{
?>
    	<th class="forum_act"><i class="mdi mdi-calendar-plus"></i>Action</th>
<?php
}
?>
	</tr>
<?php
$dnne1 = ('select c.id, c.name, c.description, c.file, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
$dnne1 = $connx->prepare($dnne1);
$dnne1 -> execute();
$nb_cats = $dnne1 -> fetch();

while($dnn1 = $dnne1 ->fetch())
{
?>
	<tr>
    	<td style="font-size:10px;" ><a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="text-white text-capitalize" style="font-size:10px;font-weight:bold; text-decoration:none;"><i class="mdi mdi-cloud-upload icon-sm "></i>&nbsp;<?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <div class="text-capitalize text-dark"><a href="upload_file/<?php echo $dnn1['file'];?>" style="text-decoration:none;color:white;font-size:10px;"><i class="mdi  mdi-server"></i><?php echo $dnn1['description']; ?></a></div></td>
    	<td><b class="badge badge-info text-white"><?php echo $dnn1['topics']; ?></b></td>
    	<td><b class="badge badge-info text-white"><?php echo $dnn1['replies']; ?></b></td>
<?php
if(isset($_SESSION['username']) and $dn['grade']==1)
{
?>
    	<td class="text-white"><a href="delete_category.php?id=<?php echo $dnn1['id']; ?>"><i class="mdi mdi-window-close text-danger"></i></a>
		<?php if($dnn1['position']>1){ ?><a href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><i class="mdi mdi mdi-chevron-double-up text-info"></i></a><?php } ?>
		<?php if($dnn1['position']<$nb_cats){ ?><a href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><i class="mdi mdi mdi-chevron-double-down text-info"></i></a><?php } ?>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><i class="mdi mdi mdi-border-color text-dark"></i></a></td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
if(isset($_SESSION['username']) and $dn['grade']==1)
{
?>
<br/>
	<a href="new_categories.php" class="btn btn-info"><i class="mdi mdi-deviantart"></i>Nouvelle Catégorie</a>
<?php
}
?>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-white"><i class="mdi mdi-database"></i>Liste des établissements</h4>
                    <hr>
                    <?php
                    $i=0;
                     $req = ("SELECT * FROM stucture WHERE id_user='$id' ");
                     $req= $connxx ->prepare($req);
                     $req ->execute();

                     while($data=$req->fetch()){
                      $i=1;
                    ?>
                    <div class="card">
                                             
                    <a href="dashboard.php" class="btn btn-inverse-info text-dark"><?php echo $data['raison_sociale']?></a>
                  
                    </div>
                    <br/>
                    <div class="progress">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    
                    </div>
                    <br/>
                    <?php
if(isset($_SESSION['username']) and $dn['grade']==1)
{
?><center>
    	<a href="delete_category.php?id=<?php echo $stmts['id']; ?>" class="text-white"><i class="mdi mdi-window-close"></i></a>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>" class="text-white"><i class="mdi mdi mdi-border-color"></i></a>
</center>
<?php
}
?>
                    <hr>
                    <?php
                     }
                     if(!$i){
                      echo "aucune données pour l'instant...";
                     }
                    ?>
                 
                  </div>
                </div>
              </div>
            </div>
            <?php if($dn['grade']==1){ ?>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-white"><i class="mdi mdi-folder"></i>Listes des Apprenants</h4>
                    <div class="table-responsive">
                      <table class="table table-secondary">
                        <thead>
                          <tr>
                            <th> Nom </th>
                            <th> Prénom </th>
                            <th> Status </th>
                            <th> Derniere mise a jour </th>
                            <th> Tracking ID </th>
                            <?php if($dn['grade']==1){?>
                            <th> Action</th>
                            <?php }
                            ?>
                          </tr>
                        </thead>
                        <tbody>
                          
                            <?php 
                            $stmt=('SELECT * FROM students where id_struc="'.$_SESSION['userid'].'"order by id desc limit 5');
                            $stmt = $connx -> prepare($stmt);
                            $stmt -> execute();
                            while($stmts = $stmt->fetch()){

                          
                            ?>
                            <tr>
                            <td>
                              <img src="assets/images/faces-clipart/pic-4.png" class="me-2" alt="image"> <?php echo $stmts['nom'];?>
                            </td>
                            <td> <?php echo $stmts['prenom'];?></td>
                            <td>
                              <?php if($stmts['status']==0){ ?><label class="badge badge-gradient-danger">Non payées</label><?php }elseif($stmts['status']==1){?><label class="badge badge-gradient-warning">En cours de paiement</label> <?php }else{ ?> <label class="badge badge-gradient-success">Inscrit</label> <?php } ?>
                            </td>
                            <td> <?php echo date('m d, Y',$stmts['timestamp']);?></td>
                            <td><a href="inscription.php" class="badge badge-success" title="£$inscription..."> ID<?php echo $stmts['id'];?></a></td>
                         
                       
                       <?php
if(isset($_SESSION['username']) and $dn['grade']==1)
{
?>
    	<td><a href="delete_category.php?id=<?php echo $stmts['id']; ?>"><i class="mdi mdi-window-close"></i></a>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><i class="mdi mdi mdi-border-color"></i></a></td>
<?php
}
?>
   </tr>
                            <?php
                              } 
                            ?>
                          
                        </tbody>
                      </table>
                      </div><br/><br/>
                      <a href="list_students.php" class="btn btn-info"><i class="mdi mdi-table-large"></i>Tous les apprenants</a>
                      <a href="pages/forms/new_students.php" class="btn btn-gradient-info" style="float:right;"><i class="mdi mdi-database-plus"></i>Nouvelle Inscription Apprenant</a>        
                    </div>
                  
                  <?php if($dn['grade']==1 or $dn['grade']==4){?>
                   <b style="font-weight:bold; font-size:20;background-color:gray; border-radius:5px;">&nbsp;<br/><a  style="text-decoration:none;" href="view_students.php" class="badge badge-danger text-dark"><i class="mdi mdi-folder-outline"></i>Tous les Apprenant</a>
                  &nbsp;<a  style="text-decoration:none;" href="id_card.php" class="badge badge-info text-warning"><i class="mdi mdi-folder-outline"></i>Gestion des cartes d'access</a>
                  &nbsp; <a  style="text-decoration:none;" href="sonline.php" class="badge badge-dark text-white"><i class="mdi mdi-folder-outline"></i>Gestion des Presences</a>
                  &nbsp;<a style="text-decoration:none;"  href="report_cart.php" class="badge badge-secondary text-dark"><i class="mdi mdi-folder-outline"></i>Bulletin de notes </a>
                  &nbsp;<a style="text-decoration:none;"  href="cours.php" class="badge badge-secondary text-success"><i class="mdi mdi-folder-outline"></i>Gestion des cours </a>
                  &nbsp;<a style="text-decoration:none;"  href="notes.php" class="badge badge-info text-dark"><i class="mdi mdi-folder-outline"></i>Saisie des notes </a><br/><br/>
                  &nbsp;<a style="text-decoration:none;"  href="timestable.php" class="badge badge-secondary text-dark"><i class="mdi mdi-folder-outline"></i>Emploi de temp (TimesTable) </a><br/><br/></b>
                    <?php }?>
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card text-white">
                  <div class="card text-white" style="background-color:darkblue;">
                    <h4 class="card-title text-white">Publication Recente <span style="float:right;"><a href="new_post.php"><i class="mdi mdi-camera-iris"></i></a></span></h4>
                   <?php
                    $query=('SELECT * FROM publication order by timestamp desc limit 5');
                    $query = $connx ->prepare($query);
                    $query -> execute();
                    while($reponse=$query->fetch()){

                    $q=('SELECT * FROM users WHERE id="'.$reponse['id_users'].'"');
                    $q= $connx ->prepare($q);
                    $q->execute();
                    $qs=$q->fetch();
                    ?>
                    <hr><i class="mdi  mdi-flattr"></i>
                    <?php if($reponse['id_users']==$_SESSION['userid']){ ?>
                     <a href="edit_post.php"> <i class="mdi  mdi-glassdoor"></i></a>
                    <?php 
                    }
                    ?>
                    <div class="d-flex">
                      <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                        <i class="mdi mdi-account-outline icon-sm me-2"></i>
                        <span><?php if(isset($_SESSION['userid']) and $reponse['id_users']==$_SESSION['userid']){?>  <i class="mdi mdi-pencil  text-danger"></i><?php }?><?php echo $qs['nom'];?></span>
                      </div>
                      <div class="d-flex align-items-center text-muted font-weight-light">
                        <i class="mdi mdi-clock icon-sm me-2"></i>
                        <span><?php echo date('M d, Y',$reponse['timestamp']);?></span>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-6 pe-1">
                        <img src="upload_file/<?php echo $reponse['like']?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                        <img src="upload_file/<?php echo $reponse['like']?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                      </div>
                      <div class="col-6 ps-1">
                      <img src="upload_file/<?php echo $reponse['like']?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                      <img src="upload_file/<?php echo $reponse['like']?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                        
                        
                      </div>
                    </div>
                    <div class="d-flex mt-5 align-items-top">
                    

                      <img src="pages/samples/avatar/<?php echo $qs['avatar'] ?>" class="img-sm rounded-circle me-3" alt="image" style="float:left;">
                  
                      <div class="mb-0 flex-grow"><br/>
                      <b><?php echo $qs['nom'] ?></b><br/><br/>
                        <h5 class="me-2 mb-2"><?php echo $reponse['description'];?></h5>
                        <p class="mb-2 font-weight-light "><mark><?php echo $reponse['comments'];?>.</mark></p>
                      </div>
                      <div class="ms-auto"><a href="upload_doc/<?php echo $reponse['files']?>" class="btn btn-danger mb-4 mw-50 w-50 rounded" title="Download"><i class="mdi mdi-debug-step-into"></i></a>

                       <a href="?like=<?php echo $reponse['id_post']; ?>"> <i class="mdi mdi-heart text-info"></i></a>
                      </div>
                    </div>
                    <?php 
                  } 
                  $cpt=$query->fetch();
                  if($cpt<0){
                    echo "<b class=\"badge text-danger\">Aucune Publication pour l'instant</b>";
                  }
                
                  ?>
                  <br>
                  
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card text-white">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-white"><i class="mdi mdi mdi-folder-multiple-outline"></i>&nbsp;Liste du Pesonnele administratif</h4>
                    <div class="table-responsive text-white">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Spécialité </th>
                            <th> Téléphone</th>
                            <th> Due Date </th>
                            <th> Assignation</th>
                            <th> Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                           $stmt=('SELECT * FROM formateur WHERE id_struc="'.$_SESSION['userid'].'"');
                           $stmt= $connx->prepare($stmt);
                           $stmt ->execute();
                           $cpt = $stmt-> fetch();
                           $stmt=$stmt->fetch();
                         
                           if($cpt==0){
                              echo "<b class=\" btn text-warning\">Aucune données pour l'instant</b>";
                           }else{
                            $stmt=('SELECT * FROM formateur WHERE id_struc="'.$_SESSION['userid'].'"');
                           $stmt= $connx->prepare($stmt);
                           $stmt ->execute();
                            while($data=$stmt->fetch()){
                              
                          ?>
                          <tr style="font-weight:bold;text-color:white;" >
                            <td class="text-white" ><?php echo $data['id']; ?></td>
                            <td class="text-white" ><i class="mdi mdi-account text-white"></i> <?php echo $data['nom']; ?></td>
                            <td class="text-white" > <?php echo $data['specialite']; ?></td>
                            <td class="text-white" > <?php echo $data['tel']; ?></td>
                            <td class="text-white" ><?php echo date('M D, Y',$data['timestamp']); ?> </td>
                            <td class="text-white" >
                            <?php echo $data['assignation']; ?>
                            </td>
                            <td class="text-white" >
                            <?php echo $data['email']; ?>
                            </td>
                          </tr>
                          <?php
                          
                        }
                      }
                      ?>
                        </tbody>
                      </table>

                    </div>
                    <br/>
                    <a href="new_staff.php" class="btn btn-danger"><i class="mdi mdi-tune-vertical"></i>Ajouter</a>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card text-white">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-white"><i class="mdi mdi mdi-grease-pencil"></i>Planning Personnel </h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="De quoi avez vous besoin?">
                      <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Ajouter</button>
                    </div>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Reunion du personnel </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Appelé Frank </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Creation des factures </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Impression des requettes </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Preparation des cours  </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Prendre les enfants a l'ecole </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
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