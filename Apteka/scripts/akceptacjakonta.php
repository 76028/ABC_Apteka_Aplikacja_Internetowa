<?php
session_start();
$komentarz = $_POST['komentarz'];
$decyzja =  $_POST['decyzja'];
$pesel=$_POST['pesel'];

for ($i = 0; $i <= strlen($komentarz)-1; $i++) {
    if($komentarz[$i]=='"'){
        $_SESSION['err_odpowiedz_w']='istnieje niedozwolony znak (") popraw go !';

    }
}

require_once "baza.php";
$db = new PDO($dsn, $db_user, $db_password);
$sql = "SELECT * FROM konta_oczekujace where pesel = '$pesel'";
$stmt = $db->prepare($sql);
$stmt->execute();

if ($data = $stmt->fetch()) {
    $id_moderatora=$data["id_moderatora"];
    $haslo=$data["haslo"];
    $imie=$data["imie"];
    $nazwisko=$data["nazwisko"];
    $email=$data["email"];
    $nr_telefonu=$data["nr_telefonu"];
    $ulica=$data["ulica"];
    $nr_domu=$data["nr_domu"];
    $nr_lokalu=$data["nr_lokalu"];
    $kod_pocztowy=$data["kod_pocztowy"];
    $miasto=$data["miasto"];
    $wojewodztwo=$data["wojewodztwo"];
}
else if(isset($_SESSION['err_odpowiedz_w'])){
    $decyzja="brak";
    header('Location: /Apteka/moderator.php');
}

if($decyzja=="akceptuj"){
    $sql = "INSERT INTO osoby(pesel,imie,nazwisko,email,nr_telefonu,ulica,nr_domu,nr_lokalu,kod_pocztowy,miasto,wojewodztwo)
    VALUES ('$pesel','$imie','$nazwisko','$email','$nr_telefonu','$ulica','$nr_domu','$nr_lokalu','$kod_pocztowy','$miasto','$wojewodztwo')";
    $db->exec($sql);
    $sql = "INSERT INTO konta_klientow(id_klienta,haslo)
    VALUES ('$pesel','$haslo')";
    $db->exec($sql);
}
else if($decyzja=="odrzuc"){
    $sql = "INSERT INTO konta_odrzucone(pesel,haslo,imie,nazwisko,email,nr_telefonu,ulica,nr_domu,nr_lokalu,kod_pocztowy,miasto,wojewodztwo,komentarz,id_moderatora)
    VALUES ('$pesel','$haslo','$imie','$nazwisko','$email','$nr_telefonu','$ulica','$nr_domu','$nr_lokalu','$kod_pocztowy','$miasto','$wojewodztwo','$komentarz','$id_moderatora')";
    $db->exec($sql);
}

if(isset($_SESSION['err_odpowiedz_w']))
{ header('Location: /Apteka/moderator.php');}
else{
$sql = "delete from konta_oczekujace where pesel='$pesel'";
$db->exec($sql);
header('Location: /Apteka/moderator.php');
}
?>