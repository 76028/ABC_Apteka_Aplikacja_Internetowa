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
                    <li class="nav-item active"><a class="nav-link" href="index.php">Strona Główna</a></li>
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
            <div class="col-lg-9">
                <section class="glownaSection">
                    <h2 class="stylpaskow">O NAS</h2>
                    <article class="glownaArticle">
                        <h3>Kim jesteśmy?</h3>
                        <p>
                            Zakupy online w ABC apteka to pewność i bezpieczeństwo. Prowadzimy sprzedaż wysyłkową z
                            dostawą do domu leków OTC, dermokosmetyków i akcesoriów medycznych. Dla wygody naszych
                            Klientów
                            zamówienia można składać zarówno elektronicznie jak i telefonicznie. W razie pytań
                            dotyczących stosowania produktów nasze farmaceutki chętnie udzielą rzetelnej i fachowej
                            informacji.
                            Szybka wysyłka, bezpłatna dostawa przy zamówieniu od 200 zł, wygodne formy płatności, oferty
                            specjalne i niespodzianki w kategorii dermokosmetyki, a przede wszystkim fachowa obsługa
                            naszych
                            farmaceutów – to wszystko znajdziesz w aptece internetowej abcapteka.pl.
                            Jeśli nie znalazłaś/łeś produktu dla siebie - poinformuj nas o tym, zawsze jesteśmy gotowi
                            pomóc!
                        </p>

                        <p>
                            <img style="width: 100%;" src="img/glowna1.png" alt="zdjecie abc apteka">
                        </p>
                        <h3>Apteka Internetowa ABCapteka.pl</h3>
                        <p>
                        Apteka Internetowa ABCapteka.pl powstała na bazie sieci aptek z Białegostoku, działającej na rynku od ponad 10 lat.
                        GROFARM jest rodzinną firmą z wieloletnim doświadczeniem i tradycją. Nasze motto „Pacjent jest najważniejszy” przyświeca
                        nam każdego dnia. Zadowolenie Pacjentów to dla nas najwyższe wyróżnienie. Staramy się, aby Nasze Apteki były tymi szczególnymi miejscami,
                         nastawionymi przede wszystkim na jakość usług i opiekę nad Pacjentem. Efektem wsłuchania się w oczekiwania Pacjentów z każdego z pokolenia,
                         jest nasza apteka on line ABCapteka.pl. Działamy w trosce i na rzecz Pacjenta, by zapewnić mu szeroki i bezpieczny dostęp do leków, wyrobów medycznych,
                          kosmetyków, suplementów diety i mlek dla dzieci. I to właśnie, wyróżnia nas wśród innych Aptek.
                        </p>
                        <p>
                            <img style="width: 100%;" src="img/glowna2.png" alt="zdjecie abc apteka2">
                        </p>
                        <p>W naszej aptece internetowej pacjenci zyskują dostęp do bardzo szerokiej oferty produktów, oszczędzają czas i pieniądze dzięki atrakcyjnej cenowo ofercie oraz
                        możliwości dokonywania zakupów 24 godziny na dobę bez wychodzenia z domu.</p>
                        <h3>Dlaczego my?</h3>
                        <p>To co nas wyróżnia na tle innych - to biznes oparty na wartościach rodzinnych. Jako wewnętrzny obowiązek traktujemy dbałość o pracowników, środowisko, społeczność,
                         w której funkcjonujemy. Wspieramy akcje prospołeczne prowadzone przez lokalne instytucje i organizacje. Angażujemy się tam, gdzie nasza pomoc może przynieść trwałe rezultaty.
                         Łączymy nasze dwie główne kompetencje – empatię i wiedzę, co pozwala nam lepiej rozumieć oczekiwania i potrzeby Pacjentów. Słuchamy ich i
                         rozumiemy obawy związane ze zdrowiem. Nasi Farmaceuci, osoby zaangażowane i otwarte, prowadzą z Pacjentem dialog, wychodząc mu naprzeciw.</p>
                    </article>
                </section>
            </div>

            <div class="col-lg-3">
                <aside >
                <div class="glownaAside">
                    <h2 class="stylpaskow">Porady</h2>
                    <p class="asideTekst">
                        <img class="glownaAside" style="width: 100%;" src="img/aside1.png" alt="wiadomosci">
                        Od kilku lat kosmetyki naturalne, czyli stworzone na bazie roślinnych i naturalnych składników,
                        podbijają kosmetyczne rynki. Nic dziwnego wpisują się w coraz większą świadomość dbania o
                        siebie w zgodzie z naturą oraz troskę o środowisko. W Polsce każdego roku powstają nowe marki
                        naturalnych kosmetyków, ale jeśli dopiero zaczynasz swoją przygodę z tego typu pielęgnacją,
                        poznaj firmy, które przodują wśród liczby zadowolonych
                    </p>
                </div>
                <div class="glownaAside">
                    <h2 class="stylpaskow">Kontakt</h2>
                    <p>BIURO OBSŁUGI KLIENTA:</p>
                    <p>Infolinia: 85 30 77 444</p>
                    <p>E-mail: apteka@abcapteka.pl</p>
                    <p>Adres: Przejazd 2A/4, 15-430 Białystok (POLSKA)</p>
                    </div>
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