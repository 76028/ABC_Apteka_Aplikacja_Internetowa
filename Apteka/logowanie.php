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
<?php session_start(); ?>
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
                        <a class="nav-link" href="administrator.php"><?php echo $_SESSION['imie'] . ' ' .$_SESSION['nazwisko'] ?></a>
                        <?php endif;?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scripts/wyloguj.php"> (Wyloguj się)</a>
                    </li>
                    <li class="nav-item">
                        <?php else: ?>
                        <a class="nav-link  active" href="logowanie.php">Rejestracja / Logowanie</a>
                        <?php endif;  ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>


        <section class="logowanieSection">
            <div class="row">
                <div class="col-lg-4 logowanieObranowanie">
                    <h2 class="stylpaskow">Logowanie</h2>
                    <article class="logowanieArticle">
                        <h3>Jeśli posiadasz konto:</h3>

                        <form method="post" action="scripts/managerLogowania.php">
                            <div class="form-group">
                                <label for="InputPESEL">PESEL:</label>
                                <input type="text" class="form-control" id="InputPESEL" pattern="[0-9]+" maxlength="11" aria-describedby="idHelp" placeholder="Np. 97052104345" name="pesel" >
                                <small id="idHelp" class="form-text text-muted">PESEL znajdziesz na swoim dokumencie prawa jazdy.</small>
                            </div>
                            <div class="form-group">
                                <label for="InputHaslo">Hasło:</label>
                                <input type="password" class="form-control" id="InputHaslo" placeholder="Hasło" name="haslo">
                            </div>
                            <div class="form-group">
                                <label for="inputRodzaj">Zaloguj jako:</label>
                                <select id="inputRodzaj" class="form-control" name="rodzaj">
                                    <option selected>Klient</option>
                                    <option>Moderator</option>
                                    <option>Administrator</option>

                                </select>
                            </div>

                            <div>

                            <button type="submit" class="btn-primary wysrodkujButtonik" style="width: 95%; height:37px; margin-top:8px;">Zaloguj</button>
                            </div>
                            <div style="text-align:center;">
                            <?php if (isset($_SESSION['errLogowanie']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['errLogowanie']; ?></span>
                                                    <?php  unset($_SESSION['errLogowanie']);
                                                }
                                        ?>
                        </div>
                            </form>

                    </article>
                </div>

                <div class="col-lg-8 logowanieObranowanie">
                    <h2 class="stylpaskow">Rejestracja</h2>
                    <article class="logowanieArticle">
                        <form method="post" action="scripts/managerRejestracji.php">
                            <h3>Jeśli nie posiadasz konta:</h3>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="inputImie">Podaj Imie:</label>
                                    <input type="text" class="form-control" id="inputImie" pattern="[a-zA-Z]+" placeholder="Imie" name="imie" >
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="inputNazwisko">Podaj Nazwisko:</label>
                                    <input type="text" class="form-control" id="inputNazwisko" pattern="[a-zA-Z]+" placeholder="Nazwisko" name="nazwisko">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="inputEmail" > <?php if (isset($_SESSION['err_email']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['err_email']; ?></span>
                                                    <?php  unset($_SESSION['err_email']);
                                                }
                                                else
                                                echo "Numer Email:" ;
                                        ?>
                                    </label>

                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$">

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputHaslo">Podaj Hasło:</label>
                                    <input type="password" class="form-control" id="inputHaslo" placeholder="Hasło" name="haslo">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputTelefon"> <?php
                                        if (isset($_SESSION['err_numer']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['err_numer']; ?></span>
                                                    <?php  unset($_SESSION['err_numer']);
                                                }
                                                else
                                                echo "Numer Telefonu:" ;
                                        ?>
                                        </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">+48</div>
                                        </div>
                                        <input type="text" class="form-control" maxlength="9" id="inputTelefon" name="nr_telefonu" placeholder="Numer Telefonu" pattern="[0-9]+">

                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputUlica">Ulica:</label>
                                    <input type="text" class="form-control" id="inputUlica" placeholder="ul. Stołeczna 12" name="ulica" pattern="[a-zA-Z]+">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputDom">Nr Domu:</label>
                                    <input type="text" class="form-control" id="inputDom" placeholder="np. 32" name="nr_domu" pattern="[0-9]+">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputLokal">Nr Lokalu:</label>
                                    <input type="text" class="form-control" id="inputLokal" placeholder="np. 16" name="nr_lokalu" pattern="[0-9]+">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputKodPocztowy">Poczta:</label>
                                    <input type="text" class="form-control" maxlength="6" pattern="^[0-9]{2}-[0-9]{3}$" id="inputKodPocztowy" placeholder="np. 16-256" name="kod_pocztowy">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputMiasto">Miasto:</label>
                                    <input type="text" class="form-control" id="inputMiasto" placeholder="np. Łódź" name="miasto" pattern="[a-zA-Z]+">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputWoj">Województwo:</label>
                                    <select id="inputWoj" class="form-control" name="wojewodztwo">
                                        <option selected>Wybierz</option>
                                        <option>dolnośląskie</option>
                                        <option>kujawsko-pomorskie</option>
                                        <option>lubelskie</option>
                                        <option>lubuskie</option>
                                        <option>łódzkie</option>
                                        <option>małopolskie</option>
                                        <option>mazowieckie</option>
                                        <option>opolskie</option>
                                        <option>podkarpackie</option>
                                        <option>podlaskie</option>
                                        <option>pomorskie</option>
                                        <option>śląskie</option>
                                        <option>świętokrzyskie</option>
                                        <option>warmińsko-mazurskie</option>
                                        <option>wielkopolskie</option>
                                        <option>zachodniopomorskie</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputPesel"><?php if (isset($_SESSION['err_pesel']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['err_pesel']; ?></span>
                                                    <?php  unset($_SESSION['err_pesel']);
                                                }
                                                else
                                                echo "Pesel:" ;
                                        ?></label>
                                    <input type="text" class="form-control" maxlength="11" id="inputPesel" placeholder="np. 97082302346" name="pesel" pattern="[0-9]+">
                                </div>
                                <div class="form-group col-md-4">
                                <label for="btn" class="wysrodkujButtonik" style="text-align:center;"><?php if (isset($_SESSION['puste_pola']))
                                                {?>
                                                    <span class="error"><?php echo $_SESSION['puste_pola']; ?></span>
                                                    <?php  unset($_SESSION['puste_pola']);
                                                }
                                                else
                                                echo "Kliknij by zarejestrowac";
                                        ?></label>
                                <div>
                                    <button type="submit" id="btn" class="btn-primary wysrodkujButtonik" style="width: 100%; height:37px; margin-top:8px;">Zarejestruj</button>
                                </div>
                               </div>

                            </div>
                            <div class="form-row">
                            <?php if (isset($_SESSION['info_rejestracja']))
                                                {?>
                                                    <div class="form-row pass" style="margin:auto;"><?php echo $_SESSION['info_rejestracja']; ?></div>
                                                    <?php  unset($_SESSION['info_rejestracja']);
                                                }
                                        ?>
                             </div>

                        </form>
                    </article>
                </div>
            </div>
        </section>

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