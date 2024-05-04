<!DOCTYPE html>

<?php
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
//Cette page permet d'ajouter une categorie
include('config.php');
session_start();
$req='SELECT * from users where nom="'.$_SESSION['username'].'"';
		$req = $connx->prepare($req);
		$req->execute();
		$dn = $req-> fetch();
        $nb_new_pm =('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"');
$nb_new_pm = $connxx->prepare($nb_new_pm);
$nb_new_pm->execute();
$nb_new_pm = $nb_new_pm -> fetch();
if(isset($_SESSION['username']) and $dn['grade']==1)
{
?>
<?php
//Cette page permet de modifier l'ordre des categories
if(isset($_GET['id'], $_GET['action']) and ($_GET['action']=='up' or $_GET['action']=='down'))
{
$id = intval($_GET['id']);
$action = $_GET['action'];
$dn1 = ('select count(c.id) as nb1, c.position, count(c2.id) as nb2 from categories as c, categories as c2 where c.id="'.$id.'" group by c.id');
$dn1 = $connx->prepare($dn1);
$dn1->execute();
$dn1 = $dn1->fetch();;
if($dn1['nb1']>0)
{
if(isset($_SESSION['username']) and $dn['grade']==1)
{
	if($action=='up')
	{
		if($dn1['position']>1)
		{
            
            $po = ('update categories as c, categories as c2 set c.position=c.position-1, c2.position=c2.position+1 where c.id="'.$id.'" and c2.position=c.position-1');
            $po = $connx->prepare($po);
			if($po->execute())
			{
				header('Location: '.$url_home);
			}
			else
			{
				echo 'Une erreur s\'est produite lors du déplacement de la catégorie.';
			}
		}
		else
		{
			echo '<h2>L\'action que vous désirez effectuer est impossible.</h2>';
		}
	}
	else
	{
		if($dn1['position']<$dn1['nb2'])
		{   
            $p = ('update categories as c, categories as c2 set c.position=c.position+1, c2.position=c2.position-1 where c.id="'.$id.'" and c2.position=c.position+1');
			$p= $connx->prepare($p);

            if($p->execute())
			{
				header('Location: '.$url_home);
			}
			else
			{
				echo 'Une erreur s\'est produite lors du déplacement de la catégorie.';
			}
		}
		else
		{
			echo '<h2>L\'action que vous désirez effectuer est impossible.</h2>';
		}
	}
}
else
{
	echo '<h2>Vous devez être connecté en tant qu\'administrateur pour accéder à cette page: <a href="login.php">Connexion</a> - <a href="signup.php">Inscription</a></h2>';
}
}
else
{
	echo '<h2>La catégorie que vous désirez déplacer n\'existe pas.</h2>';
}
}
else
{
	echo '<h2>L\'identifiant de la catégorie ou la direction du déplacement ne sont pas définis.</h2>';
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liste Sujet Kdrive</title>
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
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <?php
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = ('select count(id) as nb1, name, description from categories where id="'.$id.'" group by id');
$dn2 = ('select name, description from categories where id="'.$id.'" ');
$dn1 = $connx->prepare($dn1);
$dn2 = $connx->prepare($dn2);
$dn1->execute();
$dn2->execute();
$dn2 = $dn2->fetch();
$dn1=$dn1->fetch();
//$dn1=$dn1['nb1'];
if($dn1['nb1']>0)
{
if(isset($_SESSION['username']) and $dn['grade']==1)
{
?>
  </head>
  <body>
    <div class="container-scroller">
     <!-- partial:partials/_navbar.html -->
     <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="kdrive.jpg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
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
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi mdi-format-list-bulleted-type me-2 text-dark"></i> Parametre </a>
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
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
                </div>
              </span>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <?php
if(isset($_POST['name'], $_POST['description']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	
	$name = ($name);
	$description = ($description);
    $up=('update categories set name="'.$name.'", description="'.$description.'" where id="'.$id.'"');
    $up = $connx->prepare($up);
    
	if($up->execute())
	{
	?>
	<div class="message">La catégorie a bien été modifiée.<br />
	<a href="index.php">Retourner à l'acceuil</a></div>
	<?php
	}
	else
	{
		echo 'Une erreur s\'est produite lors de la modification de la catégorie.';
	}
}
else
{
?>
<form action="edit_category.php?id=<?php echo $id; ?>" method="post">
	<label for="name">Nom</label><input type="text" name="name" id="name" value="<?php echo $dn2['name']; ?>" /><br />
	<label for="description">Description</label>(html accepté)<br />
    <textarea name="description" id="description" cols="70" rows="6"><?php echo $dn2['description']; ?></textarea><br />
    <input type="submit" value="Modifier" />
</form>
<?php
}
}
}
?>

          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
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
  <?php
}
else
{
	echo '<h2>Vous devez être connecté en tant qu\'administrateur pour accéder à cette page: <a href="login.php">Connexion</a> - <a href="signup.php">Inscription</a></h2>';
}
}
?>
</html>