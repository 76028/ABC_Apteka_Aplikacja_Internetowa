<?php
session_start();
require_once "baza.php";
$db = new PDO($dsn, $db_user, $db_password);

$id = $_SESSION['id'];
$klient = $_POST['id_konta_bt'];
echo $id." ".$klient;

$sql = "Delete from zamowienia where id_administratora= '$id' AND id_konta_klienta='$klient'";
$db->exec($sql);
header('Location: /Apteka/administrator.php');
?>