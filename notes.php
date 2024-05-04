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
?>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kdrive access activation</title>
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
      <!-- partial:../../partials/_navbar.html -->
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
                    <img src="pages/samples/avatar/<?php echo $ps['avatar'];?>" alt="image" class="profile-pic">
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
                <span class="menu-title">kDrive Services</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-arrow-down-drop-circle text-info"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <i class="mdi mdi-pokeball"></i><a class="nav-link" href="pages/ui-features/access.php">Premium Access</a></li>
                  <li class="nav-item"> <i class="mdi mdi-pokeball"></i><a class="nav-link" href="pages/ui-features/access.php">Gold Access</a></li>
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
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">gestionnaire de tache</span>
                <i class="mdi mdi-table-large menu-icon text-dark"></i>
              </a>
            </li>
            <?php if($dn['grade']==1 or $dn['grade']==4){ ?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">kDrive for e-school</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-settings-box menu-icon text-secondary"></i>
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
            <?php } ?>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Processus</h6>
                </div>
                <a href="new_categories.php" class="btn btn-block btn-lg btn-gradient-secondary mt-4">+ Ajouter un Pro...</a>
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
          <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Gestion des notes </h4>
                    <p class="card-description"> Choisir la <code>Matiére
                    </code>
                    </p>

                        <form method="GET" action="#" >
                        <code>veuillez choisir la structure dans laquelle vous aimeriez travailler aujourdhui  <?php echo date('d/m/Y');?>
                    </code>
                    <select name="structure" class="btn">
                            <option value="none">Structure</option>
                                <?php 
                                   $st=('SELECT * FROM `stucture` WHERE id_user="'.$id.'" and upgrade=2') ;
                                   $st= $connx->prepare($st);
                                   $st->execute();
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
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-facebook" type="submit">
                            <i class="mdi  mdi-send"></i>
                          </button>
                        </div>
                                </form>
                    
                    <?php
                    if(isset($_GET['structure'])){

                   
                      $data=('SELECT * FROM cours WHERE id_struc="'.$_GET['structure'].'"');
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
                          <th> Nom de l'apprenant </th>
                          <th> Note /20 </th>
                          <th> coeficient </th>
                          <th> Rang</th>
                          <?php if($dn['grade']==1){ ?>
                          <th> Action </th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($donne=$data->fetch()){
                              $mat=('SELECT * FROM notes WHERE id_cours="'.$donne['id'].'"');
                              $mat=$connx->prepare($mat);
                              $mat->execute();
                              $mats=$mat->fetch();
                              $tt=('SELECT * FROM students WHERE id_struc="'.$donne['id_struc'] .'" ');
                              $tt=$connx->prepare($tt);
                              $tt->execute();
                              $tt=$tt->fetch();
                          ?>
                        <tr>
                          <td> <?php echo $donne['intitule']; ?> </td>
                          <td>  <?php echo $tt['nom']; ?></td>
                          <td>
                          <?php echo $mats['note']; ?>
                          </td>
                          <td> <?php echo $donne['coef']; ?></td>
                          <td><?php echo date( 'm d,Y',$donne['timestamp']); ?></td>
                          <td><a href="?act=<?php echo $donne['id_struc'];?>"><i class="mdi mdi-check" ></i></a><a href="?delete=<?php echo $donne['id_struc'];?>"><i class="mdi mdi-close" ></i></a><a href="?edit=<?php echo $donne['id_struc'];?>"><i class="mdi mdi-pencil" ></i></a></td>
                        </tr>
                        <?php 
                        } 
                    }
                        ?>
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
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
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
  <?php } ?>
</html>