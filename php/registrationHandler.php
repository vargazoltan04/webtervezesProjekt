<?php
include_once("functions.php");
session_start();

if (isset($_SESSION["userdata"])) {
    header("Location: ../index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [
        'empty' => false,
        'aszf' => false,
        'username' => false,
        'emailFormat' => false,
        'emailUsed' => false,
        'passwordNotEqual' => false,
        'passwordLength' => false
    ];

    if (!isset($_POST["first-name"]) || !isset($_POST["last-name"]) || !isset($_POST["username"]) || !isset($_POST["birthdate"]) || 
    !isset($_POST["gender"]) || !isset($_POST["tel"]) || !isset($_POST["email"]) || !isset($_POST["password1"]) || !isset($_POST["password2"])) {
        $error["empty"] = true;
    }
    if (empty($_POST["aszf"])) {
        $error["aszf"] = true;
    }

    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $username = $_POST['username'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (emptyString($first_name) || emptyString($last_name) || emptyString($username) || emptyString($birthdate) || 
    emptyString($gender) || emptyString($tel) || emptyString($email) || emptyString($password1) || emptyString($password2)) {
        $error["empty"] = true;
    }
    if ($password1 !== $password2) {
        $error["passwordNotEqual"] = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["emailFormat"] = true;
    }
    if (stringInFile("email", $email)) {
        $error["emailUsed"] = true;
    }
    if (stringInFile("username", $username)) {
        $error["username"] = true;
    }
    if (strlen($password1) < 8 || strlen($password2) < 8) {
        $error["passwordLength"] = true;
    }
    if (in_array(true, $error)) {
        errorOutput("../html/registrationPage.php", $error);
    } else {
        $newUser = [
            'firstname' => $first_name,
            'lastname' => $last_name,
            'username' => $username,
            'birthdate' => $birthdate,
            'gender' => $gender,
            'tel' => $tel,
            'email' => $email,
            'password' => password_hash($password1, PASSWORD_DEFAULT)
        ];
        $data = json_decode(file_get_contents("../database/users.json"), true);
        $data[] = $newUser;
        file_put_contents('../database/users.json', json_encode($data, JSON_PRETTY_PRINT));

        $newUserDeliveryDetails = [
            'email' => $email,
            'postalcode' => "",
            'city' => "",
            'street' => "",
            'housenumber' => "",
            'tel' => "",
            'payment' => ""
        ];
        $data = json_decode(file_get_contents("../database/deliverydetails.json"), true);
        $data[] = $newUserDeliveryDetails;
        file_put_contents('../database/deliverydetails.json', json_encode($data, JSON_PRETTY_PRINT));


        $newUserPicture = [
            'email' => $email,
            'picture' => "noprofilepicture.png"
        ];
        $data = json_decode(file_get_contents("../database/profilepictures.json"), true);
        $data[] = $newUserPicture;
        file_put_contents('../database/profilepictures.json', json_encode($data, JSON_PRETTY_PRINT));

        $newUserCart = [
            'email' => $email,
            'products' => array()
        ];
        $data = json_decode(file_get_contents("../database/cart.json"), true);
        $data[] = $newUserCart;
        file_put_contents('../database/cart.json', json_encode($data, JSON_PRETTY_PRINT));
        header("Location: ../html/loginPage.php");
    }


}
?>