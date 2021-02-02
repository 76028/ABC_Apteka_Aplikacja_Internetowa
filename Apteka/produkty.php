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
    <?php session_start();?>
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
                    <li class="nav-item active"><a class="nav-link" href="produkty.php">Produkty</a></li>
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
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/baner1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/baner2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/baner3.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Poprzedni</span>
                </a>
                <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Nastepny</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="produktySection">
                    <h2 class="stylpaskow">Produkty</h2>
                    <article>
                    <h4 class="stylpaskow">Wszystkie produkty dostępne w sklepie ABC Apteka</h4>
                    <form method="post" action="scripts/dodajDoKoszyka.php">
                        <table class="table" style="color: white;">
                            <thead style="text-align: center; vertical-align: middle;">
                                <tr>
                                <th scope="col">Kod</th>
                                <th scope="col">Produkt</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Opis</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Ilość</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once "scripts/baza.php";
                                $db = new PDO($dsn, $db_user, $db_password);
                                $sql = "SELECT * FROM produkty";
                                foreach($db->query($sql) as $row) {?>
                                 <tr>
                                    <td class ="produkty" style="text-align: center; vertical-align: middle;"><?php print $row['id'];?></td>
                                    <td class ="produkty" style="text-align: center; vertical-align: middle;"><img class="img-fluid" src=<?php echo "scripts/produkty/".$row['obrazek'];?> alt="" /></td>
                                    <td class ="produkty" style="text-align: center; vertical-align: middle;"><?php print $row['nazwa'];?></td>
                                    <td class ="produkty" style="text-align: center; vertical-align: middle;"><?php print $row['opis'];?></td>
                                    <td class ="produkty" style="text-align: center; vertical-align: middle;"><?php print $row['cena']; ?>zł</td>
                                    <td class ="produkty" style="text-align: center; vertical-align: middle;"><input class="form-control" style="width:60px;  margin-left: auto; margin-right: auto;" type="number" value="1" name="iloscproduktu<?php echo $row['id']; ?>"></td>
                                    <td class ="produkty" style="text-align: center; vertical-align: middle;">
                                        <?php
                                        if(!empty($_SESSION['rodzaj'])):
                                            if ($_SESSION['rodzaj']=="Klient" && $_SESSION['aktywna']==true):?>
                                            <button type="submit" value="<?php echo $row['id']; ?>" name="id_produktu" class="btn btn-primary">Dodaj do koszyka</button>
                                            <?php elseif ($_SESSION['rodzaj']=="Moderator" && $_SESSION['aktywna']==true):?>
                                            <p style="text-align: center; margin:auto;">Zaloguj sie na konto klienta</p>
                                            <?php elseif ($_SESSION['rodzaj']=="Administrator" && $_SESSION['aktywna']==true):?>
                                            <input name="id_produktu" type="hidden" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-primary" name="nazwa_pliku" value="<?php print $row['obrazek']; ?>">Usuń Produkt</button>
                                            <?php endif; else: ?>
                                            <a class="nav-link" href="logowanie.php">Rejestracja Lub Logowanie</a>
                                            <?php endif;  ?>
                                        </td>

                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        </form>
                    </article>
                </section>
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