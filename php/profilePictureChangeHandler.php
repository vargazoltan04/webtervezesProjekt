<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["userdata"]["personaldata"])) {
    header("Location: ../html/loginPage.php");
}

//Ebben a tömbben létre van hozva különféle error típusok, amik alapértelmezetten hamis értéket kapnak
//Ha valamilyen hiba keletkezik annak megfelelő kulcs értékét true-ra állítja
//Ha van true érték ebben, akkor nem kerül kiírásra fájlba a tartalom, hanem átirányítja a felhasználót
//ugyanarra az oldalra ahol volt, de az URL-be beírja az összes errort, hogy a frontend-en ezek megjeleníthetőek
//legyenek, és a felhasználó tudjon róla
$error = [
    'imageType' => false
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["profile-picture"];

    //Itt állítódik true-ra az error tömbben a megfelelő kulcs, ha teljesül a feltétel
    if ($file["type"] != "image/png") {
        $error["imageType"] = true;
        errorOutput("../html/profileChangePage.php", $error);
    } else {

        //beolvassa a profilképeket tartalmazó fájlt 
        //Fejléc: "email", "picture"
        $data = json_decode(file_get_contents("../database/profilepictures.json"), true);
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
                    //Módosítja az adott felhasználó profilképének nevét
                    $data[$i]["picture"] = $file["name"];
                    $_SESSION["userdata"]["picture"] = $file["name"];

                    //A feltöltött képet elmenti a profilképes mappába
                    move_uploaded_file($_FILES["profile-picture"]["tmp_name"], "../pictures/profilepicture/" . $file["name"]);
                    header("Location: ../html/profileChangePage.php");
                }
            }
        }
        //Kiírja fájlba a módosított adatokat
        file_put_contents("../database/profilepictures.json", json_encode($data, JSON_PRETTY_PRINT));
    }


}
?>