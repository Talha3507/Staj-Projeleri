<?php
    session_start();
    include("baglanti.php");

    if ($_SESSION["giris"] == sha1(md5("var")) && $_COOKIE["kullanici"] == "msb") {
        header("Location:cikis.php");
    }



?>

<!doctype html>
<html>
<head>
    <meta charset="utf8mb4">
    <title>Yönetim Ana Sayfa</title>
</head>
<body>

    <div style="text-align:center;">
        <a href="anasayfa.php">ANA SAYFA</a> - <a href="duzenleme.php?id=<?php echo $row['id']; ?>">KULLANICI DÜZENLE</a>
 - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="hizmetlerimiz.php">HİZMETLERİMİZ</a> - <a href="projelerimiz.php">PROJELERİMİZ</a> - <a href="index.php" onclick="if (!confirm ('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>

    <h2 style="text-align:center;"> Menüden Seçim Yapınız </h2>


</body>
</html>
