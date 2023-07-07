<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crustopia - Mindent a pizzáról</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/loginheader.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/aboutpizza.css">
    <link rel="icon" type="image/x-icon" href="../pictures/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>

<body>
    <header>
        <div class="header-logo-container">
            <a href="../index.php"><img src="../pictures/logo.png" alt="logo"></a>
        </div>
        <nav class="header-navigation">
            <div class="header-link-container">
                <a href="recipesPage.php"><span>Receptek</span></a>
                <a href="aboutpizzaPage.php"><span style="border-bottom: solid 2px #BDBEBE;">A pizzáról</span></a>
                <a href="webshopPage.php"><span>Webshop</span></a>
                <?php 
                if(isset($_SESSION["userdata"])) {
                    echo "
                    <div class=\"header-hamburger-menu-login\">
                        <input type=\"checkbox\" class=\"menu-checkbox\">
                        <div class=\"checkbox-background\"></div>
                        <div class=\"hamburger-menu-link-container\">
                            <a href=\"profileChangePage.php\"><span>Profil</span></a>
                            <br>
                            <a href=\"cartPage.php\"><span>Kosár</span></a>
                            <br>
                            <a href=\"orderPage.php\"><span>Rendeléseim</span></a>
                            <br>
                            <form action=\"../php/logoutHandler.php\" method=\"post\">
                                <input type=\"submit\" name=\"logout\" value=\"Kijelentkezés\">
                            </form>
                        </div>
                    </div>";
                } else {
                    echo "<a href=\"loginPage.php\"><span>Bejelentkezés</span></a>";
                }  
            ?>
            </div> 
        </nav>
        <div class="header-hamburger-menu">
            <input type="checkbox" class="menu-checkbox">
            <div class="checkbox-background"></div>
            <div class="hamburger-menu-link-container">
                <a href="webshopPage.php"><span>Webshop</span></a>
                <a href="aboutpizzaPage.php"><span style="border-bottom: solid 2px #BDBEBE;">A pizzáról</span></a>
                <a href="recipesPage.php"><span>Receptek</span></a>
                <?php
                if (isset($_SESSION["userdata"])) {
                    echo "
                        <a href=\"profileChangePage.php\"><span>Profil</span></a>
                        <a href=\"cartPage.php\"><span>Kosár</span></a>
                        <a href=\"orderPage.php\"><span>Rendeléseim</span></a>                  
                        <form action=\"../php/logoutHandler.php\" method=\"post\">
                            <input type=\"submit\" name=\"logout\" value=\"Kijelentkezés\">
                        </form>
                        ";
                } else {
                    echo "<a href=\"loginPage.php\"><span id=\"login\">Bejelentkezés</span></a>";
                }
                ?>
            </div>
        </div>
        <?php
        if (isset($_SESSION["userdata"]["picture"])) {
            echo
                "<div class=\"header-profile-picture-container\">" . "<img alt=\"profilkep\" src=" . "../pictures/profilepicture/" . $_SESSION["userdata"]["picture"] . ">
            </div>";
        }
        ?>
    </header>

    <main>
        <div class="aboutpizza-title" id="aboutpizza-title">
            <div class="aboutpizza-fixed"></div>
            <div class="aboutpizza-text">
                <h2>A pizza története</h2>
            </div>
        </div>


        <div class="aboutpizza-history" id="aboutpizza-history">
            <h2>Honnan is származik a pizza?</h2>

            <div class="aboutpizza-history-sectionA">
                <p>A pizza világszerte napjaink egyik legkedveltebb étele. Azon kevés étkek közé tartozik, melyet korra
                    és nemre való tekintet nélkül szinte mindenki szeret, és amiből szinte bármikor le tud gyűrni egy
                    szeletet. Na, de honnan származik a pizza, és mióta ennyi ember kedvence?</p>
                <img src="../pictures/aboutpizza-pizza.jpeg" alt="pizza">
            </div>


            <p>Maga a pizza szó az olasz „picea” szóból ered, melyet a rómaiak a kenyér kemencében sütésének leírására
                használtak. A pizza első feltűnése a dél-itáliai görög kolóniák idejére tehető. </p>
            <p>A pizzát Vergilius Aenisában említik először. Cato (Kr. e. 209–149) az általa írt Róma történetében is
                említ egy „lapos kelt tésztát, melyet olívaolajjal, fűszerekkel és mézzel édesítenek, és köveken sütnek
                meg”. A Kr. u. 79-ben „elpusztult” Pompei maradványai között a régészek olyan üzleteket tártak fel,
                amelyek a mai modern pizzériák elődeinek tekinthetők.</p>
            <p>Ezek a pizzák azonban még különbözőek voltak a ma ismert pizzától. Eredetileg a pizza kenyértésztából
                gömbölyített, lapított, különböző zöldségekkel megrakott lángos volt. Továbbá, a korai pizza
                elkészítésénél paradicsom helyett mézet használtak, hiszen a paradicsom ekkor még ismeretlennek
                számított Európában</p>
            <p>A 16. században az amerikaiak behozták a paradicsomot Európába, de ekkor számos európai még azt gondolta,
                hogy a paradicsom mérgező (és valóban az is néhány fajtája). Így csak a 18. századtól használtak
                paradicsomot a pizza elkészítéséhez, főleg Nápoly szegénynegyedeiben volt ez divat. A pizza Nápoly igazi
                turistalátványossága lett. A Nápolyba látogatók elzarándokoltak a város szegény negyedeibe, hogy
                kipróbálják a helyi specialitást.</p>

            <div class="aboutpizza-history-sectionB" id="aboutpizza-history-oven">
                <img src="../pictures/aboutpizza-mozarella.jpeg" alt="mozarella">
                <p>1780-ban megalapították a Pietro e basta cosí nevű sütödét, ami még ma is eredeti helyén működik
                    Nápolyban, Pizzeria Brandi néven. Itt dolgozott bő száz évvel később, 1889-ben Raffaele Esposito,
                    őneki tulajdonítják az első igazi, mai, modern pizzát. Történt ugyanis, hogy 1889-ben a szavojai I.
                    Umberto király Margherita királyné egy nápolyi nyaralás alkalmával ki akarta próbálni a pizzát. Így
                    Raffaele Esposito, a híres nápolyi pizzakészítő elkészített számára egy olyan pizzát, amely az olasz
                    nemzeti lobogó színeiből épült fel: zöld (bazsalikom), fehér (mozzarella) és piros (paradicsom).
                </p>
            </div>

            <p>Készítője a királynő iránt való tisztelete jeléül Margheritának nevezte el ezt a pizzát. A legismertebb
                egy koronás fő iránti mély tisztelet keverékeként született meg.</p>
            <div class="aboutpizza-history-sectionA">
                <p>1830-ig a pizzákat nyitott standokon árulták, és utcai árusok kínálták. Az első mai értelemben vett
                    pizzéria 1830 környékén nyílt meg Nápolyban, a neve Pizzeria Port’Alba volt. Ekkor a pizza volt az
                    egyetlen étel Nápolyban, amihez a szegény emberek hozzájutottak télvíz idején.</p>
                <img src="../pictures/aboutpizza-oven.jpeg" alt="oven">
            </div>

            <p>Az Egyesült Államokban a pizza a 19. század végén tűnt fel, olasz bevándorlók közvetítésével. Az első
                amerikai pizzériát valószínűleg Gennaro Lombardi nyitotta Manhattan Little Italy negyedében.</p>
            <p>Ahány ház, annyiféle pizza. Az igazi olasz pizza tésztáját általában vékonyra nyújtják, és kevés feltétet
                tesznek rá. A pizzakemencében lévő kb. 400 °C fokos hő hatására a sülő tésztában lévő élesztő új életre
                kel, buborékok keletkeznek, és a pizza tésztája csodálatosan könnyű lesz. A feltétek alapja a legtöbb
                esetben (az ún. fehér pizzákat leszámítva) a bazsalikommal fűszerezett paradicsomszósz, valamint a
                mozzarella sajt. A végeredmény egy fenséges és egyben egyszerű étel, amiért mindmáig milliók rajonganak,
                és napjaink ételkultújának elidegeníthetetlen részét képezi.</p>

            <div class="aboutpizza-history-ingridients" id="aboutpizza-history-ingridients">
                <h3>Mozzarella – eredetileg bivalytejből, ma inkább tehéntejből készül</h3>
                <p>Zsíros, kissé édeskés, tömör állagú gyúrt sajt, amelyet savóban árulnak. Csak óvatosan! Ha
                    kinyitjuk, el kell fogyasztani az egészet, vagy lezárt edényben a savóban tárolni, de csak 1-2
                    napig.</p>
                <h3>Mascarpone – tejszínből savak felhasználásával készül, állaga a magyar krémsajtra emlékeztet.</h3>
                <p>Nem sós sajtféle, így leginkább desszerteket készítenek belőle, de pástétomokhoz is használható. A
                    legismertebb, mascarpone felhasználásával készülő édesség a tiramisu.</p>
                <h3>Parmezán – keménysajt, amelyet 2-3 évig érlelnek</h3>
                <p>Lefölözött tehéntejből készülő sajt, amelynek eredeti kérgét lekefélik, majd beolajozzák. Már
                    Boccaccio Decameronjában is szerepelt.</p>
                <h3>Pármai sonka</h3>
                <p>Párma a hazája ennek a különlegességnek, elkészítésében pedig – állítólag – óriási szerepe van a
                    város klímáját meghatározó négy folyónak. Érlelési ideje legalább 12 hónap, de egyes olasz források
                    szerint inkább 14-18 hónap.</p>
                <p>A sonka hajszálvékonyra szeletelve mind illatá-ban, mind látványában rendkívül étvágygerjesz-tő, és
                    az igazi szakértők azt ajánlják: mindenképpen együtt kell fogyasztani a húsos és a zsíros részét,
                    hogy igazi zamata a szánkban álljon össze.</p>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-left-section">
            <ul>
                <li class="footer-li-title">Gyors gombok</li>
                <li><a href="aboutpizzaPage.php">A pizzáról</a></li>
                <li><a href="recipesPage.php">Receptek</a></li>
                <li><a href="webshopPage.php">Webshop</a></li>
                <li><a href="loginPage.php">Bejelentkezés</a></li>
            </ul>
        </div>
        <div class="footer-logo">
            <a href="../index.php"><img src="../pictures/logo.png" alt="logo"></a>
        </div>
        <div class="footer-right-section">
            <ul>
                <li class="footer-li-title">Gyors keresés az oldalon</li>
                <li>
                    <p onclick="centerScroll('aboutpizza-title')">Története</p>
                </li>
                <li>
                    <p onclick="centerScroll('aboutpizza-history')">Származás</p>
                </li>
                <li>
                    <p onclick="centerScroll('aboutpizza-history-ingridients')">Hozzávalók</p>
                </li>
                <li>
                    <p onclick="centerScroll('aboutpizza-history-oven')">Sütöde</p>
                </li>
            </ul>
        </div>

    </footer>
    <script src="../js/scroll.js"></script>
</body>

</html>