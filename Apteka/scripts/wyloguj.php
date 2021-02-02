<?php
session_start();
$_SESSION['aktywna']=false;
session_destroy();
header('Location: /Apteka/logowanie.php');
?>