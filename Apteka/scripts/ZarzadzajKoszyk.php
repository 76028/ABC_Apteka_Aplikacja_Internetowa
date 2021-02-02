<?php
session_start();
require_once "baza.php";
$db = new PDO($dsn, $db_user, $db_password);

$id = $_SESSION['id'];
if(isset($_POST['numer_produktu'])){
    $produkt = $_POST['numer_produktu'];
        $sql = "delete from koszyk where id_konta = $id && id_produktu = $produkt";
        echo $produkt;
        $db->exec($sql);
        header('Location: /Apteka/klient.php');
}
//zlozenie zamowienia
else{

    $suma_w_koszyku= $_POST['akceptuj'];
    $sql="SELECT COUNT(*) FROM konta_pracownikow where rodzaj='Administrator'";
    $zapytanie = $db->prepare($sql);
    $zapytanie->execute();
    $liczbalini = $zapytanie->fetchColumn();


    $sql="SELECT * FROM konta_pracownikow where rodzaj='Administrator'";

    $random = rand(0,$liczbalini-1);
    $licznik=0;
    foreach($db->query($sql) as $row) {
        $wylosowane_id_admina = $row["id"];
        if($random==$licznik){break;}
        $licznik=$licznik+1;
    }




    $sql = "SELECT * FROM koszyk join produkty where koszyk.id_produktu=produkty.id && id_konta=$id";
    foreach($db->query($sql) as $row){

        $id_produktu=$row["id_produktu"];
        $zamowiona_ilosc= $row["zamowiona_ilosc"];
        $cena= $row["cena"];
        $sql2 = "SELECT * from zamowienia where id_produktu=$id_produktu AND id_konta_klienta=$id";
        $stmt = $db->prepare($sql2);
        $stmt->execute();
        if ($data = $stmt->fetch()) {
                $ilosc=$data['ilosc'] + $zamowiona_ilosc;
                $sql3 = "UPDATE zamowienia set ilosc=$ilosc where id_produktu=$id_produktu AND id_konta_klienta=$id";
                $db->exec($sql3);
               header('Location: /Apteka/klient.php');
        }
        else{
        $sql = "INSERT INTO zamowienia(id_konta_klienta,id_produktu,ilosc,id_administratora)
        VALUES ('$id','$id_produktu','$zamowiona_ilosc', '$wylosowane_id_admina')";
        $db->exec($sql);
        header('Location: /Apteka/klient.php');
    }

    $sql = "delete from koszyk where id_konta=$id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    }
}
echo "Brak przedmiotów w koszyku";

?>