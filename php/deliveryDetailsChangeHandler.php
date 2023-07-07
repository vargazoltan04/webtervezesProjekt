<?php
session_start();
if (!isset($_SESSION["userdata"]["personaldata"])) {
    header("Location: ../html/loginPage.php");
}
//Ebben a tömbben létre van hozva különféle error típusok, amik alapértelmezetten hamis értéket kapnak
//Ha valamilyen hiba keletkezik annak megfelelő kulcs értékét true-ra állítja
//Ha van true érték ebben, akkor nem kerül kiírásra fájlba a tartalom, hanem átirányítja a felhasználót
//ugyanarra az oldalra ahol volt, de az URL-be beírja az összes errort, hogy a frontend-en ezek megjeleníthetőek
//legyenek, és a felhasználó tudjon róla

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postalcode = $_POST["postalcode"];
    $city = $_POST["city"];
    $street = $_POST["street"];
    $housenumber = $_POST["housenumber"];
    $tel = $_POST["tel"];
    $payment;
    if (isset($_POST["payment"]) && trim($_POST["payment"]) !== '') {
        $payment = $_POST["payment"];
    }

    //beolvassa a profilképeket tartalmazó fájlt 
    //Fejléc: "email", "picture"
    $data = json_decode(file_get_contents("../database/deliverydetails.json"), true);
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
            //Módosítja az adott felhasználó profilképének nevét
            $newDeliveryData = [
                "email" => $_SESSION["userdata"]["personaldata"]["email"],
                "postalcode" => $postalcode,
                "city" => $city,
                "street" => $street,
                "housenumber" => $housenumber,
                "tel" => $tel,
                "payment" => $payment
            ];
            $data[$i] = $newDeliveryData;
            $_SESSION["userdata"]["deliverydetails"] = $newDeliveryData;
        }
    }

    //Kiírja fájlba a módosított adatokat
    file_put_contents("../database/deliverydetails.json", json_encode($data, JSON_PRETTY_PRINT));
    header("Location: ../html/profileChangePage.php");
}
?>