<?php
session_start();
require_once "baza.php";
$db = new PDO($dsn, $db_user, $db_password);

$id_produktu = $_POST['id_produktu'];
$ilosc = $_POST['iloscproduktu'.$id_produktu];
$id= $_SESSION['id'];
$nazwa_pliku= $_POST["nazwa_pliku"];

if(isset($nazwa_pliku)){
    $sql = "delete from produkty where id = $id_produktu";
    $db->exec($sql);
    unlink('produkty/'.$nazwa_pliku);
    echo $nazwa_pliku;
    header('Location: /Apteka/administrator.php');
}
else{
    $sql = "SELECT * from koszyk where id_produktu=$id_produktu AND id_konta=$id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($data = $stmt->fetch()) {
        $nowaCena=$data['zamowiona_ilosc'] + $ilosc;
        $sql = "UPDATE koszyk set zamowiona_ilosc=$nowaCena where id_produktu=$id_produktu";
        $db->exec($sql);
        header('Location: /Apteka/produkty.php');
    }
    else{
    $sql = "INSERT INTO koszyk(id_konta,id_produktu,zamowiona_ilosc)
    VALUES ('$id','$id_produktu','$ilosc')";
    $db->exec($sql);
    header('Location: /Apteka/produkty.php');
    }
}
?>