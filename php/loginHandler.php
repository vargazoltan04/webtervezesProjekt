<?php
include_once("functions.php");
session_start();

if (isset($_SESSION["userdata"])) {
    header("Location: ../index.php");
}

$error = [
    "wrongCombination" => false,
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $data = json_decode(file_get_contents("../database/users.json"), true);
    if (!empty($data)) {
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]["email"] === $email && password_verify($password, $data[$i]["password"])) {
                $_SESSION["userdata"]["personaldata"] = $data[$i];
            } else {
                $error["wrongCombination"] = true;
                errorOutput("../html/loginPage.php", $error);
            }
        }

        $data = json_decode(file_get_contents("../database/profilepictures.json"), true);
        if (!empty($data) && isset($_SESSION["userdata"]["personaldata"])) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
                    $_SESSION["userdata"]["picture"] = $data[$i]["picture"];
                }
            }
        }

        $data = json_decode(file_get_contents("../database/deliverydetails.json"), true);
        if (!empty($data) && isset($_SESSION["userdata"]["personaldata"])) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
                    $_SESSION["userdata"]["deliverydetails"] = $data[$i];
                }
            }
        }
    } else {
        $error["wrongCombination"] = true;
        errorOutput("../html/loginPage.php", $error);
    }

    if (isset($_SESSION["userdata"])) {
        header("Location: ../index.php");
    }
}
?>