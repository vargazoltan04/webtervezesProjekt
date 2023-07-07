<?php
session_start();
if (!isset($_SESSION["userdata"])) {
    header("Location: ../html/loginPage.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "deleteUser") {
    $email = $_SESSION["userdata"]["personaldata"]["email"];

    $data = json_decode(file_get_contents("../database/users.json"), true);
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] === $email) {
            array_splice($data, $i, 1);
        }
    }
    file_put_contents("../database/users.json", json_encode($data, JSON_PRETTY_PRINT));

    $data = json_decode(file_get_contents("../database/cart.json"), true);
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] === $email) {
            array_splice($data, $i, 1);
        }
    }
    file_put_contents("../database/cart.json", json_encode($data, JSON_PRETTY_PRINT));

    $data = json_decode(file_get_contents("../database/profilepictures.json"), true);
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] === $email) {
            array_splice($data, $i, 1);
        }
    }
    file_put_contents("../database/profilepictures.json", json_encode($data, JSON_PRETTY_PRINT));

    $data = json_decode(file_get_contents("../database/deliverydetails.json"), true);
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] === $email) {
            array_splice($data, $i, 1);
        }
    }
    file_put_contents("../database/deliverydetails.json", json_encode($data, JSON_PRETTY_PRINT));

    $data = json_decode(file_get_contents("../database/orders.json"), true);
    $index = array();
    if (!empty($data)) {
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]["email"] === $email) {
                $index[] = $i;

            }
        }
    }
    if (!empty($index)) {
        for ($i = count($index) - 1; $i >= 0; $i--) {
            array_splice($data, $index[$i], 1);
        }
    }
    file_put_contents("../database/orders.json", json_encode($data, JSON_PRETTY_PRINT));

    session_destroy();
    header("Location: ../index.php");
}
?>