<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'kdrive');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
$connx = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($connx === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
try{
  $connx = new PDO("mysql:host=localhost;dbname=kdrive","root",'');
  //On définit le mode d'erreur de PDO sur Exception
  $connx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //$conn = new PDO("mysql:host=localhost;dbname=kdrive","root",'');
  //On définit le mode d'erreur de PDO sur Exception
 // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connexion réussie';
}

/*On capture les exceptions si une exception est lancée et on affiche
 *les informations relatives à celle-ci*/
catch(PDOException $e){
  echo "Erreur : " . $e->getMessage();
}
function log_recorder($message){
  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $timestamp=time();
  $id=time();
  $messages=$message;
  $result8 = ('INSERT INTO `acivity_log`(`id_act`, `id_users`, `action`, `timestamp`) VALUES  ("'.$timestamp.'","'.$id.'", "'.$messages.'", "'.$timestamp.'")');
  $result8 = $conn->prepare($result8);
  $result8 -> execute();
  return $messages;
}
$url_home="index.php";
?>