<?php
include_once("../php/functions.php");
session_start();
if (!isset($_SESSION["userdata"])) {
    header("Location: loginPage.php");
}
$orders = json_decode(file_get_contents("../database/orders.json"), true);
?>


<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crustopia - Rendelések</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/loginheader.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/order.css">
    <link rel="icon" type="image/x-icon" href="../pictures/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="../js/scroll.js"></script>
    <script src="../js/registrationLogin.js"></script>
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
                <a href="webshopPage.php"><span>Webshop</span></a>
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
                            <a href=\"orderPage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Rendeléseim</span></a>
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
                <a href="recipesPage.php"><span>Receptek</span></a>
                <?php
                if (isset($_SESSION["userdata"])) {
                    echo "
                        <a href=\"profileChangePage.php\"><span>Profil</span></a>
                        <a href=\"cartPage.php\"><span>Kosár</span></a>
                        <a href=\"orderPage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Rendeléseim</span></a>                  
                        <form action=\"../php/logoutHandler.php\" method=\"post\">
                            <input type=\"submit\" name=\"logout\" value=\"Kijelentkezés\">
                        </form>
                        ";
                } else {
                    echo "<a href=\"loginPage.php\"><span id=\"login\"style=\"border-bottom: solid 2px #BDBEBE;\">Bejelentkezés</span></a>";
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

    <main id="order-page-top">
        <?php
        $userHasOrder = false;
        if (!empty($orders)) {
            for ($i = 0; $i < count($orders); $i++) {
                if ($orders[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
                    $userHasOrder = true;
                    echo "<div class=\"order-container\">
                        <div class=\"order-title\">
                            <h2>Köszönjük a rendelésed</h2>
                        </div>
                        <div class=\"order-body\">
                            <div class=\"order-text\">
                                <p>A rendelésed megkaptuk és feldolgozás alatt áll. A rendelés pontos részleteit itt láthatod: </p>
                            </div>
                            <div class=\"order-table\">
                                <h3>Rendelési azonosító: <span>#" . str_pad($orders[$i]["orderId"], 4, "0", STR_PAD_LEFT) . "</span></h3>
                                <table style=\"width:100%\">
                                    <tr>
                                        <th>Termék</th>
                                        <th>Darab</th>
                                        <th>Ár</th>
                                    </tr>";
                    foreach ($orders[$i]["products"] as $key => $value) {
                        echo "
                                <tr>
                                    <td>" . getProductNameById($key) . "</td>
                                    <td>" . $value . "</td>
                                    <td>" . $value * getProductPriceById($key) . " Ft</td>
                                </tr>";
                    }
                    echo "<tr>
                            <td class=\"order-td-title\">Fizetési mód</td>
                            <td colspan=\"2\">Utánvétel</td>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Összesen</td>
                            <td colspan=\"2\">";
                    $sum = 0;
                    foreach ($orders[$i]["products"] as $key => $value) {
                        $sum += getProductPriceById($key) * $value;
                    }

                    echo $sum .

                        " Ft</td>
                        </tr>
                        <tr>
                            <th class=\"order-td-title\" colspan=\"3\">Szállítás</th>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Név</td>
                            <td colspan=\"2\">" . $_SESSION["userdata"]["personaldata"]["firstname"] . " " . $_SESSION["userdata"]["personaldata"]["lastname"] . "</td>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Irányítószám</td>
                            <td colspan=\"2\">" . 
                            $orders[$i]["postalcode"] . 
                            "</td>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Város</td>
                            <td colspan=\"2\">" . $orders[$i]["city"] .  "</td>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Utca/Házszám</td>
                            <td colspan=\"2\">" . $orders[$i]["housenumber"] .  "</td>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Email</td>
                            <td colspan=\"2\">" . $_SESSION["userdata"]["personaldata"]["email"] . "</td>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Telefonszám</td>
                            <td colspan=\"2\">" . $orders[$i]["tel"] .  "</td>
                        </tr>
                        <tr>
                            <td class=\"order-td-title\">Megjegyzés</td>
                            <td colspan=\"2\">" . $orders[$i]["comment"] . "</td>
                        </tr>
                    </table>
                </div>
                <div class=\"order-text2\">
                    <p>A futárok munkanapokon kézbesítik a csomagokat, általában 8:00-18:00 óra között.</p>
                    <p>Megjegyzés: Ha átvételkor észreveszed, hogy a csomagodat kinyitották vagy a csomagolás sérült,
                        akkor ne feledd, hogy a csomag átvételekor, a Futár jelenlétében van lehetőséged kárfelvételi
                        jegyzőkönyvet írni. Ez segítségégünkre lesz később a reklamáció értékelésében.</p>
                    <p>Kérdésed van? Írj nekünk az <a href=\"https://mail.google.com\">info@crustopia.hu</a> címre, vagy
                        hívj minket a <a>+36 3 800 1790</a> számon.</p>
                </div>
                <div class=\"order-farewell\">
                    <p>Köszönjük szépen,</p>

                    <div class=\"order-farewell-pic\">
                        <p class=\"order-team\">A Crustopia csapata</p>
                        <img src=\"../pictures/pizzaicon.svg\" alt=\"pizzaicon\">
                    </div>
                </div>
            </div>
        </div>";
                }
            }
        }
        if (!$userHasOrder) {
            echo "
            <div class=\"no-order-title\">
                <h2>Rendeléseim</h2>
                <h2>Még nincs rendelésed!</h2>
                <h2>Ha szeretnél rendelni valamit, akkor kattints <a href=\"webshopPage.php\">Ide</a></h2>
            </div>";
        }
        ?>

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
                <li class="footer-li-title" onclick="centerScroll('order-page-top')" style="cursor: pointer">Az oldal
                    tetejére
                </li>
            </ul>
        </div>
    </footer>



</body>

</html>