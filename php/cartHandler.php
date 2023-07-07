<?php
include_once("functions.php");
session_start();
if (!isset($_SESSION["userdata"]["personaldata"])) {
    header("Location: ../html/loginPage.php");
}

$userCartIndex;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] === "addItem") {
        addItemToCart();
    } else if ($_POST["action"] === "deleteItem") {
        deleteItemFromCart();
    } else if ($_POST["action"] === "orderItem") {
        orderItems();
    }
}



$postalcode;
$city;
$street;
$housenumber;
$tel;
$payment;
$comment;
function orderItems()
{
    $error = [
        'emptyCart' => false,
        'postalcode' => false,
        'city' => false,
        'street' => false,
        'housenumber' => false,
        'tel' => false,
        'payment' => false
    ];
    if (isset($_POST["postalcode"]) && trim($_POST["postalcode"]) !== '') {
        $postalcode = $_POST["postalcode"];
    } else {
        $error["postalcode"] = true;
    }

    if (isset($_POST["city"]) && trim($_POST["city"]) !== '') {
        $city = $_POST["city"];
    } else {
        $error["city"] = true;
    }

    if (isset($_POST["street"]) && trim($_POST["street"]) !== '') {
        $street = $_POST["street"];
    } else {
        $error["street"] = true;
    }

    if (isset($_POST["housenumber"]) && trim($_POST["housenumber"]) !== '') {
        $housenumber = $_POST["housenumber"];
    } else {
        $error["housenumber"] = true;
    }

    if (isset($_POST["tel"]) && trim($_POST["tel"]) !== '') {
        $tel = $_POST["tel"];
    } else {
        $error["tel"] = true;
    }

    if (isset($_POST["payment"]) && trim($_POST["payment"]) !== '') {
        $payment = $_POST["payment"];
    } else {
        $error["payment"] = true;
    }

    if (isset($_POST["comment"]) && trim($_POST["comment"]) !== '') {
        $comment = $_POST["comment"];
    } else {
        $comment = "";
    }

    if (in_array(true, $error)) {
        errorOutput("../html/cartPage.php", $error);
    } else {
        $data = json_decode(file_get_contents("../database/cart.json"), true);
        $index = -1;

        $previousOrders = json_decode(file_get_contents("../database/orders.json"), true);
        if (!empty($previousOrders)) {
            $orderId = count($previousOrders);
        } else {
            $orderId = 0;
        }

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
                $index = $i;
            }
        }
        //Ha üres a kosár kilép
        if(empty($data[$index]["products"])) {
            header("Location: ../html/webshopPage.php");
            exit();
        }

        $newOrder = [
            'orderId' => "0000" + $orderId + 1,
            'email' => $_SESSION["userdata"]["personaldata"]["email"],
            'postalcode' => $postalcode,
            'city' => $city,
            'street' => $street,
            'housenumber' => $housenumber,
            'tel' => $tel,
            'payment' => $payment,
            'comment' => $comment,
            'products' => $data[$index]["products"]
        ];


        $data[$index]["products"] = array();
        file_put_contents("../database/cart.json", json_encode($data, JSON_PRETTY_PRINT));

        $orders = json_decode(file_get_contents("../database/orders.json"), true);
        $orders[] = $newOrder;
        file_put_contents("../database/orders.json", json_encode($orders, JSON_PRETTY_PRINT));
        header("Location: ../html/cartPage.php");
    }
}
function getUsersCartIndex($cart)
{
    if (!empty($cart)) {
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]["email"] === $_SESSION["userdata"]["personaldata"]["email"]) {
                return $i;
            }
        }
    }

    return -1;
}

function deleteItemFromCart()
{
    $product = $_POST["product"];

    $cartContent = json_decode(file_get_contents("../database/cart.json"), true);
    $userCartIndex = getUsersCartIndex($cartContent);

    unset($cartContent[$userCartIndex]["products"][$product]);
    file_put_contents("../database/cart.json", json_encode($cartContent, JSON_PRETTY_PRINT));
    header("Location: ../html/cartPage.php");
}
function addItemToCart()
{
    if (isset($_SESSION["userdata"])) {
        $product = $_POST["product"];

        $cartContent = json_decode(file_get_contents("../database/cart.json"), true);
        $userCartIndex = getUsersCartIndex($cartContent);

        $cartContent[$userCartIndex]["products"][$product] += $_POST["count"];
        file_put_contents("../database/cart.json", json_encode($cartContent, JSON_PRETTY_PRINT));
        header("Location: ../html/webshopPage.php");
    } else {
        header("Location: ../html/loginPage.php");
    }
}
?>