<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("baglanti.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $kullanici = $baglanti->real_escape_string($_POST['kullanici']);
     $email = $baglanti->real_escape_string($_POST['email']);
     $sifre = $baglanti->real_escape_string($_POST['sifre']);

     $stmt = $baglanti->prepare("INSERT INTO kullanici (kullanici, email, sifre) VALUES (?, ?, ?)");
     $stmt->bind_param("sss", $kullanici, $email, $sifre);

     if ($stmt->execute()) {
         $stmt->close();
         header("Location: index.php?msg=Kayıt Eklendi");
         exit;
    } else {
        echo "Hata: " . $baglanti->error;
    }
}
?>

<!doctype html>
<html lang="tr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css" />
    <meta charset="utf-8">
    <title>Yeni Kayıt</title>
</head>
<body>
<div class="container mt-5">
<h2 class="text-center mb-4">Yeni Kullanıcı Ekle</h2>

<div class="d-flex justify-content-center">

<form method="post">
    <label>Kullanıcı Adı:</label><br>
    <input type="text" name="kullanici" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Şifre</label><br>
    <input type="password" name="sifre" required><br><br>

    <button type="submit" class="btn btn-outline-success">Kaydet</button>
    <button type="button" onclick="window.location.href='duzenleme.php'" class="btn btn-outline-danger">Geri Dön</button>
</form>

</div>
</div>

</body>
</html>
