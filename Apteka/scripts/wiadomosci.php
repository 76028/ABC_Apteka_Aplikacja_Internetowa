<?php
session_start();
$decyzja =  $_POST['decyzja'];
$id=$_POST['id_wiadomosci'];
$email=$_POST['email'];
$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$wiadomosc = "Dzien dobry ".$imie." ".$nazwisko.",\n\n".$_POST['message']."\n\nZ wyrazami Szacunku,\nModerator ".$_SESSION['imie']." ".$_SESSION['nazwisko'];


for ($i = 0; $i <= strlen($wiadomosc)-1; $i++) {
  if($wiadomosc[$i]=='"'){
      $_SESSION['err_odpowiedz_w']='istnieje niedozwolony znak (") popraw go!';
  }
}


require_once "baza.php";
$db = new PDO($dsn, $db_user, $db_password);

if(isset($_SESSION['err_odpowiedz_w']))
{
  $decyzja="brak";
  header('Location: /Apteka/moderator.php');
}
else if($decyzja=="tak"){
    if( mail($email, "Support ABC APTEKA", $wiadomosc) ) {
      echo "Wiadomość wysłana!";
    } else {
      echo "Niepowodzenie!";
    }
    $sql = "delete from wiadomosci where id='$id'";
    $db->exec($sql);
    header('Location: /Apteka/moderator.php');
}
else if($decyzja=="nie")
{
    $sql = "delete from wiadomosci where id='$id'";
    $db->exec($sql);
    header('Location: /Apteka/moderator.php');
}?>