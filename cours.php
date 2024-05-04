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
$st=('SELECT * FROM `stucture` WHERE id_user="'.$id.'" and upgrade=2') ;
$st= $connx->prepare($st);
$st->execute(); 
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Courses -Kdrive</title>
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
                </span> Gestion des cours 
                
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>
                    <form method="GET" action="#" class="form">
                        <label> Veuillez choisir votre etablissement pour commencer</label>
                        <select name="structure" class="btn">
                            <option value="none">Structure</option>
                                <?php 
                                    
                                    while($data=$st->fetch()){
                                ?>
                                <option value="<?php echo $data['id_struc'];?>"><?php echo $data['raison_sociale'];?></option>
                                <?php 
                                    } 
                                    $cpt=$st->fetch();
                                    if($cpt<0){
                                        ?>
                                        <option value="none">Non activé</option>
                                    <?php
                                    }
                                ?>
                        </select>
                        <button type="submit" class="btn btn-info"><i class="mdi mdi-send"></i></button>
                    </form> 
                    <?php if(isset($_GET['structure']) and $_GET['structure']!="none"){ ?>
                 <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>Vous avez choisis "<?php echo $_GET['structure']?>" pour ajouter des cours
                    <?php } ?>
                  </li>
                </ul>
              </nav>
            </div>
            <a href="index.php" class="btn btn-danger" style="float:right;"><i class="mdi mdi-arrow-left"></i></a>
            
            <div class="row">
              <?php
              if(isset($_POST['title'],$_POST['coef']) and $_POST['coef']!=0){
                $stru=$_GET['structure'];
                $cours=$_POST['title'];
                $coef=$_POST['coef'];
                $level=$_POST['level'];
                $classe=$_POST['classe'];
                $pu=$_POST['pu'];
                $i=time();
                $requette=('INSERT INTO `cours`(`id`, `intitule`, `description`, `titulaire`, `coef`, `niveau`, `classe`, `department`, `hours`, `prix_u`, `id_struc`, `timestamp`) VALUES("'.$i.'","'.$cours.'","'.$cours.'","","'.$coef.'","'.$level.'","'.$classe.'","","'.$pu.'",1000,"'.$stru.'","'.$i.'")');
                $requette=$connx->prepare($requette);
                if($requette->execute()){
                  echo"<b class=\"btn btn-success\"><iclass=\"mdi mdi-infos\"></i>Le cours a été crée avec success</b>";
                }
              } 
              ?>
         
                      
              <form method="POST" action="#" >
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title"><i class="mdi mdi-pill"></i>Formulaire de creation de cours </h4>
                    <p class="card-description"> <img src="kdrive.jpg" width="150" style="border-radius:5px;"/></p></center>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@<?php echo $_SESSION['userid']; ?></span>
                        </div>
                        <input type="text" class="form-control" placeholder="<?php echo $_SESSION['username']; ?>/courses" aria-label="Username" aria-describedby="basic-addon1" readonly />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-gradient-primary text-white">Intitulé du cours</span>
                        </div>
                        <input type="text" class="form-control" name="title" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                          <span class="input-group-text"><?php echo date('Y');?></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Coef</span>
                        </div>
                        <div class="input-group-prepend">
                          <span class="input-group-text">0.0</span>
                        </div>
                        <input type="text" class="form-control" name="coef"aria-label="Amount (to the nearest dollar)">
                      </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Niveau</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="level">
                                <option value="primaire">Primaire</option>
                                <option value="secondaire">Secondaire</option>
                                <option value="superieure">Supérieure</option>
                                <option value="professionnel">Professionnel</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Classe</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="classe">
                                <option value="6" >6 ieme</option>
                                <option value="5">5 ieme</option>
                                <option value="4" >4 ieme</option>
                                <option value="3" >3 ieme</option>
                                <option value="2" >2 nd A/C/D/TI</option>
                                <option value="1" >Premiére A/C/D/TI</option>
                                <option value="0" >Terminale A/C/D/TI</option>
                                <option value="LI" >Niveau 1</option>
                                <option value="LII" >Niveau 2 / BTS /DUT /CQP</option>
                                <option value="LIII" >Niveau 3 PRO/LMD</option>
                                <option value="MI" >Master I</option>
                                <option value="MII" >Master II</option>
                                <option value="PHD" >Phd</option>
                              </select>
                            </div>
                          </div>
                        </div>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="pu"placeholder="Nombre d'heures par cours" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-facebook" type="submit">
                            <i class="mdi  mdi-send"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    </form>
                <div class="dropdown-divider"></div>
              <div class="">
              <?php
              if(isset($_GET['nom_f'],$_GET['cours'],$_GET['structure']) and $_GET['nom_f']!=" "){
                $st=$_GET['structure'];
                $cours=$_GET['cours'];
                $nom=$_GET['nom_f'];
                $objectif=$_GET['OB'];
                $pu=$_GET['pu'];
                $i=time();
                $requette=('UPDATE `cours` SET `titulaire`="'.$nom.'",`objectif`="'.$objectif.'",`prix_u`="'.$pu.'", id_struc="'.$st.'" WHERE intitule="'.$cours.'" ');
                $requette=$connx->prepare($requette);
                if($requette->execute()){
                  echo"<b class=\"btn btn-success\"><iclass=\"mdi mdi-infos\"></i>Le cours a été attribué avec success</b>";
                }
              } 
              ?>
              <form action="" method="GET">
                  <div class="card-body">
                    <center><h4 class="card-title"><i class="mdi mdi-pill"></i>Formulaire d'attribution de cours </h4>
                    <p class="card-description"> <img src="kdrive.jpg" width="150" style="border-radius:5px;"/></p></center>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@Formateur </span>
                        </div>
                     
                        <select name="nom_f" class="form-control">
                          <option value=" "> nom du formateur</option>
                        <?php 
                        $dt=('SELECT * FROM formateur');
                        $dt=$connx->prepare($dt); 
                        $dt->execute();
                          while($dts=$dt->fetch()){
                            
                        ?>
                        <option value="<?php echo $dts['nom']?>" class="form-control" > <?php echo $dts['nom']?></option>
                        <?php 
                          } 
                          ?>
                          </select>
                          <div class="input-group-prepend">
                          <span class="input-group-text">Structure </span>
                        </div>
                          <select name="structure" class="btn">
                            <option value="none">Structure</option>
                                <?php 
                                   $st=('SELECT * FROM `stucture` WHERE id_user="'.$id.'" and upgrade=2') ;
                                   $st= $connx->prepare($st);
                                   $st->execute();
                                    while($data=$st->fetch()){
                                ?>
                                <option value="<?php echo $data['raison_sociale'];?>"><?php echo $data['raison_sociale'];?></option>
                                <?php 
                                    } 
                                    $cpt=$st->fetch();
                                    if($cpt<0){
                                        ?>
                                        <option value="none">Non activé</option>
                                    <?php
                                    }
                                ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-gradient-primary text-white">Cours</span>
                        </div>
                        <select name="cours" class="form-control">
                          <option value=' '>cours</option>
                        <?php 
                        $dt=('SELECT * FROM cours');
                        $dt=$connx->prepare($dt); 
                        $dt->execute();
                          while($dts=$dt->fetch()){
                            
                        ?>
                        <option value="<?php echo $dts['intitule']?>" class="form-control" > <?php echo $dts['intitule']?></option>
                        <?php 
                          } 
                          ?>
                          </select>
                        <div class="input-group-append">
                          <span class="input-group-text">veuillez selectionnez un cours </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Objectif</span>
                        </div>
                        <div class="input-group-prepend">
                          <span class="input-group-text">du Cours</span>
                        </div>
                        <input type="text" name="OB" class="form-control" aria-label="Amount (to the nearest dollar)">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="pu" placeholder="Prix Unitaire de l'heure" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-facebook" type="submit">
                            <i class="mdi  mdi-send"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Liste des Matieres (Unités enseignements)</h4>
                    <p class="card-description"> Ajouter <code>Une Matiéres</code>
                    </p>
                    <?php
                      $data=('SELECT * FROM cours');
                      $data= $connx->prepare($data);
                      $data->execute(); 
                      if(isset($_GET['act'])){
                        $id=$_GET['act'];
                        $query=('UPDATE `stucture` SET `upgrade`=2 WHERE id_user="'.$_SESSION['userid'].'" and id_struc="'.$id.'"');
                        $query=$connx->prepare($query);
                        if($query->execute()){echo"<b class=\" btn btn-success\"><i class=\"mdi mdi-infos\"></i>Structure activé avec success</b>";}
                      }
                      if(isset($_GET['edit'])){
                        $id=$_GET['edit'];
                        $query=('UPDATE `stucture` SET `upgrade`=0 WHERE id_user="'.$_SESSION['userid'].'" and id_struc="'.$id.'"');
                        $query=$connx->prepare($query);
                        if($query->execute()){echo"<b class=\" btn btn-info\"><i class=\"mdi mdi-infos\"></i>Structure désactivé avec success</b>";}
                      }
                    ?>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> ID # </th>
                          <th> Intitulé  </th>
                          <th> Titulaire </th>
                          <th> Classe</th>
                          <th> Niveau </th>
                          <?php if($dn['grade']==1){ ?>
                          <th> Action </th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($donne=$data->fetch()){
                          ?>
                        <tr>
                          <td> <?php echo $donne['id']; ?> </td>
                          <td> <b class="text text-capitalize"> <?php echo $donne['intitule']; ?></b></td>
                          <td>
                          M./Mme.&nbsp;<?php echo $donne['titulaire']; ?>
                          </td>
                          <td> <?php echo $donne['classe']; ?></td>
                          <td>
                            <?php
                            switch($donne['niveau']) {
                              case 0:
                                echo "Tle";
                                break;
                              case 1:
                                  echo "Premiére";
                                break;
                              case 2:
                                  echo "Seconde";
                                break;
                              case 3:
                                  echo "3 ieme";
                                break;
                              case 4:
                                  echo "4 ieme";
                                break;
                              case 5:
                                  echo "5 ieme";
                                break;
                              case 6:
                                  echo "6 ieme";
                                break;
                              case "LI":
                                  echo "Niveau 1";
                                break;
                              case "LII":
                                  echo "Niveau 2";
                                break;
                              case "LIII":
                                  echo "Niveau 3";
                                break;
                              case "MI":
                                  echo "Master 1";
                                break;
                              case "MII":
                                  echo "Master2";
                                break;
                              case "PHD":
                                  echo "Doctorat";
                                break;
                              default:
                                echo $donne['niveau'];
                              break;
                            }
                            ?>
                          </td>
                          <td><a href="?act=<?php echo $donne['id'];?>"><i class="mdi mdi-check" ></i></a><a href="?delete=<?php echo $donne['id'];?>"><i class="mdi mdi-close" ></i></a><a href="?edit=<?php echo $donne['id'];?>"><i class="mdi mdi-pencil" ></i></a></td>
                        </tr>
                        <?php 
                        } 
                        ?>
                      
                      </tbody>
                    </table>
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