<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crustopia - Webshop</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/loginheader.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/webshop.css">
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
                <a href="aboutpizzaPage.php"><span>A pizzáról</span></a>
                <a href="webshopPage.php"><span style="border-bottom: solid 2px #BDBEBE;">Webshop</span></a>
                <?php
                if (isset($_SESSION["userdata"])) {
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
                <a href="webshopPage.php"><span style="border-bottom: solid 2px #BDBEBE;">Webshop</span></a>
                <a href="aboutpizzaPage.php"><span>A pizzáról</span></a>
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

    <main id="webshop-page-top">
        <div class="webshop-title-container">
            <div class="webshop-title">
                <h1>Webshop</h1>
            </div>
        </div>


        <div class="webshop-container" id="webshop-container">
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Paradicsom: A Legjobb pizza receptek egy könyvben</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0001" value="product_0001" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Mesterkurzus: Lépésről lépésre a tökéletes pizza elkészítéséhez</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0002" value="product_0002" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Szerelmeseinek: A Legfinomabb pizzák otthoni elkészítése</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0003" value="product_0003" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>

            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Varázslat: Kreatív pizza receptek a konyhában</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0004" value="product_0004" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Varázslat 2: A Legjobb pizza receptek a világból</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0005" value="product_0005" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Gasztronómia: Ínycsiklandó pizza receptek, amelyeket mindenki szeret</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0006" value="product_0006" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Parti: Több mint 50 tökéletes pizza recept</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0007" value="product_0007" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Kaland: Fedezd fel a világ legjobb pizzáit egy könyvben</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0008" value="product_0008" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Sütés 101: Az alapoktól a mesterfogásokig</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0009" value="product_0009" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Tökéletesítés: Receptek a klasszikus pizzák megalkotásához</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0010" value="product_0010" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Társaság: Több mint 100 recept a legfinomabb pizzákhoz</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0011" value="product_0011" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
            </div>
            <div class="webshop-container-item">
                <div class="webshop-img-container">
                    <img src="../pictures/webshop-pizza-book.jpeg" alt="chicago-style-pizza">
                </div>
                <br>
                <h3>Pizza Konyha: Pizza receptek ínyenceknek</h3>
                <br>
                <span>9000 Ft</span>
                <form enctype="multipart/form-data" action="../php/cartHandler.php" method="post">
                    <input type="hidden" name="action" value="addItem">
                    <input type="hidden" id="product_0012" value="product_0012" name="product">
                    <input type="number" name="count" min="1" value="1">
                    <input type="submit" value="Kosárba tesz">
                </form>
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
                <li class="footer-li-title" onclick="centerScroll('webshop-page-top')" style="cursor: pointer">Az oldal
                    tetejére
                </li>
            </ul>
        </div>

    </footer>
    <script src="../js/scroll.js"></script>
    <script src="../js/webshop.js"></script>
</body>

</html>