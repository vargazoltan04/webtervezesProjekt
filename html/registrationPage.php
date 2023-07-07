<?php
session_start();
if(isset($_SESSION["userdata"])) {
    header("Location: ../index.php");
}

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
    <title>Crustopia - Bejelentkezés</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/loginheader.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/login.css">
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
                        <a href=\"profileChangePage.php\"><span>Profil</span></a>
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
                "<div class=\"header-profile-picture-container\">" . "<img src=" . "../pictures/profilepicture/" . $_SESSION["userdata"]["picture"] . ">
            </div>";
        }
        ?>
    </header>

    <main>
        <div class="form" id="formRegistration">
            <form id="registration" action="../php/registrationHandler.php" method="post">
                <div class="registration-title">
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="registration-title-pizzaicon1">
                    <h2>Regisztráció</h2>
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="registration-title-pizzaicon2">
                </div>

                <div class="registration-name">
                    <div class="registration-label firstname">
                        <label for="first-name">Vezetéknév</label>
                        <input type="text" id="first-name" name="first-name" placeholder="Varga" required>
                    </div>
                    <div class="registration-label">
                        <label for="last-name">Keresztnév</label>
                        <input type="text" id="last-name" name="last-name" placeholder="Zoltán" required>
                    </div>
                </div>

                <div class="registration-date-gender">
                    <div class="registration-label">
                        <label for="date">Születési idő</label>
                        <input type="date" id="date" name="birthdate" required>
                    </div>
                    <div class="registration-label gender">
                        <label for="gender">Neme</label>
                        <select name="gender" id="gender" required>
                            <option disabled selected value="">Neme</option>
                            <option value="male">Férfi</option>
                            <option value="female">Nő</option>
                        </select>
                    </div>
                </div>

                <div class="registration-label">
                    <label for="tel">Telefonszám:</label>
                    <input type="tel" name="tel" id="tel" placeholder="+36/20-260-5323" required>
                </div>
                <div class="registration-label">
                    <label for="email">Email cím
                        <?php if (isset($_GET["error"]))
                            if (in_array("emailFormat", $errors)) {
                                echo " -  <span class=\"registration-error\"> Az email cím ilyen formában kell legyen: pelda@masikpelda.com </span>";
                            } else if (in_array("emailUsed", $errors)) {
                                echo " -  <span class=\"registration-error\"> Ezt az email címet már használja valaki </span>";
                            }
                        ?>
                    </label>
                    <input type="text" name="email" id="email" placeholder="example@example.com" required>
                </div>
                <div class="registration-label">
                    <label for="username">Felhasználónév
                        <?php if (isset($_GET["error"]))
                            if (in_array("username", $errors)) {
                                echo " -  <span class=\"registration-error\"> Ez a felhasználónév már használva van </span>";
                            }
                        ?>
                    </label>
                    <input type="text" id="username" name="username" placeholder="bestcooker3" required>
                </div>
                <div class="registration-label">
                    <label for="password1">Jelszó - 8 karakter
                        <?php if (isset($_GET["error"]))
                            if (in_array("passwordLength", $errors)) {
                                echo " - <span class=\"registration-error\"> A jelszónak legalább 8 karakter hosszúnak kell lenni! </span>";
                            } else if (in_array("passwordNotEqual", $errors)) {
                                echo " -  <span class=\"registration-error\"> A jelszavaknak meg kell egyezniük! </span>";
                            }
                        ?>
                    </label>
                    <input type="password" id="password1" name="password1" placeholder="MintaJelszo012" required>
                </div>
                <div class="registration-label">
                    <label for="password2">Jelszó mégegyszer</label>
                    <input type="password" id="password2" name="password2" placeholder="MintaJelszo012" required>
                </div>



                <div class="registration-aszf">
                    <br>
                    <input type="checkbox" name="aszf" id="checkbox" required>
                    <p>Elfogadom az általános szerződési feltételeket</p>
                </div>
                <br>
                
                    <?php if (isset($_GET["error"])) {
                        if (in_array("empty", $errors)) {
                            echo "<span>A regisztrációhoz minden mezőt ki kell tölteni!</span>";
                        }
                    } ?>
                
                
                    <?php if (isset($_GET["error"])) {
                        if (in_array("aszf", $errors)) {
                            echo "<span>A regisztrációhoz el kell fogadnod a felhasználási feltételeket!</span>";
                        }
                    } ?>
                

                <div class="registration-account">
                    <input type="submit" class="register-btn" id="register-btn">
                    <p>Van már fiókod? <a href="loginPage.php">Jelentkezz be</a></p>
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
                <li class="footer-li-title">Gyors keresés az oldalon</li>
                <li>
                    <p onclick="changeForm('formLogin');centerScroll('formLogin')">Regisztráció</p>
                </li>
                <li>
                    <p onclick="changeForm('formRegistration');centerScroll('formRegistration')">Bejelentkezés</p>
                </li>
            </ul>
        </div>

    </footer>


</body>

</html>