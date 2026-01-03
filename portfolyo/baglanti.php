<?php
$baglanti = new mysqli("localhost","root","","deneme");
$baglanti->set_charset("utf8mb4");

if($baglanti->connect_error){
    die("Bağlantı hatası: " . $baglanti->connect_error);
}
