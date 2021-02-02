<?php
session_start();
$czyKlient = $_POST['gridRadios'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$tresc = $_POST['message'];


for ($i = 0; $i <= strlen($tresc)-1; $i++) {
    if($tresc[$i]=='"'){
        $_SESSION['err_odpowiedz_t']='jest';
    }
  }

  if(isset($_SESSION['err_odpowiedz_t']))
  {
    $tresc="";
    $_SESSION['err_odpowiedz_t']='istnieje niedozwolony znak (") popraw go!';
    header('Location: /Apteka/kontakt.php');
  }

if(isset($czyKlient) && isset($imie) && isset($nazwisko) && isset($telefon) && isset($email) && isset($tresc)
 && $czyKlient!="" && $imie!="" && $nazwisko!="" && $telefon!="" && $email!="" && $tresc!="")
{
    require_once "baza.php";
    $db = new PDO($dsn, $db_user, $db_password);
    $zapytanie = $db->prepare("SELECT COUNT(*) FROM konta_pracownikow where rodzaj='Moderator'");
    $zapytanie->execute();
    $liczbalini = $zapytanie->fetchColumn();
    $sql="SELECT * FROM konta_pracownikow where rodzaj='Moderator'";
    $random = rand(0,$liczbalini-1);
    $licznik=0;
    foreach($db->query($sql) as $row) {
        $wylosowane_id_moderatora = $row["id"];
        if($random==$licznik){break;}
        $licznik=$licznik+1;
    }
    $sql = "INSERT INTO wiadomosci(imie,nazwisko,telefon,email,klient,tresc,id_moderatora)
        VALUES ('$imie','$nazwisko','$telefon','$email','$klient','$tresc','$wylosowane_id_moderatora')";
    $db->exec($sql);
    $_SESSION['passKontakt']="Wiadomość została wysłana!";

}else
{
    if(!isset($_SESSION['err_odpowiedz_t']))
    $_SESSION['errKontakt']="Wprowadź wszystkie dane !";
}
header('Location: /Apteka/kontakt.php');
?>
