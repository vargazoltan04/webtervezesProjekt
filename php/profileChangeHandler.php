<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["userdata"]["personaldata"])) {
    header("Location: ../html/loginPage.php");
}

$userdata = $_SESSION["userdata"];



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $error = [
        'username' => false,
        'emailFormat' => false,
        'emailUsed' => false,
        'passwordNotEqual' => false,
        'passwordLength' => false
    ];

    $firstname = $userdata["personaldata"]["firstname"];
    if (isset($_POST["first-name"]) && trim($_POST["first-name"]) !== '') {
        $firstname = $_POST["first-name"];
    }

    $lastname = $userdata["personaldata"]["lastname"];
    if (isset($_POST["last-name"]) && trim($_POST["last-name"]) !== '') {
        $lastname = $_POST["last-name"];
    }

    $username = $userdata["personaldata"]["username"];
    if (isset($_POST["username"]) && trim($_POST["username"]) !== '') {
        //Ha az elküldött felhnév és a bejelentkezett felhnév nem egyezik meg (azaz módosította a felhasználó)
        //És ez a módosult felhasználó benne van a fájlban, akkor tudjuk, hogy foglalt a név, és nem ez a felhasználó foglalta el
        //tehát hibaüzenetet adhatunk
        if ($_POST["username"] != $userdata["personaldata"]["username"] && stringInFile("username", $_POST["username"])) {
            $error["username"] = true;
        } else {
            $username = $_POST["username"];
        }
    }

    $birthdate = $userdata["personaldata"]["birthdate"];
    if (isset($_POST["birthdate"]) && trim($_POST["birthdate"]) !== '') {
        $birthdate = $_POST["birthdate"];
    }

    $tel = $userdata["personaldata"]["tel"];
    if (isset($_POST["tel"]) && trim($_POST["tel"]) !== '') {
        $tel = $_POST["tel"];
    }

    $email = $userdata["personaldata"]["email"];
    if (isset($_POST["email"]) && trim($_POST["email"]) !== '') {
        //Ha az email formátuma megfelelő, akkor az email változóba berakjuk az elküldött emailt, különben errort adunk
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST["email"];
        } else {
            $error["emailFormat"] = true;
        }

        //Ha az elküldött email és a belépett email nem egyezik meg, de a fájlban benne van az elküldött email, akkor
        //biztosan tudjuk, hogy az adott email cím már használatban van és nem a küldő által, ezért errort adhatunk
        if ($_POST["email"] != $userdata["personaldata"]["email"] && stringInFile("email", $_POST["email"])) {
            $error["emailUsed"] = true;
        }
    }

    $password = $userdata["personaldata"]["password"];
    if (isset($_POST["password1"]) && isset($_POST["password2"])) {
        $pw1 = $_POST["password1"];
        $pw2 = $_POST["password2"];

        if (trim($pw1) !== '' && trim($pw2) != '' && (strlen($pw1) < 8 || strlen($pw2) < 8)) {
            $error["passwordLength"] = true;
        } else if (trim($pw1) !== '' && trim($pw2) != '' && $pw1 !== $pw2) {
            $error["passwordNotEqual"] = true;
        }

        if (trim($pw1) !== '' && $pw1 === $pw2) {
            $password = password_Hash($pw1, PASSWORD_DEFAULT);
        }
    }

    $gender = $userdata["personaldata"]["gender"];
    if (isset($_POST["gender"])) {
        $gender = $_POST["gender"];
    }

    if (in_array(true, $error)) {
        errorOutput("../html/profileChangePage.php", $error);
    } else {
        $data = json_decode(file_get_contents("../database/orders.json"), true);
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]["email"] == $userdata["personaldata"]["email"]) {
                    $data[$i]["email"] = $email;
                }
            }
        }
        file_put_contents("../database/orders.json", json_encode($data, JSON_PRETTY_PRINT));

        $data = json_decode(file_get_contents("../database/cart.json"), true);
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]["email"] === $userdata["personaldata"]["email"]) {
                    $data[$i]["email"] = $email;
                }
            }
        }
        file_put_contents("../database/cart.json", json_encode($data, JSON_PRETTY_PRINT));

        $data = json_decode(file_get_contents("../database/deliverydetails.json"), true);
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]["email"] === $userdata["personaldata"]["email"]) {
                    $data[$i]["email"] = $email;
                }
            }
        }
        file_put_contents("../database/deliverydetails.json", json_encode($data, JSON_PRETTY_PRINT));

        $data = json_decode(file_get_contents("../database/profilepictures.json"), true);
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]["email"] === $userdata["personaldata"]["email"]) {
                    $data[$i]["email"] = $email;
                }
            }
        }
        file_put_contents("../database/profilepictures.json", json_encode($data, JSON_PRETTY_PRINT));

        $data = json_decode(file_get_contents("../database/users.json"), true);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]["email"] === $userdata["personaldata"]["email"] && $data[$i]["username"] === $userdata["personaldata"]["username"]) {
                $data[$i]["firstname"] = $firstname;
                $data[$i]["lastname"] = $lastname;
                $data[$i]["username"] = $username;
                $data[$i]["birthdate"] = $birthdate;
                $data[$i]["tel"] = $tel;
                $data[$i]["email"] = $email;
                $data[$i]["password"] = $password;
                $data[$i]["gender"] = $gender;
                $_SESSION["userdata"]["personaldata"] = $data[$i];
                header("Location: ../html/profileChangePage.php");
            }
        }
        file_put_contents("../database/users.json", json_encode($data, JSON_PRETTY_PRINT));


    }


}

?>