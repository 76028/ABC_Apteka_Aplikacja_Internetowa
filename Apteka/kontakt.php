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
                    <li class="nav-item"><a class="nav-link" href="produkty.php">Produkty</a></li>
                    <li class="nav-item active"><a class="nav-link" href=kontakt.php>Kontakt</a></li>
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

        <section class="kontaktSection">
            <h2 class="stylpaskow">Kontakt z Doradcą Apteki ABC</h2>
            <article>
                <h3 class="infoKonsultant">Jeśli zainteresowała Cię nasza oferta i chcesz otrzymać szczegółowe informacje wypełnij poniższy formularz.</h3>
                <div>
                    <form method="post" action="scripts/kontaktwyslij.php">
                        <div class="form-group row">
                            <label for="inputimiedoradca" class="col-sm-12 col-lg-1 col-form-label">Imie:</label>
                            <div class="col-sm-12 col-lg-11">
                                <input type="text" class="form-control" id="inputimiedoradca" placeholder="Imie" name="imie" pattern="[a-zA-Z]+" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputnazwiskodoradca" class="col-sm-12 col-lg-1 col-form-label">Nazwisko:</label>
                            <div class="col-sm-12 col-lg-11">
                                <input type="text" class="form-control" id="inputnazwiskodoradca" placeholder="Nazwisko" name="nazwisko" pattern="[a-zA-Z]+" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputtelefon" class="col-sm-12 col-lg-1 col-form-label">Telefon:</label>
                            <div class="col-sm-12 col-lg-11">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+48</div>
                                    <input type="text" class="form-control" maxlength="9" id="inputtelefon" placeholder="" name="telefon" pattern="[0-9]+">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputemail" class="col-sm-12 col-lg-1 col-form-label">Email:</label>
                            <div class="col-sm-12 col-lg-11">
                                <input type="text" class="form-control" id="inputemail" placeholder="Email" name="email"  pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <label class="col-form-label col-sm-12 pt-0">Czy jesteś klientem sklepu?</label>
                                <div class="col-sm-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="tak" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Tak
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="nie">
                                        <label class="form-check-label" for="gridRadios2">
                                            Nie
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label><?php if (isset($_SESSION['err_odpowiedz_t']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['err_odpowiedz_t']; ?></span>
                                                    <?php  unset($_SESSION['err_odpowiedz_t']);
                                                }
                                                else
                                                echo "Tresc Wiadomosci:" ;
                                        ?></label>
                                <textarea class="col-sm-12" name="message" placeholder="" ></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Wyślij</button>

                            <?php if (isset($_SESSION['errKontakt']))
                                    {?>
                                    <span class="error"><?php echo $_SESSION['errKontakt']; ?></span>
                                    <?php  unset($_SESSION['errKontakt']);
                                    }
                            ?>
                           <?php if (isset($_SESSION['passKontakt']))
                                    {?>
                                    <span class="pass"><?php echo $_SESSION['passKontakt']; ?></span>
                                    <?php  unset($_SESSION['passKontakt']);
                                    }
                            ?>
                            </div>
                        </div>
                    </form>
                </div>
            </article>
        </section>
    </main>
    <footer class="kolorpaskow fixed-bottom">Wszystkie Prawa Zastrzeżone</footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body></html>
