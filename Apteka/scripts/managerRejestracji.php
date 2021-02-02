<?php

session_start();
$pesel=$_POST['pesel'];
$haslo=$_POST['haslo'];
$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$email=$_POST['email'];
$nr_telefonu=$_POST['nr_telefonu'];
$ulica=$_POST['ulica'];
$nr_domu=$_POST['nr_domu'];
$nr_lokalu=$_POST['nr_lokalu'];
$kod_pocztowy=$_POST['kod_pocztowy'];
$miasto=$_POST['miasto'];
$wojewodztwo=$_POST['wojewodztwo'];


if($pesel!=""  && $haslo!="" && $imie!="" && $nazwisko!="" && $email!="" && $nr_telefonu!="" && $ulica!=""
&& $nr_domu!=""  && $kod_pocztowy!="" && $miasto!="" && $wojewodztwo!="")
{
    require_once "baza.php";
    $db = new PDO($dsn, $db_user, $db_password);

    //sprawdzenie czy istnieje email w oczekujacych i istniejacych
    $sql = "SELECT * from osoby where email='$email'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $_SESSION['err_email']='Istnieje taki email !';
        header('Location: /Apteka/logowanie.php');
    }

    $sql = "SELECT * from konta_oczekujace where email='$email'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $_SESSION['err_email']='Email w Oczekujacych!';
        header('Location: /Apteka/logowanie.php');
    }

    //sprawdzenie czy istnieje numer w oczekujacych i istniejacych
    $sql = "SELECT * from osoby where nr_telefonu='$nr_telefonu'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $_SESSION['err_numer']='Istnieje taki numer !';
        header('Location: /Apteka/logowanie.php');
    }
    $sql = "SELECT * from konta_oczekujace where nr_telefonu='$nr_telefonu'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $_SESSION['err_numer']='Numer w Oczekujacych!';
        header('Location: /Apteka/logowanie.php');
    }


    //sprawdzenie czy istnieje pesel w oczekujacych i istniejacych
    $sql = "SELECT * from osoby where pesel='$pesel'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $_SESSION['err_pesel']='Istnieje taki Pesel !';
        header('Location: /Apteka/logowanie.php');
    }
    $sql = "SELECT * from konta_oczekujace where pesel='$pesel'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $_SESSION['err_pesel']='Pesel w Oczekujacych!';
        header('Location: /Apteka/logowanie.php');
    }

    if(!isset($_SESSION['err_email']) && !isset($_SESSION['err_numer']) && !isset($_SESSION['err_pesel']) ){
    $haslo= password_hash($haslo,PASSWORD_DEFAULT);
    $sql="SELECT COUNT(*) FROM konta_pracownikow where rodzaj='Moderator'";
    $zapytanie = $db->prepare($sql);
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

    $sql = "INSERT INTO konta_oczekujace(pesel,haslo,imie,nazwisko,email,nr_telefonu,ulica,nr_domu,nr_lokalu,kod_pocztowy,miasto,wojewodztwo,id_moderatora)
    VALUES ('$pesel','$haslo','$imie','$nazwisko','$email','$nr_telefonu','$ulica','$nr_domu','$nr_lokalu','$kod_pocztowy','$miasto','$wojewodztwo',$wylosowane_id_moderatora)";
    $db->exec($sql);

    $_SESSION['info_rejestracja']='Pomyślna Rejestracja. Teraz musisz zaczekać na akceptację konta przez Moderatora';
    header('Location: /Apteka/logowanie.php');
}
}
else{
$_SESSION['puste_pola']='Wprowadz wszystkie dane !';
header('Location: /Apteka/logowanie.php');
}
?>