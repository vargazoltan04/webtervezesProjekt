<?php
include_once("../php/functions.php");
session_start();

if (!isset($_SESSION["userdata"])) {
    header("Location: ../html/loginPage.php");
}

$errors;
if (isset($_GET["error"])) {
    $errors = explode('_', $_GET["error"]);
}

$cart;
$data = json_decode(file_get_contents("../database/cart.json"), true);
$index;
if (!empty($data)) {
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
            $index = $i;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crustopia - Bejelentkezés</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/loginheader.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/cart.css">
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
                            <a href=\"cartPage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Kosár</span></a>
                            <br>
                            <a href=\"orderPage.php\"><span>Rendeléseim</span></a>
                            <br>
                            <form action=\"../php/logoutHandler.php\" method=\"post\">
                                <input type=\"submit\" name=\"logout\" value=\"Kijelentkezés\">
                            </form>
                        </div>
                    </div>";
                } else {
                    echo "<a href=\"loginPage.php\"><span id=\"login\">Bejelentkezés</span></a>";
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
                        <a href=\"cartPage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Kosár</span></a>
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

    <main id="cart-page-top">
        <div class="cart-title">
            <h2>Kosár</h2>
        </div>
        <div class="cart-container">
            <div class="cart-body">
                <div class="cart-table">
                    <table style="width:100%">
                        <tr>
                            <th>Termék</th>
                            <th>Darab</th>
                            <th>Ár</th>
                        </tr>

                        <?php
                        foreach ($data[$index]["products"] as $key => $value) {
                            echo "
                                    <tr>
                                        <td>" . getProductNameById($key) . "                                            
                                            <form class=\"cart-remove-item\" action=\"../php/cartHandler.php\" method=\"post\">
                                                <input type=\"hidden\" name=\"action\" value=\"deleteItem\">
                                                <input type=\"hidden\" name=\"product\" value=\"$key\">
                                                <input type=\"submit\" value=\"Törlés\">
                                            </form>
                                        </td>
                                        <td>$value</td>
                                        <td>" . $value * getProductPriceById($key) . " Ft</td>
                                    </tr>
                                ";
                        }
                        ?>
                        <tr>
                            <td class="cart-td-title">Összesen</td>
                            <td colspan="2">
                                <?php
                                $sum = 0;
                                foreach ($data[$index]["products"] as $key => $value) {
                                    $sum += getProductPriceById($key) * $value;
                                }

                                echo $sum . " Ft";
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="cart-order">
            <form class="form" action="../php/cartHandler.php" method="post">
                <div class="cart-order-title">
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="cart-order-title-pizzaicon1">
                    <h2>Rendelés</h2>
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="cart-order-title-pizzaicon2">
                </div>

                <div class="cart-order">
                    <label for="zip">Irányítószám</label>
                    <input type="text" id="zip" name="postalcode" required value="<?php
                    if (empty($errors) || !in_array("postalcode", $errors)) {
                        echo $_SESSION["userdata"]["deliverydetails"]["postalcode"];
                    }
                    ?>" placeholder="<?php if (!empty($errors) && in_array("postalcode", $errors)) {
                        echo "A rendeléshez meg kell adni irányítószámot";
                    } else {
                        echo "3521";
                    } ?>
                    ">
                </div>

                <div class="cart-order">
                    <label for="city">Város</label>
                    <input type="text" id="city" name="city" required value="<?php
                    if (empty($errors) || !in_array("city", $errors)) {
                        echo $_SESSION["userdata"]["deliverydetails"]["city"];
                    }
                    ?>" placeholder="<?php if (!empty($errors) && in_array("city", $errors)) {
                        echo "A rendeléshez meg kell adni települést";
                    } else {
                        echo "Miskolc";
                    } ?>
                    ">
                </div>

                <div class="cart-order">
                    <label for="street">Utca</label>
                    <input type="text" id="street" name="street" required value="<?php
                    if (empty($errors) || !in_array("street", $errors)) {
                        echo $_SESSION["userdata"]["deliverydetails"]["street"];
                    }
                    ?>" placeholder="<?php if (!empty($errors) && in_array("street", $errors)) {
                        echo "A rendeléshez meg kell adni lakóhelyet";
                    } else {
                        echo "Hunyadi János út";
                    } ?>
                    ">
                </div>

                <div class="cart-order">
                    <label for="street">Házszám</label>
                    <input type="number" id="housenumber" name="housenumber" required value="<?php
                    if (empty($errors) || !in_array("housenumber", $errors)) {
                        echo $_SESSION["userdata"]["deliverydetails"]["housenumber"];
                    }
                    ;
                    ?>" placeholder="<?php if (!empty($errors) && in_array("street", $errors)) {
                        echo "A rendeléshez meg kell adni lakóhelyet";
                    } else {
                        echo "12";
                    } ?>
                    ">
                </div>

                <div class="cart-order">
                    <label for="street">Telefonszám</label>
                    <input type="tel" id="tel" name="tel" required value="<?php
                    if (empty($errors) || !in_array("tel", $errors)) {
                        echo $_SESSION["userdata"]["deliverydetails"]["tel"];
                    }
                    ?>" placeholder="<?php if (!empty($errors) && in_array("tel", $errors)) {
                        echo "A rendeléshez meg kell adni elérhetőséget";
                    } else {
                        echo "+36/12-345-6789";
                    } ?>
                    ">
                </div>

                <div class="cart-order">
                    <label for="payment">Fizetési mód</label>
                    <select name="payment" id="payment" required>
                        <option disabled value="">
                            <?php if (!empty($errors) && in_array("payment", $errors)) {
                                echo "A rendeléshez válassz ki egy fizetési módot";
                            } else {
                                echo "Fizetési mód";
                            }
                            ?>
                        </option>
                        <option value="cash" <?php if ((empty($errors) || !in_array("payment", $errors)) && $_SESSION["userdata"]["deliverydetails"]["payment"] == "cash")
                            echo "selected" ?>>Készpénz
                            </option>
                            <option value="creditcard" <?php if ((empty($errors) || !in_array("payment", $errors)) && $_SESSION["userdata"]["deliverydetails"]["payment"] == "creditcard")
                            echo "selected" ?>>
                                Bankkártya</option>
                        </select>
                    </div>
                    <div class="cart-order comment">
                        <label for="comment">Megjegyzés</label>
                        <input type="text" id="comment" name="comment">
                    </div>
                    <div class="cart-order-button">
                        <input type="hidden" id="action" name="action" value="orderItem">
                        <input type="submit" class="cart-order-btn" id="cart-order-btn" value="Rendelés">
                    </div>
                </form>
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
                    <li class="footer-li-title" onclick="centerScroll('cart-page-top')" style="cursor: pointer">Az oldal
                        tetejére
                    </li>
                </ul>
            </div>
        </footer>
    </body>

    </html>