<?php
include "include/head.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['logmail'];
    $password = $_POST['logpass'];

    $email = mysqli_real_escape_string($db->link, $email);
    $password = mysqli_real_escape_string($db->link, $password);
    $password=md5($password);

    $query = "SELECT * FROM users WHERE email = '$email' AND sifra = '$password'";                                        // upit ka bazi
    $result = $db->select($query);

    if ($result != false) {
        $value = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);
        $sesija->setujem_sesiju('email', $email);
        header("location:index.php");


    }
    else{
        echo "Netacno uneti podatci, uopste ovo nisam sredjivao, jer kontam da cete se dobro ulogovati sa podacima iz radme fajla";
    }
}