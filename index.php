<?php
session_start();

?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crustopia</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/loginheader.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" type="image/x-icon" href="pictures/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="header-logo-container">
            <a href="index.php">
                <div style="
                height: 80px;
                width: 80px;
                background-color: transparent;
                border: solid 1px #BDBEBE;
                border-radius: 50%;
                position: absolute;
                top: 5px;
                left: 40px;
                z-index: 40;">

                </div><img src="pictures/logo.png" alt="logo">
            </a>
        </div>
        <nav class="header-navigation">
            <div class="header-link-container">
                <a href="html/recipesPage.php"><span>Receptek</span></a>
                <a href="html/aboutpizzaPage.php"><span>A pizzáról</span></a>
                <a href="html/webshopPage.php"><span>Webshop</span></a>
                <?php
                if (isset($_SESSION["userdata"]["personaldata"])) {
                    echo "
                    <div class=\"header-hamburger-menu-login\">
                        <input type=\"checkbox\" class=\"menu-checkbox\">
                        <div class=\"checkbox-background\"></div>
                        <div class=\"hamburger-menu-link-container\">
                            <a href=\"html/profileChangePage.php\"><span>Profil</span></a>
                            <br>
                            <a href=\"html/cartPage.php\"><span>Kosár</span></a>
                            <br>
                            <a href=\"html/orderPage.php\"><span>Rendeléseim</span></a>
                            <br>
                            <form action=\"php/logoutHandler.php\" method=\"post\">
                                <input type=\"submit\" name=\"logout\" value=\"Kijelentkezés\">
                            </form>
                        </div>
                    </div>";
                } else {
                    echo "<a href=\"html/loginPage.php\"><span>Bejelentkezés</span></a>";
                }
                ?>
            </div>
        </nav>
        <div class="header-hamburger-menu">
            <input type="checkbox" class="menu-checkbox">
            <div class="checkbox-background"></div>
            <div class="hamburger-menu-link-container">
                <a href="html/webshopPage.php"><span>Webshop</span></a>
                <a href="html/aboutpizzaPage.php"><span>A pizzáról</span></a>
                <a href="html/recipesPage.php"><span>Receptek</span></a>
                <?php
                if (isset($_SESSION["userdata"]["personaldata"])) {
                    echo "
                        <a href=\"html/profileChangePage.php\"><span>Profil</span></a>
                        <a href=\"html/cartPage.php\"><span>Kosár</span></a>
                        <a href=\"html/orderPage.php\"><span>Rendeléseim</span></a>                  
                        <form action=\"php/logoutHandler.php\" method=\"post\">
                            <input type=\"submit\" name=\"logout\" value=\"Kijelentkezés\">
                        </form>
                        ";
                } else {
                    echo "<a href=\"html/loginPage.php\"><span>Bejelentkezés</span></a>";
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
        <div class="homepage-main-container" id="homepage-mainpic">
            <div class="homepage-fixed-main-picture"></div>

            <div class="homepage-main-container-text">
                <h1>Minden ami pizza!</h1>
                <a href="html/aboutpizzaPage.php"><span>Tudj meg többet</span></a>
            </div>
        </div>


        <div class="homepage-introduction" id="homepage-introduction">
            <div class="homepage-introduction-container founder-box">
                <div class="homepage-introduction-container-picture">
                    <h2>Alapító</h2>
                    <img src="pictures/founder.jpg" alt="founder">
                    <h5>Füves Ferenc</h5>
                </div>
                <p>
                    Füves Ferenc vagyok, a Crustopia alapítója.
                    Már gyerekkorom óta imádok pizzát készíteni, receptekkel kísérletezni, így 23 éves koromban jött az
                    ötlet, hogy megalapítom a Crustopiát, ahol megoszthatom az olvasóimmal a receptjeimet. Azóta már nem
                    csak én készítek új recepteket is, hanem Vörös Attila, főszakácsunk is. Remélem, hogy az
                    elkövetkezendő években is hasonló sikereket fogunk átélni együtt, veletek.
                </p>

            </div>
            <div class="homepage-introduction-container shef-box">
                <div class="homepage-introduction-container-picture">
                    <h2>Főszakács</h2>
                    <img src="pictures/shef.jpeg" alt="founder">
                    <h5>Vörös Attila</h5>
                </div>
                <p>
                    Vörös Attila vagyok, a Crustopia főszakácsa.
                    Már 17 éve, hogy pizzakészítésben dolgozom, ebből 10 évet dolgoztam Olaszországban, és küldetésemnek
                    érzem, hogy a csodás olasz ízeket, recepteket megosszam a magyar emberekkel. Hiszem, hogy a nyár
                    utolsó napsugarainak rezdüléséből aratott búzakalászból készülhet a legfinomabb pizza, melyet lelkem
                    minden egyes érintésével próbálok tökéletessé tenni.
                </p>

            </div>
            <div class="homepage-introduction-container about-box">
                <div class="homepage-introduction-container-picture">
                    <h2>Főszerkesztő</h2>
                    <img src="pictures/editor.jpg" alt="founder">
                    <h5>Bodrogi Béla</h5>
                </div>
                <p>
                    Bodrogi Béla vagyok, a Crustopia főszerkesztője.
                    Immáron hét éve dolgozok a Crustopia szerkesztőségében, eleinte még csak gyakornokként, ma már
                    főszerkesztőként. Meg kell, hogy mondjam, nagyon kellemes munkahely, ugyanis mindig akad valami új
                    kihívás, nagyon jó a társaság. Ja, és nem mellesleg még a pizzáink is nagyon finomak.
                </p>

            </div>
        </div>

        <div class="homepage-ingridients" id="homepage-ingridients">
            <div class="homepage-fixed-ingridients-picture"></div>
            <div class="homepage-ingridients-text">
                <h2>Használj minőségi hozzávalókat!</h2>
                <p>Egy jó pizzához elengedhetetlen a megfelelő alapanyagok használata. Több mint 10 éve dolgozunk, hogy
                    a megfelelő összetételű, eredeti alapanyagokat hozzunk létre.</p>
            </div>
        </div>

        <div class="homepage-webshop" id="homepage-webshop">
            <h2>Vásárolj nálunk akár 50% kedvezménnyel</h2>
            <a href="html/webshopPage.php">Vásárlás</a>
        </div>
    </main>
    <footer>
        <div class="footer-left-section">
            <ul>
                <li class="footer-li-title">Gyors gombok</li>
                <li><a href="html/aboutpizzaPage.php">A pizzáról</a></li>
                <li><a href="html/recipesPage.php">Receptek</a></li>
                <li><a href="html/webshopPage.php">Webshop</a></li>
                <li><a href="html/loginPage.php">Bejelentkezés</a></li>
            </ul>
        </div>
        <div class="footer-logo">
            <a href="index.php"><img src="pictures/logo.png" alt="logo"></a>
        </div>
        <div class="footer-right-section">
            <ul>
                <li class="footer-li-title">Gyors keresés az oldalon</li>
                <li>
                    <p onclick="centerScroll('homepage-mainpic')">Tudj meg többet</p>
                </li>
                <li>
                    <p onclick="centerScroll('homepage-introduction')">Rólunk</p>
                </li>
                <li>
                    <p onclick="centerScroll('homepage-ingridients')">Hozzávalók</p>
                </li>
                <li>
                    <p onclick="centerScroll('homepage-webshop')">Webshop</p>
                </li>
            </ul>
        </div>

    </footer>
    <script src="/js/scroll.js"></script>
</body>

</html>