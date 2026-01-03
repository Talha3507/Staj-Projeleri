<?php
include("baglanti.php");

if(!isset($_GET["id"])) {
    die("Kullanıcı Bulunamadı!");
}

$id = intval($_GET["id"]);


$sorgu = $baglanti->prepare("SELECT * FROM kullanici WHERE id=?");
$sorgu->bind_param("i", $id);
$sorgu->execute();
$sonuc = $sorgu->get_result();
$k = $sonuc->fetch_assoc();

if (!$k) {
    die("Kullanıcı Bulunamadı!");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

      $kadi = $_POST["kullanici"];
      $email = $_POST["email"];
      $sifre = $_POST["sifre"];

      $guncelle = $baglanti->prepare("UPDATE kullanici SET kullanici=?, email=?, sifre=? WHERE id=?");
      $guncelle->bind_param("sssi", $kadi, $email, $sifre, $id);
      $guncelle->execute();

      header("Location: duzenleme.php");
      exit;
}
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css" />
    <meta charset="utf-8">
    <title>Kullanıcı Düzenle</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Kullanıcı Düzenle</h2>

    <div class="d-flex justify-content-center">


<form method="post">

    Kullanıcı Adı:<br>
    <input type="text" name="kullanici" value="<?= $k['kullanici'] ?>" required><br><br>

    E-Posta:<br>
    <input type="email" name="email" value="<?= $k['email'] ?>" required><br><br>

    Şifre:<br>
    <input type="password" name="sifre" value="<?= $k['sifre'] ?>" required><br><br>

    <div class="text-center mb-3">
    <button type="submit" class="btn btn-outline-primary">Düzenle</button>
    <button type="submit" onclick="window.Location.href='duzenleme.php'" class="btn btn-outline-dark">Vazgeç</button>
    </div>
  </div>
</div>
</form>

</body>
</html>
