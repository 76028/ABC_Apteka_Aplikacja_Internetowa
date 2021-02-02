<?php
session_start();
require_once "baza.php";
$db = new PDO($dsn, $db_user, $db_password);

$login=$_POST['pesel'];
$haslo=$_POST['haslo'];
$login=htmlentities($login, ENT_QUOTES, "UTF-8");

$rodzaj=$_POST['rodzaj'];
if(isset($login) && isset($haslo) && $login!="" && $haslo!="")
{
	if($rodzaj=="Klient")
	{
		$stmt=$db->prepare("SELECT * from konta_klientow join osoby where  konta_klientow.id_klienta=osoby.pesel AND id_klienta=:login");
		$stmt->bindValue('login', $login, PDO::PARAM_STR);
		$stmt->execute();

		if ($data = $stmt->fetch()) {
			if(password_verify($haslo,$data['haslo'])){
				$_SESSION['id'] = $data['id'];
				$_SESSION['id_klienta'] = $data['id_klienta'];
				$_SESSION['haslo'] = $data['haslo'];
				$_SESSION['rodzaj'] = "Klient";
				$_SESSION['data_zalozenia'] = $data['data_zalozenia'];
				$_SESSION['pesel'] = $data['pesel'];
				$_SESSION['imie'] = $data['imie'];
				$_SESSION['nazwisko'] = $data['nazwisko'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['nr_telefonu'] = $data['nr_telefonu'];
				$_SESSION['ulica'] = $data['ulica'];
				$_SESSION['nr_domu'] = $data['nr_domu'];
				$_SESSION['nr_lokalu'] = $data['nr_lokalu'];
				$_SESSION['kod_pocztowy'] = $data['kod_pocztowy'];
				$_SESSION['miasto'] = $data['miasto'];
				$_SESSION['wojewodztwo'] = $data['wojewodztwo'];
				$_SESSION['aktywna']=true;
				header('Location: /Apteka/klient.php');
			}
			else{
				$_SESSION['errLogowanie']="Nieprawidłowy Login lub hasło Klienta!";
				header('Location: /Apteka/logowanie.php');
			}

		}
		else {
			$_SESSION['errLogowanie']="Nieprawidłowy Login lub hasło Klienta!";
			header('Location: /Apteka/logowanie.php');
		}
	}
	else if($rodzaj=="Moderator")
	{
		$stmt = $db->prepare("SELECT * from konta_pracownikow join osoby where konta_pracownikow.id_pracownika=osoby.pesel AND id_pracownika=:login AND rodzaj='$rodzaj'");
		$stmt->bindValue('login', $login, PDO::PARAM_STR);
		$stmt->execute();
		if ($data = $stmt->fetch()) {
			if(password_verify($haslo,$data['haslo'])){
			$_SESSION['id'] = $data['id'];
			$_SESSION['id_pracownika'] = $data['id_pracownika'];
			$_SESSION['haslo'] = $data['haslo'];
			$_SESSION['rodzaj'] = $data['rodzaj'];
			$_SESSION['data_zalozenia'] = $data['data_zalozenia'];
			$_SESSION['pesel'] = $data['pesel'];
			$_SESSION['imie'] = $data['imie'];
			$_SESSION['nazwisko'] = $data['nazwisko'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['nr_telefonu'] = $data['nr_telefonu'];
			$_SESSION['ulica'] = $data['ulica'];
			$_SESSION['nr_domu'] = $data['nr_domu'];
			$_SESSION['nr_lokalu'] = $data['nr_lokalu'];
			$_SESSION['kod_pocztowy'] = $data['kod_pocztowy'];
			$_SESSION['miasto'] = $data['miasto'];
			$_SESSION['wojewodztwo'] = $data['wojewodztwo'];
			$_SESSION['aktywna']=true;
			header('Location: /Apteka/moderator.php');
			}
			else {
				$_SESSION['errLogowanie']="Nieprawidłowy Login lub hasło Moderatora!";
				header('Location: /Apteka/logowanie.php');
			}
		}
		else {
			$_SESSION['errLogowanie']="Nieprawidłowy Login lub hasło Moderatora!";
			header('Location: /Apteka/logowanie.php');
		}
	}
	else if($rodzaj=="Administrator")
	{
		$stmt=$db->prepare("SELECT * from konta_pracownikow join osoby where konta_pracownikow.id_pracownika=osoby.pesel AND id_pracownika=:login AND rodzaj='$rodzaj'");
		$stmt->bindValue('login', $login, PDO::PARAM_STR);
		$stmt->execute();
		if ($data = $stmt->fetch()) {
			if(password_verify($haslo,$data['haslo'])){
			$_SESSION['id'] = $data['id'];
			$_SESSION['id_pracownika'] = $data['id_pracownika'];
			$_SESSION['haslo'] = $data['haslo'];
			$_SESSION['rodzaj'] = $data['rodzaj'];
			$_SESSION['data_zalozenia'] = $data['data_zalozenia'];
			$_SESSION['pesel'] = $data['pesel'];
			$_SESSION['imie'] = $data['imie'];
			$_SESSION['nazwisko'] = $data['nazwisko'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['nr_telefonu'] = $data['nr_telefonu'];
			$_SESSION['ulica'] = $data['ulica'];
			$_SESSION['nr_domu'] = $data['nr_domu'];
			$_SESSION['nr_lokalu'] = $data['nr_lokalu'];
			$_SESSION['kod_pocztowy'] = $data['kod_pocztowy'];
			$_SESSION['miasto'] = $data['miasto'];
			$_SESSION['wojewodztwo'] = $data['wojewodztwo'];
			$_SESSION['aktywna']=true;
			header('Location: /Apteka/administrator.php');
			}
			else {
				$_SESSION['errLogowanie']="Nieprawidłowy Login lub hasło Administratora!";
				header('Location: /Apteka/logowanie.php');
			}
		}
		else {
			$_SESSION['errLogowanie']="Nieprawidłowy Login lub hasło Administratora!";
			header('Location: /Apteka/logowanie.php');
		}
	}
}
else{
	 $_SESSION['errLogowanie']="Wypełnij wszystkie pola!";
	 header('Location: /Apteka/logowanie.php');
	}
?>