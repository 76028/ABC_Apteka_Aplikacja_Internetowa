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
                        <a class="nav-link  active" href="moderator.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
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
                    <h2 class="stylpaskow">
                    <?php
                                        if (isset($_SESSION['err_odpowiedz_w']))
                                                {?>
                                                <span class="error"><?php echo $_SESSION['err_odpowiedz_w']; ?></span>
                                                <?php  unset($_SESSION['err_odpowiedz_w']);
                                                }
                                                else echo "Panel Moderatora" ;?>
</h2>
                    <nav class="navbar navbar-dark navbar-expand-sm">
                        <div class="navbar-collapse">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item m-1">
                                    <a class="btn btn-primary" role="button" data-toggle="collapse"
                                        data-target="#wiadomosci" aria-expanded="true" aria-controls="wiadomosci"
                                        style="width: 100%; color: white;">
                                        Wiadomosci
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="btn btn-primary" role="button" data-toggle="collapse"
                                        data-target="#oczekujace" aria-expanded="false" aria-controls="oczekujace"
                                        style="width: 100%; color: white;">
                                        Oczekujące Konta
                                    </a></li>
                            </ul>

                        </div>

                    </nav>
                    <div class="collapse" id="oczekujace">
                        <div class="card card-body kontaOczekujace">
                            <h3 class="stylpaskow">Konta Oczekujace:</h3>
                            <?php
                                    $sql = "SELECT * FROM konta_oczekujace where id_moderatora = '$id'";
                                    $licznik=0;
                                    foreach($db->query($sql) as $row) {?>

                            <form class="glownaAside" method="post" action="scripts/akceptacjakonta.php">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h3>Dane Osobowe:</h3>
                                        <input name="pesel" type="hidden" value="<?php echo $row['pesel']?>">
                                        <h5>Imie: <?php print $row["imie"] ?></h5>
                                        <h5>Nazwisko: <?php print $row["nazwisko"] ?></h5>
                                        <h5>Pesel: <?php print $row["pesel"] ?></h5>
                                    </div>
                                    <div class="col-md-7">
                                        <h4>Kontakt:</h4>
                                        <h5>Telefon: <?php print $row["nr_telefonu"] ?></h5>
                                        <h5>Email: <?php print $row["email"] ?></h5>
                                        <h5>Ulica: <?php
                                        if($row["nr_lokalu"]==NULL)
                                        echo $row["ulica"]." ".$row["nr_domu"];
                                        else echo $row["ulica"]." ".$row["nr_domu"]."/".$row["nr_lokalu"]." ".$row["kod_pocztowy"]." ".$row["miasto"];
                                        ?></h5>

                                    </div>
                                    <div class="col-md-12">
                                        <label>
                                        Komentarz:
                                        </label>
                                        <textarea class="col-md-12" name="komentarz" placeholder=""></textarea>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php $licznik=$licznik+1;?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="decyzja"
                                                    id="<?php print "gridRadios".$licznik; ?>" value="akceptuj" checked>
                                                <label class="form-check-label" for="<?php print "gridRadios".$licznik; ?>">
                                                    Akceptuj
                                                </label>
                                            </div>
                                            <?php $licznik=$licznik+1;?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="decyzja"
                                                    id="<?php print "gridRadios".$licznik; ?>" value="odrzuc">
                                                <label class="form-check-label" for="<?php print "gridRadios".$licznik; ?>">
                                                    Odrzuc
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary">Akceptuj</button>
                                    </div>
                                </div>
                            </form>

                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="collapse" id="wiadomosci">
                        <div class="card card-body kontaOczekujace">

                            <h3 class="stylpaskow">Skrzynka Odbiorcza:</h3>
                            <?php
                                    $sql = "SELECT * FROM wiadomosci where id_moderatora = '$id'";
                                    foreach($db->query($sql) as $row) {
                                            ?>
                            <div>
                                <form class="glownaAside" method="post" action="scripts/wiadomosci.php">
                                    <h3>Wiadomość od:</h3>
                                    <div class="row">
                                        <div class="col-md-5 ">
                                            <input name="id_wiadomosci" type="hidden" value="<?php echo $row['id']?>">
                                            <input name="email" type="hidden" value="<?php echo $row['email']?>">
                                            <input name="imie" type="hidden" value="<?php echo $row['imie']?>">
                                            <input name="nazwisko" type="hidden" value="<?php echo $row['nazwisko']?>">
                                            <h5>Imie: <?php print $row["imie"] ?></h5>
                                            <h5>Nazwisko: <?php print $row["nazwisko"] ?></h5>
                                            <h5>Telefon: <?php print $row["telefon"] ?></h5>
                                            <h5>Email: <?php print $row["email"] ?></h5>

                                        </div>
                                        <div class="col-md-7"><textarea class="col-md-12" name="message"
                                                placeholder=""><?php print $row["tresc"] ?></textarea></div>
                                        <div class="col-md-12"><label>Szybka odpowiedz:</label><textarea
                                                class="col-md-12" name="message" placeholder=""></textarea></div>
                                    </div>

                                    <div class="col-sm-12">
                                    <?php $licznik=$licznik+1;?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="decyzja" id="<?php print "gridRadios".$licznik; ?>"
                                                value="tak" checked>
                                            <label class="form-check-label" for="<?php print "gridRadios".$licznik; ?>">
                                                Wyslij
                                            </label>
                                        </div>
                                        <?php $licznik=$licznik+1;?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="decyzja" id="<?php print "gridRadios".$licznik; ?>"
                                                value="nie">
                                            <label class="form-check-label" for="<?php print "gridRadios".$licznik; ?>">
                                                Usun
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Akceptuj</button>
                                    </div>


                                </form>
                            </div>
                        <?php

}
?>
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
                    <p class="dane">Zalogowano jako: <span style="color:orange"><?php echo $_SESSION['rodzaj']?></span>
                    </p>
                    <p class="dane">Liczba wiadomosci:
                        <span style="color: red">
                            <?php
                        $zapytanie = $db->prepare("SELECT COUNT(*) FROM wiadomosci WHERE id_moderatora = $id");
                        $zapytanie->execute();
                        $liczbalini = $zapytanie->fetchColumn();
                        echo $liczbalini;
                        ?>
                        </span></p>
                    <p class="dane">Liczba oczekujących kont: <span style="color: red">
                            <?php

                        $zapytanie = $db->prepare("SELECT COUNT(*) FROM konta_oczekujace WHERE id_moderatora = $id");
                        $zapytanie->execute();
                        $liczbalini = $zapytanie->fetchColumn();
                        echo $liczbalini;
                        ?>


                        </span> </p>
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