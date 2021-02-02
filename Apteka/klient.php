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
    $db = new PDO($dsn, $db_user, $db_password);?>
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
                        <a class="nav-link  active" href="klient.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
                    <?php elseif ($_SESSION['rodzaj']=="Moderator" && $_SESSION['aktywna']==true):?>
                        <a class="nav-link" href="moderator.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
                    <?php elseif ($_SESSION['rodzaj']=="Administrator" && $_SESSION['aktywna']==true):?>
                        <a class="nav-link" href="administrator.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
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
                    <h3 class="stylpaskow">Aktualne przedmioty znajdujące się w koszyku</h3>
                    <form method="post" action="scripts/ZarzadzajKoszyk.php">
                    <table class="table tableProdukty" style="color: white;">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;" scope="col">Kod</th>
                                <th style="text-align: center; vertical-align: middle;" scope="col">Produkt</th>
                                <th style="text-align: center; vertical-align: middle;" scope="col">Nazwa</th>
                                <th style="text-align: center; vertical-align: middle;" scope="col">Opis</th>
                                <th style="text-align: center; vertical-align: middle;" scope="col">Ilość</th>
                                <th style="text-align: center; vertical-align: middle;" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                                <?php
                                require_once "scripts/baza.php";
                                $db = new PDO($dsn, $db_user, $db_password);
                                $id=$_SESSION['id'];
                                $sql = "SELECT * FROM koszyk join produkty where koszyk.id_produktu=produkty.id && id_konta=$id";
                                $suma=0;
                                foreach($db->query($sql) as $row){
                                $suma= $suma+$row['cena']*$row['zamowiona_ilosc'];?>
                                <tr>
                                    <td class ="klient" style="text-align: center; vertical-align: middle;"><?php print $row['id'];?></td>
                                    <td class ="klient" style="text-align: center; vertical-align: middle;"><img class="img-fluid" src=<?php echo "scripts/produkty/".$row['obrazek'];?> alt="" /></td>
                                    <td class ="klient" style="text-align: center; vertical-align: middle;"><?php print $row['nazwa'];?></td>
                                    <td class ="klient" style="text-align: center; vertical-align: middle;"><?php print $row['opis'];?></td>
                                    <td class ="klient" style="text-align: center; vertical-align: middle;"><?php print $row['zamowiona_ilosc']?>x<?php print $row['cena']."zł"?></td>
                                    <td class ="klient" style="text-align: center; vertical-align: middle;"><button type="submit" class="btn btn-primary" name="numer_produktu" value="<?php print $row['id']; ?>">Usuń Produkt</button></td>
                                </tr><?php } ?>
                                </tbody>
                                <tr>
                                    <td style="text-align: right; vertical-align: middle;" colspan="5">Suma: <?php print number_format((float) $suma, 2, '.', '')." zł"; ?></td>
                                    <td style="text-align: right; vertical-align: middle;"><button type="submit" value="<?php echo $suma; ?>" class="btn btn-primary" name="akceptuj">Akceptuj Zamówienie</button></td>
                                </tr>


                    </table>
                    </form>
                </section>
            </div>

            <div class="col-xl-3">
                <aside class="glownaAside">
                    <h2 class="stylpaskow kolorpaskow">Dane Osobowe</h2>
                    <p class="dane">Imie: <span style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['imie']?></span></p>
                    <p class="dane">Nazwisko: <span style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['nazwisko']?></span></p>
                    <p class="dane">Email: <span style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['email']?></span></p>
                    <p class="dane">Adres: <span style="color: orangered; font-size:20px; font-style: italic">
                    <?php
					if($_SESSION['nr_lokalu']==NULL)
					echo $_SESSION['ulica']." ".$_SESSION['nr_domu'];
					else echo $_SESSION['ulica']." ".$_SESSION['nr_domu']."/".$_SESSION['nr_lokalu'];
					?></span></p>

                    <p class="dane">Pesel: <span style="color: orangered; font-size:20px; font-style: italic"><?php echo $_SESSION['pesel']?></span></p>
                    <h2 class="stylpaskow">Dane Konta</h2>
                    <p class="dane">Zalogowano jako: <span style="color:yellow"><?php echo $_SESSION['rodzaj']?></span></p>
                    <p class="dane">Liczba przedmiotów w koszyku: <span style="color: red">
                    <?php
                        $zapytanie = $db->prepare("SELECT sum(zamowiona_ilosc) FROM `koszyk` where id_konta=$id");
                        $zapytanie->execute();
                        $liczbalini = $zapytanie->fetchColumn();
                            echo $liczbalini;
                    ?></span></p>
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