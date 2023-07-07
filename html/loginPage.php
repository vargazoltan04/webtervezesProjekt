<?php
    session_start();
    if(isset($_SESSION["userdata"])) {
        header("Location: ../index.php");
    }
    $errors;
    if(isset($_GET["error"])) {
        $errors = explode('_', $_GET["error"]);
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

        <div class="form" id="formLogin">
            <form id="login" action="../php/loginHandler.php" method="post">
                <div class="registration-title">
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="registration-title-pizzaicon1">
                    <h2>Bejelentkezés</h2>
                    <img src="../pictures/pizzaicon.svg" alt="pizzaicon" class="registration-title-pizzaicon2">
                </div>
                <?php
                        if(!empty($errors) && in_array("wrongCombination", $errors)) {
                            echo "<h3 style=\"color: red\">Rossz email cím és jelszó kombináció</h3><br>";
                        }
                    ?>

                <input type="email" name="email" id="emailLogin" placeholder="example@example.com"><br>
                <input type="password" id="passwordLogin" name="password" placeholder="Jelszó" required>

                <div class="registration-account">
                    <input type="submit" class="register-btn" id="login-btn" value="Bejelentkezés">
                    <p>Nincs még fiókod? <a href="registrationPage.php">Regisztrálj be</a></p>
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