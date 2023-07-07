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
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/loginheader.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/recipes.css">
    <link rel="icon" type="image/x-icon" href="../pictures/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <script src="../js/recipes.js"></script>
</head>

<body>
    <header>
        <div class="header-logo-container">
            <a href="../index.php"><img src="../pictures/logo.png" alt="logo"></a>
        </div>
        <nav class="header-navigation">
            <div class="header-link-container">
                <a href="recipesPage.php"><span style="border-bottom: solid 2px #BDBEBE;">Receptek</span></a>
                <a href="aboutpizzaPage.php"><span>A pizzáról</span></a>
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
                <a href="aboutpizzaPage.php"><span>A pizzáról</span></a>
                <a href="recipesPage.php"><span style="border-bottom: solid 2px #BDBEBE;">Receptek</span></a>
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
                    echo "<a href=\"loginPage.php\"><span>Bejelentkezés</span></a>";
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

    <main id="recipe-page-top">
        <div class="recipes-pizza-types">
            <div class="pizza pizza-1">
                <h2>Receptek</h2>
            </div>
            <div class="pizza">
                <h2>Nápolyi pizza</h2>
                <img src="../pictures/napolitan-style-pizza.jpeg" alt="napolyi" onclick="changeRecipe('napolyi')">
            </div>
            <div class="pizza">
                <h2>Milánói pizza</h2>
                <img src="../pictures/milanoi-pizza.jpeg" alt="milanoi" onclick="changeRecipe('milanoi')">
            </div>
            <div class="pizza">
                <h2>Quattro Formaggi pizza</h2>
                <img src="../pictures/quatro-formaggi-pizza.jpeg" alt="quattroformaggi" onclick="changeRecipe('quattroformaggi')">
            </div>
            <div class="pizza">
                <h2>Marinara pizza</h2>
                <img src="../pictures/marinara-pizza.jpeg" alt="marinara" onclick="changeRecipe('marinara')">
            </div>
            <div class="pizza">
                <h2>Margherita pizza</h2>
                <img src="../pictures/margherita-pizza.jpeg" alt="margherita" onclick="changeRecipe('margherita')">
            </div>
            <div class="pizza">
                <h2>Diavolo pizza</h2>
                <img src="../pictures/diavolo-pizza.jpeg" alt="diavolo" onclick="changeRecipe('diavolo')">
            </div>
            <div class="pizza">
                <h2>Capricciosa pizza</h2>
                <img src="../pictures/capricciosa-pizza.jpg" alt="capricciosa" onclick="changeRecipe('capricciosa')">
            </div>
            <div class="pizza">
                <h2>Quattro stagioni pizza</h2>
                <img src="../pictures/quattro-straggioni-pizza.webp" alt="quattro-stagioni-pizza" onclick="changeRecipe('quattrostagioni')">
            </div>
            <div class="pizza">
                <h2>Sfincione pizza</h2>
                <img src="../pictures/sicily-stlye-pizza.jpeg" alt="sfincione" onclick="changeRecipe('sfincione')">
            </div>
        </div>

        <hr>

        <div class="recipes-recipe-container" id="recipe">
            <div class="recipes-recipe-information">
                <div class="recipes-recipe-ingredients">
                    <h4>Hozzávalók</h4>
                    <ul>

                        <li>500 g kenyérliszt bl80</li>
                        <li>325 ml víz</li>
                        <li>15 g só</li>
                        <li>1 g instant élesztő</li>
                        <li>10 csepp olívaolaj</li>

                        <li>350 g konzerv paradicsom (1 konzerv)</li>
                        <li>1 gerezd fokhagyma (ízlés szerint)</li>
                        <li>1 ek olívaolaj (ízlés szerint)</li>
                        <li>bazsalikom ízlés szerint</li>
                        <li>só ízlés szerint</li>
                        <li>bors ízlés szerint</li>
                    </ul>
                </div>
                <div class="recipes-recipe-other">
                    <h4>Recept információk</h4>
                    <ul>
                        <li>Elkészítési idő: 60 perc</li>
                        <li>4 adag</li>
                        <li>Sütési hőmérséklet: 285 °C</li>
                        <li>Sütés ideje: 5 perc</li>
                    </ul>
                </div>
            </div>
            <div class="recipes-recipe-description">
                <p>
                    Keverjük el az élesztőt egy kevés langyos vízben, majd keverjük össze a lisztet a sóval egy
                    tálban.<br>
                    Ha feléledt az élesztő, keverjük hozzá a maradék vizet hidegen, majd öntsük a tálba, amiben a sós
                    lisztet kevertük. Gyúrjuk addig a tésztát, amíg el nem válik a tál falától.<br>
                    Formáljunk labdát a tésztából úgy, hogy a széleit mindig széthúzzuk, majd maga alá hajtjuk.<br>
                    Tegyük vissza a tésztát tálba. Fedjük le légmentesen fóliával, vagy tegyük az egész tálat
                    szemeteszsákba, hogy ki ne száradjon. Kelesszük 6-8 órán keresztül hűvös helyen.<br>
                </p>
                <p>
                    Kelés után vegyük elő a tésztát, és osszuk 3-4 részre. Formáljunk belőlük kis bucikat (úgy ahogy az
                    előző lépésnél is tettük, vagy formáljunk karikát mutató és hüvely ujjunkból és tömködjük át a
                    tésztát rajta).
                    Olajozzuk be a bucik felületét, hogy ki ne száradjanak. Fedjük le őket légmentesen, és kelesszük
                    legalább egy éjszakát a hűtőben vagy hűvös helyen.
                    A második kelés után vegyük ki a bucikat a hűtőből, hagyjuk 20 percig felengedni őket, majd
                    lapogassuk ki, és nyújtsuk kerekre a őket.
                    szósz
                </p>
                <p>
                    A nápolyiak nem szórakoznak sokat a szósszal. Vegyünk egy hámozott paradicsomkonzervet, sózzuk,
                    borsozzuk majd ízlés szerint tegyünk bele bazsalikomot, olívaolajat, fokhagymát. Kéziturmixszal
                    turmixoljuk össze, és kész is a tökéletes pizzaszósz!
                    Sütéshez melegítsük elő a sütőt maximum hőfokon pizzakövünkkel vagy pizzavasunkkal 30-40 percig.
                    Hirtelen mozdulattal csúsztassuk a kész pizzát lisztezett pizzalapátról vagy kartonlapról a
                    kőre/vasra. Kövön 7-10 perc a sütési idő, vason 4-5 perc.
                </p>
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
                <li class="footer-li-title" onclick="centerScroll('recipe-page-top')" style="cursor: pointer">Az oldal tetejére
                </li>
            </ul>
        </div>
    </footer>
    <script src="../js/scroll.js"></script>
</body>

</html>