<?php
session_start();
    $nazwa=$_POST['nazwa'];
    $opis=$_POST['opis'];
    $cena=$_POST['cena'];

    $imagename = $_FILES['obrazek']['name'];
    $imagetype = $_FILES['obrazek']['type'];
    $imageerror = $_FILES['obrazek']['error'];
    $imagetemp = $_FILES['obrazek']['tmp_name'];
    $imagePath = "produkty/";



    for ($i = 0; $i <= strlen($opis)-1; $i++) {
        if($opis[$i]=='"'){
            $_SESSION['err_odpowiedz_a']='jest';
        }
      }

      if(isset($_SESSION['err_odpowiedz_a']))
      {
        $_SESSION['err_odpowiedz_a']='istnieje niedozwolony znak (") popraw go!';
        $imagetemp="null";
      }



    if(!isset($nazwa) || $nazwa=="" || !isset($opis) || $opis=="" || !isset($cena) || $cena==0){
        $_SESSION['err_produkt']="Wprowadz wszystkie dane !";

    }

    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath.$imagename)) {
            require_once "baza.php";
            $db = new PDO($dsn, $db_user, $db_password);
            $sql = "INSERT INTO Produkty(nazwa,opis,cena,obrazek)
            VALUES ('$nazwa','$opis','$cena','$imagename')";
            $db->exec($sql);
        }
    }

    header('Location: /Apteka/administrator.php');


?>