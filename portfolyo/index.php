<?php
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $sifre = trim($_POST["sifre"]);


    if ($email === "admin@gmail.com" && $sifre === "admin") {

        $_SESSION["giris"] = true;
        $_SESSION["email"] = $email;

        header("Location: anasayfa.php");
        exit;
    }

    $stmt = $baglanti->prepare("SELECT * FROM kullanici WHERE TRIM(email)=? AND TRIM(sifre)=?");
    $stmt->bind_param("ss", $email, $sifre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        setcookie("email", $email, time() + 3600);
        $_SESSION["giris"] = true;
        $_SESSION["email"] = $email;

        header("Location: kanasayfa.php");
        exit;

    } else {
        echo "<script>alert('Hatalı E-Posta veya şifre!'); window.location.href='index.php';</script>";
        exit;
    }
}
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css" />
    <meta charset="utf-8">
    <title>Giriş Yap</title>
</head>
<body style="text-align:center;padding-top:50px;">

<form action="" method="post">
    <b>E-Posta:</b><br>
    <input type="text" name="email" required><br>
    <b>Parola:</b><br>
    <input type="password" name="sifre" required><br><br>
    <button type="submit" class="btn btn-outline-success">Giriş Yap</button>
    <button type="submit" onclick="window.location.href='index_yeni_kayit.php'" class="btn btn-outline-info">Yeni Kayıt Ekle</button>
</form>

</body>
</html>
