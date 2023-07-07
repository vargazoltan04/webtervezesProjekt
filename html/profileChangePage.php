<?php
session_start();

if(!isset($_SESSION["userdata"])) {
    header("Location: loginPage.php");
}

$user_data = $_SESSION["userdata"];

$errors;
if (isset($_GET["error"])) {
    $errors = explode('_', $_GET["error"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crustopia - Fiók beállítás</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/loginheader.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/profileChange.css">
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
                            <a href=\"profileChangePage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Profil</span></a>
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
                    echo "<a href=\"loginPage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Bejelentkezés</span></a>";
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
                        <a href=\"profileChangePage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Profil</span></a>
                        <a href=\"cartPage.php\"><span>Kosár</span></a>
                        <a href=\"orderPage.php\"><span>Rendeléseim</span></a>                  
                        <form action=\"../php/logoutHandler.php\" method=\"post\">
                            <input type=\"submit\" name=\"logout\" value=\"Kijelentkezés\">
                        </form>
                        ";
                } else {
                    echo "<a href=\"loginPage.php\"><span style=\"border-bottom: solid 2px #BDBEBE;\">Bejelentkezés</span></a>";
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

    <main id="profile-page-top">
        <div class="form" id="formProfileChange">
            <form enctype="multipart/form-data" id="ProfileChange" action="../php/profileChangeHandler.php"
                method="post">
                <div class="ProfileChange-title">
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="ProfileChange-title-pizzaicon1">
                    <h2>Fiók beállítás</h2>
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="ProfileChange-title-pizzaicon2">
                </div>


                <div class="profile-change">
                    <label for="first-name">Vezetéknév</label>
                    <input type="text" id="first-name" name="first-name" value="<?php echo $user_data["personaldata"]["firstname"]; ?>">
                </div>

                <div class="profile-change">
                    <label for="last-name">Keresztnév</label>
                    <input type="text" id="last-name" name="last-name" value="<?php echo $user_data["personaldata"]["lastname"]; ?>">
                </div>

                <div class="profile-change">
                    <label for="username" title="username">Felhasználónév</label>
                    <input type="text" id="username" name="username" value="<?php if (empty($errors) || !in_array("username", $errors)) {
                        echo $user_data["personaldata"]["username"];
                    } ?>" placeholder="<?php if (!empty($errors) && in_array("username", $errors)) {
                         echo "Ez a felhasználónév már használva van";
                     } ?>">
                </div>

                <div class="profile-change">
                    <label for="date">Születési idő</label>
                    <input type="date" id="date" name="birthdate" required
                        value="<?php echo $user_data["personaldata"]["birthdate"]; ?>">
                </div>

                <div class="profile-change">
                    <label for="tel">Telefonszám</label>
                    <input type="tel" name="tel" id="tel" value="<?php echo $user_data["personaldata"]["tel"]; ?>">
                </div>

                <div class="profile-change">
                    <label for="email">Email cím</label>
                    <input type="text" name="email" id="email" value="<?php if (empty($errors) || (!in_array("emailFormat", $errors) && !in_array("emailUsed", $errors))) {
                        echo $user_data["personaldata"]["email"];
                    } ?>" placeholder="<?php if (!empty($errors) && in_array("emailFormat", $errors)) {
                         echo "Az email cím ilyen formában kell legyen: pelda@masikpelda.com";
                     } else if (!empty($errors) && in_array("emailUsed", $errors)) {
                         echo "Ezt az email címet már használja valaki";
                     } ?>">
                </div>

                <div class="profile-change">
                    <label for="password1">Jelszó</label>
                    <input type="password" id="password1" name="password1" placeholder="<?php if (!empty($errors) && in_array("passwordLength", $errors)) {
                        echo "A jelszónak legalább 8 karakter hosszúnak kell lenni!";
                    } else if (!empty($errors) && in_array("passwordNotEqual", $errors)) {
                        echo "A jelszavaknak meg kell egyezniük!";
                    } ?>">
                </div>

                <div class="profile-change">
                    <label for="password2">Jelszó mégegyszer</label>
                    <input type="password" id="password2" name="password2" placeholder="<?php if (!empty($errors) && in_array("passwordLength", $errors)) {
                        echo "A jelszónak legalább 8 karakter hosszúnak kell lenni!";
                    } else if (!empty($errors) && in_array("passwordNotEqual", $errors)) {
                        echo "A jelszavaknak meg kell egyezniük!";
                    } ?>">
                </div>

                <div class="profile-change">
                    <label for="gender">Neme</label>
                    <select class="gender-selection" size="1" name="gender" id="gender" style="width: 100%" required>
                        <option disabled value="">Neme</option>
                        <option value="male" <?php if ($user_data["personaldata"]["gender"] == "male")
                            echo "selected" ?>>Férfi
                            </option>
                            <option value="female" <?php if ($user_data["personaldata"]["gender"] == "female")
                            echo "selected" ?>>Nő
                            </option>
                        </select>
                    </div>

                    <div class="profileChange-account">
                        <input type="submit" class="profilChange-btn" id="ProfilChange-btn"
                            value="Személyes adatok elmentése">
                    </div>
                </form>

                <form enctype="multipart/form-data" id="deliveryDetailsChange"
                    action="../php/deliveryDetailsChangeHandler.php" method="post" style="margin-top: 100px">

                    <div class="profile-change">
                        <label for="postalcode">Irányítószám</label>
                        <input type="number" id="postalcode" name="postalcode"
                            value="<?php echo $user_data["deliverydetails"]["postalcode"]; ?>">
                </div>

                <div class="profile-change">
                    <label for="city">Város</label>
                    <input type="text" id="city" name="city"
                        value="<?php echo $user_data["deliverydetails"]["city"]; ?>">
                </div>

                <div class="profile-change">
                    <label for="street">Utca</label>
                    <input type="text" id="street" name="street" value="<?php if (!empty($user_data["deliverydetails"]["street"])) {
                        echo $user_data["deliverydetails"]["street"];
                    } ?>">
                </div>

                <div class="profile-change">
                    <label for="housenumber">Házszám</label>
                    <input type="number" id="housenumber" name="housenumber" value="<?php if (!empty($user_data["deliverydetails"]["housenumber"])) {
                        echo $user_data["deliverydetails"]["housenumber"];
                    } ?>">
                </div>

                <div class="profile-change">
                    <label for="phone">Telefonszám</label>
                    <input type="tel" name="tel" id="phone" value="<?php if (!empty($user_data["deliverydetails"]["tel"])) {
                        echo $user_data["deliverydetails"]["tel"];
                    } ?>">
                </div>

                <div class="profile-change">
                    <label for="payment">Fizetési mód</label>
                    <select class="gender-selection" size="1" name="payment" id="payment" style="width: 100%" required>
                        <option disabled value="">Fizetési mód</option>
                        <option value="cash" <?php if ($user_data["deliverydetails"]["payment"] == "cash")
                            echo "selected" ?>>Készpénz
                            </option>
                            <option value="creditcard" <?php if ($user_data["deliverydetails"]["payment"] == "creditcard")
                            echo "selected" ?>>Bankkártya
                            </option>
                        </select>
                    </div>

                    <div class="profileChange-account">
                        <input type="submit" class="profilChange-btn" id="DeliveryChange-btn"
                            value="Szállítási adatok elmentése">
                    </div>
                </form>

                <form enctype="multipart/form-data" id="pictureChange" action="../php/profilePictureChangeHandler.php"
                    method="post" style="margin-top: 100px">
                    <?php 
                        if(!empty($errors) && in_array("imageType", $errors)) {
                            echo "<h3 style=\"color: red\">Csak PNG formátumú képet lehet feltölteni!<h3>";
                        }
                    ?>
                    <div class="profile-change-picture">
                        <img src="../pictures/profilepicture/noprofilepicture.png" alt="profilepicture">
                        <input type="file" id="profile-picture" name="profile-picture">
                    </div>

                    <div class="profileChange-account">
                        <input type="submit" class="profilChange-btn" id="PictureChange-btn" value="Profilkép elmentése">
                    </div>
                </form>

                <br>
                <br>
                <form enctype="multipart/form-data" id="userDelete" action="../php/deleteUserHandler.php"
                    method="post" style="margin-top: 100px">
                    <div class="delete-account">
                        <input type="hidden" name="action" value="deleteUser">
                        <input type="submit" class="profilChange-btn" id="userDelete-btn" value="Fiók törlése">
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
                    <li class="footer-li-title" onclick="centerScroll('profile-page-top')" style="cursor: pointer">Az oldal
                        tetejére
                    </li>
                </ul>
            </div>
        </footer>
    </body>

    </html>