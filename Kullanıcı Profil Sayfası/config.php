<?php

$servername="localhost";
$username="root";
$password="Test";
$dbname="deneme";

//Bağlantı oluştur
$baglanti = new mysqli($servername, $username, $password, $dbname);

// bağlantıyı test et
if($baglanti->connect_error) {
    die("Bağlantı hatası:" . $baglanti->connect_error);
}else {
}
?>
