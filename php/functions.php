<?php
function emptyString($inputText)
{
    if (trim($inputText) == '') {
        return true;
    }
    return false;
}


//Megkap egy kulcsot, és egy szöveget amit keres egy fileban (users.json-ban)
function stringInFile($arrayKey, $stringToSearch)
{
    //Beolvassa a file tartalmát, és egy asszociatív tömbben eltárolja
    $data = json_decode(file_get_contents("../database/users.json"), true);
    if(empty($data)) return false;

    //Végigmegy a tömbön
    for ($i = 0; $i < count($data); $i++) {
        //Ha a tömb egy adott elemén lévő tömbben a kulcs értéke megegyezik a keresett szöveggel
        //visszaad igazat
        if ($data[$i] !== null && $data[$i][$arrayKey] === $stringToSearch) {
            return true;
        }
    }

    return false;
}

function errorOutput($link, $errors)
{
    $errorString = "error=";
    foreach ($errors as $key => $value) {
        if ($value) {
            $errorString = $errorString . $key . '_';
        }
    }

    $link = $link . '?' . $errorString;
    echo $link;
    print_r($errors);
    if ($errorString !== "error=") {
        header("Location: $link");
    }
}

function getProductNameById($productId) {
    $data = json_decode(file_get_contents("../database/products.json"), true);
    if(empty($productId)) return "A termék nincs raktáron";
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i] !== null && $data[$i]["id"] === $productId) {
            return $data[$i]["name"];
        }
    }
}

function getProductPriceById($productId) {
    $data = json_decode(file_get_contents("../database/products.json"), true);
    if(empty($productId)) return "A termék nincs raktáron";
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i] !== null && $data[$i]["id"] === $productId) {
            return $data[$i]["cost"];
        }
    }
}
?>