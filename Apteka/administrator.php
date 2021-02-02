<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ABC Apteka</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    require_once "scripts/baza.php";
    $db = new PDO($dsn, $db_user, $db_password);

?>
    <header>
    <nav class="navbar navbar-dark navbar-expand-md fixed-top stylmenu">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" width="180" height="40" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu"
                aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="mainmenu" class="navbar-collapse collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Strona Główna</a></li>
                    <li class="nav-item"><a class="nav-link" href="produkty.php">Produkty</a></li>
                    <li class="nav-item"><a class="nav-link" href=kontakt.php>Kontakt</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                <?php
                    if(!empty($_SESSION['rodzaj'])):
                        $id=$_SESSION['id'];
                        if ($_SESSION['rodzaj']=="Klient" && $_SESSION['aktywna']==true):?>
                        <a class="nav-link" href="klient.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
                    <?php elseif ($_SESSION['rodzaj']=="Moderator" && $_SESSION['aktywna']==true):?>
                        <a class="nav-link" href="moderator.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
                    <?php elseif ($_SESSION['rodzaj']=="Administrator" && $_SESSION['aktywna']==true):?>
                        <a class="nav-link  active" href="administrator.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
                        <?php endif;?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scripts/wyloguj.php"> (Wyloguj się)</a>
                    </li>
                    <li class="nav-item">
                        <?php else: ?>
                        <a class="nav-link" href="logowanie.php">Rejestracja / Logowanie</a>
                        <?php endif;  ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="row">
            <div class="col-xl-9">
                <section class="glownaSection">
                    <h2 class="stylpaskow">Panel Administratora</h2>

                    <nav class="navbar navbar-dark navbar-expand-sm">
                        <div class="navbar-collapse">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item m-1">
                                    <a class="btn btn-primary" role="button" data-toggle="collapse"
                                        data-target="#dodajProdukt" aria-expanded="true" aria-controls="dodajProdukt"
                                        style="width: 100%; color: white;">
                                        Dodaj Produkt
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="btn btn-primary" role="button" data-toggle="collapse"
                                        data-target="#zlozoneZamowienia" aria-expanded="false" aria-controls="zlozoneZamowienia"
                                        style="width: 100%; color: white;">
                                        Złożone zamówienia
                                    </a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="collapse" id="zlozoneZamowienia">
                        <div class="card card-body kontaOczekujace">
                            <h3 class="stylpaskow">Zamowienia:</h3>

                            <?php
                                $sql = "SELECT DISTINCT id_konta_klienta FROM zamowienia where id_administratora = '$id'";
                                foreach($db->query($sql) as $row){
                                    $id_konta_klienta = $row['id_konta_klienta'];
                                    $sql2 = "SELECT * FROM konta_klientow join osoby on konta_klientow.id_klienta=osoby.pesel where konta_klientow.id=$id_konta_klienta";
                                    $zapytanie = $db->prepare($sql2);
                                    $zapytanie->execute();

                                    if ($data = $zapytanie->fetch()) {
                                    $imie = $data['imie'];
                                    $nazwisko=$data['nazwisko'];
                                    $pesel=$data['pesel'];
                                    $emial=$data['email'];
                                    $numer_tel=$data['nr_telefonu'];
                                    $ulica = $data['ulica'];
                                    $nr_domu = $data['nr_domu'];
                                    $nr_lokalu = $data['nr_lokalu'];
                                    $kod_pocztowy = $data['kod_pocztowy'];
                                    $miasto = $data['miasto'];
                                    }?>

<form class="glownaAside" method="post" action="scripts/ZatwierdzZamowienie.php">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h3>Dane Osobowe:</h3>
                                        <h5>Imie: <?php print $imie?></h5>
                                        <h5>Nazwisko: <?php print $nazwisko ?></h5>
                                        <h5>Pesel: <?php print $pesel ?></h5>
                                    </div>
                                    <div class="col-md-7">
                                        <h3>Kontakt:</h3>
                                        <h5>Telefon: <?php print $numer_tel ?></h5>
                                        <h5>Email: <?php print $emial ?></h5>
                                        <h5>Ulica: <?php
                                        if($nr_lokalu==NULL)
                                        echo $ulica." ".$nr_domu." ".$kod_pocztowy." ".$miasto;
                                        else echo $ulica." ".$nr_domu."/".$nr_lokalu." ".$kod_pocztowy." ".$miasto;
                                        ?></h5>
                                    </div>
                                </div>

                                <table class="table" style="color: white;">
                                    <thead style="text-align: center; vertical-align: middle;">
                                        <tr>
                                        <th scope="col">Kod</th>
                                        <th scope="col">Produkt</th>
                                        <th scope="col">Nazwa</th>
                                        <th scope="col">Opis</th>
                                        <th scope="col">Cena</th>
                                        <th scope="col">Ilość</th>
                                        </tr>
                                    </thead>
                                <tbody>

                            <?php
                                $sql4 = "SELECT * FROM zamowienia join produkty on zamowienia.id_produktu=produkty.id where id_konta_klienta=$id_konta_klienta";
                                foreach($db->query($sql4) as $row) {?>
                                 <tr>
                                    <td class ="zamowienia" style="text-align: center; vertical-align: middle;"><?php print $row['id'];?></td>
                                    <td class ="zamowienia" style="text-align: center; vertical-align: middle;"><img class="img-fluid" src=<?php echo "scripts/produkty/".$row['obrazek'];?> alt="" /></td>
                                    <td class ="zamowienia" style="text-align: center; vertical-align: middle;"><?php print $row['nazwa'];?></td>
                                    <td class ="zamowienia" style="text-align: center; vertical-align: middle;"><?php print $row['opis'];?></td>
                                    <td class ="zamowienia" style="text-align: center; vertical-align: middle;"><?php print $row['cena']; ?>zł</td>
                                    <td class ="zamowienia" style="text-align: center; vertical-align: middle;"><?php echo $row['ilosc']; ?></td>
                                </tr>

                                <?php }?>
                            </tbody>
                        </table>

                                <div class="row">
                                    <button type="submit" class="btn btn-primary" value="<?php echo $id_konta_klienta; ?>" name="id_konta_bt" style="margin:auto;">Zatwierdz Zamówienie</button>
                                </div>
                            </form>
                         <?php }?>

                        </div>
                    </div>
                    <div class="collapse" id="dodajProdukt">
                        <div class="card card-body kontaOczekujace">
                            <h3 class="stylpaskow">Dodawanie produktu:</h3>
                            <form class="glownaAside" method="post" enctype="multipart/form-data" action="scripts/dodajProdukt.php">
                                <div class="form-group">
                                    <label for="inputNazwa">Podaj nazwę:</label>
                                    <input type="text" class="form-control" id="inputNazwa" placeholder="Nazwa" name="nazwa" pattern="[a-zA-Z]+">
                                </div>
                                <div class="form-group">
                                    <label for="inputOpis"><?php if (isset($_SESSION['err_odpowiedz_a']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['err_odpowiedz_a']; ?></span>
                                                    <?php  unset($_SESSION['err_odpowiedz_a']);
                                                }
                                                else
                                                echo "Podaj opis:" ;
                                        ?></label>
                                    <textarea class="col-sm-12" id="inputOpis" name="opis" placeholder="Opis produktu" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputCena">Podaj cenę:</label>
                                    <input type="number" class="form-control" id="inputCena" placeholder="0,00 zł" name="cena" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="obrazek"><?php if (isset($_SESSION['err_produkt']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['err_produkt']; ?></span>
                                                    <?php  unset($_SESSION['err_produkt']);
                                                }
                                                else
                                                echo "Wybierz obrazek produktu (musi mieć wymiary 250x150):" ;
                                        ?></label>
                                    <input class="col-sm-12" type="file" id="obrazek" name="obrazek" accept="image/png">
                                </div>
                                <button type="submit" class="btn-primary wysrodkujButtonik">Dodaj produkt</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>



            <div class="col-xl-3">
                <aside class="glownaAside">
                    <h2 class="stylpaskow">Dane Osobowe</h2>
                    <p class="dane">Imie: <span
                            style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['imie']?></span>
                    </p>
                    <p class="dane">Nazwisko: <span
                            style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['nazwisko']?></span>
                    </p>
                    <p class="dane">Email: <span
                            style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['email']?></span>
                    </p>
                    <p class="dane">Adres: <span style="color: orangered; font-size:20px; font-style: italic">
                            <?php
					if($_SESSION['nr_lokalu']==NULL)
					echo $_SESSION['ulica']." ".$_SESSION['nr_domu'];
					else echo $_SESSION['ulica']." ".$_SESSION['nr_domu']."/".$_SESSION['nr_lokalu'];
					?></span></p>
                    <p class="dane">Pesel: <span
                            style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['pesel']?></span>
                    </p>
                    <h2 class="stylpaskow">Dane Konta</h2>
                    <p class="dane">Zalogowano jako: <span style="color:red"><?php echo $_SESSION['rodzaj']?></span>
                    </p>
                    <p class="dane">Liczba zamówień:
                        <span style="color: red">
                            <?php
                        $zapytanie = $db->prepare("SELECT distinct id_konta_klienta from zamowienia where id_administratora=10;");
                        $zapytanie->execute();
                        $liczbalini = $zapytanie->rowCount();
                        echo $liczbalini;
                        ?>
                        </span></p>
                </aside>
            </div>
        </div>
    </main>
    <footer class="fixed-bottom">Wszystkie Prawa Zastrzeżone</footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>